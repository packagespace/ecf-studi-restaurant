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

    #[ORM\Column(type: Types::TIME_IMMUTABLE)]
    private ?\DateTimeImmutable $openingTime = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE)]
    private ?\DateTimeImmutable $closingTime = null;

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

    public function getOpeningTime(): ?\DateTimeImmutable
    {
        return $this->openingTime;
    }

    public function setOpeningTime(\DateTimeImmutable $openingTime): self
    {
        $this->openingTime = $openingTime;

        return $this;
    }

    public function getClosingTime(): ?\DateTimeImmutable
    {
        return $this->closingTime;
    }

    public function setClosingTime(\DateTimeImmutable $closingTime): self
    {
        $this->closingTime = $closingTime;

        return $this;
    }

    public function getReadableOpeningHourRange(): string
    {
        return $this->openingTime->format('H:i') . ' - ' . $this->closingTime->format('H:i');
    }
}
