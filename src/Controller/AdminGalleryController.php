<?php

namespace App\Controller;

use App\Entity\Gallery;
use App\Form\GalleryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class AdminArticlesController
 * @package App\Controller
 * @Route("/admin/admin_gallery/")
 */
class AdminGalleryController extends AbstractController
{


    /**
     * @Route("gallery", name="addgallery")
     */
    public function addGallery(Request $request): Response
    {
        $gallery = new Gallery();

        $form = $this->createForm(GalleryType::class,$gallery);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $gallery = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($gallery);
            $em->flush();
            $this->addFlash('success', "galerie ajouté");
            return $this->redirectToRoute('admin');
        }

        return $this->render('/admin/admin_gallery/index.html.twig', [
            'createForm'=>$form->createView()
        ]);
    }

    /**
     * @Route("gallery/delete/{id}")
     */
    public function deleteImage(Gallery $gallery)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($gallery);
        $em->flush();
        $this->addFlash('danger', "image supprimé");
        return $this->redirectToRoute('admin');

    }

}
