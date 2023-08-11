<?php

namespace App\Test\Controller;

use App\Entity\Allocation;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AllocationControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/allocation/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Allocation::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Allocation index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'allocation[allocationDate]' => 'Testing',
            'allocation[dog]' => 'Testing',
            'allocation[keeper]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Allocation();
        $fixture->setAllocationDate('My Title');
        $fixture->setDog('My Title');
        $fixture->setKeeper('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Allocation');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Allocation();
        $fixture->setAllocationDate('Value');
        $fixture->setDog('Value');
        $fixture->setKeeper('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'allocation[allocationDate]' => 'Something New',
            'allocation[dog]' => 'Something New',
            'allocation[keeper]' => 'Something New',
        ]);

        self::assertResponseRedirects('/allocation/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getAllocationDate());
        self::assertSame('Something New', $fixture[0]->getDog());
        self::assertSame('Something New', $fixture[0]->getKeeper());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Allocation();
        $fixture->setAllocationDate('Value');
        $fixture->setDog('Value');
        $fixture->setKeeper('Value');

        $$this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/allocation/');
        self::assertSame(0, $this->repository->count([]));
    }
}
