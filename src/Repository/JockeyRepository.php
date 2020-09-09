<?php

namespace App\Repository;

use App\Entity\Jockey;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Jockey|null find($id, $lockMode = null, $lockVersion = null)
 * @method Jockey|null findOneBy(array $criteria, array $orderBy = null)
 * @method Jockey[]    findAll()
 * @method Jockey[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JockeyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Jockey::class);
    }

    // /**
    //  * @return Jockey[] Returns an array of Jockey objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Jockey
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
