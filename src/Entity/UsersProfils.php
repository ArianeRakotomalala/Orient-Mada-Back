<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UsersProfilsRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UsersProfilsRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Post(),
        new Get(),
        new Patch(),
    ]
)]
class UsersProfils
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['users_profils:read', 'users_profils:write', 'avp:read', 'avp:write'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['users_profils:read', 'users_profils:write', 'avp:read', 'avp:write'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['users_profils:read', 'users_profils:write', 'avp:read', 'avp:write'])]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    #[Groups(['users_profils:read', 'users_profils:write', 'avp:read', 'avp:write'])]
    private ?string $birthday = null;

    #[ORM\Column(length: 255)]
    #[Groups(['users_profils:read', 'users_profils:write', 'avp:read', 'avp:write'])]
    private ?string $adress = null;

    #[ORM\Column(length: 255)]
    #[Groups(['users_profils:read', 'users_profils:write', 'avp:read', 'avp:write'])]
    private ?string $hobbies = null;

    #[ORM\Column(length: 255)]
    #[Groups(['users_profils:read', 'users_profils:write', 'avp:read', 'avp:write'])]
    private ?string $serie = null;

    #[ORM\OneToOne(targetEntity: User::class, inversedBy: "userProfils", cascade: ["persist", "remove"])]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", nullable: true, onDelete: "CASCADE")]
    #[Groups(['users_profils:read', 'users_profils:write', 'avp:read', 'avp:write'])]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }


    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    public function setBirthday(string $birthday): static
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }

    public function getHobbies(): ?string
    {
        return $this->hobbies;
    }

    public function setHobbies(string $hobbies): static
    {
        $this->hobbies = $hobbies;

        return $this;
    }

    public function getSerie(): ?string
    {
        return $this->serie;
    }

    public function setSerie(string $serie): static
    {
        $this->serie = $serie;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;
        return $this;
    }
}
