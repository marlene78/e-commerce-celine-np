<?php

namespace App\Controller;

use App\Entity\Mensurations;

use App\Form\MensurationsType;
use App\Repository\MensurationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("user_mensuration/mensurations")
 */
class MensurationsController extends AbstractController
{


    /**
     * @Route("/new", name="mensurations_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $mensuration = new Mensurations();
      
        $form = $this->createForm(MensurationsType::class, $mensuration);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $mensuration->setUser($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mensuration);
            $entityManager->flush();

            return $this->redirectToRoute('fos_user_profile_show');
        }



        return $this->render('user_mensuration/mensurations/new.html.twig', [
            'mensuration' => $mensuration,
            'form' => $form->createView()
           
        ]);
    }

    /**
     * @Route("/{id}", name="mensurations_show", methods={"GET"})
     */
    public function show(Mensurations $mensuration): Response
    {
        

        return $this->render('user_mensuration/mensurations/show.html.twig', [
            'mensuration' => $mensuration,

      
        ]);
    }

    /**
     * @Route("/{id}/edit", name="mensurations_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Mensurations $mensuration): Response
    {
        $form = $this->createForm(MensurationsType::class, $mensuration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fos_user_profile_show', [
                'id' => $mensuration->getId(),
            ]);
        }

 

        return $this->render('user_mensuration/mensurations/edit.html.twig', [
            'mensuration' => $mensuration,
            'form' => $form->createView()
          
        ]);
    }

    /**
     * @Route("/{id}", name="mensurations_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Mensurations $mensuration): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mensuration->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mensuration);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fos_user_profile_show');
    }
}
