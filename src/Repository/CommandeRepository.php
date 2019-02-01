<?php
/**
 * Created by PhpStorm.
 * User: marlene
 * Date: 2019-01-31
 * Time: 21:04
 */

namespace App\Repository;


use App\Entity\Commande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


/**
 * Class CommandeRepository
 * @package App\Repository
 */
class CommandeRepository extends ServiceEntityRepository
{


    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Commande::class);
    }


}