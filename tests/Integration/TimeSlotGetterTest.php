<?php

namespace App\Tests\Integration;

use App\Factory\DayOpeningHoursFactory;
use App\Factory\ReservationFactory;
use App\TimeSlotGetter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TimeSlotGetterTest extends KernelTestCase
{
    public function testSomething(): void
    {
        $kernel = self::bootKernel();
        $container = self::getContainer();
        $timeSlotGetter = $container->get(TimeSlotGetter::class);

        DayOpeningHoursFactory::truncate();
        ReservationFactory::truncate();
    }
}
