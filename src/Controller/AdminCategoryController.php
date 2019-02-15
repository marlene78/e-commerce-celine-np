<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 19/12/2018
 * Time: 16:16
 */

namespace App\Controller;



use App\Entity\Image;
use App\Entity\Tissu;
use App\Form\ImageType;
use App\Form\TissuType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminCategoryController
 * @package App\Controller
 * @Route("/admin/admin_category/")
 */
class AdminCategoryController extends AbstractController
{



/***********************/
/* GESTION DES IMAGES
**********************/

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("edition/image/{id}")
     */
    public function ImageEdition(Request $request,Image $image):Response
    {
        $form = $this->createForm(ImageType::class,$image);
        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid())
        {
            $image = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();
            $this->addFlash('success', 'image mis à jour');
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/admin_category/imageEdition.html.twig',[
            'createForm' =>$form->createView()
        ]);
    }







 /***********************/
 /* GESTION DES TISSUS
 **********************/



    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("addTissu", name="addTissu")
     */
    public function Tissuadd(Request $request):Response
    {
        $tissu = new Tissu();
        $form = $this->createForm(TissuType::class,$tissu);
        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid())
        {
            $tissu = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($tissu);
            $em->flush();
            $this->addFlash('success', 'le tissu a bien été ajouté');
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/admin_category/tissu.html.twig',[
            'createForm' =>$form->createView()
        ]);
    }

    /**
     * @Route("delete/tissu/{slug}")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @return Response
     */
    public function Tissudelete(Tissu $tissu):Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($tissu);
        $em->flush();
        $this->addFlash('danger', 'le tissu a bien été supprimé');
        return $this->redirectToRoute('admin');

    }


    /**
     * @Route("edition/tissu/{slug}")
     */
    public function Tissuedit(Tissu $tissu,Request $request):Response
    {
        $form = $this->createForm(TissuType::class,$tissu);
        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid())
        {
            $tissu = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($tissu);
            $em->flush();
            $this->addFlash('success', 'le tissu a bien été mis à jour');
            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/admin_category/tissuEdition.html.twig',[
            'createForm' =>$form->createView(), 
            'tissu' => $tissu
        ]);


    }



    /**
     * @Route("tissuliste", name="tissuliste")
     */
    public function Tissuliste():Response
    {
        $rep = $this->getDoctrine()->getRepository(Tissu::class);
        $tissus = $rep->findAll();

        return $this->render('admin/admin_category/tissuListe.html.twig',[
            'tissus'=>$tissus
        ]);

    }





















}