<?php

namespace App\Repository;

use App\Entity\SpecialisteChoice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SpecialisteChoice|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpecialisteChoice|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpecialisteChoice[]    findAll()
 * @method SpecialisteChoice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpecialisteChoiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpecialisteChoice::class);
    }

    /**
     * addCourseChoiced
     *
     * @param  mixed $rank
     * @param  mixed $idCourse
     * @param  mixed $specialisteId
     * @param  mixed $date
     *
     * @return void
     */
    public function addCourseChoiced(int $ranky, int $idCourse, int $specialisteId, string $daty): void
    {
        $sql = "insert into SpecialisteChoice (course_id, specialiste_id, rang, date_specialiste_choice) values (" . $idCourse . "," . $specialisteId . "," . $ranky . "," . $daty . ")";
        $query = $this->createNativeNamedQuery($sql);
        $query->execute();
    }

    // /**
    //  * @return SpecialisteChoice[] Returns an array of SpecialisteChoice objects
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
    public function findOneBySomeField($value): ?SpecialisteChoice
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function AllSpecialisteCourseChoiceOneDate($value)
    {
        return $this->createQueryBuilder('specialiste_choice')
            ->andWhere('specialiste_choice.datechoice = :val')
            ->setParameter('val', $value)
            //->groupBy('specialiste_choice.rang')
            ->setMaxResults(8)
            ->getQuery()
            ->getResult();
    }

    // public function specialisteHavechoice(string $date)
    // {
    //     $query = $this->createQuery('SELECT DISTINCT specialiste_id FROM specialiste_choice WHERE datechoice = :daty')->setParameters('daty', $date);
    //     $ids = $query->getResult(); // array of CmsUser ids
    //     return $ids;
    // }
}
