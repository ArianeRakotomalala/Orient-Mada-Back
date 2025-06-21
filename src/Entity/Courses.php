<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CoursesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: CoursesRepository::class)]
#[ApiResource(
    paginationEnabled: false,
    normalizationContext: ['groups' => ['courses:read']],
    denormalizationContext: ['groups' => ['courses:write']]
)]
#[Broadcast]
class Courses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['courses:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['courses:read', 'courses:write'])]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Groups(['courses:read', 'courses:write'])]
    private ?string $duration = null;

    #[ORM\Column(length: 255)]
    #[Groups(['courses:read', 'courses:write'])]
    private ?string $degree = null;

    #[ORM\Column(length: 255)]
    #[Groups(['courses:read', 'courses:write'])]
    private ?string $prerequisites = null;

    #[ORM\Column(length: 255)]
    #[Groups(['courses:read', 'courses:write'])]
    private ?string $admission_process = null;

    #[ORM\Column]
    #[Groups(['courses:read', 'courses:write'])]
    private ?string $fees = null;

    #[ORM\Column(length: 255)]
    #[Groups(['courses:read', 'courses:write'])]
    private ?string $languages = null;

    #[ORM\Column(length: 255)]
    #[Groups(['courses:read', 'courses:write'])]
    private ?string $career_prospects = null;

    #[ORM\ManyToOne(inversedBy: 'courses')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['courses:read', 'courses:write'])]
    private ?Institutions $institutions = null;

    /**
     * @var Collection<int, Testimonials>
     */
    #[ORM\OneToMany(targetEntity: Testimonials::class, mappedBy: 'courses')]
    #[Groups(['courses:read'])]
    private Collection $testimonials;

    #[ORM\ManyToOne(inversedBy: 'courses')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['courses:read', 'courses:write'])]
    private ?Domaine $domaine = null;

    public function __construct()
    {
        $this->testimonials = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDegree(): ?string
    {
        return $this->degree;
    }

    public function setDegree(string $degree): static
    {
        $this->degree = $degree;

        return $this;
    }

    public function getPrerequisites(): ?string
    {
        return $this->prerequisites;
    }

    public function setPrerequisites(string $prerequisites): static
    {
        $this->prerequisites = $prerequisites;

        return $this;
    }

    public function getAdmissionProcess(): ?string
    {
        return $this->admission_process;
    }

    public function setAdmissionProcess(string $admission_process): static
    {
        $this->admission_process = $admission_process;

        return $this;
    }

    public function getFees(): ?string
    {
        return $this->fees;
    }

    public function setFees(string $fees): static
    {
        $this->fees = $fees;

        return $this;
    }

    public function getLanguages(): ?string
    {
        return $this->languages;
    }

    public function setLanguages(string $languages): static
    {
        $this->languages = $languages;

        return $this;
    }

    public function getCareerProspects(): ?string
    {
        return $this->career_prospects;
    }

    public function setCareerProspects(string $career_prospects): static
    {
        $this->career_prospects = $career_prospects;

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

    /**
     * @return Collection<int, Testimonials>
     */
    public function getTestimonials(): Collection
    {
        return $this->testimonials;
    }

    public function addTestimonial(Testimonials $testimonial): static
    {
        if (!$this->testimonials->contains($testimonial)) {
            $this->testimonials->add($testimonial);
            $testimonial->setCourses($this);
        }

        return $this;
    }

    public function removeTestimonial(Testimonials $testimonial): static
    {
        if ($this->testimonials->removeElement($testimonial)) {
            // set the owning side to null (unless already changed)
            if ($testimonial->getCourses() === $this) {
                $testimonial->setCourses(null);
            }
        }

        return $this;
    }

    public function getDomaine(): ?Domaine
    {
        return $this->domaine;
    }

    public function setDomaine(?Domaine $domaine): static
    {
        $this->domaine = $domaine;

        return $this;
    }
}
