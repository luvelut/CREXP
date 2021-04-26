<?php

namespace App\Repository;

use App\Entity\Student;
use App\Model\Search\StudentSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }


    public function search($search) : array
    {
        $query = $this
            ->createQueryBuilder('s')
            ->join('s.team','t')
            ->join('t.teacher','teacher')
            ->select('s')
            ->andWhere('t.teacher = :user')
            ->andWhere('t.id = s.team')
            ->andWhere('teacher.id = :user')
            ->setParameter('user', $search->getTeacher())
        ;

        if(!empty($search->getName())){
            $query=$query
                ->andWhere('s.name LIKE :q')
                ->setParameter('q',"%{$search->getName()}%");
        }


        return $query->getQuery()->getResult();

    }



}
