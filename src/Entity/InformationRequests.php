<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\InformationRequestsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: InformationRequestsRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['information_requests:read']],
    denormalizationContext: ['groups' => ['information_requests:write']]
)]
class InformationRequests
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['information_requests:read', 'information_requests:write', 'avp:read', 'avp:write'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['information_requests:read', 'information_requests:write', 'avp:read', 'avp:write'])]
    private ?string $status = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['information_requests:read', 'information_requests:write', 'avp:read', 'avp:write'])]
    private ?\DateTimeInterface $request_date = null;

    // #[ORM\ManyToOne(inversedBy: 'information_requests')]
    // #[ORM\JoinColumn(nullable: false)]
    // private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'information_requests')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['information_requests:read', 'information_requests:write', 'avp:read', 'avp:write'])]
    private ?Institutions $institutions = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[Groups(['information_requests:read', 'information_requests:write', 'avp:read', 'avp:write'])]
    private ?InformationsAnswers $information_answers = null;

    #[ORM\ManyToOne(inversedBy: 'informationrequests')]
    #[Groups(['information_requests:read', 'information_requests:write', 'avp:read', 'avp:write'])]
    private ?User $user = null;

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

    // public function getUser(): ?User
    // {
    //     return $this->user;
    // }

    // public function setUser(?User $user): static
    // {
    //     $this->user = $user;

    //     return $this;
    // }

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
