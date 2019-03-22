<?php

namespace App\Repository;

use App\Entity\Accessoires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Accessoires|null find($id, $lockMode = null, $lockVersion = null)
 * @method Accessoires|null findOneBy(array $criteria, array $orderBy = null)
 * @method Accessoires[]    findAll()
 * @method Accessoires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccessoiresRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Accessoires::class);
    }

     public function findArrayAccessoire($array)
    {
        return $this->createQueryBuilder('a')
            ->Select('a')
            ->Where('a.id IN(:array)')
            ->setParameter('array', $array)
            ->getQuery()
            ->getResult()
            ;

    }

    // /**
    //  * @return Accessoires[] Returns an array of Accessoires objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Accessoires
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
