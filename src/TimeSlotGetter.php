<?php

namespace App;

use App\Entity\DayOpeningHours;
use App\Entity\Reservation;
use App\Repository\DayOpeningHoursRepository;
use App\Repository\MaximumNumberOfGuestsRepository;
use App\Repository\ReservationRepository;
use DateTimeImmutable;

class TimeSlotGetter
{


    public function __construct(
        private readonly ReservationRepository     $reservationRepository,
        private readonly DayOpeningHoursRepository $dayOpeningHoursRepository,
        private readonly MaximumNumberOfGuestsRepository $maximumNumberOfGuestsRepository
    )
    {
    }

    public function getAvailableTimeSlots(?int $numberOfGuests, \DateTimeImmutable $date): array
    {
        $maxGuests = $this->maximumNumberOfGuestsRepository->findAll()[0]->getMaximumNumberOfGuests();
        /** @var ?DayOpeningHours $dayOpeningHours */
        $dayOpeningHours = $this->dayOpeningHoursRepository->findOneBy(['dayOfWeek' => lcfirst($date->format('l'))]);
        if (!$dayOpeningHours || $dayOpeningHours->isClosed()) {
            return [];
        }
        $reservations = $this->reservationRepository->findBy(['date' => $date]);
        $timeSlots = [];

        if ($this->dayOpeningHoursHasAvailableLunchSlots($reservations, $dayOpeningHours, $numberOfGuests, $maxGuests)) {
            $timeSlots = array_merge($timeSlots, $dayOpeningHours->getLunchTimeSlots());
        }

        if ($this->dayOpeningHoursHasAvailableDinnerSlots($reservations, $dayOpeningHours, $numberOfGuests, $maxGuests)) {
            $timeSlots = array_merge($timeSlots, $dayOpeningHours->getDinnerTimeSlots());
        }

        return $timeSlots;
    }

    /**
     * @param Reservation[] $reservations
     * @param DayOpeningHours $dayOpeningHours
     * @return bool
     */
    private function dayOpeningHoursHasAvailableLunchSlots(array $reservations, DayOpeningHours $dayOpeningHours, $numberOfGuests, $maxGuests): bool
    {
        $sumGuests = $numberOfGuests;
        foreach ($reservations as $reservation) {
            if ($this->reservationIsDuringLunch($reservation, $dayOpeningHours)) {
                $sumGuests += $reservation->getNumberOfGuests();
            }
        }
        return ($sumGuests <= $maxGuests);
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
    private function dayOpeningHoursHasAvailableDinnerSlots(array $reservations, DayOpeningHours $dayOpeningHours, $numberOfGuests, $maxGuests): bool
    {

        $sumGuests = $numberOfGuests;
        foreach ($reservations as $reservation) {
            if ($this->reservationIsDuringDinner($reservation, $dayOpeningHours)) {
                $sumGuests += $reservation->getNumberOfGuests();
            }
        }
        return ($sumGuests <= $maxGuests);
    }

    private function reservationIsDuringDinner(Reservation $reservation, DayOpeningHours $dayOpeningHours): bool
    {
        return ($reservation->getTime() / 100 >= $dayOpeningHours->getDinnerOpeningTime() && $reservation->getTime() / 100 <= $dayOpeningHours->getDinnerClosingTime());
    }
}