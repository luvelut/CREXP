<?php


namespace App\Listener;


use App\Security\Role;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): Response
    {
        $roles = $token->getRoleNames();

        if (in_array(Role::ROLE_TEACHER, $roles, true)) {
            return new RedirectResponse($this->router->generate('teacher_index'));
        }
        if (in_array(Role::ROLE_STUDENT, $roles, true)) {
            return new RedirectResponse($this->router->generate('student_index'));
        }

        //Cas où l'utilisateur n'a ni le rôle teacher ni le rôle student
        return new RedirectResponse($this->router->generate('login'));
    }
}