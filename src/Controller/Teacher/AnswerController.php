<?php

namespace App\Controller\Teacher;


use App\Entity\Exercise;
use App\Security\Voters\AnswerVoter;
use App\Service\Exercise\CrudManager;
use App\Service\Exercise\FormBuilder;
use App\Service\Exercise\FormHandler;
use App\Service\Exercise\SearchProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AnswerController extends AbstractController
{
    /**
     * @Route("/comptes-rendus", name="answer_list")
     * @param Request $request
     * @param SearchProvider $provider
     * @param FormHandler $formHandler
     * @param FormBuilder $formBuilder
     * @return Response
     */
    public function list(Request $request, SearchProvider $provider, FormHandler $formHandler,FormBuilder $formBuilder): Response
    {
        $form=$formBuilder->getAnswerSearchForm();
        $data = $formHandler->handleSearch($request,$form);

        return $this->render('teacher/answer/list.html.twig',[
            'exercises' => $provider->getSubjects($data),'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/voir/{id}", name="answer_show")
     * @param Exercise $exercise
     * @return Response
     */
    public function show(Exercise $exercise): Response
    {
        $this->denyAccessUnlessGranted(AnswerVoter::SHOW,$exercise);

        return $this->render('teacher/answer/show.html.twig',[
            'exercise' => $exercise
        ]);
    }

    /**
     * @Route("/valider/{id}", name="answer_edit")
     * @param Exercise $exercise
     * @param Request $request
     * @param CrudManager $crudManager
     * @param FormHandler $formHandler
     * @return Response
     */
    public function edit(Exercise $exercise,Request $request,CrudManager $crudManager,FormHandler $formHandler, FormBuilder $formBuilder): Response
    {
        $this->denyAccessUnlessGranted(AnswerVoter::VALIDATE,$exercise);

        $form=$formBuilder->getEditForm($exercise);
        $validateExercise=$formHandler->handleForm($request,$form);
        if ($form->isSubmitted() && $form->isValid()) {
            $exercise=$validateExercise;
            $crudManager->updateTeacher($exercise);
            $this->addFlash('success',"L'exercice a bien été validé !");
            return $this->redirectToRoute('teacher_answer_list');
        }

        return $this->render('teacher/answer/edit.html.twig',[
            'exercise' => $exercise,'form'=>$form->createView()
        ]);
    }
}