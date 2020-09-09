<?php

namespace App\Repository;

use App\Entity\SelectionPress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SelectionPress|null find($id, $lockMode = null, $lockVersion = null)
 * @method SelectionPress|null findOneBy(array $criteria, array $orderBy = null)
 * @method SelectionPress[]    findAll()
 * @method SelectionPress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SelectionPressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SelectionPress::class);
    }

    // /**
    //  * @return SelectionPress[] Returns an array of SelectionPress objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SelectionPress
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
