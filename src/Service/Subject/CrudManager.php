<?php


namespace App\Service\Subject;


use App\Entity\Exercise;
use App\Entity\Subject;
use App\Entity\Team;
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
     */
    public function __construct(Security $security, ContainerInterface $container)
    {
        $this->security = $security;
        $this->container=$container;
    }

    public function add(Subject $subject)
    {
        $user=$this->security->getUser();
        if(!($user instanceof User)){
            return;
        }

        $teacher=$user->getTeacher();
        $subject->setTeacher($teacher);
        $subject->setPublishedAt(new \DateTime());

        $entityManager=$this->container->get('doctrine')->getManager();
        $entityManager->persist($subject);

        foreach($subject->getTeam()->getStudents() as $student) {
            $exercise = new Exercise();
            $exercise->setState('ATTENTE');
            $exercise->setPublishedAt(new \DateTime());
            $exercise->setSubject($subject);
            $exercise->setStudent($student);
            $exercise->setResponse('');

            $entityManager->persist($exercise);
        }
        $entityManager->flush();
    }

    public function update(){
        $entityManager=$this->container->get('doctrine')->getManager();
        $entityManager->flush();
    }

    public function delete(Subject $subject)
    {
        $entityManager=$this->container->get('doctrine')->getManager();
        $entityManager->remove($subject);
        $entityManager->flush();
    }

}