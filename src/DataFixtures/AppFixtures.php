<?php

namespace App\DataFixtures;

use App\Factory\DayOpeningHoursFactory;
use App\Factory\DishCategoryFactory;
use App\Factory\DishFactory;
use App\Factory\DishPhotoFactory;
use App\Factory\MenuFactory;
use App\Factory\OpeningHourRangeFactory;
use App\Factory\SetMenuFactory;
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
        DishFactory::createMany(20, fn() => ['category' => DishCategoryFactory::random()]);

        MenuFactory::createMany(3);
        SetMenuFactory::createMany(5, fn() => ['menu' => MenuFactory::random()]);

        OpeningHourRangeFactory::createMany(10);

        DayOpeningHoursFactory::createMany(10);
        $manager->flush();
    }
}
