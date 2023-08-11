<?php

namespace App\Test\Controller;

use App\Entity\Dog;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DogControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/dog/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Dog::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Dog index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'dog[name]' => 'Testing',
            'dog[age]' => 'Testing',
            'dog[breed]' => 'Testing',
            'dog[sex]' => 'Testing',
            'dog[weight]' => 'Testing',
            'dog[dietaryRequirements]' => 'Testing',
            'dog[medicineRequirements]' => 'Testing',
            'dog[specialNotes]' => 'Testing',
            'dog[owner]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Dog();
        $fixture->setName('My Title');
        $fixture->setAge('My Title');
        $fixture->setBreed('My Title');
        $fixture->setSex('My Title');
        $fixture->setWeight('My Title');
        $fixture->setDietaryRequirements('My Title');
        $fixture->setMedicineRequirements('My Title');
        $fixture->setSpecialNotes('My Title');
        $fixture->setOwner('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Dog');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Dog();
        $fixture->setName('Value');
        $fixture->setAge('Value');
        $fixture->setBreed('Value');
        $fixture->setSex('Value');
        $fixture->setWeight('Value');
        $fixture->setDietaryRequirements('Value');
        $fixture->setMedicineRequirements('Value');
        $fixture->setSpecialNotes('Value');
        $fixture->setOwner('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'dog[name]' => 'Something New',
            'dog[age]' => 'Something New',
            'dog[breed]' => 'Something New',
            'dog[sex]' => 'Something New',
            'dog[weight]' => 'Something New',
            'dog[dietaryRequirements]' => 'Something New',
            'dog[medicineRequirements]' => 'Something New',
            'dog[specialNotes]' => 'Something New',
            'dog[owner]' => 'Something New',
        ]);

        self::assertResponseRedirects('/dog/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getAge());
        self::assertSame('Something New', $fixture[0]->getBreed());
        self::assertSame('Something New', $fixture[0]->getSex());
        self::assertSame('Something New', $fixture[0]->getWeight());
        self::assertSame('Something New', $fixture[0]->getDietaryRequirements());
        self::assertSame('Something New', $fixture[0]->getMedicineRequirements());
        self::assertSame('Something New', $fixture[0]->getSpecialNotes());
        self::assertSame('Something New', $fixture[0]->getOwner());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Dog();
        $fixture->setName('Value');
        $fixture->setAge('Value');
        $fixture->setBreed('Value');
        $fixture->setSex('Value');
        $fixture->setWeight('Value');
        $fixture->setDietaryRequirements('Value');
        $fixture->setMedicineRequirements('Value');
        $fixture->setSpecialNotes('Value');
        $fixture->setOwner('Value');

        $$this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/dog/');
        self::assertSame(0, $this->repository->count([]));
    }
}
