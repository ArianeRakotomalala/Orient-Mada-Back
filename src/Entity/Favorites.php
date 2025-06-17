<?php

namespace App\Entity;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\FavoritesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;

#[ORM\Entity(repositoryClass: FavoritesRepository::class)]
#[ApiResource(
    operations: [
        new \ApiPlatform\Metadata\Post(),
        new \ApiPlatform\Metadata\Delete(),
        new \ApiPlatform\Metadata\Get(),
        new \ApiPlatform\Metadata\GetCollection()
    ],
    normalizationContext: ['groups' => ['favori:read']],
    denormalizationContext: ['groups' => ['favori:write']]
)]
#[ApiFilter(SearchFilter::class, properties: ['user' => 'exact'])]

class Favorites
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['favori:read', 'favori:write'])]
    private ?string $collection_name = null;

    #[ORM\ManyToOne(inversedBy: 'favorite')]
    #[Groups(['favori:read', 'favori:write'])] 
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'favorites')]
    #[Groups(['favori:read', 'favori:write'])] 
    private ?Institutions $institution = null;

    // #[ORM\ManyToOne(inversedBy: 'favorites')]
    // #[ORM\JoinColumn(nullable: false)]
    // private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getInstitution(): ?Institutions
    {
        return $this->institution;
    }

    public function setInstitution(?Institutions $institution): static
    {
        $this->institution = $institution;

        return $this;
    }
}
