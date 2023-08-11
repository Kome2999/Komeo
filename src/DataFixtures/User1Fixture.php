<?php


// src/DataFixtures/User1Fixture.php

// src/DataFixtures/User1Fixture.php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\CustomUserFactory;

class User1Fixture extends Fixture
{
    private $customUserFactory;

    public function __construct(CustomUserFactory $customUserFactory)
    {
        $this->customUserFactory = $customUserFactory;
    }

    public function load(ObjectManager $manager)
    {
        // Create a new user with the "manager" role
        $user = $this->customUserFactory->createUser('manager@example.com', 'managerpassword', 'ROLE_MANAGER');
        $manager->persist($user);

        // Create a user with the "owner" role
        $owner = $this->customUserFactory->createUser('owner@example.com', 'ownerpassword', 'ROLE_OWNER');
        $manager->persist($owner);

        // Create a user with the "user" role
        $normalUser = $this->customUserFactory->createUser('user@example.com', 'userpassword', 'ROLE_USER');
        $manager->persist($normalUser);

        // Create an admin with the "admin" role
        $admin = $this->customUserFactory->createUser('admin@example.com', 'adminpassword', 'ROLE_ADMIN');
        $manager->persist($admin);

        // Create a user with the "vet" role
        $vetUser = $this->customUserFactory->createUser('vet@example.com', 'vetpassword', 'ROLE_VET');
        $manager->persist($vetUser);

        // Create a user with the "keeper" role
        $keeperUser = $this->customUserFactory->createUser('keeper@example.com', 'keeperpassword', 'ROLE_KEEPER');
        $manager->persist($keeperUser);

        $manager->flush();
    }
}

