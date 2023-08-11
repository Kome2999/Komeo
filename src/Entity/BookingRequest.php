<?php

// src/Entity/BookingRequest.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class BookingRequest
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
     * @ORM\Column(type="date")
     */
    private $startDate;

    /**
     * @ORM\Column(type="date")
     */
    private $endDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $approved = false; // Set the default value to false

    /**
     * @ORM\Column(type="boolean")
     */
    private $isolationKennelAvailable;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sharedSocialKennelAvailable;

    /**
     * @ORM\Column(type="string")
     */
    private $vaccinationStatus;

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

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function isApproved(): bool
    {
        return $this->approved;
    }

    public function setApproved(bool $approved): void
    {
        $this->approved = $approved;
    }

    public function setIsolationKennelAvailable(bool $isolationKennelAvailable): void
    {
        $this->isolationKennelAvailable = $isolationKennelAvailable;
    }

    public function isIsolationKennelAvailable(): bool
    {
        return $this->isolationKennelAvailable;
    }

    public function setSharedSocialKennelAvailable(bool $sharedSocialKennelAvailable): void
    {
        $this->sharedSocialKennelAvailable = $sharedSocialKennelAvailable;
    }

    public function isSharedSocialKennelAvailable(): bool
    {
        return $this->sharedSocialKennelAvailable;
    }

    public function getVaccinationStatus(): ?string
    {
        return $this->vaccinationStatus;
    }

    public function setVaccinationStatus(string $vaccinationStatus): void
    {
        $this->vaccinationStatus = $vaccinationStatus;
    }

    // ...
}
