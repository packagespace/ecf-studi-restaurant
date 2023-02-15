<?php

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RestaurantControllerTest extends WebTestCase
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

    public function testIndexRendersWithHeader()
    {
        $client = static::createClient();
        $client->request('GET', self::INDEX_URL);

        $this->assertSelectorExists('header');
        $this->assertSelectorTextContains('h1#restaurant-name','Le Quai Antique');
        $this->assertSelectorExists('header nav');
        $this->assertSelectorExists('a#login-link');
        $this->assertSelectorTextContains('a#reserve-link', 'Réserver');
    }

    public function testHeaderLoginLinkRedirectsToLoginPage()
    {
        $client = static::createClient();
        $client->followRedirects();
        $client->request('GET', self::INDEX_URL);

        $client->clickLink('Se connecter');

        $this->assertPageTitleSame('Le Quai Antique - Connexion');
    }
}
