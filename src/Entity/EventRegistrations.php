<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EventRegistrationsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: EventRegistrationsRepository::class)]
#[ApiResource]
#[Broadcast]
class EventRegistrations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $registration_date = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    // #[ORM\ManyToOne(inversedBy: 'event_registrations')]
    // #[ORM\JoinColumn(nullable: false)]
    // private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'event_registrations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Events $events = null;

    #[ORM\ManyToOne(inversedBy: 'eventRegistrations')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegistrationDate(): ?string
    {
        return $this->registration_date;
    }

    public function setRegistrationDate(string $registration_date): static
    {
        $this->registration_date = $registration_date;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

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

    public function getEvents(): ?Events
    {
        return $this->events;
    }

    public function setEvents(?Events $events): static
    {
        $this->events = $events;

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
