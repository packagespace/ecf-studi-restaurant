<?php

namespace App;

class TimeSlotFactory
{

    private function __construct()
    {
    }

    public static function generateTimeSlot($prevResult = null): int
    {
        do {
            $hours = rand(0, 23);
            $minutes = rand(0, 3) * 15;
            $rand = $hours * 100 + $minutes;
        } while ($rand === $prevResult);
        return $rand;
    }
}