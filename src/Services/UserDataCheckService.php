<?php

namespace App\Services;

use App\Entity\GuestQuestion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class UserDataCheckService
{
    private $entityManager;
    private $security;

    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
    }

    public function hasUserData(): bool
    {

        $user = $this->security->getUser();

        // Vérifie si l'utilisateur est connecté
        if (!$user) {
            return false;
        }

        // Vérifie si l'utilisateur a des données enregistrées dans la table guest_question
        $userRepository = $this->entityManager->getRepository(GuestQuestion::class);
        $userData = $userRepository->findBy(['user' => $user]);

        // Modifie la logique de retour en fonction du résultat de la recherche
        if (count($userData) > 0) {
            return true; // L'utilisateur a des données enregistrées
        } else {
            return false; // L'utilisateur n'a pas de données enregistrées
        }
    }
}
