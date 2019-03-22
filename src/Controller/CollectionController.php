<?php

namespace App\Controller;



use App\Entity\ModelHaut;
use App\Entity\ModelBas;
use App\Entity\Accessoires;
use App\Entity\Tissu;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


/**
* @Route("/collection")
*/
class CollectionController extends AbstractController
{


    /**
     * @Route("/",name="collection_index")
     */
    public function affiche():Response
    {
      

        return $this->render('collection/index.html.twig');
    }





/***************/
/* MODÈLE HAUT
***************/


     ///Liste des modèles hauts
    /**
     * @Route("/modele_haut", name="modele_haut")
     * @param SessionInterface $session
     * @return Response
     */
   public function modelHaut(SessionInterface $session):Response
   {

    $repository = $this->getDoctrine()->getRepository(ModelHaut::class);
    $models = $repository->findAll();

       if($session->has('panierHaut')){
           $panierHaut = $session->get('panierHaut');
       } else{
           $panierHaut = false;
       }



    return $this->render('collection/modele_haut/modele_haut_liste.html.twig',[
        'models'=>$models,
        'panierHaut' =>$panierHaut
    ]);


   }


    /**
     * @Route("/modele_haut/{slug}", name="modele_haut_show")
     * @param $slug
     * @param SessionInterface $session
     * @return Response
     */
    public function modelHautShowOne($slug, SessionInterface $session):Response
    {
        $repo = $this->getDoctrine()->getRepository(ModelHaut::class);
        $model = $repo->findOneBySlug($slug);

        if($session->has('panierHaut')){
            $panierHaut = $session->get('panierHaut');
        } else{
            $panierHaut = false;
        }


        $modeles = $repo->findAll();


        return $this->render('collection/modele_haut/modele_haut_show.html.twig',[
            'modeles'=>$modeles,
            'model'=>$model,
            'panierHaut' =>$panierHaut

        ]);


    }


    //Permet de composer son modèle haut
    /**
     * @param $slug
     * @param ModelHaut $id
     * @return Response
     * @Route("/modele_haut/{slug}/commande" , name="modele_haut_commande")
     */
    public function modelHautCommande($slug, ModelHaut $id):Response
    {
        $repo = $this->getDoctrine()->getRepository(ModelHaut::class);
        $model = $repo->findOneBySlug($slug);





        $this->redirectToRoute('add_panier_modele_haut',[
            'id' => $id,

        ]);


        return $this->render('commande/commande_haut.html.twig',[
            'model' => $model
         
        ]);
    }







/***************/
/* MODÈLE BAS
***************/

    /**
     * Liste des Modèles bas
     * @Route("/modele_bas",name="modele_bas")
     * @param SessionInterface $session
     * @return Response
     */
   public function modelBas(SessionInterface $session):Response
   {

    $repository = $this->getDoctrine()->getRepository(ModelBas::class);
    $models = $repository->findAll();

       // vérifie si le modèle est dans le panier
       if($session->has('panierBas')){
           $panierBas = $session->get('panierBas');
       } else{
           $panierBas = false;
       }


    return $this->render('collection/modele_bas/modele_bas_liste.html.twig',[
        'models'=>$models,
        'panierBas' =>$panierBas
    ]);


   }


    /**
     * @Route("/modele_bas/{slug}", name="modele_bas_show")
     * @param $slug
     * @param SessionInterface $session
     * @return Response
     */
    public function modelBasShowOne($slug, SessionInterface $session):Response
    {
        $repo = $this->getDoctrine()->getRepository(ModelBas::class);
        $model = $repo->findOneBySlug($slug);
        $modeles = $repo->findAll();


        // vérifie si le modèle est dans la session
        if($session->has('panierBas')){
            $panierBas = $session->get('panierBas');
        } else{
            $panierBas = false;
        }




        return $this->render('collection/modele_bas/modele_bas_show.html.twig',[
           'modeles'=>$modeles,
           'model'=>$model,
            'panierBas'=>$panierBas
        ]);


    }


    /**
     * Permet de composer son modèle bas
     * @param $slug
     * @param ModelBas $id
     * @return Response
     * @Route("/modele_bas/{slug}/commande" , name="modele_bas_commande")
     */
    public function modelBasCommande($slug, ModelBas $id):Response
    {
        $repo = $this->getDoctrine()->getRepository(ModelBas::class);
        $model = $repo->findOneBySlug($slug);



        $this->redirectToRoute('add_panier_modele_bas',[
            'id' => $id
        ]);


        return $this->render('commande/commande_bas.html.twig',[
            'model' => $model
    
        ]);
    }














/***************/
/* ACCESSOIRES
***************/

    /**
     * @Route("/accessoires",name="accessoires")
     * @param SessionInterface $session
     * @return Response
     */
   public function accessoires(SessionInterface $session):Response
   {

    $repository = $this->getDoctrine()->getRepository(Accessoires::class);
    $accessoires = $repository->findAll();

       // vérifie si l'accessoire est dans le panier
       if($session->has('panierAccessoire')){
           $panierAccessoire = $session->get('panierAccessoire');
       } else{
           $panierAccessoire = false;
       }


    return $this->render('collection/accessoires/accessoires_liste.html.twig',[
        'accessoires'=>$accessoires,
        'panierAccessoire' =>$panierAccessoire
    ]);


   }


    /**
     * @Route("/accessoires/{slug}", name="accessoires_show")
     * @param $slug
     * @param SessionInterface $session
     * @return Response
     */
    public function accessoireShowOne($slug,SessionInterface $session):Response
    {
        $repo = $this->getDoctrine()->getRepository(Accessoires::class);
        $accessoire = $repo->findOneBySlug($slug);
        $accessoires = $repo->findAll();

        // vérifie si l'accessoire est dans le panier
        if($session->has('panierAccessoire')){
            $panierAccessoire = $session->get('panierAccessoire');
        } else{
            $panierAccessoire = false;
        }





        return $this->render('collection/accessoires/accessoire_show.html.twig',[
            'accessoires'=>$accessoires,
            'accessoire'=>$accessoire,
            'panierAccessoire '=>$panierAccessoire
        ]);


    }
















}
