<?php
/**
 * Created by PhpStorm.
 * User: marlene
 * Date: 2019-03-12
 * Time: 17:28
 */

namespace App\Controller;



use App\Entity\User;
use App\Service\CalculMontantCommande;
use App\Service\StripeClient;
use Stripe\Customer;
use Stripe\Error\Card;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class StripeController extends AbstractController
{



    // système de paiement avec l'API Stripe
    /**
     * @param Request $request
     * @param StripeClient $stripeClient
     * @param CalculMontantCommande $calculMontantCommande
     * @param SessionInterface $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/ckeckout", name="ckeckout",  methods={"POST"})
     */
    public function checkout(Request $request, StripeClient $stripeClient,CalculMontantCommande $calculMontantCommande, SessionInterface $session)
    {



        $error = false;
        $token = $request->request->get('stripeToken');

        /**
         * @var User $user
         */
        $user = $this->getUser();


        try{

            \Stripe\Stripe::setApiKey("sk_test_Jpzi6iCF2HE2iLtDCzxspjUl");

            if(!$user->getCustomerId())
            {
                $customer = $stripeClient->createCustomer($user, $token, $user->getEmail());

            }else{
                $customer = $stripeClient->retrieveCustomer($user->getCustomerId());
            }



            \Stripe\Charge::create([
                "amount" =>  $calculMontantCommande->montantTotal($session)*100,
                "currency" => "eur",
                "customer" =>$customer,
                "description" => "Paiement provenant du site Celine-Np"
            ]);

            $user->setCustomerId($customer['id']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();


        }catch(  Card $exception){
            $error = $exception->getMessage();
        }

        if(!$error){
            $this->addFlash('success', "Paiement validé ! ");
            return $this->redirectToRoute('persist');
        }else{
            $this->addFlash('error' , $error);
            return $this->redirectToRoute('validation');
        }



    }




}