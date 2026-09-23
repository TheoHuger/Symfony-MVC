<?php

namespace App\Entity;

use App\Repository\CeintureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CeintureRepository::class)]
class Ceinture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $couleurC = null;

    #[ORM\Column]
    private ?int $ageC = null;

    /**
     * @var Collection<int, Obtenir>
     */
    #[ORM\OneToMany(targetEntity: Obtenir::class, mappedBy: 'idC')]
    private Collection $obtenirs;

    public function __construct()
    {
        $this->obtenirs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCouleurC(): ?string
    {
        return $this->couleurC;
    }

    public function setCouleurC(string $couleurC): static
    {
        $this->couleurC = $couleurC;

        return $this;
    }

    public function getAgeC(): ?int
    {
        return $this->ageC;
    }

    public function setAgeC(int $ageC): static
    {
        $this->ageC = $ageC;

        return $this;
    }

    /**
     * @return Collection<int, Obtenir>
     */
    public function getObtenirs(): Collection
    {
        return $this->obtenirs;
    }

    public function addObtenir(Obtenir $obtenir): static
    {
        if (!$this->obtenirs->contains($obtenir)) {
            $this->obtenirs->add($obtenir);
            $obtenir->setIdC($this);
        }

        return $this;
    }

    public function removeObtenir(Obtenir $obtenir): static
    {
        if ($this->obtenirs->removeElement($obtenir)) {
            // set the owning side to null (unless already changed)
            if ($obtenir->getIdC() === $this) {
                $obtenir->setIdC(null);
            }
        }

        return $this;
    }
}
