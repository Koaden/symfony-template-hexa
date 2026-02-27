<?php

declare(strict_types=1);

namespace Domain\Model;

class Product
{
    private ?int $id = null;
    private string $name;
    private string $slug;
    private ?string $description = null;
    private int $price; // En centimes
    private int $stock;
    private ?string $imageName = null;
    private ?Category $category = null;

    public function __construct(string $name, string $slug, int $price, int $stock)
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->price = $price;
        $this->stock = $stock;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
    public function setPrice(int $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getPriceAsFloat(): float
    {
        return $this->price / 100;
    }

    public function getStock(): int
    {
        return $this->stock;
    }
    public function setStock(int $stock): self
    {
        $this->stock = $stock;
        return $this;
    }
    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }
    public function setCategory(?Category $category): self
    {
        $this->category = $category;
        return $this;
    }
}
