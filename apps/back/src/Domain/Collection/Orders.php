<?php

declare(strict_types=1);

namespace Domain\Collection;

use Domain\Model\Order;

interface Orders{
    public function add(Order $order): void;
    public function findByReference(string $reference): ?Order;
}