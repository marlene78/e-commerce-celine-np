<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 20/12/2018
 * Time: 16:20
 */

namespace App\Controller;


use App\Entity\User;
use App\Form\UserEditType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    /**
     * @param User $user
     * @param Request $request
     * @return Response
     * @Route("/user/edit/{id}")
     */
    public function updateUser(User $user, Request $request):Response
    {

        $editForm = $this->createForm(UserEditType::class,$user);

        $editForm->handleRequest($request);

        if($editForm->isSubmitted()&& $editForm->isValid())
        {
            $user = $editForm->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'félicitation tes informations ont été mise à jour');

        }

        return $this->render('user/edit.html.twig',[
            'editForm' =>$editForm->createView()
        ]);
    }


    /**
     * @Route("/user/delete/{id}" , name="user_delete"  ,methods={"DELETE"})
     */
    public function deleteUser(User $user, Request $request):Response
    {
        if($this->isCsrfTokenValid('delete' .$user->getId(), $request->request->get('_token')))
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
            $this->addFlash('success' , 'Votre compte a été supprimé');
        }
        return $this->redirectToRoute('fos_user_security_login');


    }






 
}