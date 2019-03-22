<?php

namespace App\Controller;



use App\Entity\Accessoires;

use App\Entity\ModelBas;
use App\Entity\ModelHaut;
use App\Entity\UserCommande;
use App\Service\CalculMontantCommande;

use App\Service\SetNewReference;

use Spipu\Html2Pdf\Exception\ExceptionFormatter;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;



/**
 * Class AdminUserCommandeController
 * @package App\Controller
 * @Route("/user/commande")
 */
class UserCommandeController extends AbstractController
{

    // Renseignement des informations de livraison et mensuration
    /**
     * @Route("/", name="user_commande")
     *@return \Symfony\Component\HttpFoundation\Response
     * @IsGranted("ROLE_USER")
     */
    public function index()
    {
      


        // récupére l'utilisateur connecté
        $user = $this->getUser();




        return $this->render('user_commande/index.html.twig', [
            'user'=>$user


        ]);
    }




    // Template de validation commande

    /**
     * @Route("/validation" , name="validation")
     * @param SessionInterface $session
     * @return Response
     * @IsGranted("ROLE_USER")
     */
    public function UserCommandeValidation(SessionInterface $session):Response
    {





        // Contrôle si les sessions existe
        if(!$session->has('panierBas')) $session->set('panierBas', array());

        if(!$session->has('panierHaut')) $session->set('panierHaut', array());

        if(!$session->has('panierAccessoire')) $session->set('panierAccessoire', array());





        // récupération des modèles hauts en session
        $repo = $this->getDoctrine()->getRepository(ModelHaut::class);
        $modelehaut = $repo->findArrayHaut(array_keys($session->get('panierHaut')));



        // récupération des modèles bas en session
        $repo = $this->getDoctrine()->getRepository(ModelBas::class);
        $modelebas = $repo->findArrayBas(array_keys($session->get('panierBas')));


        // récupération quantité des accessoires en session
        $repo = $this->getDoctrine()->getRepository(Accessoires::class);
        $accessoires = $repo->findArrayAccessoire(array_keys($session->get('panierAccessoire')));






        return $this->render('user_commande/validation.html.twig',[
            'modelehaut'=>$modelehaut,
            'modelebas'=>$modelebas,
            'accessoires'=>$accessoires,
            'panierHaut'=> $session->get('panierHaut'),
            'panierBas'=> $session->get('panierBas'),
            'panierAccessoire' => $session->get('panierAccessoire')
           

        ]);


    }



    // Annulation de la commande

    /**
     * @Route("/delete", name="delete_Usercommande")
     * @param SessionInterface $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteUsercommande(SessionInterface $session)
    {

        $session->remove('Usercommande');
        $session->remove('panierHaut');
        $session->remove('panierBas');
        $session->remove('panierAccessoire');

        $this->addFlash('success', 'Commande annulé');

        return $this->redirectToRoute('home');
    }





    //Enregistrement de la commande en base

    /**
     * @Route("/persist", name="persist")
     * @param SessionInterface $session
     * @param SetNewReference $newReference
     * @param CalculMontantCommande $calculMontantCommande
     * @return Response
     */
    public function UserCommandePersist(SessionInterface $session, SetNewReference $newReference,CalculMontantCommande $calculMontantCommande):Response
    {


        $panierBas= $session->get('panierBas');

        $panierHaut = $session->get('panierHaut');

        $panierAccessoire = $session->get('panierAccessoire');



        if (!$session->has('Usercommande')) $session->set('Usercommande', array());



        $Usercommande = [
            'panierHaut' => $panierHaut,
            'panierBas' =>  $panierBas,
            'panierAccessoire' => $panierAccessoire


        ];

        $session->set('Usercommande', $Usercommande);


        $Usercommande = new UserCommande();

        // récupère l'utilisateur connecté
        $Usercommande->setUser($this->getUser());

        // génère une référence grâce au service SetNewReference
        $Usercommande->setReference($newReference->reference());

        $Usercommande->setValider(1);
        $Usercommande->setCommande($session->get('Usercommande'));
        $Usercommande->setTotal($calculMontantCommande->montantTotal($session));
        $Usercommande->setEtat('En cours de traitement');

        $em = $this->getDoctrine()->getManager();
        $em->persist($Usercommande);
        $em->flush();


        // suppression des sessions après le flush
        $session->remove('Usercommande');
        $session->remove('panierHaut');
        $session->remove('panierBas');
        $session->remove('panierAccessoire');

        $this->addFlash('sucess', 'Paiement validé');
        return $this->redirectToRoute('commande_show');




    }








    // Visualisation des commandes

    /**
     * @Route("/show ", name="commande_show" , methods={"GET"})
     * @return Response
     */
    public function UserCommandeShow()
    {

       $repo = $this->getDoctrine()->getRepository(UserCommande::class);
       $UserCommande = $repo->findAll();

       $user = $this->getUser();



       return $this->render('user_commande/user_commande_show.html.twig',[
           'UserCommande' => $UserCommande,
           'user'=>$user
       ]);
    }






    // Génération facture pdf html2pdf

    /**
     * @Route("/facture/{id}", name="facture")
     * @param $id
     * @return Response
     */
    public function facturePdf($id):Response
    {
        $user = $this->getUser();
        $repo = $this->getDoctrine()->getRepository(UserCommande::class);
        $UserCommande = $repo->findOneBy([
            'user'=> $user,
            'valider'=>1,
            'id'=>$id
        ]);



        try {
            ob_start();

            $html = $this->render('user_commande/facture.html.twig',[
                'UserCommande' =>$UserCommande,
                'user'=>$user

            ]);

            $html2pdf = new Html2Pdf('P', 'A4', 'fr');

            $html2pdf->writeHTML($html);
            $html2pdf->pdf->SetTitle('Facture');
            $html2pdf->pdf->SetDisplayMode('real');
            $html2pdf->output('facture.pdf');

        } catch (Html2PdfException $e) {
            $html2pdf->clean();
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }

        $response = new Response();
        $response->headers->set('Content-type', 'application/pdf');

        return $response;

    }

















}
