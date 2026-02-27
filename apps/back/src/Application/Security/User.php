<?php

declare(strict_types=1);

namespace Application\Security;

use Domain\Model\User as ModelUser;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    public function __construct(
        private ModelUser $user,
    ) {
    }

    /** @return non-empty-string */
    public function getUserIdentifier(): string
    {
        return $this->user->getEmail();
    }

    /** @return array<string> */
    public function getRoles(): array
    {
        return $this->user->getRoles();
    }

    public function setPassword(string $hashedPassword): void
    {
        $this->user->setPassword($hashedPassword);
    }

    public function getPassword(): ?string
    {
        return $this->user->getPassword();
    }

    public function eraseCredentials(): void
    {
    }

    public function getuser(): ModelUser
    {
        return $this->user;
    }
}