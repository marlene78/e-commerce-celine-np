<?php
/**
 * Created by PhpStorm.
 * User: marlene
 * Date: 2019-02-08
 * Time: 17:58
 */

namespace App\Repository;


use App\Entity\Mensurations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class MensurationsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Mensurations::class);
    }

}