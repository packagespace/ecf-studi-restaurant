<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RestaurantControllerTest extends WebTestCase
{
    public function testIndexRendersWithCorrectTitle(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertPageTitleSame('Le Quai Antique');
    }

    public function testIndexRendersWithHeader()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

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
        $crawler = $client->request('GET', '/');

        $client->clickLink('Se connecter');

        $this->assertPageTitleSame('Le Quai Antique - Connexion');
    }
}
