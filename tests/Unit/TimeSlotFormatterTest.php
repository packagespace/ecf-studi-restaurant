<?php

namespace App\Tests\Unit;

use App\TimeSlotFormatter;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertSame;

class TimeSlotFormatterTest extends TestCase
{
    /**
     * @dataProvider timeSlotProvider
     */
    public function testFormatsTimeSlotsIntoAHumanReadableFormat(int $timeSlot, string $expected): void
    {
        $formatter = new TimeSlotFormatter();
        assertSame($expected, $formatter->getHumanReadableTimeSlot($timeSlot));
    }

    private function timeSlotProvider(): \Generator
    {
        yield [
            1230,
            '12:30'
        ];
        yield [
            1415,
            '14:15'
        ];
        yield [
            0000,
            '00:00'
        ];
        yield [
            1500,
            '15:00'
        ];
        yield [
            2330,
            '23:30'
        ];
    }

    /**
     * @dataProvider timeSlotArrayProvider
     */
    public function testFormatsAnArrayOfTimeSlotsIntoAnArrayOfHumanReadableFormats(array $timeSlots, array $expected)
    {
        $formatter = new TimeSlotFormatter();
        assertSame($expected, $formatter->getHumanReadableTimeSlotArray($timeSlots));
    }

    private function timeSlotArrayProvider(): \Generator
    {
        yield [
            [
                1230
            ],
            [
                '12:30'
            ]
        ];
        yield [
            [
                1230,
                1445
            ],
            [
                '12:30',
                '14:45'
            ]
        ];
        yield [
            [
            ],
            [
            ]
        ];
    }
}
