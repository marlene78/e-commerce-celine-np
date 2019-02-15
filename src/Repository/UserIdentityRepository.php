<?php

namespace App\Repository;

use App\Entity\UserIdentity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserIdentity|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserIdentity|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserIdentity[]    findAll()
 * @method UserIdentity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserIdentityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserIdentity::class);
    }

    // /**
    //  * @return UserIdentity[] Returns an array of UserIdentity objects
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
    public function findOneBySomeField($value): ?UserIdentity
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
