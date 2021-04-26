<?php

namespace App\Controller\Teacher;


use App\Entity\Subject;
use App\Form\SubjectType;
use App\Security\Voters\SubjectVoter;
use App\Service\Subject\CrudManager;
use App\Service\Subject\FormBuilder;
use App\Service\Subject\FormHandler;
use App\Service\Subject\SearchProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Route("/mes-sujets", name="subject_")
 */
class SubjectController extends AbstractController
{
    /**
     * @Route("/", name="list")
     * @param Request $request
     * @param SearchProvider $provider
     * @param FormHandler $formHandler
     * @param FormBuilder $formBuilder
     * @return Response
     */
    public function list(Request $request,SearchProvider $provider,FormHandler $formHandler,FormBuilder $formBuilder): Response
    {
        $form=$formBuilder->getSearchForm();
        $data = $formHandler->handleSearch($request,$form);

        return $this->render('teacher/subject/list.html.twig',[
            'subjects' => $provider->getSubjects($data),'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/edition/{id}", name="edit")
     * @param Subject $subject
     * @param Request $request
     * @param FormHandler $formHandler
     * @param CrudManager $crudManager
     * @return Response
     */
    public function edit(Subject $subject,Request $request,FormHandler $formHandler,CrudManager $crudManager, FormBuilder $formBuilder): Response
    {
        $this->denyAccessUnlessGranted(SubjectVoter::EDIT,$subject);

        $form=$formBuilder->getEditForm($subject);
        $subject=$formHandler->handleForm($request,$form);

        if ($form->isSubmitted() && $form->isValid()) {

            $crudManager->update();
            $this->addFlash('success',"Le sujet a bien été modifié !");
            return $this->redirectToRoute('teacher_subject_list');
        }

        return $this->render('/teacher/subject/edit.html.twig',[
            'subject'=>$subject, 'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/ajout", name="new")
     * @param Request $request
     * @param CrudManager $crudManager
     * @param FormBuilder $formBuilder
     * @param FormHandler $formHandler
     * @return Response
     */
    public function new(Request $request, CrudManager $crudManager,FormBuilder $formBuilder,FormHandler $formHandler): Response
    {
        $form=$formBuilder->getForm();
        $subject=$formHandler->handleForm($request,$form);

        if ($form->isSubmitted() && $form->isValid()) {

            $crudManager->add($subject);

            $this->addFlash('success',"Le sujet a bien été ajouté !");

            return $this->redirectToRoute('teacher_subject_list');
        }

        return $this->render('/teacher/subject/new.html.twig', ['form'=>$form->createView()]);
    }

    /**
     * @Route("/suppression/{id}", name="delete")
     * @param Subject $subject
     * @param Request $request
     * @param CrudManager $crudManager
     * @return Response
     */
    public function delete(Subject $subject,Request $request,CrudManager $crudManager): Response
    {
        $this->denyAccessUnlessGranted(SubjectVoter::DELETE,$subject);

        $form = $this->createFormBuilder()->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $crudManager->delete($subject);
            $this->addFlash('success',"Le sujet a bien été supprimé !");
            return $this->redirectToRoute('teacher_subject_list');
        }

        return $this->render('teacher/subject/delete.html.twig',['subject'=>$subject,'form'=>$form->createView()]);

    }
}