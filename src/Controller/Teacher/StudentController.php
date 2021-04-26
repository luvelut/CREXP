<?php


namespace App\Controller\Teacher;

use App\Entity\Student;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Security\Voters\StudentVoter;
use App\Service\Student\CrudManager;
use App\Service\Student\FormBuilder;
use App\Service\Student\FormHandler;
use App\Service\Student\SearchProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/mes-etudiants", name="student_")
 */
class StudentController extends AbstractController
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

        return $this->render('teacher/student/list.html.twig', [
            'students' => $provider->getStudents($data),'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/edition/{id}", name="edit")
     * @param Student $student
     * @param Request $request
     * @param FormHandler $formHandler
     * @param CrudManager $crudManager
     * @param \App\Service\User\SearchProvider $provider
     * @param FormBuilder $formBuilder
     * @return Response
     */
    public function edit(Student $student,Request $request,FormHandler $formHandler,CrudManager $crudManager, \App\Service\User\SearchProvider $provider, FormBuilder $formBuilder): Response
    {
        $this->denyAccessUnlessGranted(StudentVoter::EDIT,$student);
        $user = $provider->getUser($student);

        $form=$formBuilder->getEditForm($user);
        $user=$formHandler->handleForm($request,$form);

        if ($form->isSubmitted() && $form->isValid()) {

            $crudManager->update();
            $this->addFlash('success',"L'étudiant a bien été modifié !");

            return $this->redirectToRoute('teacher_student_list');
        }

        return $this->render('/teacher/student/edit.html.twig', [
            'student'=>$student,'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/ajout", name="new")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param CrudManager $crudManager
     * @param FormHandler $formHandler
     * @return Response
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder,CrudManager $crudManager,FormHandler $formHandler, FormBuilder $formBuilder): Response
    {
        $user = new User();

        $form = $formBuilder->getEditForm($user);
        $student=$formHandler->handleForm($request,$form);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $crudManager->add($student);
            $this->addFlash('success',"L'étudiant a bien été ajouté !");

            return $this->redirectToRoute('teacher_student_list');
        }

        return $this->render('/teacher/student/new.html.twig',[
            'form'=>$form->createView()]);
    }

    /**
     * @Route("/suppression/{id}", name="delete")
     * @param Student $student
     * @param Request $request
     * @param CrudManager $crudManager
     * @param \App\Service\User\SearchProvider $provider
     * @return Response
     */
    public function delete(Student $student,Request $request,CrudManager $crudManager,\App\Service\User\SearchProvider $provider): Response
    {
        $this->denyAccessUnlessGranted(StudentVoter::DELETE,$student);

        $user = $provider->getUser($student);

        $form = $this->createFormBuilder($student)->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $crudManager->delete($student,$user);
            $this->addFlash('success',"L'étudiant a bien été supprimé !");
            return $this->redirectToRoute('teacher_student_list');
        }

        return $this->render('teacher/student/delete.html.twig',['student'=>$student,'form'=>$form->createView()]);

    }
}