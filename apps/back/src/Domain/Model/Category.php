<?php

declare(strict_types=1);

namespace Domain\Model;

class Category
{
    private ?int $id = null;
    private string $name;
    private string $slug;

    /** @var iterable<Product> */
    private iterable $products;

    public function __construct(string $name, string $slug)
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->products = [];
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

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    /** @return iterable<Product> */
    public function getProducts(): iterable
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        $products = iterator_to_array($this->products);

        foreach ($products as $p) {
            if ($p === $product) {
                return $this;
            }
        }

        $products[] = $product;
        $product->setCategory($this);
        $this->products = $products;

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        $this->products = array_filter(
            [...iterator_to_array($this->products)],
            function (Product $p) use ($product) {
                return $p->getId() !== $product->getId();
            }
        );

        if ($product->getCategory() === $this) {
            $product->setCategory(null);
        }

        return $this;
    }
}
