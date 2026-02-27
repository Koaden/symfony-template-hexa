<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Domain\Model\Order;
use Domain\Collection\Orders;

class OrderRepository implements Orders
{
    public function __construct(private EntityManagerInterface $em) {}

    public function add(Order $order): void
    {
        $this->em->persist($order);
    }

    public function findByReference(string $reference): ?Order
    {
        return $this->em->getRepository(Order::class)->findOneBy(['reference' => $reference]);
    }
}
