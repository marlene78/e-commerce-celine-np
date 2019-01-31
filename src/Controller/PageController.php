<?php

namespace App\Controller;

use App\Entity\Page;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/concept", name="concept")
     */
    public function concept():Response
    {
        $repo = $this->getDoctrine()->getRepository(Page::class);
        $page = $repo->find(5);
        $footer = $repo->findFooter();
        $header = $repo->findHeader();

        return $this->render('page/concept.html.twig',[
            'page'=>$page,
            'footer'=>$footer,
            'header'=>$header
        ]);
    }






    /**
     * @Route("/coaching", name="coaching")
     */
    public function coaching():Response
    {
        $repo = $this->getDoctrine()->getRepository(Page::class);
        $page = $repo->find(6);
        $footer = $repo->findFooter();
        $header = $repo->findHeader();

        return $this->render('page/coaching.html.twig',[
            'page'=>$page,
            'footer'=>$footer,
            'header'=>$header
        ]);
    }







    /**
     * @Route("/about", name="about")
     */
    public function about():Response
    {
        $repo = $this->getDoctrine()->getRepository(Page::class);
        $page = $repo->find(7);
        $footer = $repo->findFooter();
        $header = $repo->findHeader();

        return $this->render('page/about.html.twig',[
            'page'=>$page,
            'footer'=>$footer,
            'header'=>$header
        ]);
    }




    /**
     * @Route("/mon-compte", name="compte")
     */
    public function compte():Response
    {
        $repo = $this->getDoctrine()->getRepository(Page::class);
        $footer = $repo->findFooter();
        $header = $repo->findHeader();
        return $this->render('page/compte.html.twig',[
             'footer'=>$footer,
            'header'=>$header
        ]);
    }


    /**
     * @return Response
     * @Route("/creation" , name="creation")
     */
    public function creation():Response
    {
        $repo = $this->getDoctrine()->getRepository(Page::class);
        $page = $repo->find(13);
        $footer = $repo->findFooter();
        $header = $repo->findHeader();

        return $this->render('page/creation.html.twig',[
            'page' =>$page,
            'footer'=>$footer,
            'header'=>$header
        ]);

    }









/**************/
/*    FOOTER
*************/



    /**
     * @Route("/contact", name="contact")
     */
     public function contact():Response
     {
         $repo = $this->getDoctrine()->getRepository(Page::class);
         $page = $repo->find(8);
         $footer = $repo->findFooter();
         $header = $repo->findHeader();
         
         return $this->render('page/contact.html.twig',[
             'page'=>$page,
             'footer'=>$footer,
             'header'=>$header

         ]);
     }



    /**
     * @Route("/livraison" , name="livrision_et_retour")
     */
     public function livraison():Response
     {
         $repo = $this->getDoctrine()->getRepository(Page::class);
         $page = $repo->find(9);
         $footer = $repo->findFooter();
         $header = $repo->findHeader();

         return $this->render('page/livraison.html.twig',[
            'page'=>$page,
             'footer'=>$footer,
             'header'=>$header
         ]);
     }


    /**
     * @Route("/information", name="information")
     */
     public function information():Response
     {
        $repo = $this->getDoctrine()->getRepository(Page::class);
        $page = $repo->find(10);
        $footer = $repo->findFooter();
        $header = $repo->findHeader();

         return $this->render('page/information.html.twig',[
            'page'=>$page,
             'footer'=>$footer,
             'header'=>$header
         ]);
     }

    /**
     * @return Response
     * @Route("/mentions", name="mentions_legales")
     */
     public function mentions():Response
     {
        $repo = $this->getDoctrine()->getRepository(Page::class);
        $page = $repo->find(11);
        $footer = $repo->findFooter();
        $header = $repo->findHeader();

         return $this->render('page/mentions.html.twig',[
            'page'=>$page,
             'footer'=>$footer,
             'header'=>$header
         ]);
     }


    /**
     * @return Response
     * @Route("/politique" , name="politique_de_confidentialite")
     */
     public function politique():Response
     {
        $repo = $this->getDoctrine()->getRepository(Page::class);
        $page = $repo->find(12);
        $footer = $repo->findFooter();
        $header = $repo->findHeader();

         return $this->render('page/politique.html.twig',[
            'page'=>$page,
             'footer'=>$footer,
             'header'=>$header
         ]);

     }



}
