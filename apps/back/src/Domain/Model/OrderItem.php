<?php

declare(strict_types=1);

namespace Domain\Model;

class OrderItem
{
    private ?int $id = null;
    private Order $order;
    private Product $product;
    private int $quantity;
    private int $unitPrice; // Prix sauvegardé à l'achat

    public function __construct(Order $order, Product $product, int $quantity, int $unitPrice)
    {
        $this->order = $order;
        $this->product = $product;
        $this->quantity = $quantity;
        $this->unitPrice = $unitPrice;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getUnitPrice(): int
    {
        return $this->unitPrice;
    }

    public function getTotalPrice(): int
    {
        return $this->unitPrice * $this->quantity;
    }
}
