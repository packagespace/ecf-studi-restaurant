<?php

namespace App\DataFixtures;

use App\Entity\MaximumNumberOfGuests;
use App\Factory\DayOpeningHoursFactory;
use App\Factory\DishCategoryFactory;
use App\Factory\DishFactory;
use App\Factory\DishPhotoFactory;
use App\Factory\MenuFactory;
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
                                   'email'    => 'test@mail.com',
                                   'password' => 'root',
                                   'roles'    => ["ROLE_ADMIN"]
                               ]);
        DishPhotoFactory::createMany(10);

        DishCategoryFactory::createMany(5);
        DishFactory::createMany(20, fn() => ['category' => DishCategoryFactory::random()]);

        MenuFactory::createMany(3);
        SetMenuFactory::createMany(5, fn() => ['menu' => MenuFactory::random()]);

        DayOpeningHoursFactory::createOne(['dayOfWeek' => 'monday']);
        DayOpeningHoursFactory::createOne(['dayOfWeek' => 'wednesday']);
        DayOpeningHoursFactory::createOne(['dayOfWeek' => 'tuesday']);
        DayOpeningHoursFactory::createOne(['dayOfWeek' => 'thursday']);
        DayOpeningHoursFactory::createOne(['dayOfWeek' => 'friday']);
        DayOpeningHoursFactory::createOne(['dayOfWeek' => 'saturday']);
        DayOpeningHoursFactory::createOne(['dayOfWeek' => 'sunday']);
        $manager->persist((new MaximumNumberOfGuests())->setMaximumNumberOfGuests(10));
        $manager->flush();
    }
}
