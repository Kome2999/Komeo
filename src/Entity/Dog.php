<?php



namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Dog
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $breed;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sex;

    /**
     * @ORM\Column(type="float")
     */
    private $weight;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $dietaryRequirements;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $medicineRequirements;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $specialNotes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vaccinationStatus;

   /**
     * @ORM\ManyToOne(targetEntity="Owner", inversedBy="dogs")
     * @ORM\JoinColumn(nullable=true) // Set nullable to true
     */
    private $owner;

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getBreed(): ?string
    {
        return $this->breed;
    }

    public function setBreed(string $breed): self
    {
        $this->breed = $breed;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getDietaryRequirements(): ?string
    {
        return $this->dietaryRequirements;
    }

    public function setDietaryRequirements(?string $dietaryRequirements): self
    {
        $this->dietaryRequirements = $dietaryRequirements;

        return $this;
    }

    public function getMedicineRequirements(): ?string
    {
        return $this->medicineRequirements;
    }

    public function setMedicineRequirements(?string $medicineRequirements): self
    {
        $this->medicineRequirements = $medicineRequirements;

        return $this;
    }

    public function getSpecialNotes(): ?string
    {
        return $this->specialNotes;
    }

    public function setSpecialNotes(?string $specialNotes): self
    {
        $this->specialNotes = $specialNotes;

        return $this;
    }

    public function getVaccinationStatus(): ?string
    {
        return $this->vaccinationStatus;
    }

    public function setVaccinationStatus(string $vaccinationStatus): self
    {
        $this->vaccinationStatus = $vaccinationStatus;

        return $this;
    }

    public function getOwner(): ?Owner
    {
        return $this->owner;
    }

    public function setOwner(Owner $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name; // Use the 'name' property as the string representation of the Dog entity
    }
}