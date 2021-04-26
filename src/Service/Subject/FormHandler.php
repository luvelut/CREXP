<?php


namespace App\Service\Subject;


use App\Entity\Subject;
use App\Entity\Team;
use App\Model\Search\SubjectSearch;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class FormHandler
{
    public function handleSearch(Request $request, FormInterface $form)
    {
        $search = new SubjectSearch();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $search=$form->getData();
        }

        return $search;
    }

    public function handleForm(Request $request,FormInterface $form)
    {
        $subject = new Subject();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $subject=$form->getData();

        }

        return $subject;
    }

}