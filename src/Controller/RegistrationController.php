<?php

namespace App\Controller;


  use App\Entity\User;
use App\Form\RegistrationType;
use App\Services\AuthenticationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(
        AuthenticationService $authenticationService,
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        $isAuthenticated = $authenticationService->isAuthenticated();

        $user = new User(); // Créez une nouvelle instance de l'entité User

        // Logique d'enregistrement du profil
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (empty($user->getUsername())) {
                // Gérer l'erreur de champ vide
                // Par exemple, ajouter un message d'erreur et rediriger vers le formulaire
                $this->addFlash('error', 'Le champ username est requis.');
                return $this->redirectToRoute('app_register');
            }

            // Hash the password
            $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);

            // Persist the user
            $entityManager->persist($user);
            $entityManager->flush();

            // Redirection vers une autre page, par exemple, la page de succès
            return $this->redirectToRoute('app_user');
        }

        return $this->render(
            'registration/index.html.twig',
            [
                'form' => $form->createView(),
                'isAuthenticated' => $isAuthenticated,
            ]
        );
    }
}