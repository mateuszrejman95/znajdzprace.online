<?php

namespace App\Controller;

use App\Entity\Uzytkownik;
use App\Repository\UzytkownikRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        $request->setLocale('pl');
        //dd($request->getLocale());
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): Response
    {
        return $this->render('base.html.twig');

    }
    /**
     * @Route("/register", name="app_zarejestruj")
     */
    public function zarejestruj():Response
    {
        return $this->render('base.html.twig');
    }

    /**
     * @Route("/userpassword", name="app_userpassword")
     */
    public function setUserPasword(UserPasswordEncoderInterface $encoder, UzytkownikRepository $uzytkownikRepository, ObjectManager $manager):Response
    {
        $user = $uzytkownikRepository->findOneBy(['email'=>'admin@example.com']);
        $user->setPassword(
            $encoder->encodePassword($user, '1234')
        );
        $manager->flush();
        return $this->render('base.html.twig');
    }


}

