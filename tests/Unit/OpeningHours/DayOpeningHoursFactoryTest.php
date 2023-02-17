<?php

namespace App\Tests\Unit\OpeningHours;

use App\Factory\OpeningHourRangeFactory;
use App\OpeningHours\DayOpeningHoursFactory;
use PHPUnit\Framework\TestCase;
use Zenstruck\Foundry\Test\Factories;

class DayOpeningHoursFactoryTest extends TestCase
{
    use Factories;

    /**
     * @dataProvider timeRangeProvider
     */
    public function testCreateDayOpeningHours($timeRanges, $expected)
    {
        $factory = new DayOpeningHoursFactory();
        $openingHourRanges = [];
        foreach ($timeRanges as $timeRange) {
            $openingHourRanges[] = OpeningHourRangeFactory::createOne(
                [
                    'day'         => 'monday',
                    'openingTime' => $timeRange[0],
                    'closingTime' => $timeRange[1],
                ]);
        }
        $a = $openingHourRanges;

        $dayOpeningHour = $factory->createDayOpeningHours('monday', $openingHourRanges);
        self::assertSame('monday', $dayOpeningHour->getDay());
        self::assertSame($expected, $dayOpeningHour->getOpeningHours());
    }

    private function timeRangeProvider(): \Generator
    {
        yield [
            [
                [
                    10, 12
                ]
            ],
            '10:00 - 12:00'
        ];
        yield [
            [
                [
                    12, 14
                ],
                [
                    19, 22
                ]
            ],
            '12:00 - 14:00, 19:00 - 22:00'
        ];
    }
}
