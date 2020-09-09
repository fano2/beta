<?php

namespace App\Entity;

use App\Repository\ProprietaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProprietaireRepository::class)
 */
class Proprietaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $proprietaireName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adress;

    /**
     * @ORM\OneToMany(targetEntity=Horse::class, mappedBy="proprietaire")
     */
    private $HorseId;

    public function __construct()
    {
        $this->HorseId = new ArrayCollection();
    }

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProprietaireName(): ?string
    {
        return $this->proprietaireName;
    }

    public function setProprietaireName(string $proprietaireName): self
    {
        $this->proprietaireName = $proprietaireName;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * @return Collection|Horse[]
     */
    public function getHorseId(): Collection
    {
        return $this->HorseId;
    }

    public function addHorseId(Horse $horseId): self
    {
        if (!$this->HorseId->contains($horseId)) {
            $this->HorseId[] = $horseId;
            $horseId->setProprietaire($this);
        }

        return $this;
    }

    public function removeHorseId(Horse $horseId): self
    {
        if ($this->HorseId->contains($horseId)) {
            $this->HorseId->removeElement($horseId);
            // set the owning side to null (unless already changed)
            if ($horseId->getProprietaire() === $this) {
                $horseId->setProprietaire(null);
            }
        }

        return $this;
    }
}
