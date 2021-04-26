<?php


namespace App\Service\Subject;


use App\Entity\Subject;
use App\Entity\Teacher;
use App\Entity\User;
use App\Model\Search\SubjectSearch;
use App\Repository\SubjectRepository;
use Symfony\Component\Security\Core\Security;

class SearchProvider
{
    private Security $security;
    private SubjectRepository $subjectRepository;

    public function __construct(Security $security, SubjectRepository $subjectRepository){
        $this->security=$security;
        $this->subjectRepository=$subjectRepository;
    }

    /**
     * @param SubjectSearch $search
     * @return Subject[]
     */
    public function getSubjects($search):array
    {
        $user = $this->security->getUser();
        if(!($user instanceof User)){
            return []; //or throw new exception
        }
        $teacher=$user->getTeacher();
        if(!($teacher instanceof Teacher)){
            return []; //or throw new exception
        }

        if(!empty($search)){
            $search->setTeacher($teacher);
        }

        return $this->subjectRepository->search($search);

    }

}