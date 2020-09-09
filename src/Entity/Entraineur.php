<?php

namespace App\Entity;

use App\Repository\EntraineurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntraineurRepository::class)
 */
class Entraineur
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
    private $entraineurName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $EntraineurAge;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $entraineurSexe;

    /**
     * @ORM\OneToMany(targetEntity=Course::class, mappedBy="entraineur")
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

    public function getEntraineurName(): ?string
    {
        return $this->entraineurName;
    }

    public function setEntraineurName(string $entraineurName): self
    {
        $this->entraineurName = $entraineurName;

        return $this;
    }

    public function getEntraineurAge(): ?int
    {
        return $this->EntraineurAge;
    }

    public function setEntraineurAge(?int $EntraineurAge): self
    {
        $this->EntraineurAge = $EntraineurAge;

        return $this;
    }

    public function getEntraineurSexe(): ?string
    {
        return $this->entraineurSexe;
    }

    public function setEntraineurSexe(?string $entraineurSexe): self
    {
        $this->entraineurSexe = $entraineurSexe;

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
            $idCourse->setEntraineur($this);
        }

        return $this;
    }

    public function removeIdCourse(Course $idCourse): self
    {
        if ($this->idCourse->contains($idCourse)) {
            $this->idCourse->removeElement($idCourse);
            // set the owning side to null (unless already changed)
            if ($idCourse->getEntraineur() === $this) {
                $idCourse->setEntraineur(null);
            }
        }

        return $this;
    }

    
}
