<?php

namespace App\Tests\Func;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class UserTest extends AbstractEndPoint
{
    private $baseUrl = "http://127.0.0.1:8000/";
    private string $userPayload = '{"funcTesteur", "functest@test.com", "funcPassword", "["ROLE_USER"]"}';

    public function testGetUsers() : void
    {
       // $client = self::createClient();

       // $client->request(Request::METHOD_GET, '/users.json');

       // dd($client->getResponse());

        $response = $this->getResponseFromRequest(Request::METHOD_GET, "/users");

        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);
        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        // Verify if json content is json type
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }
}