<?php


namespace App\Service\Student;


use App\Entity\User;
use App\Form\Search\StudentSearchType;
use App\Form\UserType;
use Psr\Container\ContainerInterface;
use Symfony\Component\Form\FormInterface;

class FormBuilder
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container=$container;
    }

    public function getSearchForm() : FormInterface
    {
        return $this->container->get('form.factory')->create(StudentSearchType::class);
    }

    public function getForm() : FormInterface
    {
        return $this->container->get('form.factory')->create(UserType::class);
    }

    public function getEditForm(User $user) : FormInterface
    {
        return $this->container->get('form.factory')->create(UserType::class,$user);
    }


}