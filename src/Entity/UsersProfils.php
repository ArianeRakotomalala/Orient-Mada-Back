<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UsersProfilsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: UsersProfilsRepository::class)]
#[ApiResource]
#[Broadcast]
class UsersProfils
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $birthday = null;

    #[ORM\Column(length: 255)]
    private ?string $adress = null;

    #[ORM\Column(length: 255)]
    private ?string $hobbies = null;

    #[ORM\Column(length: 255)]
    private ?string $serie = null;

    #[ORM\OneToOne(mappedBy: 'user_profils_id', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    // #[ORM\OneToOne(mappedBy: 'user_profils', cascade: ['persist', 'remove'])]
    // private ?User $user = null;

    // #[ORM\OneToOne(mappedBy: 'user_profils', cascade: ['persist', 'remove'])]
    // private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }


    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    public function setBirthday(string $birthday): static
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }

    public function getHobbies(): ?string
    {
        return $this->hobbies;
    }

    public function setHobbies(string $hobbies): static
    {
        $this->hobbies = $hobbies;

        return $this;
    }

    public function getSerie(): ?string
    {
        return $this->serie;
    }

    public function setSerie(string $serie): static
    {
        $this->serie = $serie;

        return $this;
    }

    // public function getUser(): ?User
    // {
    //     return $this->user;
    // }

    // public function setUser(User $user): static
    // {
    //     // set the owning side of the relation if necessary
    //     if ($user->getUserProfil() !== $this) {
    //         $user->setUserProfil($this);
    //     }

    //     $this->user = $user;

    //     return $this;
    // }

    // // public function getUser(): ?User
    // {
    //     return $this->user;
    // }

    // public function setUser(?User $user): static
    // {
    //     // unset the owning side of the relation if necessary
    //     if ($user === null && $this->user !== null) {
    //         $this->user->setUserProfils(null);
    //     }

    //     // set the owning side of the relation if necessary
    //     if ($user !== null && $user->getUserProfils() !== $this) {
    //         $user->setUserProfils($this);
    //     }

    //     $this->user = $user;

    //     return $this;
    // }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setUserProfilsId(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getUserProfilsId() !== $this) {
            $user->setUserProfilsId($this);
        }

        $this->user = $user;

        return $this;
    }
}
