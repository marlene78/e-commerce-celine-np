<?php

namespace App\Controller;

use App\Entity\UserCommande;
use App\Form\UserCommandeType;
use App\Repository\UserCommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/commande")
 */
class AdminUserCommandeController extends AbstractController
{
    /**
     * @Route("/", name="user_commande_index", methods={"GET"})
     * @param UserCommandeRepository $userCommandeRepository
     * @return Response
     */
    public function index(UserCommandeRepository $userCommandeRepository): Response
    {
        return $this->render('admin/admin_user_commande/index.html.twig', [
            'user_commandes' => $userCommandeRepository->findAll(),
        ]);
    }







    /**
     * @Route("/{id}", name="user_commande_show", methods={"GET"})
     * @param UserCommande $userCommande
     * @return Response
     */
    public function show(UserCommande $userCommande): Response
    {
        return $this->render('admin/admin_user_commande/show.html.twig', [
            'user_commande' => $userCommande,
        ]);
    }





    

    /**
     * @Route("/{id}/edit", name="user_commande_edit", methods={"GET","POST"})
     * @param Request $request
     * @param UserCommande $userCommande
     * @return Response
     */
    public function edit(Request $request, UserCommande $userCommande): Response
    {
        $form = $this->createForm(UserCommandeType::class, $userCommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Commande mise à jour');
            return $this->redirectToRoute('admin');

        }

        return $this->render('admin/admin_user_commande/edit.html.twig', [
            'user_commande' => $userCommande,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_commande_delete", methods={"DELETE"})
     * @param Request $request
     * @param UserCommande $userCommande
     * @return Response
     */
    public function delete(Request $request, UserCommande $userCommande): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userCommande->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userCommande);
            $entityManager->flush();
        }
        $this->addFlash('danger', 'Commande supprimé');

        return $this->redirectToRoute('admin');
    }
}
