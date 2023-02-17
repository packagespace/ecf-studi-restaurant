<?php

namespace App\Entity;

use App\Repository\OpeningHourRangeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpeningHourRangeRepository::class)]
class OpeningHourRange
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $day = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $openingTime = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $closingTime = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getOpeningTime(): int
    {
        return $this->openingTime;
    }

    public function setOpeningTime(int $openingTime): self
    {
        $this->openingTime = $openingTime;

        return $this;
    }

    public function getClosingTime(): int
    {
        return $this->closingTime;
    }

    public function setClosingTime(int $closingTime): self
    {
        $this->closingTime = $closingTime;

        return $this;
    }

    public function getReadableOpeningHourRange(): string
    {
        return $this->openingTime . ':00 - ' . $this->closingTime . ':00';
    }
}
