<?php

namespace App\Repository;

use App\Entity\UserCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCommande[]    findAll()
 * @method UserCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCommandeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserCommande::class);
    }






    // /**
    //  * @return UserCommande[] Returns an array of UserCommande objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserCommande
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
