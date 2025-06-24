<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EventRegistrationsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: EventRegistrationsRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['event_registrations:read']],
    denormalizationContext: ['groups' => ['event_registrations:write']]
)]
class EventRegistrations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['event_registrations:read', 'event_registrations:write', 'avp:read', 'avp:write'])]
    private ?int $id = null;



    #[ORM\Column]
    #[Groups(['event_registrations:read', 'event_registrations:write', 'avp:read', 'avp:write'])]
    private ?bool $status = null;

    // #[ORM\ManyToOne(inversedBy: 'event_registrations')]
    // #[ORM\JoinColumn(nullable: false)]
    // private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'event_registrations')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['event_registrations:read', 'event_registrations:write', 'avp:read', 'avp:write'])]
    private ?Events $events = null;

    #[ORM\ManyToOne(inversedBy: 'eventRegistrations')]
    #[Groups(['event_registrations:read', 'event_registrations:write', 'avp:read', 'avp:write'])]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): static
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
