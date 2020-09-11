<?php

namespace App\Entity;

use App\Repository\HorseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HorseRepository::class)
 */
class Horse
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
    private $horseName;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $sexe;

   
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $courseResume;



    /**
     * @ORM\Column(type="integer")
     */
    private $age;
     /**
     * @ORM\OneToMany(targetEntity=Course::class, mappedBy="horse")
     */
    private $idCourse;

    /**
     * @ORM\OneToMany(targetEntity=Proprietaire::class, mappedBy="horseId")
     */
    private $proprietaires;

    /**
     * @ORM\ManyToOne(targetEntity=Proprietaire::class, inversedBy="HorseId")
     */
    private $proprietaire;

    public function __construct()
    {
        $this->proprietaires = new ArrayCollection();
    }

 


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHorseName(): ?string
    {
        return $this->horseName;
    }

    public function setHorseName(string $horseName): self
    {
        $this->horseName = $horseName;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    
    public function getCourseResume(): ?string
    {
        return $this->courseResume;
    }

    public function setCourseResume(string $courseResume): self
    {
        $this->courseResume = $courseResume;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

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
            $idCourse->setHorse($this);
        }

        return $this;
    }

    public function removeIdCourse(Course $idCourse): self
    {
        if ($this->idCourse->contains($idCourse)) {
            $this->idCourse->removeElement($idCourse);
            // set the owning side to null (unless already changed)
            if ($idCourse->getHorse() === $this) {
                $idCourse->setHorse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Proprietaire[]
     */
    public function getProprietaires(): Collection
    {
        return $this->proprietaires;
    }

    public function getProprietaire(): ?Proprietaire
    {
        return $this->proprietaire;
    }

    public function setProprietaire(?Proprietaire $proprietaire): self
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

   
  

    
}
