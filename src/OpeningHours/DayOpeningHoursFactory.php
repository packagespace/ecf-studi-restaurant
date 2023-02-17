<?php

namespace App\OpeningHours;

use App\Entity\OpeningHourRange;

class DayOpeningHoursFactory
{

    /**
     * @param string $day
     * @param OpeningHourRange[] $openingHourRanges
     * @return DayOpeningHours
     */
    public function createDayOpeningHours(string $day, ?array $openingHourRanges): DayOpeningHours
    {
        $openingRanges = [];
        foreach ($openingHourRanges as $openingHourRange) {
            $openingRanges[] = $openingHourRange->getReadableOpeningHourRange();
        }
        return new DayOpeningHours($day, $openingRanges);
    }
}