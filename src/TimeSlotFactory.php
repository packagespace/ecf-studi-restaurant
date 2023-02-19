<?php

namespace App;

class TimeSlotFactory
{

    public function __construct()
    {
    }

    public function generateTimeSlot($prevResult = null): int
    {
        $rand = rand(min: 0, max: 2359);
        while (
            (($rand - (floor($rand / 100) * 100)) % 15 !== 0)
            || ($rand - (floor($rand / 100) * 100) > 59) || $rand === $prevResult) {
            $rand = rand(min: 0, max: 2359);
        }
        return $rand;
    }
}