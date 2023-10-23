<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\GuestQuestion;
use App\Entity\Photos;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard/index.html.twig', [

            //Message affiché sur la page d'acceuil du tbx de bord
            'welcome_message' => 'Bienvenue Sylvie que puis-je faire pour vous ?',
        ]);
    }

    //Methode de configuration gérérale du backoffice
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('BackOffice de Sylvie')
            ->renderContentMaximized();
    }

    //Methode de configuration des onglets du tableau de bord
    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::section('Admin'),
            MenuItem::linkToCrud('Questions', 'fas fa-id-card', GuestQuestion::class),
            MenuItem::linkToCrud('Users', 'fas fa-user-astronaut', User::class),
            MenuItem::linkToCrud('Photos', 'fas fa-camera', Photos::class),
        ];
    }
}
