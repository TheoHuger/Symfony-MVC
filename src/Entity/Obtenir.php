<?php

namespace App\Entity;

use App\Repository\ObtenirRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ObtenirRepository::class)]
#[ORM\UniqueConstraint(name: 'unique_ceinture_adherent', columns: ['id_c_id', 'adherent_id'])]
class Obtenir
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateObtention = null;

    #[ORM\ManyToOne(inversedBy: 'obtenirs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ceinture $idC = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Adherent $adherent = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateObtention(): ?\DateTime
    {
        return $this->dateObtention;
    }

    public function setDateObtention(\DateTime $dateObtention): static
    {
        $this->dateObtention = $dateObtention;

        return $this;
    }

    public function getIdC(): ?Ceinture
    {
        return $this->idC;
    }

    public function setIdC(?Ceinture $idC): static
    {
        $this->idC = $idC;

        return $this;
    }

    public function getAdherent(): ?Adherent
    {
        return $this->adherent;
    }

    public function setAdherent(?Adherent $adherent): static
    {
        $this->adherent = $adherent;

        return $this;
    }
}
