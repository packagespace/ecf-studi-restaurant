<?php

namespace App\DataFixtures;

use App\Factory\DishCategoryFactory;
use App\Factory\DishFactory;
use App\Factory\DishPhotoFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createMany(10);
        UserFactory::createOne([
            'email' => 'test@mail.com',
            'password' => 'root',
            'roles' => ["ROLE_ADMIN"]
        ]);
        DishPhotoFactory::createMany(10);

        DishCategoryFactory::createMany(5);
        DishFactory::createMany(20, ['category' => DishCategoryFactory::random()]);
        $manager->flush();
    }
}
