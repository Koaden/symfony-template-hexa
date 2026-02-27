<?php

declare(strict_types=1);

namespace Domain\Model;

class User
{
    private ?int $id = null;
    private string $email;
    private iterable $roles = [];
    private string $password;

    /** @var iterable<Order> */
    private iterable $orders;

    public function __construct(string $email)
    {
        $this->email = $email;
        $this->orders = [];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getRoles(): iterable
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles(iterable $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /** @return iterable<Order> */
    public function getOrders(): iterable
    {
        return $this->orders;
    }
}
