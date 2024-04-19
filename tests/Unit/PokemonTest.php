<?php

namespace App\Tests\Unit;

use App\Entity\Pokemon;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class PokemonTest extends TestCase
{
    private Pokemon $pokemon;

    protected function setUp(): void
    {
        parent::setUp();
        $this->pokemon = (new Pokemon());
    }

    // test editable properties

    // public function testGet() : void
    // {
    //     $value = ;
    //     $response = $this->pokemon->se($value);

    //     self::assertInstanceOf(Pokemon::class, $response);
    //     self::assertEquals($value, $this->pokemon->ge());
    // }

    public function testGetName() : void
    {
        $value = "pikaTest";
        $response = $this->pokemon->setName($value);

        self::assertInstanceOf(Pokemon::class, $response);
        self::assertEquals($value, $this->pokemon->getName());
    }

    public function testGetImageLink() : void
    {
        $value = "http://test-link.com";
        $response = $this->pokemon->setImageLink($value);

        self::assertInstanceOf(Pokemon::class, $response);
        self::assertEquals($value, $this->pokemon->getImageLink());
    }

    public function testGetPrice() : void
    {
        $value = 42;
        $response = $this->pokemon->setPrice($value);

        self::assertInstanceOf(Pokemon::class, $response);
        self::assertEquals($value, $this->pokemon->getPrice());
    }

    public function testGetOwner() : void
    {
        $value = new User();
        $response = $this->pokemon->setOwner($value);

        self::assertInstanceOf(Pokemon::class, $response);
        self::assertEquals($value, $this->pokemon->getOwner());
    }
}