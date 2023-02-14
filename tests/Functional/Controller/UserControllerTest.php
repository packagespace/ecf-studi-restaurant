<?php

namespace App\Tests\Functional\Controller;

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

    public function testLoggingInRedirectsToTheHomePage()
    {
        $client = static::createClient();
        $client->request('GET', self::LOGIN_URL);
        $client->followRedirects();

        $client->submitForm('Connexion');

        $this->assertPageTitleSame('Le Quai Antique');
    }

    public function testHeaderShowsLogoutLinkWhenLoggedIn()
    {
        $client = static::createClient();
        self::markTestIncomplete('Need to implement user etc');
        $client->loginUser();

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
}
