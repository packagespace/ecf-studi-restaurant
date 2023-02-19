<?php

namespace App\Tests\Integration;

use App\Factory\DayOpeningHoursFactory;
use App\Factory\ReservationFactory;
use App\TimeSlotGetter;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TimeSlotGetterTest extends KernelTestCase
{
    private ?TimeSlotGetter $timeSlotGetter;
    private DateTimeImmutable $date;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->timeSlotGetter = $container->get(TimeSlotGetter::class);

        DayOpeningHoursFactory::truncate();
        ReservationFactory::truncate();

        DayOpeningHoursFactory::createOne(
            [
                'dayOfWeek'         => 'wednesday',
                'lunchOpeningTime'  => 12,
                'lunchClosingTime'  => 14,
                'dinnerOpeningTime' => 19,
                'dinnerClosingTime' => 22
            ])->object();
        $this->date = \DateTimeImmutable::createFromFormat('l d/m/Y', 'wednesday 22/02/2023');
    }

    public function testGetCorrectReservationsWhenBothServicesEmpty(): void
    {
        self::assertSame(
            [
                1200,
                1215,
                1230,
                1245,
                1300,
                1900,
                1915,
                1930,
                1945,
                2000,
                2015,
                2030,
                2045,
                2100
            ],
            $this->timeSlotGetter->getAvailableTimeSlots(3, $this->date));
    }

    public function testGetCorrectReservationsWhenLunchServiceIsFull(): void
    {
        ReservationFactory::createMany(100, [
            'date' => $this->date,
            'time' => 1200
        ]);
        self::assertSame(
            [
                1900,
                1915,
                1930,
                1945,
                2000,
                2015,
                2030,
                2045,
                2100
            ],
            $this->timeSlotGetter->getAvailableTimeSlots(3, $this->date));
    }

    public function testGetCorrectReservationsWhenDinnerServiceIsFull(): void
    {
        ReservationFactory::createMany(100, [
            'date' => $this->date,
            'time' => 2000
        ]);
        self::assertSame(
            [
                1200,
                1215,
                1230,
                1245,
                1300,
            ],
            $this->timeSlotGetter->getAvailableTimeSlots(3, $this->date));
    }

    public function testReturnsAnEmptyArrayIfBothServicesAreFull()
    {
        ReservationFactory::createMany(100, [
            'date' => $this->date,
            'time' => 1200
        ]);
        ReservationFactory::createMany(100, [
            'date' => $this->date,
            'time' => 2000
        ]);

        self::assertSame(
            [],
            $this->timeSlotGetter->getAvailableTimeSlots(3, $this->date
            ));
    }


}
