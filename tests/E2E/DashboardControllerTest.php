<?php

namespace App\Tests\E2E;

use Symfony\Component\Panther\PantherTestCase;

class DashboardControllerTest extends PantherTestCase
{
    public function testSomething(): void
    {

        $client = static::createPantherClient([
            'hostname' => 'localhost',
            'port'=> 443
        ]);
        $client->followRedirects();
        $client->request('GET', '/');

        $client->clickLink('Se connecter');

        $this->assertPageTitleSame('Le Quai Antique - Connexion');

        $crawler = $client->getCrawler();

        $buttonCrawlerNode = $crawler->selectButton('Connexion');

        $form = $buttonCrawlerNode->form();

        $form['_username']->setValue('test@mail.com');
        $form['_password']->setValue('root');

        $client->submit($form);

        $this->assertPageTitleSame('Le Quai Antique');
        $this->assertSelectorExists('a#logout-link');

        $client->clickLink('Panel administrateur');

        $client->clickLink('Créer DishPhoto');
        $client->takeScreenshot('screen.png');
    }

}
