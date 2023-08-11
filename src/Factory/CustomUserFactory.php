<?php
// src/Factory/CustomUserFactory.php

namespace App\Factory;
use App\DataFixtures\User1Fixture;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CustomUserFactory
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function createUser(string $username, string $password, string $role): User
    {
        $user = new User();
        $user->setUsername($username);
        $user->setPassword($this->passwordHasher->hashPassword($user, $password));
        $user->setRoles([$role]); // Use setRoles() method instead

        return $user;
    }
}
