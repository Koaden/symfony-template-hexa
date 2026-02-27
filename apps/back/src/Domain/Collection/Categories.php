<?php

declare(strict_types=1);

namespace Domain\Collection;

use Domain\Model\Category;

interface Categories{
    public function add(Category $category): void;
    /** @return iterable<Category> */
    public function findAll(): iterable;
}