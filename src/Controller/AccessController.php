<?php

namespace App\Controller;

use App\Services\AuthenticationService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;




class AccessController extends AbstractController
{
    /**
     * @Route("/access", name="app_access")
     */
    public function access(AuthenticationService $authenticationService): Response
    {


        $isAuthenticated = $authenticationService->isAuthenticated();

        return $this->render('access/index.html.twig', [
            'controller_name' => 'AccessController',
            'isAuthenticated' => $isAuthenticated,
        ]);
    }
}
