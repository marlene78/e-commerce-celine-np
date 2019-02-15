<?php

namespace App\Controller;


use App\Entity\Page;
use App\Entity\ModelHaut;
use App\Entity\ModelBas;
use App\Entity\Accessoires;
use App\Form\ModelHautType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
   * @Route("/modele_haut", name="modele_haut")
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
     * @Route("/modele_haut/{slug}", name="modele_haut_show")
     * @param $slug
     * @return Response
     */
    public function modelHautShowOne($slug):Response
    {
        $repo = $this->getDoctrine()->getRepository(ModelHaut::class);
        $model = $repo->findOneBySlug($slug); 
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



    /**
     * @Route("/modele_haut/{slug}/commande", name="model_haut_commande")
     */
    public function ModelHautCommande(ModelHaut $model, Request $request):Response
    {
        $form = $this->createForm(ModelHautType::class,$model);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $form->getData();
            /*$em = $this->getDoctrine()->getManager();
            $em->persist($model);
            $em->flush();
            */
            $this->addFlash('success','le modèle a été ajouté au panier');


        }
        return $this->render('collection/modele_haut/modele_haut_commande.html.twig',[
            'createForm'=>$form->createView(),
            'model'=>$model

        ]);



    }




    /***************/
/* MODÈLE BAS
***************/

   /**
   *@Route("/modele_bas",name="modele_bas")
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
     * @Route("/modele_bas/{slug}", name="modele_bas_show")
     * @param $slug
     * @return Response
     */
    public function modelBasShowOne($slug):Response
    {
        $repo = $this->getDoctrine()->getRepository(ModelBas::class);
        $model = $repo->findOneBySlug($slug);
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
   *@Route("/accessoires",name="accessoires")
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
     * @Route("/accessoires/{slug}", name="accessoires_show")
     * @param $slug
     * @return Response
     */
    public function accessoireShowOne($slug):Response
    {
        $repo = $this->getDoctrine()->getRepository(Accessoires::class);
        $accessoire = $repo->findOneBySlug($slug);
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
