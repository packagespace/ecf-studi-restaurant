<?php

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MenuControllerTest extends WebTestCase
{
    public function testMenuPageRendersWithCorrectTitle(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/menu');

        $this->assertPageTitleContains('Le Quai Antique - Carte et Menu');
    }

    public function testMenuPageRendersCategoryNamesInAList()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/menu');

        $this->assertSelectorExists('ul#dish-categories');
        $this->assertSelectorExists('li.dish-category');
    }

    public function testMenuPageRendersCategoryDishes()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/menu');

        $this->assertSelectorExists('dl.category-dishes');
        $this->assertSelectorExists('dt.category-dish-name');
        $this->assertSelectorExists('dd.category-dish-price');
        $this->assertSelectorExists('dd.category-dish-description');
    }

    public function testMenuPageRendersMenus()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/set-menus');

        $this->assertSelectorExists('ul#menus', );
        $this->assertSelectorExists('li.menu');
    }

    public function testMenuPageRendersSetMenus()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/set-menus');

        $this->assertSelectorExists('ul.menu-set-menus');
        $this->assertSelectorExists('li.set-menu');
        $this->assertSelectorExists('span.set-menu-description');
        $this->assertSelectorExists('span.set-menu-price');
    }
}
