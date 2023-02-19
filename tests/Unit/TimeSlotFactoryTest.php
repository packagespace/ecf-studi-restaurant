<?php

namespace App\Tests\Unit;

use App\TimeSlotFactory;
use PHPUnit\Framework\TestCase;

class TimeSlotFactoryTest extends TestCase
{
    public function testGeneratesCorrectTimesAsIntegers(): void
    {
        $timeSlot = TimeSlotFactory::generateTimeSlot();

        $hours = floor($timeSlot / 100);
        self::assertLessThanOrEqual(23, $hours);
        self::assertLessThanOrEqual(2359, $timeSlot);
        self::assertGreaterThanOrEqual(0, $timeSlot);
        self::assertLessThanOrEqual(59, $timeSlot - $hours * 100);
        self::assertEquals(0, ($timeSlot - $hours * 100) % 15);
        self::assertIsInt($timeSlot);
        for ($i = 0; $i < 10000; $i++) {
            self::assertNotEquals($timeSlot, TimeSlotFactory::generateTimeSlot($timeSlot));
        }
    }
}
