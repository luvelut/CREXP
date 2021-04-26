<?php


namespace App\Service\Team;


use App\Entity\Team;
use App\Entity\User;
use Psr\Container\ContainerInterface;
use Symfony\Component\Security\Core\Security;

class CrudManager
{
    private Security $security;
    private ContainerInterface $container;
    private $entityManager;

    /**
     * CrudManager constructor.
     * @param Security $security
     * @param ContainerInterface $container
     */
    public function __construct(Security $security, ContainerInterface $container)
    {
        $this->security = $security;
        $this->container=$container;
        $this->entityManager=$this->container->get('doctrine')->getManager();
    }

    public function add(Team $team)
    {
        $user=$this->security->getUser();
        if(!($user instanceof User)){
            return;
        }

        $teacher=$user->getTeacher();
        $team->setTeacher($teacher);

        //$entityManager=$this->container->get('doctrine')->getManager();
        $this->entityManager->persist($team);
        $this->entityManager->flush();
    }

    public function update(){
        $this->entityManager=$this->container->get('doctrine')->getManager();
        $this->entityManager->flush();
    }

    public function delete(Team $team)
    {
        //$entityManager=$this->container->get('doctrine')->getManager();
        $this->entityManager->remove($team);
        $this->entityManager->flush();
    }
}