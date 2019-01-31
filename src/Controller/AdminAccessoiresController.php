<?php
/**
 * Created by PhpStorm.
 * User: marlene
 * Date: 2019-01-29
 * Time: 18:45
 */

namespace App\Controller;


use App\Entity\Accessoires;
use App\Form\AccessoiresType;
use App\Repository\AccessoiresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminAccessoiresController
 * @package App\Controller
 * @Route("/admin/admin_accessoires/")
 */
class AdminAccessoiresController extends AbstractController
{


    /**
     * @Route("accessoires_index", name="accessoires_index", methods={"GET"})
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Accessoires::class);
        $accessoires = $repo->findAll(); 

        return $this->render('admin/admin_accessoires/index.html.twig',[
            'accessoires' => $accessoires
        ]);
    }




    /**
     * @Route("new", name="accessoires_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $accessoire = new Accessoires();
        $form = $this->createForm(AccessoiresType::class, $accessoire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accessoire);
            $entityManager->flush();

            return $this->redirectToRoute('accessoires_index');
        }

        return $this->render('admin/admin_accessoires/new.html.twig', [
            'accessoire' => $accessoire,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("{id}/edit", name="accessoires_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Accessoires $accessoire): Response
    {
        $form = $this->createForm(AccessoiresType::class, $accessoire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/admin_accessoires/edit.html.twig', [
            'accessoire' => $accessoire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("{id}", name="accessoires_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Accessoires $accessoire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$accessoire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($accessoire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('accessoires_index');
    }














}