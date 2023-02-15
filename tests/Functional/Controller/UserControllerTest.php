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

    public function testHeaderShowsLogoutLinkWhenLoggedIn()
    {
        $client = static::createClient();
        /** @var UserRepository $userRepository*/
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findAll()[0];
        $client->loginUser($testUser);

        $client->request('GET', self::LOGIN_URL);

        $this->assertSelectorExists('a#logout-link');
    }
    
    public function testLoginRendersWithHeader()
    {
        $client = static::createClient();
        $client->request('GET', self::LOGIN_URL);

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
        $client->request('GET', self::LOGIN_URL);

        $client->clickLink('Se connecter');

        $this->assertPageTitleSame('Le Quai Antique - Connexion');
    }

    public function testHeaderLogoutLinkLogsUserOut()
    {
        $client = static::createClient();
        $client->followRedirects();
        /** @var UserRepository $userRepository*/
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findAll()[0];
        $client->loginUser($testUser);

        $client->request('GET', self::LOGIN_URL);

        $client->clickLink('Se déconnecter');

        $this->assertSelectorExists('a#login-link');
    }
}
