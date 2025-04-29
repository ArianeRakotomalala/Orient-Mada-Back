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
    private ?string $bacc_result = null;

    #[ORM\Column(length: 255)]
    private ?string $birthday = null;

    #[ORM\Column(length: 255)]
    private ?string $clear = null;

    #[ORM\Column(length: 255)]
    private ?string $adress = null;

    #[ORM\Column(length: 255)]
    private ?string $hobbies = null;

    #[ORM\Column(length: 255)]
    private ?string $serie = null;

    #[ORM\OneToOne(mappedBy: 'user_profils', cascade: ['persist', 'remove'])]
    private ?Users $users = null;

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

    public function getBaccResult(): ?string
    {
        return $this->bacc_result;
    }

    public function setBaccResult(string $bacc_result): static
    {
        $this->bacc_result = $bacc_result;

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

    public function getClear(): ?string
    {
        return $this->clear;
    }

    public function setClear(string $clear): static
    {
        $this->clear = $clear;

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

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(Users $users): static
    {
        // set the owning side of the relation if necessary
        if ($users->getUserProfils() !== $this) {
            $users->setUserProfils($this);
        }

        $this->users = $users;

        return $this;
    }
}
