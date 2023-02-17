<?php

namespace App\Tests\Unit\OpeningHours\Integration\Functional\Functional\Controller;

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
        $this->assertSelectorTextContains('label#username-label', 'Adresse email:');
        $this->assertSelectorTextContains('label#password-label', 'Mot de passe:');
        $this->assertSelectorExists('input#username-input');
        $this->assertSelectorExists('input#password-input');
        $this->assertSelectorTextContains('button#login-button', 'Connexion');
    }

    public function testLoggingInSuccessfullyRedirectsToTheHomePageAsLoggedInUser()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', self::LOGIN_URL);
        $client->followRedirects();

        $buttonCrawlerNode = $crawler->selectButton('Connexion');

        $form = $buttonCrawlerNode->form();

        $form['_username']->setValue('test@mail.com');
        $form['_password']->setValue('root');

        $client->submit($form);

        $this->assertPageTitleSame('Le Quai Antique');
        $this->assertSelectorExists('a#logout-link');
    }
}
