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

    public function testMenuRendersCategoryNamesInAList()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/menu');

        $this->assertSelectorExists('ul#dish-categories');
        $this->assertSelectorExists('li.dish-category');
    }

    public function testMenuRendersCategoryDishes()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/menu');

        $this->assertSelectorExists('dl.category-dishes');
        $this->assertSelectorExists('dt.category-dish-name');
        $this->assertSelectorExists('dd.category-dish-price');
        $this->assertSelectorExists('dd.category-dish-description');
    }
}
