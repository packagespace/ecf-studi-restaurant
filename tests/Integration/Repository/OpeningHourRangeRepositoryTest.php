<?php

namespace App\Tests\Unit\OpeningHours\Integration\Integration\Repository;

use App\Factory\OpeningHourRangeFactory;
use App\Repository\OpeningHourRangeRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OpeningHourRangeRepositoryTest extends KernelTestCase
{
    public function testGetOpenDaysOnlyReturnsDistinctDayLabels()
    {
        self::bootKernel();
        $container = self::getContainer();
        $repository = $container->get(OpeningHourRangeRepository::class);

        $openDays = $repository->getOpenDays();

        self::assertIsArray($openDays);
        self::assertGreaterThanOrEqual(1, count($openDays));
        self::assertSameSize(
            array_unique($openDays),
            $openDays
        );
    }

    /**
     * @dataProvider dayProvider
     */
    public function testGetOpenDaysReturnsAllDaysPresentInDatabase($openOn, $closedOn)
    {
        self::bootKernel();
        $container = self::getContainer();
        $repository = $container->get(OpeningHourRangeRepository::class);
        OpeningHourRangeFactory::truncate();
        foreach ($openOn as $openDay) {
            OpeningHourRangeFactory::createOne(['day' => $openDay]);
        }
        $openDays = $repository->getOpenDays();
        foreach ($openOn as $openDay) {
            self::assertContains($openDay, $openDays);
        }
        foreach ($closedOn as $closedDay) {
            self::assertNotContains($closedDay, $openDays);
        }
    }

    private function dayProvider(): \Generator
    {
        yield [
            [
                'monday',
                'tuesday',
                'wednesday'
            ],
            [
                'thursday',
                'friday',
                'saturday',
                'sunday',
            ]
        ];
        yield [
            [
                'tuesday',
                'wednesday'
            ],
            [
                'monday',
                'thursday',
                'friday',
                'saturday',
                'sunday',
            ]
        ];
        yield [
            [

            ],
            [
                'tuesday',
                'wednesday',
                'monday',
                'thursday',
                'friday',
                'saturday',
                'sunday',
            ]
        ];

    }
}
