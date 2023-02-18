<?php

namespace App\OpeningHours;

use App\Repository\DayOpeningHoursRepository;
use App\Repository\OpeningHourRangeRepository;

class OpeningHoursCompiler
{

    public function __construct(
        private readonly DayOpeningHoursRepository $repository,
        private readonly DayOpeningHoursFactory     $dayOpeningHoursFactory)
    {
    }

    public function getOpeningHours(): array
    {
        $daysOfWeek = [
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
            'sunday'
        ];
        $dayOpeningHours = $this->repository->findAll();
        $openingHours = [];
        foreach ($openDaysSorted as $openDay) {
            $openingHours[] = $this->getDayOpeningHours($openDay);
        }
        return $openingHours;
    }

    private function getDayOpeningHours(string $day): DayOpeningHours
    {
        $openingRanges = $this->repository->findBy(['day' => $day]);
        return $this->dayOpeningHoursFactory->createDayOpeningHours($day, $openingRanges);
    }
}