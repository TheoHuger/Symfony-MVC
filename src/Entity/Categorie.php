<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idCat = null;

    #[ORM\Column(length: 255)]
    private ?string $nomCat = null;

    #[ORM\Column]
    private ?int $ageCat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCat(): ?int
    {
        return $this->idCat;
    }

    public function setIdCat(int $idCat): static
    {
        $this->idCat = $idCat;

        return $this;
    }

    public function getNomCat(): ?string
    {
        return $this->nomCat;
    }

    public function setNomCat(string $nomCat): static
    {
        $this->nomCat = $nomCat;

        return $this;
    }

    public function getAgeCat(): ?int
    {
        return $this->ageCat;
    }

    public function setAgeCat(int $ageCat): static
    {
        $this->ageCat = $ageCat;

        return $this;
    }
}
