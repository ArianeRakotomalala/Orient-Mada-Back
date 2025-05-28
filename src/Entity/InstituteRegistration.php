<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\InstituteRegistrationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: InstituteRegistrationRepository::class)]
#[ApiResource]
#[Broadcast]
class InstituteRegistration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?bool $is_validated = null;

    // #[ORM\ManyToOne(inversedBy: 'institute_registrations')]
    // #[ORM\JoinColumn(nullable: false)]
    // private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'institute_registrations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Institutions $intitution = null;

    #[ORM\ManyToOne(inversedBy: 'instituteRegistration')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function isValidated(): ?bool
    {
        return $this->is_validated;
    }

    public function setIsValidated(bool $is_validated): static
    {
        $this->is_validated = $is_validated;

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

    public function getIntitution(): ?Institutions
    {
        return $this->intitution;
    }

    public function setIntitution(?Institutions $intitution): static
    {
        $this->intitution = $intitution;

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
