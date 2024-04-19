//<?php
//
//namespace App\Tests\Func;
//
//use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;
//
//
//class PokemonTest extends AbstractEndPoint
//{
//    private string $postPokemonPayload = '{"username": "hard", "email": "hard@gmail.com", "password": "password"}';
//
//    private string $putPokemonPayload = '{"name": "testPokemon", "imageLink": "https://test.com", "price": 12, "type": "eau", "owner": "remplir",}';
//
//
//    protected function setUp(): void
//    {
//        parent::setUp();
//    }
//
//    public function testPostPokemon() : void
//    {
//        $response = $this->getResponseFromRequest(
//            Request::METHOD_POST,
//            "/pokemons",
//            '{"name": "testPokemon", "imageLink": "https://test.com", "price": 12, "type": "eau", "owner":'.$this->getPokemonOwnerId().',"createdAt": "2024-04-17T20:13:29.777Z", "updatedAt": "2024-04-17T20:13:29.777Z","sold": false}',
//        );
//
//        $responseContent = $response->getContent();
//        $responseDecoded = json_decode($responseContent);
//
//        //dd($responseContent);
//
//        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
//        // Verify if json content is json type
//        self::assertJson($responseContent);
//        self::assertNotEmpty($responseDecoded);
//    }
//
//
//    private function getPokemonOwnerId() : string
//    {
//        // create and recover an owner for the pokemon
//        $response = $this->getResponseFromRequest(
//            Request::METHOD_POST,
//            "/users",
//            '{"username": "hard", "email": "hard@gmail.com", "password": "password"}',
//        );
//
//
//        $response = $this->getResponseFromRequest(Request::METHOD_GET, "/users");
//        $responseContent = $response->getContent();
//        $responseDecoded = json_decode($responseContent);
//
//        return $responseDecoded[0]->id;
//    }
//
//
//}