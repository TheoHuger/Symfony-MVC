<?php

namespace App\Tests\Controller;

use App\Entity\Obtenir;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ObtenirControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;

    /** @var EntityRepository<Obtenir> */
    private EntityRepository $obtenirRepository;
    private string $path = '/obtenir/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->obtenirRepository = $this->manager->getRepository(Obtenir::class);

        foreach ($this->obtenirRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Obtenir index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'obtenir[dateObtention]' => 'Testing',
            'obtenir[idC]' => 'Testing',
            'obtenir[adherent]' => 'Testing',
        ]);

        self::assertResponseRedirects('/obtenir');

        self::assertSame(1, $this->obtenirRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }

    public function testShow(): void
    {
        $fixture = new Obtenir();
        $fixture->setDateObtention('My Title');
        $fixture->setIdC('My Title');
        $fixture->setAdherent('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Obtenir');

        // Use assertions to check that the properties are properly displayed.
        $this->markTestIncomplete('This test was generated');
    }

    public function testEdit(): void
    {
        $fixture = new Obtenir();
        $fixture->setDateObtention('Value');
        $fixture->setIdC('Value');
        $fixture->setAdherent('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'obtenir[dateObtention]' => 'Something New',
            'obtenir[idC]' => 'Something New',
            'obtenir[adherent]' => 'Something New',
        ]);

        self::assertResponseRedirects('/obtenir');

        $fixture = $this->obtenirRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getDateObtention());
        self::assertSame('Something New', $fixture[0]->getIdC());
        self::assertSame('Something New', $fixture[0]->getAdherent());

        $this->markTestIncomplete('This test was generated');
    }

    public function testRemove(): void
    {
        $fixture = new Obtenir();
        $fixture->setDateObtention('Value');
        $fixture->setIdC('Value');
        $fixture->setAdherent('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/obtenir');
        self::assertSame(0, $this->obtenirRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }
}
