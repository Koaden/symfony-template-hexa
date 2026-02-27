<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Domain\Collection\Users;
use Domain\Model\User;

class UserRepository implements Users
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function add(User $member): void
    {
        $this->em->persist($member);
    }

    public function findOneByEmail(string $email): ?User
    {
        $qb = $this->em->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u')
            ->where('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery();

        $result = $qb->getOneOrNullResult();

        return $result instanceof User ? $result : null;
    }

    public function findOneById(int $id): ?User
    {
        $qb = $this->em->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u')
            ->where('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        $result = $qb->getOneOrNullResult();

        return $result instanceof User ? $result : null;
    }
}