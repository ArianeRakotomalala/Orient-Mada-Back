<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\FavoritesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: FavoritesRepository::class)]
#[ApiResource]
#[Broadcast]
class Favorites
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $favorite_type = null;

    #[ORM\Column(length: 255)]
    private ?string $collection_name = null;

    #[ORM\ManyToOne(inversedBy: 'favorite')]
    private ?User $user = null;

    // #[ORM\ManyToOne(inversedBy: 'favorites')]
    // #[ORM\JoinColumn(nullable: false)]
    // private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFavoriteType(): ?string
    {
        return $this->favorite_type;
    }

    public function setFavoriteType(string $favorite_type): static
    {
        $this->favorite_type = $favorite_type;

        return $this;
    }

    public function getCollectionName(): ?string
    {
        return $this->collection_name;
    }

    public function setCollectionName(string $collection_name): static
    {
        $this->collection_name = $collection_name;

        return $this;
    }

    // public function getUser(): ?User
    // {
    //     return $this->user;
    // }

    // public function setUser(?User $user): static
    // {
    //     $this->user = $user;

    //     return $this;
    // }

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
