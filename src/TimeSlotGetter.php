<?php

namespace App;

use App\Entity\DayOpeningHours;
use App\Repository\DayOpeningHoursRepository;
use App\Repository\ReservationRepository;

class TimeSlotGetter
{


    public function __construct(private readonly ReservationRepository $reservationRepository, private readonly DayOpeningHoursRepository $dayOpeningHoursRepository)
    {
    }

    public function getAvailableSlots(?DateTimeImmutable $date): ?array
    {
        /** @var DayOpeningHours $dayOpeningHours*/
        $dayOpeningHours = $this->dayOpeningHoursRepository->findBy(['dayOfWeek' => lcfirst($date->format('l'))]);
        $dayOpeningHours->getLunchTimeSlots();
        $dayOpeningHours->getDinnerTimeSlots();
    }
}