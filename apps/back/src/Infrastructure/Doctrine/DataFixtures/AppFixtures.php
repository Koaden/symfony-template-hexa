<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Domain\Model\Category;
use Domain\Model\Product;
use Domain\Model\User;
use Application\Security\User as SymfonyUser;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $hasher
    ) {}

    public function load(ObjectManager $manager): void
    {
        $categories = [];
        $catNames = ['Électronique', 'Maison', 'Loisirs'];
        
        foreach ($catNames as $name) {
            $category = new Category($name, strtolower($name));
            $manager->persist($category);
            $categories[] = $category;
        }

        for ($i = 1; $i <= 10; $i++) {
            $product = new Product(
                "Produit $i",
                "produit-$i",
                random_int(1000, 5000),
                random_int(5, 20)
            );
            
            $product->setCategory($categories[array_rand($categories)]);
            $manager->persist($product);
        }

        $user = new User('client@test.com');
        $symfonyUser = new SymfonyUser($user);
        $password = $this->hasher->hashPassword($symfonyUser, 'password');
        $user->setPassword($password);
        $user->setRoles(['ROLE_USER']);
        
        $manager->persist($user);

        $manager->flush();
    }
}
