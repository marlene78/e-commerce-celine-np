<?php

namespace App\Controller;

use App\Entity\Page;
use App\Entity\Panier;
use App\Form\PanierType;
use App\Repository\PanierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/panier")
 */
class PanierController extends AbstractController
{



    /**
     * @Route("/", name="panier_index", methods={"GET","POST"})
     */
    public function index(PanierRepository $panierRepository, SessionInterface $session, Request $request): Response
    {
        $repo = $this->getDoctrine()->getRepository(Page::class);
        $footer = $repo->findFooter();
        $header = $repo->findHeader();


        // récupération de la session commande

        $session->get('commande');
        $session = $request->request->all();
        var_dump($session);



        return $this->render('panier/index.html.twig', [
            'paniers' => $panierRepository->findAll(),
            'header' => $header,
            'footer' => $footer
        ]);
    }

















/////////////////////////////////////////////


    /**
     * @Route("/{id}", name="panier_show", methods={"GET"})
     */
  /*  public function show(Panier $panier): Response
    {
        $repo = $this->getDoctrine()->getRepository(Page::class);
        $footer = $repo->findFooter();
        $header = $repo->findHeader();
        return $this->render('panier/show.html.twig', [
            'panier' => $panier,
            'header' => $header,
            'footer' => $footer
        ]);
    }

    /**
     * @Route("/{id}/edit", name="panier_edit", methods={"GET","POST"})
     */
   /* public function edit(Request $request, Panier $panier): Response
    {
        $form = $this->createForm(PanierType::class, $panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('panier_index', [
                'id' => $panier->getId(),
            ]);
        }
        $repo = $this->getDoctrine()->getRepository(Page::class);
        $footer = $repo->findFooter();
        $header = $repo->findHeader();

        return $this->render('panier/edit.html.twig', [
            'panier' => $panier,
            'form' => $form->createView(),
            'footer' => $footer,
            'header' => $header
        ]);
    }

    /**
     * @Route("/{id}", name="panier_delete", methods={"DELETE"})
     */
 /*   public function delete(Request $request, Panier $panier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$panier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($panier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('panier_index');
    }





 */
}

