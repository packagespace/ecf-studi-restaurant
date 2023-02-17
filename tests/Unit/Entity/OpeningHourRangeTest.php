<?php

namespace App\Tests\Unit\OpeningHours\Unit\Entity;

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
                'openingTime' => \DateTimeImmutable::createFromFormat('H:i', $openingTime),
                'closingTime' => \DateTimeImmutable::createFromFormat('H:i', $closingTime)
            ]);

        self::assertSame($expected, $openingHourRange->getReadableOpeningHourRange());
    }

    private function timeProvider(): \Generator
    {
        yield [
            '12:30',
            '13:00',
            '12:30 - 13:00'
        ];
    }
}
