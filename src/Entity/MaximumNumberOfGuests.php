<?php

namespace App\Entity;

use App\Repository\MaximumNumberOfGuestsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaximumNumberOfGuestsRepository::class)]
class MaximumNumberOfGuests
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $MaximumNumberOfGuests = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaximumNumberOfGuests(): ?int
    {
        return $this->MaximumNumberOfGuests;
    }

    public function setMaximumNumberOfGuests(int $MaximumNumberOfGuests): self
    {
        $this->MaximumNumberOfGuests = $MaximumNumberOfGuests;

        return $this;
    }
}
