<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\OrientationQuestionsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OrientationQuestionsRepository::class)]
#[ApiResource(paginationEnabled: false)]
class OrientationQuestions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['orientation_questions:read', 'orientation_questions:write', 'avp:read', 'avp:write'])]
    private ?int $id = null;
    
    public function getId(): ?int
    {
        return $this->id;
    }


    
}
