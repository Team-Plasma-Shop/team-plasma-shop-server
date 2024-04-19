<?php

namespace App\Tests\Unit;

use App\Entity\Pokemon;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class UserTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = (new User())
            ->setUsername("testeur")
            ->setEmail("test@test.com")
            ->setPassword("password")
            ->setRoles(["ROLE_USER"]);
    }

    public function testGetMail() : void
    {
        $value = "setTest@test.com";
        $response = $this->user->setEmail($value);

        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $this->user->getEmail());
    }

    public function testGetRole() : void
    {
        $value = ["ROLE_USER"];
        $response = $this->user->setRoles($value);

        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $this->user->getRoles());
    }

    public function testGetUsername() : void
    {
      $value = "pseudoTest";
      $response = $this->user->setUsername($value);

      self::assertInstanceOf(User::class, $response);
      self::assertEquals($value, $this->user->getUsername());
    }

    public function testGetPassword() : void
    {
        $value = "testPassword";
        $response = $this->user->setPassword($value);

        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $this->user->getPassword());
    }

    // objet associé
    public function testGetPokemon() : void
    {
        $value = new Pokemon();
        $response = $this->user->addPokemon($value);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(1, $this->user->getPokemons());
        self::assertTrue($this->user->getPokemons()->contains($value));

        // test remove
        $response = $this->user->removePokemon($value);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(0, $this->user->getPokemons());
        self::assertFalse($this->user->getPokemons()->contains($value));
    }
}