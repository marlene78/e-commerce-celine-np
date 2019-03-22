<?php

namespace App\Controller;


use App\Entity\UserIdentity;

use App\Form\UserIdentityType;
use App\Repository\UserIdentityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/identity")
 */
class UserIdentityController extends AbstractController
{

    // Création de son profil
    /**
     * @Route("/new", name="user_identity_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $userIdentity = new UserIdentity();
     
        $form = $this->createForm(UserIdentityType::class, $userIdentity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $userIdentity->setUser($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userIdentity);
            $entityManager->flush();

            $this->addFlash('success', 'profil créer');
            return $this->redirectToRoute('fos_user_profile_show');
        }



        return $this->render('user_identity/new.html.twig', [
            'user_identity' => $userIdentity,
            'form' => $form->createView()
        ]);
    }


    // Visualisation du profil
    /**
     * @Route("/{id}", name="user_identity_show", methods={"GET"})
     */
    public function show(UserIdentity $userIdentity): Response
    {
       


        return $this->render('user_identity/show.html.twig', [
            'user_identity' => $userIdentity
        ]);
    }

    // Édition du profil

    /**
     * @Route("/{id}/edit", name="user_identity_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserIdentity $userIdentity): Response
    {
        $form = $this->createForm(UserIdentityType::class, $userIdentity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();


            $this->addFlash('success', 'profil mis à jour');
    
            return $this->redirectToRoute('fos_user_profile_show', [
                'id' => $userIdentity->getId(),
            ]);
        }

 

        return $this->render('user_identity/edit.html.twig', [
            'user_identity' => $userIdentity,
            'form' => $form->createView()
        
        ]);
    }


    // Suppression du profil

    /**
     * @Route("/{id}", name="user_identity_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UserIdentity $userIdentity): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userIdentity->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userIdentity);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fos_user_profile_show');
    }
}
