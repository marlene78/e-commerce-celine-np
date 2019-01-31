<?php

namespace App\Repository;

use App\Entity\ModelBas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ModelBas|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModelBas|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModelBas[]    findAll()
 * @method ModelBas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModelBasRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ModelBas::class);
    }

    // /**
    //  * @return ModelBas[] Returns an array of ModelBas objects
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
    public function findOneBySomeField($value): ?ModelBas
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
