<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EventsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Serializer\Annotation\Groups as SerializerGroups;

#[ORM\Entity(repositoryClass: EventsRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['events:read']],
    denormalizationContext: ['groups' => ['events:write']],
    operations: [
        new \ApiPlatform\Metadata\Get(),
        new \ApiPlatform\Metadata\GetCollection(),
        new \ApiPlatform\Metadata\Post(),
        new \ApiPlatform\Metadata\Patch(),
        new \ApiPlatform\Metadata\Delete(),
        new \ApiPlatform\Metadata\Put(),
    ]
)]
class Events
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['events:read', 'events:write', 'avp:read', 'avp:write'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['events:read', 'events:write', 'avp:read', 'avp:write'])]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Groups(['events:read', 'events:write', 'avp:read', 'avp:write'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['events:read', 'events:write', 'avp:read', 'avp:write'])]
    private ?\DateTimeImmutable $event_date_time = null;

    #[ORM\Column(type: 'datetime_immutable', options: ['default' => 'CURRENT_TIMESTAMP'])]
    #[Groups(['events:read', 'events:write', 'avp:read', 'avp:write'])]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['events:read', 'events:write', 'avp:read', 'avp:write'])]
    private ?Institutions $institution = null;

    /**
     * @var Collection<int, EventRegistrations>
     */
    #[ORM\OneToMany(targetEntity: EventRegistrations::class, mappedBy: 'events')]
    #[Groups(['events:read', 'events:write', 'avp:read', 'avp:write'])]
    private Collection $event_registrations;

    #[ORM\Column(length: 255)]
    #[Groups(['events:read', 'events:write', 'avp:read', 'avp:write'])]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    #[Groups(['events:read', 'events:write', 'avp:read', 'avp:write'])]
    private ?string $participant = null;

    #[ORM\Column(length: 255)]
    #[Groups(['events:read', 'events:write', 'avp:read', 'avp:write'])]
    private ?string $lieu = null;

    public function __construct()
    {
        $this->event_registrations = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getEventDateTime(): ?\DateTimeImmutable
    {
        return $this->event_date_time;
    }

    public function setEventDateTime(\DateTimeImmutable $event_date_time): static
    {
        $this->event_date_time = $event_date_time;

        return $this;
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

    public function getInstitution(): ?Institutions
    {
        return $this->institution;
    }

    public function setInstitution(?Institutions $institution): static
    {
        $this->institution = $institution;

        return $this;
    }

    /**
     * @return Collection<int, EventRegistrations>
     */
    public function getEventRegistrations(): Collection
    {
        return $this->event_registrations;
    }

    public function addEventRegistration(EventRegistrations $eventRegistration): static
    {
        if (!$this->event_registrations->contains($eventRegistration)) {
            $this->event_registrations->add($eventRegistration);
            $eventRegistration->setEvents($this);
        }

        return $this;
    }

    public function removeEventRegistration(EventRegistrations $eventRegistration): static
    {
        if ($this->event_registrations->removeElement($eventRegistration)) {
            // set the owning side to null (unless already changed)
            if ($eventRegistration->getEvents() === $this) {
                $eventRegistration->setEvents(null);
            }
        }

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getParticipant(): ?string
    {
        return $this->participant;
    }

    public function setParticipant(string $participant): static
    {
        $this->participant = $participant;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }
}
