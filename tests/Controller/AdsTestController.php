<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdsTestController extends WebTestCase{

    public function testAds(){

        $client = static::createClient();

        $client->request('GET', '/annonces');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertSelectorTextContains('h1', 'Annonces');
    }
}