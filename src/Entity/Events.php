<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EventsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: EventsRepository::class)]
#[ApiResource]
#[Broadcast]
class Events
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $event_date_time = null;

    #[ORM\Column(length: 255)]
    private ?string $registration_parameters = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Institutions $institution = null;

    /**
     * @var Collection<int, EventRegistrations>
     */
    #[ORM\OneToMany(targetEntity: EventRegistrations::class, mappedBy: 'events')]
    private Collection $event_registrations;

    public function __construct()
    {
        $this->event_registrations = new ArrayCollection();
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

    public function getRegistrationParameters(): ?string
    {
        return $this->registration_parameters;
    }

    public function setRegistrationParameters(string $registration_parameters): static
    {
        $this->registration_parameters = $registration_parameters;

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
}
