<?php


namespace App\Service\Exercise;


use App\Entity\Exercise;
use App\Form\ExerciseType;
use App\Form\Search\AnswerSearchType;
use App\Form\Search\ExerciseSearchType;
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
        return $this->container->get('form.factory')->create(ExerciseSearchType::class);
    }

    public function getForm() : FormInterface
    {
        return $this->container->get('form.factory')->create(ExerciseType::class);
    }

    public function getAnswerSearchForm() : FormInterface
    {
        return $this->container->get('form.factory')->create(AnswerSearchType::class);
    }

    public function getEditForm(Exercise $exercise) : FormInterface
    {
        return $this->container->get('form.factory')->create(ExerciseType::class,$exercise,['label'=>$exercise->getSubject()->getNumberValues()]);
    }

}