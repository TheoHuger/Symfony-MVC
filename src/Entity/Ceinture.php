<?php

namespace App\Entity;

use App\Repository\CeintureRepository;
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
}
