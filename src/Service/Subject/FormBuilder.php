<?php


namespace App\Service\Subject;


use App\Entity\Subject;
use App\Form\Search\SubjectSearchType;
use App\Form\SubjectType;
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
        return $this->container->get('form.factory')->create(SubjectSearchType::class);
    }

    public function getForm() : FormInterface
    {
        return $this->container->get('form.factory')->create(SubjectType::class);
    }

    public function getEditForm(Subject $subject) : FormInterface
    {
        return $this->container->get('form.factory')->create(SubjectType::class,$subject);
    }
}