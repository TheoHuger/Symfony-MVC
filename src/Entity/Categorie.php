<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255)]
    private ?string $nomCat = null;

    #[ORM\Column]
    private ?int $ageCat = null;

    /**
     * @var Collection<int, Adherent>
     */
    #[ORM\OneToMany(targetEntity: Adherent::class, mappedBy: 'categorie')]
    private Collection $adherents;

    public function __construct()
    {
        $this->adherents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Adherent>
     */
    public function getAdherents(): Collection
    {
        return $this->adherents;
    }

    public function addAdherent(Adherent $adherent): static
    {
        if (!$this->adherents->contains($adherent)) {
            $this->adherents->add($adherent);
            $adherent->setCategorie($this);
        }

        return $this;
    }

    public function removeAdherent(Adherent $adherent): static
    {
        if ($this->adherents->removeElement($adherent)) {
            // set the owning side to null (unless already changed)
            if ($adherent->getCategorie() === $this) {
                $adherent->setCategorie(null);
            }
        }

        return $this;
    }
}
