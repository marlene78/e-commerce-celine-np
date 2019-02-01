<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Page;
use App\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{

    /**
     * @Route("/commande", name="commande")
     */
    public function commande(Request $request):Response
    {
        $commande = new Commande();

        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){

            $commande = $form->getData();



        }


        $repo = $this->getDoctrine()->getRepository(Page::class);
        $footer = $repo->findFooter();
        $header = $repo->findHeader();


        return $this->render('commande/commande.html.twig',[
            'footer' =>$footer,
            'header' =>$header,
            'createForm' => $form->createView()

        ]);
    }



}
