<?php


namespace App\Controller\Teacher;

use App\Entity\Team;
use App\Form\TeamType;
use App\Security\Voters\TeamVoter;
use App\Service\Team\CrudManager;
use App\Service\Team\FormHandler;
use App\Service\Team\SearchProvider as TeamProvider;
use App\Service\Team\FormBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Route("/mes-classes", name="team_")
 */
class TeamController extends AbstractController
{

    /**
     * @Route("/", name="list")
     * @param Request $request
     * @param TeamProvider $provider
     * @param FormBuilder $formBuilder
     * @param FormHandler $formHandler
     * @return Response
     */
    public function list(Request $request, TeamProvider $provider, FormBuilder $formBuilder, FormHandler $formHandler): Response
    {

        $form=$formBuilder->getSearchForm();
        $data = $formHandler->handleSearch($request,$form);

        return $this->render('teacher/team/list.html.twig',[
            'teams' => $provider->getTeams($data),'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/ajout", name="new")
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @param FormHandler $formHandler
     * @param CrudManager $crudManager
     * @return Response
     */
    public function new(Request $request,FormBuilder $formBuilder,FormHandler $formHandler, CrudManager $crudManager): Response
    {

        $form=$formBuilder->getForm();
        $team=$formHandler->handleForm($request,$form);
        if($form->isSubmitted())
        {
            $crudManager->add($team);
            $this->addFlash('success',"La classe a bien été ajoutée !");
            return $this->redirectToRoute('teacher_team_list');

        }

        return $this->render('teacher/team/new.html.twig',[
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/edition/{id}", name="edit")
     * @param Team $team
     * @param Request $request
     * @param FormHandler $formHandler
     * @param CrudManager $crudManager
     * @param FormBuilder $formBuilder
     * @return Response
     */
    public function edit(Team $team,Request $request,FormHandler $formHandler, CrudManager $crudManager,FormBuilder $formBuilder): Response
    {
        $this->denyAccessUnlessGranted(TeamVoter::EDIT,$team);

        $form=$formBuilder->getEditForm($team);
        $team=$formHandler->handleForm($request,$form);

        if ($form->isSubmitted()) {

            $crudManager->update();
            $this->addFlash('success',"La classe a bien été modifiée !");
            return $this->redirectToRoute('teacher_team_list');

        }

        return $this->render('teacher/team/edit.html.twig',[
            'team'=>$team,'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/suppression/{id}", name="delete")
     * @param Team $team
     * @param Request $request
     * @param CrudManager $crudManager
     * @return Response
     */
    public function delete(Team $team, Request $request, CrudManager $crudManager): Response
    {
        $this->denyAccessUnlessGranted(TeamVoter::DELETE,$team);

        $form = $this->createFormBuilder($team)->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $crudManager->delete($team);
            $this->addFlash('success',"La classe a bien été supprimée !");
            return $this->redirectToRoute('teacher_team_list');
        }

        return $this->render('teacher/team/delete.html.twig',['team'=>$team,'form'=>$form->createView()]);

    }


}