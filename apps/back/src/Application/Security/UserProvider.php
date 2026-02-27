<?php

declare(strict_types=1);

namespace Application\Security;

use Domain\Collection\Users;
use Domain\Model\User as ModelUser;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/** @implements UserProviderInterface<User> */
final class UserProvider implements UserProviderInterface
{
    public function __construct(
        private readonly Users $users,
    ) {
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        /** @var ModelUser|null */
        $modelUser = $this->users->findOneByEmail($identifier);

        if (null === $modelUser) {
            throw new UserNotFoundException();
        }

        return new User($modelUser);
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $this->loadUserByIdentifier(
            $user->getUserIdentifier()
        );
    }

    public function supportsClass(string $class): bool
    {
        return User::class === $class;
    }
}