<?php

namespace App\Controller;


use App\Entity\Contact;
use App\Entity\Page;

use App\Form\ContactType;
use App\Notifications\ContactNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    

        return $this->render('page/concept.html.twig',[
            'page'=>$page
        ]);
    }






    /**
     * @Route("/coaching", name="coaching")
     */
    public function coaching():Response
    {
        $repo = $this->getDoctrine()->getRepository(Page::class);
        $page = $repo->find(6);
 

        return $this->render('page/coaching.html.twig',[
            'page'=>$page
    
        ]);
    }







    /**
     * @Route("/about", name="about")
     */
    public function about():Response
    {
        $repo = $this->getDoctrine()->getRepository(Page::class);
        $page = $repo->find(7);
 

        return $this->render('page/about.html.twig',[
            'page'=>$page
         
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
    

        return $this->render('page/creation.html.twig',[
            'page' =>$page
           
        ]);

    }









/**************/
/*    FOOTER
*************/


    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @param ContactNotification $contactNotification
     * @return Response
     */
     public function contact(Request $request, ContactNotification $contactNotification):Response
     {

         $repo = $this->getDoctrine()->getRepository(Page::class);
         $page = $repo->find(8);


         $contact = new Contact();
         $form = $this->createForm(ContactType::class, $contact);
         $form->handleRequest($request);
         if($form->isSubmitted() && $form->isValid())
         {
             $contactNotification->notify($contact);
             $this->addFlash('success', 'Votre message a été transmis');
         }


         
         return $this->render('page/contact.html.twig',[
             'page'=>$page,
             'createForm' => $form->createView()

         ]);
     }



    /**
     * @Route("/livraison" , name="livrision_et_retour")
     */
     public function livraison():Response
     {
         $repo = $this->getDoctrine()->getRepository(Page::class);
         $page = $repo->find(9);
   

         return $this->render('page/livraison.html.twig',[
            'page'=>$page
          
         ]);
     }


    /**
     * @Route("/information", name="information")
     */
     public function information():Response
     {
        $repo = $this->getDoctrine()->getRepository(Page::class);
        $page = $repo->find(10);
   

         return $this->render('page/information.html.twig',[
            'page'=>$page
           
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
    

         return $this->render('page/mentions.html.twig',[
            'page'=>$page
          
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
    

         return $this->render('page/politique.html.twig',[
            'page'=>$page
           
         ]);

     }



}
