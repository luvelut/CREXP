<?php


namespace App\Service\Exercise;


use App\Entity\Exercise;
use App\Entity\Student;
use App\Entity\User;
use Psr\Container\ContainerInterface;
use Symfony\Component\Security\Core\Security;

class CrudManager
{
    private Security $security;
    private ContainerInterface $container;

    /**
     * CrudManager constructor.
     * @param Security $security
     * @param ContainerInterface $container
     */
    public function __construct(Security $security, ContainerInterface $container)
    {
        $this->security = $security;
        $this->container=$container;
    }


    public function updateStudent(Exercise $exercise){
        $entityManager=$this->container->get('doctrine')->getManager();
        $exercise->validateStudentState();
        $entityManager->flush();
    }

    public function updateTeacher(Exercise $exercise){
        $entityManager=$this->container->get('doctrine')->getManager();
        $exercise->validateTeacherState();
        $entityManager->flush();
    }

    public function delete(Student $student,User $user)
    {
        $entityManager=$this->container->get('doctrine')->getManager();
        $entityManager->remove($student);
        $entityManager->remove($user);
        $entityManager->flush();
        return true;
    }

}