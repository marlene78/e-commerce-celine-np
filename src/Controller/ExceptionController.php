<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 21/12/2018
 * Time: 10:56
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ExceptionController extends AbstractController
{

    /**
     * @return Response
     */
    public function notFound():Response
    {
        $response = new Response(404);
        return $this->render($response, 'errors/error404.twig');

    }


}