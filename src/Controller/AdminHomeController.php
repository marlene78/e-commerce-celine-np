<?php
/**
 * Created by PhpStorm.
 * User: marlene
 * Date: 2019-01-08
 * Time: 16:06
 */

namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminHomeController extends AbstractController
{

    /**
     * @Route("/admin", name="admin")
     */
    public function index():Response
    {
       
        return $this->render('admin/index.html.twig');
    }



}