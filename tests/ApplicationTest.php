<?php

namespace App\Tests;

use App\Factory\UserFactory;
use App\Repository\UserRepository;
use Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url): void
    {
        $client = static::createClient();
        $client->request('GET', $url);

        $this->assertResponseIsSuccessful();
    }
    /**
     * @dataProvider urlProvider
     */
    public function testRendersWithHeader($url)
    {
        $client = static::createClient();
        $client->request('GET', $url);

        $this->assertSelectorExists('header');
        $this->assertSelectorTextContains('h1#restaurant-name','Le Quai Antique');
        $this->assertSelectorExists('header nav');
        $this->assertSelectorExists('a#login-link');
        $this->assertSelectorTextContains('a#reserve-link', 'Réserver');
    }

    /**
     * @dataProvider urlProvider
     */
    public function testHeaderShowsAdminPanelWhenLoggedInAsAdmin($url)
    {
        $client = static::createClient();
        $user = UserFactory::createOne(['roles' => ["ROLE_ADMIN"]])->object();
        $client->loginUser($user);
        $client->request('GET', $url);

        $this->assertSelectorExists('a#admin-panel-link');
    }

    /**
     * @dataProvider urlProvider
     */
    public function testHeaderHidesAdminPanelWhenLoggedInAsUser($url)
    {
        $client = static::createClient();
        $user = UserFactory::createOne(['roles' => ["ROLE_USER"]])->object();
        $client->loginUser($user);
        $client->request('GET', $url);

        $this->assertSelectorNotExists('a#admin-panel-link');
    }

    /**
     * @dataProvider urlProvider
     */
    public function testHeaderLoginLinkRedirectsToLoginPage($url)
    {
        $client = static::createClient();
        $client->followRedirects();
        $client->request('GET', $url);

        $client->clickLink('Se connecter');

        $this->assertPageTitleSame('Le Quai Antique - Connexion');
    }

    /**
     * @dataProvider urlProvider
     */
    public function testHeaderLogoutLinkLogsUserOut($url)
    {
        $client = static::createClient();
        $client->followRedirects();
        /** @var UserRepository $userRepository*/
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findAll()[0];
        $client->loginUser($testUser);

        $client->request('GET', $url);

        $client->clickLink('Se déconnecter');

        $this->assertSelectorExists('a#login-link');
    }


    private function urlProvider(): Generator
    {
        yield 'homepage' => ['/'];
        yield 'login page' => ['/login'];
        yield 'menu' => ['/menu'];
    }
}
