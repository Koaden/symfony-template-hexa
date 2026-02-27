<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Domain\Collection\Products;
use Domain\Model\Product;

class ProductRepository implements Products
{
    public function __construct(private EntityManagerInterface $em) {}

    public function add(Product $product): void
    {
        $this->em->persist($product);
    }

    public function remove(Product $product): void
    {
        $this->em->remove($product);
    }

    public function findBySlug(string $slug): ?Product
    {
        return $this->em->getRepository(Product::class)->findOneBy(['slug' => $slug]);
    }

    /** @return iterable<Product> */
    public function findAllVisible(): iterable
    {
        return $this->em->createQueryBuilder()
            ->select('p')
            ->from(Product::class, 'p')
            ->where('p.stock > 0')
            ->getQuery()
            ->getResult();
    }
}
