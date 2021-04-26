<?php


namespace App\Service\Student;


use App\Entity\Student;
use App\Entity\Teacher;
use App\Entity\User;
use App\Model\Search\StudentSearch;
use App\Repository\StudentRepository;

use Symfony\Component\Security\Core\Security;

class SearchProvider
{
    private Security $security;
    private StudentRepository $studentRepository;

    public function __construct(Security $security, StudentRepository $studentRepository){
        $this->security=$security;
        $this->studentRepository=$studentRepository;
    }

    /**
     * @param StudentSearch $search
     * @return Student[]
     */
    public function getStudents(StudentSearch $search):array
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


        return $this->studentRepository->search($search);

    }
}