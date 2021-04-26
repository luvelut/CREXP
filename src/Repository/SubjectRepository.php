<?php

namespace App\Repository;

use App\Entity\Subject;
use App\Model\Search\SubjectSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Subject|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subject|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subject[]    findAll()
 * @method Subject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subject::class);
    }

    public function search($search): array
    {

        $query = $this
            ->createQueryBuilder('s')
            ->andWhere('s.teacher = :user')
            ->setParameter('user', $search->getTeacher())
        ;

        if(!empty($search->getName())){
            $query=$query
                ->andWhere('s.title LIKE :q')
                ->setParameter('q',"%{$search->getName()}%");
        }


        return $query->getQuery()->getResult();
    }


}
