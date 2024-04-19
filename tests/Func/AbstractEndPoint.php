<?php

namespace App\Tests\Func;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


abstract class AbstractEndPoint extends WebTestCase
{
    private array $serverInformations = ['ACCEPT' => 'application/json', 'CONTENT_TYPE' => 'application/json'];
    private $client;

    protected function setUp(): void
    {
        $this->client = self::createClient();

    }

    public function getResponseFromRequest(string $method, string $uri, string $payload = '') : Response
    {

        $this->client->request(
            $method,
            $uri . '.json',
            [],
            [],
            $this->serverInformations,
            $payload
        );

        return $this->client->getResponse();
    }
}