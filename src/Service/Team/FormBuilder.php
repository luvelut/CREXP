<?php


namespace App\Service\Team;


use App\Entity\Team;
use App\Form\Search\TeamSearchType;
use App\Form\TeamType;
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
        return $this->container->get('form.factory')->create(TeamSearchType::class);
    }

    public function getForm() : FormInterface
    {
        return $this->container->get('form.factory')->create(TeamType::class);
    }

    public function getEditForm(Team $team): FormInterface
    {
        return $this->container->get('form.factory')->create(TeamType::class,$team);
    }

}