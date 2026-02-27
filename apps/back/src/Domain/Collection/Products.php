<?php

declare(strict_types=1);

namespace Domain\Collection;

use Domain\Model\Product;

interface Products{
    public function add(Product $product): void;
    public function remove(Product $product): void;
    public function findBySlug(string $slug): ?Product;
    /** @return iterable<Product> */
    public function findAllVisible(): iterable;
}