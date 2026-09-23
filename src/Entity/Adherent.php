<?php

namespace App\Entity;

use App\Repository\AdherentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdherentRepository::class)]
class Adherent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomJ = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column]
    private ?\DateTime $dateNaissJ = null;

    #[ORM\ManyToOne(inversedBy: 'adherents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

    /**
     * @var Collection<int, Obtenir>
     */
    #[ORM\OneToMany(targetEntity: Obtenir::class, mappedBy: 'adherent', orphanRemoval: true)]
    private Collection $obtenirs;

    public function __construct()
    {
        $this->obtenirs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomJ(): ?string
    {
        return $this->nomJ;
    }

    public function setNomJ(string $nomJ): static
    {
        $this->nomJ = $nomJ;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissJ(): ?\DateTime
    {
        return $this->dateNaissJ;
    }

    public function setDateNaissJ(\DateTime $dateNaissJ): static
    {
        $this->dateNaissJ = $dateNaissJ;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

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
            $obtenir->setAdherent($this);
        }

        return $this;
    }

    public function removeObtenir(Obtenir $obtenir): static
    {
        if ($this->obtenirs->removeElement($obtenir)) {
            // set the owning side to null (unless already changed)
            if ($obtenir->getAdherent() === $this) {
                $obtenir->setAdherent(null);
            }
        }

        return $this;
    }
}
