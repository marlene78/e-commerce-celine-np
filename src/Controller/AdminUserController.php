<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminUserController extends AbstractController
{



    /// Affiche l'ensemble des utilisateurs
    /**
     * @Route("/admin/user", name="admin_user")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(User::class);
        $user = $repo->findAll();


        return $this->render('admin/admin_user/index.html.twig', [
            'user'=>$user
        ]);
    }
}
