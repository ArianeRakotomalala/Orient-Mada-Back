<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Put;
use App\State\UserPasswordHasher;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ApiResource(
    operations: [
        new GetCollection(),
        new Post(processor: UserPasswordHasher::class, validationContext: ['groups' => ['Default', 'user:create']]),
        new Get(),
        new Put(processor: UserPasswordHasher::class),
        new Patch(processor: UserPasswordHasher::class),
        new Delete(),
        
    ],
    normalizationContext: ['groups' => ['user:read']],
    denormalizationContext: ['groups' => ['user:create', 'user:update']],
        )]
        #[ORM\Entity(repositoryClass: UserRepository::class)]
        #[ORM\Table(name: '`user`')]
        #[UniqueEntity('email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user:read', 'user:create', 'avp:read', 'avp:write'])]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    #[Groups(['user:read', 'user:create', 'avp:read', 'avp:write'])]
    private ?string $email = null;

    #[ORM\Column(length: 20)]
    #[Groups(['user:write', 'user:create', 'user:update', 'avp:read', 'avp:write'])]
    #[Assert\NotBlank(message: "Le numéro de téléphone est obligatoire")]
    #[Assert\Regex(
        pattern: "/^\+?[0-9]{7,15}$/",
        message: "Numéro de téléphone invalide",
        groups: ['user:create']
    )]
    private ?string $telephone = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column(type: 'json')]
    #[Groups(['user:create', 'user:update', 'avp:read', 'avp:write'])]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Groups(['avp:read', 'avp:write'])]
    private ?string $password = null;

    // #[Assert\NotBlank(groups: ['user:create'])]
    #[Groups(['user:create', 'user:update', 'avp:read', 'avp:write'])]
    private ?string $plainPassword = null;



    #[ORM\OneToOne(mappedBy: "user", targetEntity: UsersProfils::class)]
    private ?UsersProfils $userProfils = null;

    /**
     * @var Collection<int, UserPreferences>
     */
    #[ORM\OneToMany(targetEntity: UserPreferences::class, mappedBy: 'user')]
    private Collection $user_preferences;

    /**
     * @var Collection<int, Favorites>
     */
    #[ORM\OneToMany(targetEntity: Favorites::class, mappedBy: 'user')]
    private Collection $favorite;

    /**
     * @var Collection<int, InformationRequests>
     */
    #[ORM\OneToMany(targetEntity: InformationRequests::class, mappedBy: 'user')]
    private Collection $informationrequests;

    /**
     * @var Collection<int, EventRegistrations>
     */
    #[ORM\OneToMany(targetEntity: EventRegistrations::class, mappedBy: 'user')]
    private Collection $eventRegistrations;

    /**
     * @var Collection<int, InstituteRegistration>
     */
    #[ORM\OneToMany(targetEntity: InstituteRegistration::class, mappedBy: 'user')]
    private Collection $instituteRegistration;

    /**
     * @var Collection<int, Avis>
     */
    #[ORM\OneToMany(targetEntity: Avis::class, mappedBy: 'user')]
    private Collection $institutions;

    #[ORM\Column]
    #[Groups(['avp:read', 'avp:write'])]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        if ($this->created_at === null) {
            $this->created_at = new \DateTimeImmutable();
        }
    }

    public function __construct()
    {
        $this->user_preferences = new ArrayCollection();
        $this->favorite = new ArrayCollection();
        $this->informationrequests = new ArrayCollection();
        $this->eventRegistrations = new ArrayCollection();
        $this->instituteRegistration = new ArrayCollection();
        $this->institutions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): void
    {
        $this->telephone = $telephone;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }

    public function getUserProfils(): ?UsersProfils
    {
        return $this->userProfils;
    }

    public function setUserProfils(?UsersProfils $userProfils): static
    {
        $this->userProfils = $userProfils;
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
            $userPreference->setUser($this);
        }

        return $this;
    }

    public function removeUserPreference(UserPreferences $userPreference): static
    {
        if ($this->user_preferences->removeElement($userPreference)) {
            // set the owning side to null (unless already changed)
            if ($userPreference->getUser() === $this) {
                $userPreference->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Favorites>
     */
    public function getFavorite(): Collection
    {
        return $this->favorite;
    }

    public function addFavorite(Favorites $favorite): static
    {
        if (!$this->favorite->contains($favorite)) {
            $this->favorite->add($favorite);
            $favorite->setUser($this);
        }

        return $this;
    }

    public function removeFavorite(Favorites $favorite): static
    {
        if ($this->favorite->removeElement($favorite)) {
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
    public function getInformationrequests(): Collection
    {
        return $this->informationrequests;
    }

    public function addInformationrequest(InformationRequests $informationrequest): static
    {
        if (!$this->informationrequests->contains($informationrequest)) {
            $this->informationrequests->add($informationrequest);
            $informationrequest->setUser($this);
        }

        return $this;
    }

    public function removeInformationrequest(InformationRequests $informationrequest): static
    {
        if ($this->informationrequests->removeElement($informationrequest)) {
            // set the owning side to null (unless already changed)
            if ($informationrequest->getUser() === $this) {
                $informationrequest->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EventRegistrations>
     */
    public function getEventRegistrations(): Collection
    {
        return $this->eventRegistrations;
    }

    public function addEventRegistration(EventRegistrations $eventRegistration): static
    {
        if (!$this->eventRegistrations->contains($eventRegistration)) {
            $this->eventRegistrations->add($eventRegistration);
            $eventRegistration->setUser($this);
        }

        return $this;
    }

    public function removeEventRegistration(EventRegistrations $eventRegistration): static
    {
        if ($this->eventRegistrations->removeElement($eventRegistration)) {
            // set the owning side to null (unless already changed)
            if ($eventRegistration->getUser() === $this) {
                $eventRegistration->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InstituteRegistration>
     */
    public function getInstituteRegistration(): Collection
    {
        return $this->instituteRegistration;
    }

    public function addInstituteRegistration(InstituteRegistration $instituteRegistration): static
    {
        if (!$this->instituteRegistration->contains($instituteRegistration)) {
            $this->instituteRegistration->add($instituteRegistration);
            $instituteRegistration->setUser($this);
        }

        return $this;
    }

    public function removeInstituteRegistration(InstituteRegistration $instituteRegistration): static
    {
        if ($this->instituteRegistration->removeElement($instituteRegistration)) {
            // set the owning side to null (unless already changed)
            if ($instituteRegistration->getUser() === $this) {
                $instituteRegistration->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getInstitutions(): Collection
    {
        return $this->institutions;
    }

    public function addInstitution(Avis $institution): static
    {
        if (!$this->institutions->contains($institution)) {
            $this->institutions->add($institution);
            $institution->setUser($this);
        }

        return $this;
    }

    public function removeInstitution(Avis $institution): static
    {
        if ($this->institutions->removeElement($institution)) {
            // set the owning side to null (unless already changed)
            if ($institution->getUser() === $this) {
                $institution->setUser(null);
            }
        }

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

    




}



