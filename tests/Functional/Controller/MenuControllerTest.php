<?php

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MenuControllerTest extends WebTestCase
{
    public function testMenuRendersWithCorrectTitle(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/menu');

        $this->assertPageTitleContains('Le Quai Antique - Carte et Menus');
    }
}
