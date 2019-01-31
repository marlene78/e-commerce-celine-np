<?php

namespace App\Controller;


use App\Entity\Page;
use App\Entity\ModelHaut;
use App\Entity\ModelBas;
use App\Entity\Accessoires;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
* @Route("/collection")
*/
class CollectionController extends AbstractController
{


    /**
     * @Route("/collection_index",name="collection_index")
     */
    public function affiche():Response
    {
      
        $repository = $this->getDoctrine()->getRepository(Page::class);
        $footer = $repository->findFooter();
        $header = $repository->findHeader();

        return $this->render('collection/index.html.twig', [
    
            'footer'=>$footer,
            'header'=>$header
        ]);
    }





/***************/
/* MODÈLE HAUT
***************/

   /**
   * @Route("/modele_haut/modele_haut_liste", name="modele_haut")
   */
   public function modelHaut():Response
   {

    $repository = $this->getDoctrine()->getRepository(ModelHaut::class);
    $models = $repository->findAll(); 

    $repo = $this->getDoctrine()->getRepository(Page::class);
    $footer = $repo->findFooter();
    $header = $repo->findHeader();

    return $this->render('collection/modele_haut/modele_haut_liste.html.twig',[
        'models'=>$models,
        'footer'=>$footer,
        'header'=>$header
    ]);


   }


    /**
     * @Route("/modele_haut/modele_haut_show/{id}", name="modele_haut_show")
     * @param $id
     * @return Response
     */
    public function modelHautShowOne($id):Response
    {
        $repo = $this->getDoctrine()->getRepository(ModelHaut::class);
        $model = $repo->find($id); 
        $modeles = $repo->findAll();

        $repository = $this->getDoctrine()->getRepository(Page::class);
        $footer = $repository->findFooter();
        $header = $repository->findHeader();

        return $this->render('collection/modele_haut/modele_haut_show.html.twig',[
           'modeles'=>$modeles,
            'model'=>$model,
           'footer'=>$footer,
           'header'=>$header
        ]);


    }



/***************/
/* MODÈLE BAS
***************/

   /**
   *@Route("/modele_bas/modele_bas_liste",name="modele_bas")
   */
   public function modelBas():Response
   {

    $repository = $this->getDoctrine()->getRepository(ModelBas::class);
    $models = $repository->findAll(); 

    $repo = $this->getDoctrine()->getRepository(Page::class);
    $footer = $repo->findFooter();
    $header = $repo->findHeader();

    return $this->render('collection/modele_bas/modele_bas_liste.html.twig',[
        'models'=>$models,
        'footer'=>$footer,
        'header'=>$header
    ]);


   }



    /**
     * @Route("/modele_bas/modele_bas_show/{id}", name="modele_bas_show")
     * @param $id
     * @return Response
     */
    public function modelBasShowOne($id):Response
    {
        $repo = $this->getDoctrine()->getRepository(ModelBas::class);
        $model = $repo->find($id); 
        $modeles = $repo->findAll();


        $repository = $this->getDoctrine()->getRepository(Page::class);
        $footer = $repository->findFooter();
        $header = $repository->findHeader();

        return $this->render('collection/modele_bas/modele_bas_show.html.twig',[
           'modeles'=>$modeles,
           'model'=>$model,
           'footer'=>$footer,
           'header'=>$header
        ]);


    }









/***************/
/* ACCESSOIRES
***************/

   /**
   *@Route("/accessoires/accessoires_liste",name="accessoires")
   */
   public function accessoires():Response
   {

    $repository = $this->getDoctrine()->getRepository(Accessoires::class);
    $accessoires = $repository->findAll(); 

    $repo = $this->getDoctrine()->getRepository(Page::class);
    $footer = $repo->findFooter();
    $header = $repo->findHeader();

    return $this->render('collection/accessoires/accessoires_liste.html.twig',[
        'accessoires'=>$accessoires,
        'footer'=>$footer,
        'header'=>$header
    ]);


   }



    /**
     * @Route("/accessoires/accesoires_show/{id}", name="accessoires_show")
     * @param $id
     * @return Response
     */
    public function accessoireShowOne($id):Response
    {
        $repo = $this->getDoctrine()->getRepository(Accessoires::class);
        $accessoire = $repo->find($id);
        $accessoires = $repo->findAll(); 

        $repository = $this->getDoctrine()->getRepository(Page::class);
        $footer = $repository->findFooter();
        $header = $repository->findHeader();

        return $this->render('collection/accessoires/accessoire_show.html.twig',[
            'accessoires'=>$accessoires,
            'accessoire'=>$accessoire,
           'footer'=>$footer,
           'header'=>$header
        ]);


    }












}
