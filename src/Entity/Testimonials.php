<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TestimonialsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TestimonialsRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['testimonials:read']],
    denormalizationContext: ['groups' => ['testimonials:write']]
)]
class Testimonials
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['testimonials:read', 'testimonials:write', 'avp:read', 'avp:write'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['testimonials:read', 'testimonials:write', 'avp:read', 'avp:write'])]
    private ?string $author = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['testimonials:read', 'testimonials:write', 'avp:read', 'avp:write'])]
    private ?\DateTimeInterface $publication_date = null;

    #[ORM\Column(length: 255)]
    #[Groups(['testimonials:read', 'testimonials:write', 'avp:read', 'avp:write'])]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'testimonials')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['testimonials:read', 'testimonials:write', 'avp:read', 'avp:write'])]
    private ?Courses $courses = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publication_date;
    }

    public function setPublicationDate(\DateTimeInterface $publication_date): static
    {
        $this->publication_date = $publication_date;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getCourses(): ?Courses
    {
        return $this->courses;
    }

    public function setCourses(?Courses $courses): static
    {
        $this->courses = $courses;

        return $this;
    }
}
