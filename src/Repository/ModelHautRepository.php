<?php

namespace App\Repository;

use App\Entity\ModelHaut;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ModelHaut|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModelHaut|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModelHaut[]    findAll()
 * @method ModelHaut[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModelHautRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ModelHaut::class);
    }

    // /**
    //  * @return ModelHaut[] Returns an array of ModelHaut objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ModelHaut
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
