<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[ApiResource]
#[Broadcast]
class Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\OneToOne(inversedBy: 'users', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?UsersProfils $user_profils = null;

    /**
     * @var Collection<int, UserPreferences>
     */
    #[ORM\OneToMany(targetEntity: UserPreferences::class, mappedBy: 'users')]
    private Collection $user_preferences;

    /**
     * @var Collection<int, Favorites>
     */
    #[ORM\OneToMany(targetEntity: Favorites::class, mappedBy: 'user')]
    private Collection $favorites;

    /**
     * @var Collection<int, InformationRequests>
     */
    #[ORM\OneToMany(targetEntity: InformationRequests::class, mappedBy: 'user')]
    private Collection $information_requests;

    /**
     * @var Collection<int, InstituteRegistration>
     */
    #[ORM\OneToMany(targetEntity: InstituteRegistration::class, mappedBy: 'users')]
    private Collection $institute_registrations;

    /**
     * @var Collection<int, EventRegistrations>
     */
    #[ORM\OneToMany(targetEntity: EventRegistrations::class, mappedBy: 'users')]
    private Collection $event_registrations;

    public function __construct()
    {
        $this->user_preferences = new ArrayCollection();
        $this->favorites = new ArrayCollection();
        $this->information_requests = new ArrayCollection();
        $this->institute_registrations = new ArrayCollection();
        $this->event_registrations = new ArrayCollection();
    }

    public function getId(): ?int
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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUserProfils(): ?UsersProfils
    {
        return $this->user_profils;
    }

    public function setUserProfils(UsersProfils $user_profils): static
    {
        $this->user_profils = $user_profils;

        return $this;
    }

    /**
     * @return Collection<int, UserPreferences>
     */
    public function getUserPreferences(): Collection
    {
        return $this->user_preferences;
    }

    public function addUserPreference(UserPreferences $userPreference): static
    {
        if (!$this->user_preferences->contains($userPreference)) {
            $this->user_preferences->add($userPreference);
            $userPreference->setUsers($this);
        }

        return $this;
    }

    public function removeUserPreference(UserPreferences $userPreference): static
    {
        if ($this->user_preferences->removeElement($userPreference)) {
            // set the owning side to null (unless already changed)
            if ($userPreference->getUsers() === $this) {
                $userPreference->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Favorites>
     */
    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorite(Favorites $favorite): static
    {
        if (!$this->favorites->contains($favorite)) {
            $this->favorites->add($favorite);
            $favorite->setUser($this);
        }

        return $this;
    }

    public function removeFavorite(Favorites $favorite): static
    {
        if ($this->favorites->removeElement($favorite)) {
            // set the owning side to null (unless already changed)
            if ($favorite->getUser() === $this) {
                $favorite->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InformationRequests>
     */
    public function getInformationRequests(): Collection
    {
        return $this->information_requests;
    }

    public function addInformationRequest(InformationRequests $informationRequest): static
    {
        if (!$this->information_requests->contains($informationRequest)) {
            $this->information_requests->add($informationRequest);
            $informationRequest->setUser($this);
        }

        return $this;
    }

    public function removeInformationRequest(InformationRequests $informationRequest): static
    {
        if ($this->information_requests->removeElement($informationRequest)) {
            // set the owning side to null (unless already changed)
            if ($informationRequest->getUser() === $this) {
                $informationRequest->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InstituteRegistration>
     */
    public function getInstituteRegistrations(): Collection
    {
        return $this->institute_registrations;
    }

    public function addInstituteRegistration(InstituteRegistration $instituteRegistration): static
    {
        if (!$this->institute_registrations->contains($instituteRegistration)) {
            $this->institute_registrations->add($instituteRegistration);
            $instituteRegistration->setUsers($this);
        }

        return $this;
    }

    public function removeInstituteRegistration(InstituteRegistration $instituteRegistration): static
    {
        if ($this->institute_registrations->removeElement($instituteRegistration)) {
            // set the owning side to null (unless already changed)
            if ($instituteRegistration->getUsers() === $this) {
                $instituteRegistration->setUsers(null);
            }
        }

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
            $eventRegistration->setUsers($this);
        }

        return $this;
    }

    public function removeEventRegistration(EventRegistrations $eventRegistration): static
    {
        if ($this->event_registrations->removeElement($eventRegistration)) {
            // set the owning side to null (unless already changed)
            if ($eventRegistration->getUsers() === $this) {
                $eventRegistration->setUsers(null);
            }
        }

        return $this;
    }
}
