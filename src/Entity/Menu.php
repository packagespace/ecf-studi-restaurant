<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: SetMenu::class)]
    private Collection $setMenus;

    public function __construct()
    {
        $this->setMenus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, SetMenu>
     */
    public function getSetMenus(): Collection
    {
        return $this->setMenus;
    }

    public function addSetMenu(SetMenu $setMenu): self
    {
        if (!$this->setMenus->contains($setMenu)) {
            $this->setMenus->add($setMenu);
            $setMenu->setMenu($this);
        }

        return $this;
    }

    public function removeSetMenu(SetMenu $setMenu): self
    {
        if ($this->setMenus->removeElement($setMenu)) {
            // set the owning side to null (unless already changed)
            if ($setMenu->getMenu() === $this) {
                $setMenu->setMenu(null);
            }
        }

        return $this;
    }
}
