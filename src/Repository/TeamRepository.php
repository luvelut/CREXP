<?php

namespace App\Repository;

use App\Entity\Team;
use App\Model\Search\TeamSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Team|null find($id, $lockMode = null, $lockVersion = null)
 * @method Team|null findOneBy(array $criteria, array $orderBy = null)
 * @method Team[]    findAll()
 * @method Team[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Team::class);
    }

    /**
     * Récupère la classe selon une recherche
     * @param TeamSearch $search
     * @return array
     */

    public function search($search): array
    {

        $query = $this
            ->createQueryBuilder('team')
            ->join('team.teacher','t')
            ->select('team')
            ->andWhere('team.teacher = :user')
            ->setParameter('user', $search->getTeacher())
        ;

        if(!empty($search->getName())){
            $query=$query
                ->andWhere('team.name LIKE :q')
                ->setParameter('q',"%{$search->getName()}%");
        }


        return $query->getQuery()->getResult();
    }

}
