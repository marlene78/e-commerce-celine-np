<?php

namespace App\Service;





use App\Entity\UserCommande;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SetNewReference extends AbstractController
{



    public function reference()
    {
        $repo = $this->getDoctrine()->getRepository(UserCommande::class);
        $reference = $repo->findOneBy(array('valider' =>1), array('id' => 'DESC'),1,1);

        if(!$reference)
        {
            return 1;
        }else
        {
            return $reference->getReference() +1 ;
        }
    }
}