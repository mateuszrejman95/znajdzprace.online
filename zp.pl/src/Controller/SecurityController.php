<?php

namespace App\Controller;

use App\Entity\Oferta;
use App\Entity\Uzytkownik;
use App\Repository\UzytkownikRepository;
use App\Security\LoginFormAuthenticator;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
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
     * @Route("/register", name="app_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $guardHandler
     * @param LoginFormAuthenticator $formAuthenticator
     * @return Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $formAuthenticator)//:Response
    {
        /*$error = '';
        return $this->render('security/register.html.twig', ['error' => $error]);*/
        if ($request->isMethod('POST')) {
            $user = new Uzytkownik();
            $user -> setImie('Stefan');
            $user->setEmail($request->request->get('email'));
           $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $request->request->get('password')
            ));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            //dd($user);

            $em->flush();
            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $formAuthenticator,
                'main'
            );
        }
        return $this->render('security/register.html.twig');
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

