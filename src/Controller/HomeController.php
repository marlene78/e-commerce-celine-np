<?php

namespace App\Controller;


use App\Entity\Page;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index():Response
    {
       

        $repository =$this->getDoctrine()->getRepository(Page::class);
        $page = $repository->find(4);;
        $footer = $repository->findFooter();
        $header = $repository->findHeader();

        return $this->render('home/index.html.twig',[
         
            'page'=>$page, 
            'footer'=>$footer,
            'header'=>$header
        ]);
    }


















}
