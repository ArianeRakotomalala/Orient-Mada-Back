<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserPreferencesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserPreferencesRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['user_preferences:read']],
    denormalizationContext: ['groups' => ['user_preferences:write']]
)]
class UserPreferences
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user_preferences:read', 'user_preferences:write', 'avp:read', 'avp:write'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user_preferences:read', 'user_preferences:write', 'avp:read', 'avp:write'])]
    private ?string $field_study = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user_preferences:read', 'user_preferences:write', 'avp:read', 'avp:write'])]
    private ?string $type_of_institution = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user_preferences:read', 'user_preferences:write', 'avp:read', 'avp:write'])]
    private ?string $location = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user_preferences:read', 'user_preferences:write', 'avp:read', 'avp:write'])]
    private ?string $max_coast = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user_preferences:read', 'user_preferences:write', 'avp:read', 'avp:write'])]
    private ?string $prefered_language = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user_preferences:read', 'user_preferences:write', 'avp:read', 'avp:write'])]
    private ?string $min_success_rate = null;

    #[ORM\ManyToOne(inversedBy: 'user_preferences')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['user_preferences:read', 'user_preferences:write', 'avp:read', 'avp:write'])]
    private ?User $user = null;

    // #[ORM\ManyToOne(inversedBy: 'user_preferences')]
    // #[ORM\JoinColumn(nullable: false)]
    // private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFieldStudy(): ?string
    {
        return $this->field_study;
    }

    public function setFieldStudy(string $field_study): static
    {
        $this->field_study = $field_study;

        return $this;
    }

    public function getTypeOfInstitution(): ?string
    {
        return $this->type_of_institution;
    }

    public function setTypeOfInstitution(string $type_of_institution): static
    {
        $this->type_of_institution = $type_of_institution;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getMaxCoast(): ?string
    {
        return $this->max_coast;
    }

    public function setMaxCoast(string $max_coast): static
    {
        $this->max_coast = $max_coast;

        return $this;
    }

    public function getPreferedLanguage(): ?string
    {
        return $this->prefered_language;
    }

    public function setPreferedLanguage(string $prefered_language): static
    {
        $this->prefered_language = $prefered_language;

        return $this;
    }

    public function getMinSuccessRate(): ?string
    {
        return $this->min_success_rate;
    }

    public function setMinSuccessRate(string $min_success_rate): static
    {
        $this->min_success_rate = $min_success_rate;

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
