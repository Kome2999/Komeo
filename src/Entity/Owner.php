<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Owner
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

    // Add other owner properties, such as address and contact details

    /**
     * @ORM\OneToMany(targetEntity="Dog", mappedBy="owner", cascade={"persist", "remove"})
     */
    private $dogs;

    public function __construct()
    {
        $this->dogs = new ArrayCollection();
    }

    // Getters and setters

    public function addDog(Dog $dog)
    {
        $this->dogs[] = $dog;
        $dog->setOwner($this);
    }

    public function removeDog(Dog $dog)
    {
        $this->dogs->removeElement($dog);
        $dog->setOwner(null);
    }
}