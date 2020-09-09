<?php

namespace App\Entity;

use App\Repository\SpecialisteChoiceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpecialisteChoiceRepository::class)
 */
class SpecialisteChoice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="integer")
     */
    public $rang;

    /**
     * @ORM\ManyToOne(targetEntity=Course::class, inversedBy="idSpecialisteChoice")
     */
    public $course;

    /**
     * @ORM\ManyToOne(targetEntity=Specialiste::class, inversedBy="idSpecialisteChoice")
     */
    public $specialiste;

    /**
     * @ORM\Column(type="string", length=12)
     */
    public $datechoice;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRang(): ?int
    {
        return $this->rang;
    }

    public function setRang(int $rang): self
    {
        $this->rang = $rang;

        return $this;
    }

    

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): self
    {
        $this->course = $course;

        return $this;
    }

    public function getSpecialiste(): ?Specialiste
    {
        return $this->specialiste;
    }

    public function setSpecialiste(?Specialiste $specialiste): self
    {
        $this->specialiste = $specialiste;

        return $this;
    }

    public function getDatechoice(): ?string
    {
        return $this->datechoice;
    }

    public function setDatechoice(string $datechoice): self
    {
        $this->datechoice = $datechoice;

        return $this;
    }
}
