<?php
/**
 * Created by PhpStorm.
 * User: marlene
 * Date: 2019-03-14
 * Time: 18:14
 */

namespace App\Service;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Customer;
use Stripe\Stripe;

class StripeClient extends Stripe
{


    /**
     * @var
     */
   private $entity_manager_interface;



   public function __construct(EntityManagerInterface $entityManager)
   {
       $this->entity_manager_interface = $entityManager;
   }


    /**
     * @param User $user
     * @param $paymentToken
     * @param null $email
     * @return \Stripe\ApiResource
     */
    public function createCustomer(User $user, $paymentToken, $email = null)
    {
        $customer = Customer::create([
            'source' => $paymentToken,
            'email' =>$email
        ]);

        $user->setCustomerId($customer->id);

        $this->entity_manager_interface->persist($user);
        $this->entity_manager_interface->flush();

        return $customer;
    }


    /**
     * @param string $customerId
     * @return \Stripe\StripeObject
     */
    public function retrieveCustomer(string $customerId){

        return  \Stripe\Customer::retrieve($customerId);
    }



}