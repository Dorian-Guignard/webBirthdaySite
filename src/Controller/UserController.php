<?php

namespace App\Controller;

use App\Services\UserDataCheckService;
use App\Services\AuthenticationService;
use App\Services\FormValidationService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class UserController extends AbstractController
{
    /**
     * @Route("/user", name="app_user")
     * 
     */
    public function index(FormValidationService $formValidationService, AuthenticationService $authenticationService, UserDataCheckService $userDataCheckService): Response
    {
        $hasUserData = $userDataCheckService;
        $isAuthenticated = $authenticationService->isAuthenticated();
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'isAuthenticated' => $isAuthenticated,
            'hasUserData' => $userDataCheckService->hasUserData(),
            'isFormSubmittedAndValid' => $formValidationService,
            
        ]);
        
        
    }
}
