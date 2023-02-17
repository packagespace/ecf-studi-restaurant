<?php

namespace App\Tests\Unit\OpeningHours\Integration\Functional\Functional\Controller;

use App\Factory\UserFactory;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexControllerTest extends WebTestCase
{
    const INDEX_URL = '/';

    public function testIndexRendersWithCorrectTitle(): void
    {
        $client = static::createClient();
        $client->request('GET', self::INDEX_URL);

        $this->assertResponseIsSuccessful();
        $this->assertPageTitleSame('Le Quai Antique');
    }

    public function testIndexRendersImages()
    {
        $client = static::createClient();
        $client->request('GET', self::INDEX_URL);

        $this->assertSelectorExists('img.gallery-image');
    }

    public function testIndexHasReservationButton()
    {
        $client = static::createClient();
        $client->request('GET', self::INDEX_URL);

        $this->assertSelectorTextSame('a#reserve-link-main', 'Réserver');
    }

    public function testIndexHasMenuButton()
    {
        $client = static::createClient();
        $client->request('GET', self::INDEX_URL);

        $this->assertSelectorTextSame('a#menu-link', 'Carte et Menus');
    }

    public function testClickingOnMenuButtonRedirectsToMenu()
    {
        $client = static::createClient();
        $client->followRedirects();
        $client->request('GET', self::INDEX_URL);

        $client->clickLink('Carte et Menus');

        $this->assertPageTitleSame('Le Quai Antique - Carte et Menus');
    }
}
