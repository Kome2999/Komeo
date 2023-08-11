<?php

namespace App\Entity;


use App\Repository\MedicalRecordRepository;
use App\Entity\Dog;
use App\Entity\Vet;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass = MedicalRecordRepository::class)
 */
class MedicalRecord
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type = "integer")
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity = Dog::class)
     * @ORM\JoinColumn(nullable = false)
     */
    private ?Dog $dog = null;

    /**
     * @ORM\ManyToOne(targetEntity = Vet::class)
     * @ORM\JoinColumn(nullable = false)
     */
    private ?Vet $vet = null;

    /**
     * @ORM\Column(type = "date", nullable = true)
     */
    private ?\DateTimeInterface $examinationDate = null;

    /**
     * @ORM\Column(length = 255, nullable = true)
     */
    private ?string $examinationNotes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDog(): ?Dog
    {
        return $this->dog;
    }

    public function setDog(?Dog $dog): self
    {
        $this->dog = $dog;

        return $this;
    }

    public function getVet(): ?Vet
    {
        return $this->vet;
    }

    public function setVet(?Vet $vet): self
    {
        $this->vet = $vet;

        return $this;
    }

    public function getExaminationDate(): ?\DateTimeInterface
    {
        return $this->examinationDate;
    }

    public function setExaminationDate(?\DateTimeInterface $examinationDate): self
    {
        $this->examinationDate = $examinationDate;

        return $this;
    }

    public function getExaminationNotes(): ?string
    {
        return $this->examinationNotes;
    }

    public function setExaminationNotes(?string $examinationNotes): self
    {
        $this->examinationNotes = $examinationNotes;

        return $this;
    }
}
