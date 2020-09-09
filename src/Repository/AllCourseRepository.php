<?php

namespace App\Repository;

use App\Entity\AllCourse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AllCourse|null find($id, $lockMode = null, $lockVersion = null)
 * @method AllCourse|null findOneBy(array $criteria, array $orderBy = null)
 * @method AllCourse[]    findAll()
 * @method AllCourse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AllCourseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AllCourse::class);
    }

    // /**
    //  * @return AllCourse[] Returns an array of AllCourse objects
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
    public function findOneBySomeField($value): ?AllCourse
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
