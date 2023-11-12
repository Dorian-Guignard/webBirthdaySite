<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\AuthenticationService;
use App\Services\UserDataCheckService;

class SurpiseController extends AbstractController
{
    /**
     * @Route("/surpise", name="app_surpise")
     */
    public function index(UserDataCheckService $hasUserData, AuthenticationService $authenticationService): Response
    {
        $isAuthenticated = $authenticationService->isAuthenticated();

        return $this->render('surpise/index.html.twig', [
            'controller_name' => 'SurpiseController',
            'isAuthenticated' => $isAuthenticated,
            'hasUserData' => $hasUserData
    
    
        ]);
    }
}