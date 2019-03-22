<?php
/**
 * Created by PhpStorm.
 * User: marlene
 * Date: 2019-03-16
 * Time: 22:34
 */

namespace App\Service;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CalculMontantCommande extends AbstractController
{




    public function montantTotal(SessionInterface $session)
   {

       $panierAccessoire =$session->get('panierAccessoire');
       $panierB =$session->get('panierBas');
       $panierH = $session->get('panierHaut');




       $total_Accessoire = 0;
     
       foreach ($panierAccessoire as $key => $accessoires)
       {
          
           $total_Accessoire += $accessoires['prix_total_accessoire'] ;


       }




       $totalb = 0;
       foreach ($panierB as $key =>$modele_bas)
       {
           $totalb += $modele_bas['total_modele_bas'];

       }




       $totalh = 0;
       foreach ($panierH as $key =>$modele_haut)
       {
           $totalh += $modele_haut['total_modele_haut'];

       }



       $Montant_Final =   $total_Accessoire +   $totalb + $totalh;



       return $Montant_Final;










   }










}