<?php

namespace App\Repository;

use App\Entity\ParametreDate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ParametreDate|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParametreDate|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParametreDate[]    findAll()
 * @method ParametreDate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParametreDateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParametreDate::class);
    }

    // /**
    //  * @return ParametreDate[] Returns an array of ParametreDate objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ParametreDate
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
