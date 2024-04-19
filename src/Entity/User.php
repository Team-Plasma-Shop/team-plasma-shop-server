<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Length;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource(
    normalizationContext: ['groups' => ['read:user:collection']],
)]



class User implements UserInterface, PasswordAuthenticatedUserInterface
{   
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\Column(type: UuidType::NAME)]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[Groups(['read:user:collection'])]
    private ?string $id = null;

    #[ORM\Column(length: 255)]
    #[
        Groups(['read:user:collection']),
        Length(min: 5, max: 255),
    ]
    private ?string $username = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Groups(['read:user:collection'])]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    #[Groups(['read:user:collection'])]
    private ?bool $isVerified;

    #[ORM\Column(type: Types::ARRAY)]
    #[Groups(['read:user:collection'])]
    private $roles = [];

    #[ORM\Column]
    #[Groups(['read:user:collection'])]
    private ?\DateTimeImmutable $createdAt;

    /**
     * @var Collection<int, Pokemon>
     */
    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Pokemon::class, orphanRemoval: true)]
    private Collection $pokemons;

    public function __construct()
    {
        $this->isVerified = false;
        $this->pokemons = new ArrayCollection();
        $this->createdAt = (new \DateTimeImmutable('now', new \DateTimeZone('Europe/Paris')))->setTimezone(new \DateTimeZone('Europe/Paris'));

    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials()
    {

    }

    public function getUserIdentifier(): string
    {
        return (string) $this->id;
    
    }

    public function isVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, Pokemon>
     */
    public function getPokemons(): Collection
    {
        return $this->pokemons;
    }

    public function addPokemon(Pokemon $pokemon): static
    {
        if (!$this->pokemons->contains($pokemon)) {
            $this->pokemons->add($pokemon);
            $pokemon->setOwner($this);
        }

        return $this;
    }

    public function removePokemon(Pokemon $pokemon): static
    {
        if ($this->pokemons->removeElement($pokemon)) {
            // set the owning side to null (unless already changed)
            if ($pokemon->getOwner() === $this) {
                $pokemon->setOwner(null);
            }
        }

        return $this;
    }
}