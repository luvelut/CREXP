<?php


namespace App\Service\Student;


use App\Entity\Student;
use App\Model\Search\StudentSearch;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class FormHandler
{
    public function handleSearch(Request $request, FormInterface $form)
    {
        $search = new StudentSearch();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $search=$form->getData();
        }

        return $search;
    }

    public function handleForm(Request $request,FormInterface $form)
    {
        $student = new Student();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $student=$form->getData();

        }

        return $student;
    }

}