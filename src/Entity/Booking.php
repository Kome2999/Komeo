<?php

// src/Entity/Booking.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Booking
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

    // Add other booking properties if needed

    // Getters and setters
}

