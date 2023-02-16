<?php

namespace App\Tests;

use Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationAvailabilityTest extends WebTestCase
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

    private function urlProvider(): Generator
    {
        yield 'homepage' => ['/'];
        yield 'login page' => ['/login'];
        yield 'menu' => ['/menu'];
    }
}
