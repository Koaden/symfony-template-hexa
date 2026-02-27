<?php

declare(strict_types=1);

namespace Domain\UseCase\Query\Product\GetAll;

use Domain\Collection\Products;

final readonly class Handler
{
    public function __construct(
        private Products $products,
    ) {}

    /** @return array<\Domain\Model\Product> */
    public function __invoke(Query $query): array
    {
        return $this->products->findAllVisible();
    }
}
