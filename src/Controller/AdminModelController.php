<?php

namespace App\Controller;

use App\Form\ModelHautType;
use App\Form\ModelBasType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ModelHaut;
use App\Entity\ModelBas;





/**
 * Class AdminPageController
 * @package App\Controller
 * @Route("/admin/admin_model/")
 */
class AdminModelController extends AbstractController
{


    /**
     * @Route("model", name="model")
     */
    public function index()
    {
        return $this->render('admin/admin_model/index.html.twig');
    }




/***************/
/* MODÈLE HAUT
***************/


	/**
	* @Route("haut/model_liste", name="model_haut_liste")
	*/
	public function ModelListeHaut()
	{
		$repo = $this->getDoctrine()->getRepository(ModelHaut::class); 
		$models = $repo->findAll();

		return $this->render('admin/admin_model/haut/model_liste.html.twig',[
			'models'=>$models
		]); 
	}

    /**
     * @Route("haut/modeladd", name="model_haut_add")
     * @param Request $request
     * @return Response
     */
	public function ModelAddHaut(Request $request):Response
    {
        $model = new ModelHaut();
        $form = $this->createForm(ModelHautType::class, $model);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($model);
            $em->flush();
            $this->addFlash('success','le modèle a bien été ajouté');
            return $this->redirectToRoute('model_haut_liste');
        }
        return $this->render('admin/admin_model/haut/model_add.html.twig',[
            'createForm'=>$form->createView()
        ]);

    }



    /**
     * @Route("haut/edition/{id}", name="model_haut_edit")
     */
    public function ModelEditionHaut(ModelHaut $model, Request $request):Response
    {
        $form = $this->createForm(ModelHautType::class,$model);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($model);
            $em->flush();
            $this->addFlash('success','le modèle a bien été ajouté');
            return $this->redirectToRoute('admin');

        }
        return $this->render('admin/admin_model/haut/model_haut_edit.html.twig',[
            'createForm'=>$form->createView(),
            'model'=>$model
          
        ]);



    }


    /**
     * @Route("haut/delete/{id}")
     * @param ModelHaut $model
     * @return Response
     */
    public function ModelDeleteHaut(ModelHaut $model):Response
    {
       $em = $this->getDoctrine()->getManager();
       $em->remove($model);
       $em->flush();
        $this->addFlash('danger', 'le modèle a été supprimé');

        return $this->redirectToRoute('model_haut_liste');
    }






/***************/
/* MODÈLE BAS
***************/


    /**
    * @Route("bas/model_liste", name="model_bas_liste")
    */
    public function ModelListeBas()
    {
        $repo = $this->getDoctrine()->getRepository(ModelBas::class); 
        $models = $repo->findAll();

        return $this->render('admin/admin_model/bas/model_liste.html.twig',[
            'models'=>$models
        ]); 
    }

    /**
     * @Route("bas/modeladd", name="model_bas_add")
     * @param Request $request
     * @return Response
     */
    public function ModelAddBas(Request $request):Response
    {
        $model = new ModelBas();
        $form = $this->createForm(ModelBasType::class, $model);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($model);
            $em->flush();
            $this->addFlash('success','le modèle a bien été ajouté');
            return $this->redirectToRoute('model_bas_liste');
        }
        return $this->render('admin/admin_model/bas/model_add.html.twig',[
            'createForm'=>$form->createView()
        ]);

    }



    /**
     * @Route("bas/edition/{id}", name="model_bas_edit")
     */
    public function ModelEditionBas(ModelBas $model, Request $request):Response
    {
        $form = $this->createForm(ModelBasType::class,$model);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($model);
            $em->flush();
            $this->addFlash('success','le modèle a bien été ajouté');
            return $this->redirectToRoute('admin');

        }
        return $this->render('admin/admin_model/bas/model_bas_edit.html.twig',[
            'createForm'=>$form->createView()
        ]);



    }


    /**
     * @Route("bas/delete/{id}")
     * @param Modelbas $model
     * @return Response
     */
    public function ModelDeleteBas(ModelBas $model):Response
    {
       $em = $this->getDoctrine()->getManager();
       $em->remove($model);
       $em->flush();
        $this->addFlash('danger', 'le modèle a été supprimé');

        return $this->redirectToRoute('model_bas_liste');
    }









}




