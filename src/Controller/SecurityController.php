<?php

namespace App\Controller;

use App\Services\AuthenticationService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Services\UserDataCheckService;


class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login", methods={"GET", "POST"})
     */
    public function login(UserDataCheckService $hasUserData, AuthenticationService $authenticationService, AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        $isAuthenticated = $authenticationService->isAuthenticated();



        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
            'isAuthenticated' => $isAuthenticated, 
            'hasUserData' => $hasUserData->hasUserData()
    
    
            
        ]);

        if ($isAuthenticated === true) {
            return new RedirectResponse($this->generateUrl('app_user'));
        }
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
