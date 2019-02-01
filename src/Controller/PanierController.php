<?php

namespace App\Controller;


use App\Entity\Page;

use App\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;




class PanierController extends AbstractController
{



    /**
     * @Route("/panier", name="panier")
     */
    public function Panier(SessionInterface $session):Response
    {


        $repo = $this->getDoctrine()->getRepository(Page::class);
        $footer = $repo->findFooter();
        $header = $repo->findHeader();

        return $this->render('panier/panier.html.twig',[
            'footer'=>$footer,
            'header'=>$header
        ]);

    }




    /**
     * @Route("/ajouter/{id}", name="ajouter")
     * @param SessionInterface $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function AjouterPanier(SessionInterface $session,Request $request,$id)
    {




        return $this->redirectToRoute('panier');
    }















}
