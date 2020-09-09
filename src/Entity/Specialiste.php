<?php

namespace App\Entity;

use App\Repository\SpecialisteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpecialisteRepository::class)
 */
class Specialiste
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $specialisteName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $specialisteAge;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $job;

    /**
     * @ORM\OneToMany(targetEntity=SpecialisteChoice::class, mappedBy="specialiste")
     */
    private $idSpecialisteChoice;

    public function __construct()
    {
        $this->idSpecialisteChoice = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id;
        return $this;
    }

    public function getSpecialisteName(): ?string
    {
        return $this->specialisteName;
    }

    public function setSpecialisteName(string $specialisteName): self
    {
        $this->specialisteName = $specialisteName;

        return $this;
    }

    public function getSpecialisteAge(): ?int
    {
        return $this->specialisteAge;
    }

    public function setSpecialisteAge(?int $specialisteAge): self
    {
        $this->specialisteAge = $specialisteAge;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(?string $job): self
    {
        $this->job = $job;

        return $this;
    }

    /**
     * @return Collection|SpecialisteChoice[]
     */
    public function getIdSpecialisteChoice(): Collection
    {
        return $this->idSpecialisteChoice;
    }

    public function addIdSpecialisteChoice(SpecialisteChoice $idSpecialisteChoice): self
    {
        if (!$this->idSpecialisteChoice->contains($idSpecialisteChoice)) {
            $this->idSpecialisteChoice[] = $idSpecialisteChoice;
            $idSpecialisteChoice->setSpecialiste($this);
        }

        return $this;
    }

    public function removeIdSpecialisteChoice(SpecialisteChoice $idSpecialisteChoice): self
    {
        if ($this->idSpecialisteChoice->contains($idSpecialisteChoice)) {
            $this->idSpecialisteChoice->removeElement($idSpecialisteChoice);
            // set the owning side to null (unless already changed)
            if ($idSpecialisteChoice->getSpecialiste() === $this) {
                $idSpecialisteChoice->setSpecialiste(null);
            }
        }

        return $this;
    }
}
