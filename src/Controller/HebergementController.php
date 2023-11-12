<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\AuthenticationService;
use App\Services\UserDataCheckService;

class HebergementController extends AbstractController
{
    /**
     * @Route("/hebergement", name="app_hebergement")
     */
    public function index(UserDataCheckService $hasUserData, AuthenticationService $authenticationService): Response
    {

        $isAuthenticated = $authenticationService->isAuthenticated();

        return $this->render('hebergement/index.html.twig', [
            'controller_name' => 'HebergementController',
            'isAuthenticated' => $isAuthenticated,
            'hasUserData' => $hasUserData
    
    
        ]);

    }
}
