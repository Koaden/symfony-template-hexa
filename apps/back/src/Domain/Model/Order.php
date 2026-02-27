<?php

declare(strict_types=1);

namespace Domain\Model;

use DateTimeImmutable;

class Order
{
    private ?int $id = null;
    private string $reference;
    private DateTimeImmutable $createdAt;
    private string $status;
    private int $totalPrice = 0;
    private User $user;

    /** @var iterable<OrderItem> */
    private iterable $items;

    public function __construct(string $reference, User $user)
    {
        $this->reference = $reference;
        $this->user = $user;
        $this->createdAt = new DateTimeImmutable();
        $this->status = 'PENDING';
        $this->items = [];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    /** @return iterable<OrderItem> */
    public function getItems(): iterable
    {
        return $this->items;
    }

    public function addItem(Product $product, int $quantity): self
    {
        $items = iterator_to_array($this->items);
        $orderItem = new OrderItem($this, $product, $quantity, $product->getPrice());
        $items[] = $orderItem;

        $this->items = $items;
        $this->calculateTotal();

        return $this;
    }

    private function calculateTotal(): void
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getTotalPrice();
        }
        $this->totalPrice = $total;
    }

    public function getTotalPrice(): int
    {
        return $this->totalPrice;
    }
}
