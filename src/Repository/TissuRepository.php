<?php

namespace App\Repository;

use App\Entity\Tissu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tissu|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tissu|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tissu[]    findAll()
 * @method Tissu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TissuRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tissu::class);
    }

    // /**
    //  * @return Tissu[] Returns an array of Tissu objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tissu
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
