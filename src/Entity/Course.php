<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CourseRepository::class)
 */
class Course
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $distance;

    /**
     * @ORM\Column(type="integer")
     */
    public $numero;

    /**
     * @ORM\Column(type="integer")
     */
    private $gains;

    /**
     * @ORM\Column(type="float")
     */
    private $cote;

    /**
     * @ORM\ManyToOne(targetEntity=Entraineur::class, inversedBy="idCourse")
     */
    private $entraineur;

    /**
     * @ORM\ManyToOne(targetEntity=Horse::class, inversedBy="idCourse")
     */
    private $horse;

    /**
     * @ORM\ManyToOne(targetEntity=Jockey::class, inversedBy="idCourse")
     */
    private $jockey;

    /**
     * @ORM\OneToMany(targetEntity=SpecialisteChoice::class, mappedBy="course")
     */
    private $idSpecialisteChoice;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $date;


   
    public function __construct()
    {
        $this->idChoice = new ArrayCollection();
        $this->idSpecialisteChoice = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getDistance(): ?float
    {
        return $this->distance;
    }

    public function setDistance(float $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getGains(): ?int
    {
        return $this->gains;
    }

    public function setGains(int $gains): self
    {
        $this->gains = $gains;

        return $this;
    }

    public function getCote(): ?float
    {
        return $this->cote;
    }

    public function setCote(float $cote): self
    {
        $this->cote = $cote;

        return $this;
    }

    public function getEntraineur(): ?Entraineur
    {
        return $this->entraineur;
    }

    public function setEntraineur(?Entraineur $entraineur): self
    {
        $this->entraineur = $entraineur;

        return $this;
    }

    public function getHorse(): ?Horse
    {
        return $this->horse;
    }

    public function setHorse(?Horse $horse): self
    {
        $this->horse = $horse;

        return $this;
    }

    public function getJockey(): ?Jockey
    {
        return $this->jockey;
    }

    public function setJockey(?Jockey $jockey): self
    {
        $this->jockey = $jockey;

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
            $idSpecialisteChoice->setCourse($this);
        }

        return $this;
    }

    public function removeIdSpecialisteChoice(SpecialisteChoice $idSpecialisteChoice): self
    {
        if ($this->idSpecialisteChoice->contains($idSpecialisteChoice)) {
            $this->idSpecialisteChoice->removeElement($idSpecialisteChoice);
            // set the owning side to null (unless already changed)
            if ($idSpecialisteChoice->getCourse() === $this) {
                $idSpecialisteChoice->setCourse(null);
            }
        }

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

   

    

    

    
}
