<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route ("/", name="login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils):Response {
        $lastLogin=$authenticationUtils->getLastUsername();
        $error=$authenticationUtils->getLastAuthenticationError();
        return $this->render('security/login.html.twig',[
            'last_login'=>$lastLogin,
            'error'=>$error
        ]);

    }
}