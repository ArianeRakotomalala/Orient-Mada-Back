<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\InformationsAnswersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: InformationsAnswersRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['informations_answers:read']],
    denormalizationContext: ['groups' => ['informations_answers:write']]
)]
class InformationsAnswers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['informations_answers:read', 'informations_answers:write', 'avp:read', 'avp:write'])]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
