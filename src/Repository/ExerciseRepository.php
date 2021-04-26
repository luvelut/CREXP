<?php

namespace App\Repository;

use App\Entity\Exercise;
use App\Model\Search\ExerciseSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;

/**
 * @method Exercise|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exercise|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exercise[]    findAll()
 * @method Exercise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciseRepository extends ServiceEntityRepository
{
    private Security $security;

    public function __construct(ManagerRegistry $registry, Security $security)
    {
        parent::__construct($registry, Exercise::class);
        $this->security=$security;
    }


    public function searchSubjects($search)
    {

        $query = $this
            ->createQueryBuilder('e')
            ->innerJoin('e.subject','s')
            ->innerJoin('s.teacher','t')
            ->select('e,s')
            ->andWhere('t.id = s.teacher')
            ->andWhere('s.id = e.subject')
            ->andWhere('t.id = :user')
            ->setParameter('user', $search->getTeacher())
            ->andWhere('e.state NOT LIKE :p')
            ->setParameter('p','ATTENTE');
        ;

        if(!empty($search->getName())){
            $query=$query
                ->andWhere('s.title LIKE :q')
                ->setParameter('q',"%{$search->getName()}%");
        }

        if($search->isCheck==1){
            $query = $query
                ->andWhere('e.state LIKE :u')
                ->setParameter('u','OK-ELEVE');
        }

        return $query->getQuery()->getResult();

    }

    public function searchExercises(ExerciseSearch $search)
    {
        $query = $this
            ->createQueryBuilder('e')
            ->join('e.subject','s') //innerJoin plutot ?
            ->select('e,s')
            ->andWhere('e.student = :user')
            ->setParameter('user', $search->getStudent())
        ;

        if(!empty($search->getName())){
            $query=$query
                ->andWhere('s.title LIKE :q')
                ->setParameter('q',"%{$search->getName()}%");
        }

        if($search->isCheck==1){
            $query = $query
                ->andWhere('e.state LIKE :u')
                ->setParameter('u','ATTENTE');
        }

        return $query->getQuery()->getResult();

    }

}
