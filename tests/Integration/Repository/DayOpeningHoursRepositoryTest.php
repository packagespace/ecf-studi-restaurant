<?php

namespace App\Tests\Integration\Repository;

use App\Repository\DayOpeningHoursRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DayOpeningHoursRepositoryTest extends KernelTestCase
{

    public function testFindAllInOrder()
    {
        self::bootKernel();
        $container = self::getContainer();

        /** @var DayOpeningHoursRepository $repository*/
        $repository = $container->get(DayOpeningHoursRepository::class);

        $dayOpeningHours = $repository->findAllInOrder();

        self::assertSame('monday',$dayOpeningHours[0]->getDayOfWeek());
        self::assertSame('tuesday',$dayOpeningHours[1]->getDayOfWeek());
        self::assertSame('wednesday',$dayOpeningHours[2]->getDayOfWeek());
        self::assertSame('thursday',$dayOpeningHours[3]->getDayOfWeek());
        self::assertSame('friday',$dayOpeningHours[4]->getDayOfWeek());
        self::assertSame('saturday',$dayOpeningHours[5]->getDayOfWeek());
        self::assertSame('sunday',$dayOpeningHours[6]->getDayOfWeek());
    }
}
