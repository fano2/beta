<?php

namespace App\Entity;

use App\Repository\JockeyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JockeyRepository::class)
 */
class Jockey
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
    private $jockeyName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $jockeyAge;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $poids;

    /**
     * @ORM\OneToMany(targetEntity=Course::class, mappedBy="jockey")
     */
    private $idCourse;

    public function __construct()
    {
        $this->idCourse = new ArrayCollection();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJockeyName(): ?string
    {
        return $this->jockeyName;
    }

    public function setJockeyName(string $jockeyName): self
    {
        $this->jockeyName = $jockeyName;

        return $this;
    }

    public function getJockeyAge(): ?int
    {
        return $this->jockeyAge;
    }

    public function setJockeyAge(?int $jockeyAge): self
    {
        $this->jockeyAge = $jockeyAge;

        return $this;
    }

    public function getPoids(): ?int
    {
        return $this->poids;
    }

    public function setPoids(?int $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    /**
     * @return Collection|Course[]
     */
    public function getIdCourse(): Collection
    {
        return $this->idCourse;
    }

    public function addIdCourse(Course $idCourse): self
    {
        if (!$this->idCourse->contains($idCourse)) {
            $this->idCourse[] = $idCourse;
            $idCourse->setJockey($this);
        }

        return $this;
    }

    public function removeIdCourse(Course $idCourse): self
    {
        if ($this->idCourse->contains($idCourse)) {
            $this->idCourse->removeElement($idCourse);
            // set the owning side to null (unless already changed)
            if ($idCourse->getJockey() === $this) {
                $idCourse->setJockey(null);
            }
        }

        return $this;
    }

    
}
