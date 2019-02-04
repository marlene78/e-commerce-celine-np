<?php

namespace App\Controller;

use App\Entity\Accessoires;
use App\Entity\Commande;
use App\Entity\Finitions;
use App\Entity\ModelBas;
use App\Entity\ModelHaut;
use App\Entity\Page;
use App\Entity\Tissu;
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

        $repoModelHaut = $this->getDoctrine()->getRepository(ModelHaut::class);
        $modelhaut = $repoModelHaut->findAll();



        $repoModelBas = $this->getDoctrine()->getRepository(ModelBas::class);
        $modelbas = $repoModelBas->findAll();



        $repoTissu = $this->getDoctrine()->getRepository(Tissu::class);
        $tissu =   $repoTissu->findAll();


        $repoFinition = $this->getDoctrine()->getRepository(Finitions::class);
        $finition = $repoFinition->findAll();


        $repoAccessoire = $this->getDoctrine()->getRepository(Accessoires::class);
        $accessoire=  $repoAccessoire->findAll();




        $repo = $this->getDoctrine()->getRepository(Page::class);
        $footer = $repo->findFooter();
        $header = $repo->findHeader();


        return $this->render('commande/commande.html.twig',[
            'footer' =>$footer,
            'header' =>$header,
            'createForm' => $form->createView(),
            'modelhaut'=>$modelhaut,
           'modelbas'=>$modelbas,
            'tissu'=> $tissu,
            'finition'=>$finition,
            'accessoire'=>$accessoire


        ]);
    }





}
