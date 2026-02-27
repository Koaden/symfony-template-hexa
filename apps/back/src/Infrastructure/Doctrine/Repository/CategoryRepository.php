<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Domain\Collection\Categories;
use Domain\Model\Category;

class CategoryRepository implements Categories
{
    public function __construct(private EntityManagerInterface $em) {}

    public function add(Category $category): void
    {
        $this->em->persist($category);
    }

    /** @return iterable<Category> */
    public function findAll(): iterable
    {
        return $this->em->getRepository(Category::class)->findAll();
    }
}
