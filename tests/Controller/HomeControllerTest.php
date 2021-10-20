<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    //each test is a function
    public function testIndexRoute(): void
    {
        $client = static::createClient(); //browser instance
        $crawler = $client->request('GET', '/'); //browser makes this route request

        //assert that we expect something to be the answer
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello World');
    }
}
