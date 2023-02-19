<?php

namespace App;

class TimeSlotFormatter
{

    public function __construct()
    {
    }

    public function getHumanReadableTimeSlot(int $timeSlot): string
    {
        return substr_replace(sprintf('%04d', $timeSlot), ':', 2, 0);
    }

    public function getHumanReadableTimeSlotArray(array $timeSlots): array
    {
        return array_map(fn($timeSlot) => $this->getHumanReadableTimeSlot($timeSlot), $timeSlots);
    }
}