<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 20/12/2018
 * Time: 16:20
 */

namespace App\Controller;


use App\Entity\Contact;
use App\Entity\User;
use App\Form\ContactType;
use App\Form\UserEditType;
use App\Notifications\ContactNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{




    // Mise à jour des informations utilisateur : email, mot de passe
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





    // Suppression du compte
    /**
     * @Route("/user/delete/{id}" , name="user_delete"  ,methods={"DELETE"})
     * @param User $user
     * @param Request $request
     * @return Response
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




    // Envois Email depuis profil utilisateur

    /**
     * @Route("/user/contact",name="user_contact")
     * @param Request $request
     * @param ContactNotification $contactNotification
     * @return Response
     */
    public function UserContact(Request $request, ContactNotification $contactNotification)
    {



        $contact = new Contact();
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $contactNotification->notify($contact);
            $this->addFlash('success', 'Votre message a bien été envoyé');
            return $this->redirectToRoute('fos_user_profile_show');
        }

        return $this->render('/user/message.html.twig',[
            'createForm'=>$form->createView(),
          
        ]);
    }






 
}