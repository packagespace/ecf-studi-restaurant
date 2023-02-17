<?php

namespace App\OpeningHours;

class DayOpeningHours
{
    private string $day;

    private array $openingRanges;

    /**
     * @param string $day
     * @param array $openingRanges
     * @internal
     */
    public function __construct(string $day, array $openingRanges)
    {
        $this->day = $day;
        $this->openingRanges = $openingRanges;
    }

    /**
     * @return string
     */
    public function getDay(): string
    {
        return $this->day;
    }

    /**
     * @param string $day
     */
    public function setDay(string $day): void
    {
        $this->day = $day;
    }

    /**
     * @return array
     */
    public function getOpeningRanges(): array
    {
        return $this->openingRanges;
    }

    /**
     * @param array $openingRanges
     */
    public function setOpeningRanges(array $openingRanges): void
    {
        $this->openingRanges = $openingRanges;
    }

    public function getOpeningHours(): string
    {
        return implode(', ', $this->getOpeningRanges());
    }

    public function getDayLabel(): string
    {
        return ucfirst($this->getDay());
    }
}