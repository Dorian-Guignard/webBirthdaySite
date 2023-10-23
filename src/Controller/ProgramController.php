<?php

namespace App\Controller;

use App\Services\AuthenticationService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProgramController extends AbstractController
{
    /**
     * @Route("/program", name="app_program")
     */
    public function program(AuthenticationService $authenticationService): Response
    {
        
        $isAuthenticated = $authenticationService->isAuthenticated();

        return $this->render('program/index.html.twig', [
            'controller_name' => 'ProgramController',
            'isAuthenticated' => $isAuthenticated,
        ]);
    }
}