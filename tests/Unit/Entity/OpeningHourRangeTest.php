<?php

namespace App\Tests\Unit\Entity;

use App\Entity\OpeningHourRange;
use App\Factory\OpeningHourRangeFactory;
use PHPUnit\Framework\TestCase;
use Zenstruck\Foundry\Test\Factories;

class OpeningHourRangeTest extends TestCase
{

    use Factories;

    /**
     * @dataProvider timeProvider
     */
    public function testGetReadableOpeningHourRange($openingTime, $closingTime, $expected)
    {
        $openingHourRange = OpeningHourRangeFactory::createOne(
            [
                'day'         => 'monday',
                'openingTime' => $openingTime,
                'closingTime' => $closingTime
            ]);

        self::assertSame($expected, $openingHourRange->getReadableOpeningHourRange());
    }

    private function timeProvider(): \Generator
    {
        yield [
            12,
            13,
            '12:00 - 13:00'
        ];

        yield [
            12,
            15,
            '12:00 - 15:00'
        ];

        yield [
            19,
            23,
            '19:00 - 23:00'
        ];
    }
}
