<?php

namespace App\Repository;

use App\Entity\Finitions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Finitions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Finitions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Finitions[]    findAll()
 * @method Finitions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FinitionsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Finitions::class);
    }

    // /**
    //  * @return Finitions[] Returns an array of Finitions objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Finitions
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
