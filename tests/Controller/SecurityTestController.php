<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityTestController extends WebTestCase{

    public function testLogin(){

        $client = static::createClient();

        $client->request('GET', '/login');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertSelectorTextContains('h1', 'Connexion');
    }

    public function testLoginError(){

        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Connexion')->form([
            'email' => 'test@test.com',
            'password' => 'motdepasse'
        ]);
        $client->submit($form);

        $this->assertResponseRedirects('/login');
        $client->followRedirect();
        $this->assertSelectorExists('.alert.alert-danger');
    }

    public function testLoginSuccess(){

        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Connexion')->form([
            'email' => 'admin@admin.com',
            'password' => 'password'
        ]);
        $client->submit($form);

        $this->assertResponseRedirects('/');
    }
}