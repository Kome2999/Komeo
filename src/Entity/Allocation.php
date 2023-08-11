<?php

// src/Entity/Allocation.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Allocation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Dog")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dog;

    /**
     * @ORM\ManyToOne(targetEntity="Keeper")
     * @ORM\JoinColumn(nullable=false)
     */
    private $keeper;

    /**
     * @ORM\Column(type="date")
     */
    private $allocationDate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $notes;

    // Getters and setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDog(): ?Dog
    {
        return $this->dog;
    }

    public function setDog(?Dog $dog): void
    {
        $this->dog = $dog;
    }

    public function getKeeper(): ?Keeper
    {
        return $this->keeper;
    }

    public function setKeeper(?Keeper $keeper): void
    {
        $this->keeper = $keeper;
    }

    public function getAllocationDate(): ?\DateTimeInterface
    {
        return $this->allocationDate;
    }

    public function setAllocationDate(\DateTimeInterface $allocationDate): void
    {
        $this->allocationDate = $allocationDate;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): void
    {
        $this->notes = $notes;
    }
}
