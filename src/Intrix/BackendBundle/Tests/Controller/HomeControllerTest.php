<?php

namespace Intrix\BackendBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testBanner()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/banner');
    }

    public function testFrase()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/frase');
    }

    public function testDestaque()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/destaque');
    }

    public function testTrabalho()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/trabalho');
    }

    public function testResumo()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/resumo');
    }

    public function testPergunta()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/pergunta');
    }

}
