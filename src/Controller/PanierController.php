<?php

namespace App\Controller;


use App\Entity\ModelBas;
use App\Entity\ModelHaut;
use App\Entity\Accessoires;
use App\Entity\Tissu;
use App\Entity\Finitions;
use App\Service\CalculMontantCommande;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


class PanierController extends AbstractController
{


    /**
     * @Route("/panier/index", name="panier_index", methods={"GET","POST"})
     * @param SessionInterface $session
     * @return Response
     */
    public function index(SessionInterface $session): Response
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



        return $this->render('panier/index.html.twig', [
            'modelehaut'=>$modelehaut,
            'modelebas'=>$modelebas,
            'accessoires'=>$accessoires,
            'panierHaut'=> $session->get('panierHaut'),
            'panierBas'=> $session->get('panierBas'),
            'panierAccessoire' => $session->get('panierAccessoire')

          
        ]);
    }


    /********************/
    /* AJOUT MODÈLE HAUT
    ********************/


    //Ajoute un modèle haut dans le panier
    /**
     * @Route("/ajouter/modele_haut/{id}", name="add_panier_modele_haut", methods={"POST"})
     * @param $id
     * @param SessionInterface $session
     * @param Request $request
     * @param ModelHaut $modelehaut
     * @return Response
     */
    public function addPanierModeleHaut($id,SessionInterface $session, Request $request,ModelHaut $modelehaut):Response
    {

        // création session panierHaut
      if(!$session->has('panierHaut')) $session->set('panierHaut', array());
        $panierHaut = $session->get('panierHaut');



        //récupération du prix du tissu présent en session
        $prix_tissu = 0;
        foreach ($modelehaut->getTissu() as $tissu)
        {
            if($tissu->getNom() == $request->request->get('tissu')){
                $prix_tissu = $tissu->getPrix();
            }

        }



        // récupération du prix de la finition présente en session
        $prix_finition = 0;
        foreach ($modelehaut->getFinition() as $finitions)
        {
            if($finitions->getNom() == $request->request->get('finition')){
                $prix_finition = $finitions->getPrix();
            }

        }



        //calcul du prix du modèle haut
        $total_modele_haut = $modelehaut->getPrix() + $prix_tissu + $prix_finition;





        // session panierHaut
        $panierHaut[$id] =[
            'Nom'=>$modelehaut->getNom(),
            'Prix'=>$modelehaut->getPrix(),
            'tissu'=>$request->request->get('tissu'),
            'prix_tissu'=>$prix_tissu,
            'finition'=>$request->request->get('finition'),
            'prix_finition'=>$prix_finition,
            'total_modele_haut'=> $total_modele_haut
        ];



        $session->set('panierHaut', $panierHaut);


        // message flash
        $this->addFlash('success', 'modèle ajouté au panier');

        //redirection
        return $this->redirectToRoute('panier_index');

    }





     //Supprime un modèle haut du panier
    /**
     * @Route("/supprimer/modele_haut/{id}", name="delete_panier_modele_haut")
     * @param SessionInterface $session
     * @param $id
     * @return Response
     */
    public function deletepanier(SessionInterface $session, $id):Response
    {
        $panierHaut = $session->get('panierHaut');

        if(array_key_exists($id, $panierHaut))
        {
            unset($panierHaut[$id]);
            $session->set('panierHaut', $panierHaut);
        }
        $this->addFlash('danger', 'modéle supprimé');
       return $this->redirectToRoute('panier_index');

    }





    /*******************/
    /* AJOUT MODÈLE BAS
    ********************/


    /**
     * Ajoute un modèle bas dans le panier
     * @Route("/ajouter/modele_bas/{id}", name="add_panier_modele_bas", methods={"POST"})
     * @param $id
     * @param SessionInterface $session
     * @param Request $request
     * @param ModelBas $modelBas
     * @return Response
     */
    public function addPanierModelBas($id,SessionInterface $session, Request $request,ModelBas $modelBas):Response
    {

        if(!$session->has('panierBas')) $session->set('panierBas', array());
        $panierBas = $session->get('panierBas');

        $prix_tissu = 0 ;
        $prix_finition = 0 ;


        foreach ($modelBas->getTissu() as $tissu)
        {
            if($tissu->getNom() == $request->request->get('tissu')){
                $prix_tissu = $tissu->getPrix();
            }
        }

        foreach ($modelBas->getFinition() as $finitions)
        {
            if($finitions->getNom() == $request->request->get('finition')){
                $prix_finition = $finitions->getPrix();
            }
        }

        $total_modele_bas = $modelBas->getPrix() + $prix_finition + $prix_tissu;



        $panierBas[$id]=[
            'Nom' => $modelBas->getNom(),
            'Prix'=>$modelBas->getPrix(),
            'tissu'=>$request->request->get('tissu'),
            'prix_tissu'=>$prix_tissu,
            'finition'=>$request->request->get('finition'),
            'prix_finition'=>$prix_finition,
            'total_modele_bas' => $total_modele_bas
         ];





        $session->set('panierBas', $panierBas);

        $this->addFlash('success', 'modèle ajouté au panier');



        return $this->redirectToRoute('panier_index');

    }


    /**
     * Supprime un modèle bas du panier
     * @Route("/supprimer/modele_bas/{id}", name="delete_panier_modele_bas")
     * @param SessionInterface $session
     * @param $id
     * @return Response
     */
    public function deletePanierModelBas(SessionInterface $session, $id):Response
    {
        $panierBas = $session->get('panierBas');

        if(array_key_exists($id, $panierBas))
        {
            unset($panierBas[$id]);
            $session->set('panierBas', $panierBas);
        }
        $this->addFlash('danger', 'modéle supprimé');
        return $this->redirectToRoute('panier_index');

    }

    /*********************/
    /* AJOUT ACCESSOIRE
    **********************/


    /**
     * Ajoute un accessoire dans le panier
     * @Route("/ajoute/accessoire/{id}" , name="ajoute_panier_accessoire", methods={"POST"})
     * @param $id
     * @param SessionInterface $session
     * @param Request $request
     * @param Accessoires $accessoires
     * @return Response
     */
    public function addPanierAccessoire($id,SessionInterface $session, Request $request, Accessoires $accessoires):Response
    {
       if(!$session->has('panierAccessoire')) $session->set('panierAccessoire', array());
        $panierAccessoire = $session->get('panierAccessoire');

        $panierAccessoire[$id] = $request->request->get('quantite');


        $panierAccessoire[$id] =[
            'Nom'=>$accessoires->getNom(),
            'Prix'=>$accessoires->getPrix(),
            'quantite'=>$request->request->get('quantite'),
            'prix_total_accessoire'=>$accessoires->getPrix() * $request->request->get('quantite')
        ];



        $session->set('panierAccessoire', $panierAccessoire);






    
        $this->addFlash('success', 'accessoire ajouté au panier');

        return $this->redirectToRoute('panier_index');

    }





    /**
     * Supprime un accessoire du panier
     * @Route("/supprimer/accessoire/{id}", name="delete_panier_accessoire")
     * @param SessionInterface $session
     * @param $id
     * @return Response
     */
    public function deletePanierAccessoire(SessionInterface $session, $id):Response
    {
        $panierAccessoire = $session->get('panierAccessoire');

        if(array_key_exists($id, $panierAccessoire))
        {
            unset($panierAccessoire[$id]);
            $session->set('panierAccessoire', $panierAccessoire);
        }
        $this->addFlash('danger', 'accessoire supprimé');
        return $this->redirectToRoute('panier_index');

    }





















}

