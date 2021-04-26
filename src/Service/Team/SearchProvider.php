<?php


namespace App\Service\Team;


use App\Entity\Teacher;
use App\Entity\Team;
use App\Entity\User;
use App\Model\Search\TeamSearch;
use App\Repository\TeamRepository;
use Symfony\Component\Security\Core\Security;

class SearchProvider
{
    private Security $security;
    private TeamRepository $teamRepository;

    public function __construct(Security $security, TeamRepository $teamRepository){
        $this->security=$security;
        $this->teamRepository=$teamRepository;
    }

    /**
     * @param TeamSearch $search
     * @return Team[]
     */
    public function getTeams($search):array
    {
        $user = $this->security->getUser();
        //$search = new TeamSearch();
        if(!($user instanceof User)){
            return []; //or throw new exception
        }
        $teacher=$user->getTeacher();
        if(!($teacher instanceof Teacher)){
            return []; //or throw new exception
        }
        $search->setTeacher($teacher);



        return $this->teamRepository->search($search);

    }


}