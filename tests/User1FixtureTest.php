<?php

// tests/DataFixtures/User1FixtureTest.php

namespace App\Tests\DataFixtures;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\DataFixtures\User1Fixture;
use App\Factory\CustomUserFactory;
use Doctrine\Persistence\ObjectManager;

class User1FixtureTest extends KernelTestCase
{
    private $entityManager;
    private $customUserFactory;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->entityManager = self::$container->get('doctrine')->getManager();
        $this->customUserFactory = self::$container->get(CustomUserFactory::class);
    }

    public function testUser1FixtureLoadsUsers()
    {
        $fixture = new User1Fixture($this->customUserFactory);
        $fixture->load($this->entityManager);

        // Test that the users are correctly loaded into the database
        $users = $this->entityManager->getRepository(User::class)->findAll();
        $this->assertCount(6, $users); // Assuming you have a total of 6 users in the fixture

        // Add more assertions here if needed
    }

    // You can add more test methods here to test specific scenarios related to the fixture
}
