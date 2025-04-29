<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\InformationRequestsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: InformationRequestsRepository::class)]
#[ApiResource]
#[Broadcast]
class InformationRequests
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $request_date = null;

    #[ORM\ManyToOne(inversedBy: 'information_requests')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user = null;

    #[ORM\ManyToOne(inversedBy: 'information_requests')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Institutions $institutions = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?InformationsAnswers $information_answers = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getRequestDate(): ?\DateTimeInterface
    {
        return $this->request_date;
    }

    public function setRequestDate(\DateTimeInterface $request_date): static
    {
        $this->request_date = $request_date;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getInstitutions(): ?Institutions
    {
        return $this->institutions;
    }

    public function setInstitutions(?Institutions $institutions): static
    {
        $this->institutions = $institutions;

        return $this;
    }

    public function getInformationAnswers(): ?InformationsAnswers
    {
        return $this->information_answers;
    }

    public function setInformationAnswers(?InformationsAnswers $information_answers): static
    {
        $this->information_answers = $information_answers;

        return $this;
    }
}
