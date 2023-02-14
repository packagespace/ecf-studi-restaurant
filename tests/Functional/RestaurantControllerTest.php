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
        $this->assertSelectorTextContains('header > h1','Le Quai Antique');
        $this->assertSelectorExists('header > nav');
        $this->assertSelectorTextContains('header > nav > a', 'Réserver');
    }
}
