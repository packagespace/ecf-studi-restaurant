<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testLoginPageRendersCorrectly(): void
    {
        $client = static::createClient();
        $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('form');
        $this->assertSelectorTextContains('label#username-label', 'Adresse email:');
        $this->assertSelectorTextContains('label#password-label', 'Mot de passe:');

    }
}
