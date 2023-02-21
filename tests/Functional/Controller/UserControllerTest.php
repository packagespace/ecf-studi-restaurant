<?php

namespace App\Tests\Functional\Controller;

use App\Factory\UserFactory;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    const LOGIN_URL = '/login';

    public function testLoginPageRendersCorrectly(): void
    {
        $client = static::createClient();
        $client->request('GET', self::LOGIN_URL);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('form');
        $this->assertSelectorExists('input#inputEmail');
        $this->assertSelectorExists('input#inputPassword');
        $this->assertSelectorExists('button', 'Connexion');
    }

    public function testLoggingInSuccessfullyRedirectsToTheHomePageAsLoggedInUser()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', self::LOGIN_URL);
        $client->followRedirects();

        $buttonCrawlerNode = $crawler->selectButton('Connexion');

        $form = $buttonCrawlerNode->form();

        $form['email']->setValue('test@mail.com');
        $form['password']->setValue('root');

        $client->submit($form);

        $this->assertPageTitleSame('Le Quai Antique');
        $this->assertSelectorExists('a#logout-link');
    }
}
