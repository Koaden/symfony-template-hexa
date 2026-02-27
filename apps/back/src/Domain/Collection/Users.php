<?php

declare(strict_types=1);

namespace Domain\Collection;

use Domain\Model\User;

interface Users
{
    public function add(User $user): void;

    public function findOneByEmail(string $email): ?User;

    public function findOneById(int $id): ?User;
}
