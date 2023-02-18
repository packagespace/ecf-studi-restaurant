<?php

namespace App;

use App\Entity\DayOpeningHours;
use App\Entity\Reservation;
use App\Repository\DayOpeningHoursRepository;
use App\Repository\ReservationRepository;
use DateTimeImmutable;

class TimeSlotGetter
{


    public function __construct(private readonly ReservationRepository $reservationRepository, private readonly DayOpeningHoursRepository $dayOpeningHoursRepository)
    {
    }

    public function getAvailableSlots(?DateTimeImmutable $date): ?array
    {
        /** @var DayOpeningHours $dayOpeningHours */
        $dayOpeningHours = $this->dayOpeningHoursRepository->findBy(['dayOfWeek' => lcfirst($date->format('l'))]);

        $dayOpeningHours->getLunchTimeSlots();
        $dayOpeningHours->getDinnerTimeSlots();
    }

    public function getAvailableTimeSlots(?int $numberOfGuests, \DateTimeImmutable $date): array
    {

        /** @var DayOpeningHours $dayOpeningHours */
        $dayOpeningHours = $this->dayOpeningHoursRepository->findOneBy(['dayOfWeek' => lcfirst($date->format('l'))]);
        $reservations = $this->reservationRepository->findBy(['date' => $date]);
        $timeSlots = [];

        if($this->dayOpeningHoursHasAvailableLunchSlots($reservations, $dayOpeningHours)){
            $timeSlots = array_merge($timeSlots, $dayOpeningHours->getLunchTimeSlots());
        }

        if($this->dayOpeningHoursHasAvailableDinnerSlots($reservations, $dayOpeningHours)){
            $timeSlots = array_merge($timeSlots, $dayOpeningHours->getDinnerTimeSlots());
        }

        return $timeSlots;
    }

    /**
     * @param Reservation[] $reservations
     * @param DayOpeningHours $dayOpeningHours
     * @return bool
     */
    private function dayOpeningHoursHasAvailableLunchSlots(array $reservations, DayOpeningHours $dayOpeningHours): bool
    {

        $sumGuests = 0;
        foreach ($reservations as $reservation) {
            if ($this->reservationIsDuringLunch($reservation, $dayOpeningHours)) {
                $sumGuests += $reservation->getNumberOfGuests();
            }
        }
        return ($sumGuests <= 10);
    }

    private function reservationIsDuringLunch(Reservation $reservation, DayOpeningHours $dayOpeningHours): bool
    {
        return ($reservation->getTime() / 100 >= $dayOpeningHours->getLunchOpeningTime() && $reservation->getTime() / 100 <= $dayOpeningHours->getLunchClosingTime());
    }

    /**
     * @param Reservation[] $reservations
     * @param DayOpeningHours $dayOpeningHours
     * @return bool
     */
    private function dayOpeningHoursHasAvailableDinnerSlots(array $reservations, DayOpeningHours $dayOpeningHours): bool
    {

        $sumGuests = 0;
        foreach ($reservations as $reservation) {
            if ($this->reservationIsDuringDinner($reservation, $dayOpeningHours)) {
                $sumGuests += $reservation->getNumberOfGuests();
            }
        }
        return ($sumGuests <= 10);
    }

    private function reservationIsDuringDinner(Reservation $reservation, DayOpeningHours $dayOpeningHours): bool
    {
        return ($reservation->getTime() / 100 >= $dayOpeningHours->getDinnerOpeningTime() && $reservation->getTime() / 100 <= $dayOpeningHours->getDinnerClosingTime());
    }
}