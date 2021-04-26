<?php


namespace App\Service\Team;


use App\Entity\Team;
use App\Model\Search\TeamSearch;
use Psr\Container\ContainerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class FormHandler
{
    public function handleSearch(Request $request, FormInterface $form)
    {
        $search = new TeamSearch();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $search=$form->getData();
        }

        return $search;
    }

    public function handleForm(Request $request,FormInterface $form)
    {
        $team = new Team();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $team=$form->getData();

        }

        return $team;
    }

}