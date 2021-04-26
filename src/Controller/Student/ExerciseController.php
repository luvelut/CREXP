<?php


namespace App\Controller\Student;

use App\Entity\Exercise;
use App\Security\Voters\ExerciseVoter;
use App\Service\Exercise\CrudManager;
use App\Service\Exercise\FormBuilder;
use App\Service\Exercise\FormHandler;
use App\Service\Exercise\SearchProvider;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/mes-exercises", name="exercise_")
 */
class ExerciseController extends AbstractController
{
    /**
     * @Route("/", name="list")
     * @param Request $request
     * @param SearchProvider $provider
     * @param FormBuilder $formBuilder
     * @param FormHandler $formHandler
     * @return Response
     */
    public function list(Request $request, SearchProvider $provider,FormBuilder $formBuilder,FormHandler $formHandler): Response
    {
        $form=$formBuilder->getSearchForm();
        $data = $formHandler->handleSearch($request,$form);


        return $this->render('student/exercise/list.html.twig',[
            'exercises' => $provider->getExercises($data),'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/voir/{id}", name="show")
     * @param Exercise $exercise
     * @return Response
     */
    public function show(Exercise $exercise): Response
    {
        $this->denyAccessUnlessGranted(ExerciseVoter::VIEW,$exercise);

        return $this->render('student/exercise/show.html.twig',[
            'exercise' => $exercise
        ]);
    }

    /**
     * @Route("/edition/{id}", name="edit")
     * @param Exercise $exercise
     * @param Request $request
     * @param CrudManager $crudManager
     * @param FormHandler $formHandler
     * @param FormBuilder $formBuilder
     * @return Response
     */
    public function edit(Exercise $exercise,Request $request,CrudManager $crudManager,FormHandler $formHandler,FormBuilder $formBuilder): Response
    {
        $this->denyAccessUnlessGranted(ExerciseVoter::EDIT,$exercise);
        $exercise->setResponse('');

        $form=$formBuilder->getEditForm($exercise);
        $validateExercise=$formHandler->handleForm($request,$form);

        if ($form->isSubmitted() && $form->isValid()) {
            $exercise=$validateExercise;
            $crudManager->updateStudent($exercise);
            $this->addFlash('success',"L'exercice a bien été envoyé !");
            return $this->redirectToRoute('student_exercise_list');
        }

        return $this->render('student/exercise/edit.html.twig',[
            'exercise' => $exercise, 'form'=>$form->createView()
        ]);
    }

}