<?php

namespace App\Services;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class AuthenticationService
{
    private $authorizationChecker;
    private $isAuthenticated;

    public function __construct(AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
        $this->isAuthenticated = $this->authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY');
    }

    public function isAuthenticated(): bool
    {
        return $this->isAuthenticated;
    }
}
