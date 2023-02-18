<?php

namespace App\Entity;

use App\Repository\DayOpeningHoursRepository;
use App\Validator\ValidDayOpeningHour;
use Doctrine\ORM\Mapping as ORM;

#[ValidDayOpeningHour]
#[ORM\Entity(repositoryClass: DayOpeningHoursRepository::class)]
class DayOpeningHours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $dayOfWeek = null;

    #[ORM\Column(nullable: true)]
    private ?int $lunchOpeningTime = null;

    #[ORM\Column(nullable: true)]
    private ?int $lunchClosingTime = null;

    #[ORM\Column(nullable: true)]
    private ?int $dinnerOpeningTime = null;

    #[ORM\Column(nullable: true)]
    private ?int $dinnerClosingTime = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDayOfWeek(): ?string
    {
        return $this->dayOfWeek;
    }

    public function setDayOfWeek(string $dayOfWeek): self
    {
        $this->dayOfWeek = $dayOfWeek;

        return $this;
    }

    public function getLunchOpeningTime(): ?int
    {
        return $this->lunchOpeningTime;
    }

    public function setLunchOpeningTime(?int $lunchOpeningTime): self
    {
        $this->lunchOpeningTime = $lunchOpeningTime;

        return $this;
    }

    public function getLunchClosingTime(): ?int
    {
        return $this->lunchClosingTime;
    }

    public function setLunchClosingTime(int $lunchClosingTime): self
    {
        $this->lunchClosingTime = $lunchClosingTime;

        return $this;
    }

    public function getDinnerOpeningTime(): ?int
    {
        return $this->dinnerOpeningTime;
    }

    public function setDinnerOpeningTime(?int $dinnerOpeningTime): self
    {
        $this->dinnerOpeningTime = $dinnerOpeningTime;

        return $this;
    }

    public function getDinnerClosingTime(): ?int
    {
        return $this->dinnerClosingTime;
    }

    public function setDinnerClosingTime(?int $dinnerClosingTime): self
    {
        $this->dinnerClosingTime = $dinnerClosingTime;

        return $this;
    }
}
