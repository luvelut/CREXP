<?php


namespace App\Service\Exercise;



use App\Entity\Exercise;
use App\Model\Search\ExerciseSearch;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class FormHandler
{
    public function handleSearch(Request $request, FormInterface $form)
    {
        $search = new ExerciseSearch();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $search=$form->getData();
        }

        return $search;
    }

    public function handleForm(Request $request,FormInterface $form)
    {
        $exercise = new Exercise();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $exercise=$form->getData();

        }

        return $exercise;
    }

}