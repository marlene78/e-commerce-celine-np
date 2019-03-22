<?php

namespace App\Controller;

use App\Entity\Finitions;
use App\Form\FinitionsType;
use App\Repository\FinitionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/admin_finitions")
 */
class AdminFinitionsController extends AbstractController
{
    /**
     * @Route("/finition_index", name="finitions_index", methods={"GET"})
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Finitions::class);
        $finitions = $repo->findAll(); 

        return $this->render('admin/admin_finitions/index.html.twig',[
            'finitions' => $finitions
        ]);
    }

    /**
     * @Route("/new", name="finitions_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $finition = new Finitions();
        $form = $this->createForm(FinitionsType::class, $finition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($finition);
            $entityManager->flush();
            $this->addFlash('success', 'finition ajouté');

            return $this->redirectToRoute('finitions_index');
        }

        return $this->render('admin/admin_finitions/new.html.twig', [
            'finition' => $finition,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{slug}/edit", name="finitions_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Finitions $finition): Response
    {
        $form = $this->createForm(FinitionsType::class, $finition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'finition mis à jour');

            return $this->redirectToRoute('finitions_index');
        }

        return $this->render('admin/admin_finitions/edit.html.twig', [
            'finition' => $finition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="finitions_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Finitions $finition): Response
    {
        if ($this->isCsrfTokenValid('delete'.$finition->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($finition);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin');
    }
}
