<?php


namespace App\Service\Exercise;


use App\Entity\Exercise;
use App\Entity\Student;
use App\Entity\Teacher;
use App\Entity\User;
use App\Model\Search\ExerciseSearch;
use App\Repository\ExerciseRepository;
use Symfony\Component\Security\Core\Security;

class SearchProvider
{
    private Security $security;
    private ExerciseRepository $exerciseRepository;

    public function __construct(Security $security, ExerciseRepository $exerciseRepository){
        $this->security=$security;
        $this->exerciseRepository=$exerciseRepository;
    }

    /**
     * @param ExerciseSearch $search
     * @return Exercise[]
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

        return $this->exerciseRepository->searchSubjects($search);

    }

    /**
     * @param ExerciseSearch $search
     * @return Exercise[]
     */
    public function getExercises($search):array
    {
        $user = $this->security->getUser();

        if(!($user instanceof User)){
            return []; //or throw new exception
        }
        $student=$user->getStudent();
        if(!($student instanceof Student)){
            return []; //or throw new exception
        }

        if(!empty($search)){
            $search->setStudent($student);
        }

        return $this->exerciseRepository->searchExercises($search);

    }



}