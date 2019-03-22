<?php

namespace App\Controller;

use App\Entity\Page;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PartialController extends AbstractController
{
    public function header()
    {
        $repository = $this->getDoctrine()->getRepository(Page::class);
        $header = $repository->findHeader();

        return $this->render('partial/header.html.twig', [
            'header'=>$header
        ]);
    }

    
    public function footer()
    {
        $repository = $this->getDoctrine()->getRepository(Page::class);
        $footer = $repository->findFooter();

        return $this->render('partial/footer.html.twig', [
            'footer'=>$footer
        ]);
    }
}
