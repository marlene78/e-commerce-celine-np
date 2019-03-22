<?php

namespace App\Controller;

use App\Entity\Page;
use App\Form\PageType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminPageController
 * @package App\Controller
 * @Route("/admin/admin_page/")
 */
class AdminPageController extends AbstractController
{
    /**
     * @Route("pageListe", name="pageListe")
     */
    public function PageListe():Response
    {
        $repo = $this->getDoctrine()->getRepository(Page::class);
        $pages = $repo->findAll();

        return $this->render('admin/admin_page/pageListe.html.twig',[
            'pages'=>$pages
        ]);
    }



    /**
     * @Route("addPage", name="addPage")
     * @param Request $request
     * @return Response
     */
    public function Pageadd(Request $request):Response
    {
        $page = new Page();

        $form = $this->createForm(PageType::class, $page);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $page = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($page);
            $em->flush();
            $this->addFlash('succes', 'la page a bien été créer');
            return $this->redirectToRoute('admin');

        }

        return $this->render('admin/admin_page/pages.html.twig',[
            'createForm'=>$form->createView()
        ]);

    }



    /**
     * @Route("edition/{id}")
     *édition des pages du site sauf la page collection
     */
    public function PageEdition(Request $request, Page $page):Response
    {
       $form = $this->createForm(PageType::class,$page);
       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid())
       {
           $page = $form->getData();
           $em = $this->getDoctrine()->getManager();
           $em->persist($page);
           $em->flush();
           $this->addFlash('success', 'la page a bien été mise à jour');
           return $this->redirectToRoute('pageListe');

       }
       return $this->render('admin/admin_page/pageEdition.html.twig',[
           'createForm'=>$form->createView(),
          
       ]);

    }

    /**
     * @Route("page/{id}")
     * @param $id
     * @return Response
     */
    public function PageShow($id):Response
    {
        $rep = $this->getDoctrine()->getRepository(Page::class);
        $page = $rep->find($id);

        return $this->render('/admin/admin_page/pageShow.html.twig',[
           'page'=>$page,
        ]);

    }


}
