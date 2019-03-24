<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Page;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class AdminArticlesController
 * @package App\Controller
 * @Route("/admin/admin_articles/")
 */
class AdminArticlesController extends AbstractController
{
    /**
     * @Route("addarticle", name="addarticle")
     */
    public function addArticle(Request $request): Response
    {
        $article = new Articles();

        $form = $this->createForm(ArticleType::class,$article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
           $article = $form->getData();
           $em = $this->getDoctrine()->getManager();
           $em->persist($article);
           $em->flush();
           $this->addFlash('success', " L' article a bien été ajouté");
           return $this->redirectToRoute('pageListe');
        }

        return $this->render('admin/admin_articles/index.html.twig', [
           'createForm'=>$form->createView(),
          
        ]);
    }


    /**
     * @Route("edition/{id}")
     * @param Request $request
     * @param Articles $article
     * @return Response
     */
    public function articleEdition(Request $request, Articles $article):Response
    {

        $form = $this->createForm(ArticleType::class,$article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
           $article = $form->getData();
           $em = $this->getDoctrine()->getManager();
           $em->persist($article);
           $em->flush();
           $this->addFlash('success', "L' article a bien été mis à jour");
           return $this->redirectToRoute('pageListe');
        }

        return $this->render('admin/admin_articles/articleEdition.html.twig', [
           'createForm'=>$form->createView(),
           'article'=>$article
        ]);

    }



    /**
     * @Route("delete/{id}")
     */
    public function articleDelete(Articles $article):Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();
        $this->addFlash('danger', "L' article a bien été supprimé");
        return $this->redirectToRoute('pageListe');

    }






}
