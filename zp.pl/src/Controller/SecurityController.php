<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends AbstractController
{
    /**
     * @Route("/security", name="security")
     */
    public function index()
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $uwiezytelniacz): Response
    {

        $error = $uwiezytelniacz->getLastAuthenticationError();
        $email = $uwiezytelniacz->getLastUsername();
        dd($uwiezytelniacz, $email);
        return $this->render('security/login.html.twig', [
            'login' => $email,
            'error' => $error
        ]);
    }
}
