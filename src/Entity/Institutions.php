<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\InstitutionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Put;

#[ORM\Entity(repositoryClass: InstitutionsRepository::class)]
#[ApiResource(
    paginationEnabled: false,
    operations: [
        new \ApiPlatform\Metadata\Get(),
        new \ApiPlatform\Metadata\GetCollection(),
        new \ApiPlatform\Metadata\Post(),
        new \ApiPlatform\Metadata\Delete(),
        new \ApiPlatform\Metadata\Patch(),
        new Put(),
    ],
    normalizationContext: ['groups' => ['institutions:read']],
    denormalizationContext: ['groups' => ['institutions:write', 'avp:write']]
)]
#[ApiFilter(SearchFilter::class, properties: [
    'location' => 'partial',
    'domaine' => 'partial',
    
])]
class Institutions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['institutions:read', 'institutions:write', 'avp:read', 'avp:write'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['institutions:read', 'institutions:write', 'avp:read', 'avp:write'])]
    private ?string $institution_name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['institutions:read', 'institutions:write', 'avp:read', 'avp:write'])]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    #[Groups(['institutions:read', 'institutions:write', 'avp:read', 'avp:write'])]
    private ?string $location = null;

    #[ORM\Column(length: 255)]
    #[Groups(['institutions:read', 'institutions:write', 'avp:read', 'avp:write'])]
    private ?string $history = null;

    
    #[ORM\Column(length: 255)]
    #[Groups(['institutions:read', 'institutions:write', 'avp:read', 'avp:write'])]
    private ?string $contact = null;

    #[ORM\Column(length: 255)]
    #[Groups(['institutions:read', 'institutions:write', 'avp:read', 'avp:write'])]
    private ?string $region = null;


    /**
     * @var Collection<int, Courses>
     */
    #[ORM\OneToMany(targetEntity: Courses::class, mappedBy: 'institutions')]
    private Collection $courses;

    /**
     * @var Collection<int, Events>
     */
    #[ORM\OneToMany(targetEntity: Events::class, mappedBy: 'institution')]
    private Collection $events;

    /**
     * @var Collection<int, InstituteRegistration>
     */
    #[ORM\OneToMany(targetEntity: InstituteRegistration::class, mappedBy: 'intitution')]
    private Collection $institute_registrations;

    /**
     * @var Collection<int, InformationRequests>
     */
    #[ORM\OneToMany(targetEntity: InformationRequests::class, mappedBy: 'institutions')]
    private Collection $information_requests;

    /**
     * @var Collection<int, Favorites>
     */
    #[ORM\OneToMany(targetEntity: Favorites::class, mappedBy: 'institution')]
    private Collection $favorites;

    #[ORM\Column(length: 255)]
    #[Groups(['institutions:read', 'institutions:write', 'avp:read', 'avp:write'])]
    private ?string $logo = null;

    /**
     * @var Collection<int, Avis>
     */
    #[ORM\OneToMany(targetEntity: Avis::class, mappedBy: 'institutions')]
    private Collection $avis;



    #[ORM\Column(length: 255)]
    #[Groups(['institutions:read', 'institutions:write', 'avp:read', 'avp:write'])]
    private ?string $src_img = null;

    public function __construct()
    {
        $this->courses = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->institute_registrations = new ArrayCollection();
        $this->information_requests = new ArrayCollection();
        $this->favorites = new ArrayCollection();
        $this->avis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInstitutionName(): ?string
    {
        return $this->institution_name;
    }

    public function setInstitutionName(string $institution_name): static
    {
        $this->institution_name = $institution_name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

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

    public function getHistory(): ?string
    {
        return $this->history;
    }

    public function setHistory(string $history): static
    {
        $this->history = $history;

        return $this;
    }

 

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): static
    {
        $this->contact = $contact;

        return $this;
    }
    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): static
    {
        $this->region = $region;
        return $this;
    }

    /**
     * @return Collection<int, Courses>
     */
    public function getCourses(): Collection
    {
        return $this->courses;
    }

    public function addCourse(Courses $course): static
    {
        if (!$this->courses->contains($course)) {
            $this->courses->add($course);
            $course->setInstitutions($this);
        }

        return $this;
    }

    public function removeCourse(Courses $course): static
    {
        if ($this->courses->removeElement($course)) {
            $course->setInstitutions(null);
        }

        return $this;
    }

    /**
     * @return Collection<int, Events>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Events $event): static
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setInstitution($this);
        }

        return $this;
    }

    public function removeEvent(Events $event): static
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getInstitution() === $this) {
                $event->setInstitution(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InstituteRegistration>
     */
    public function getInstituteRegistrations(): Collection
    {
        return $this->institute_registrations;
    }

    public function addInstituteRegistration(InstituteRegistration $instituteRegistration): static
    {
        if (!$this->institute_registrations->contains($instituteRegistration)) {
            $this->institute_registrations->add($instituteRegistration);
            $instituteRegistration->setIntitution($this);
        }

        return $this;
    }

    public function removeInstituteRegistration(InstituteRegistration $instituteRegistration): static
    {
        if ($this->institute_registrations->removeElement($instituteRegistration)) {
            // set the owning side to null (unless already changed)
            if ($instituteRegistration->getIntitution() === $this) {
                $instituteRegistration->setIntitution(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InformationRequests>
     */
    public function getInformationRequests(): Collection
    {
        return $this->information_requests;
    }

    public function addInformationRequest(InformationRequests $informationRequest): static
    {
        if (!$this->information_requests->contains($informationRequest)) {
            $this->information_requests->add($informationRequest);
            $informationRequest->setInstitutions($this);
        }

        return $this;
    }

    public function removeInformationRequest(InformationRequests $informationRequest): static
    {
        if ($this->information_requests->removeElement($informationRequest)) {
            // set the owning side to null (unless already changed)
            if ($informationRequest->getInstitutions() === $this) {
                $informationRequest->setInstitutions(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Favorites>
     */
    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorite(Favorites $favorite): static
    {
        if (!$this->favorites->contains($favorite)) {
            $this->favorites->add($favorite);
            $favorite->setInstitution($this);
        }

        return $this;
    }

    public function removeFavorite(Favorites $favorite): static
    {
        if ($this->favorites->removeElement($favorite)) {
            // set the owning side to null (unless already changed)
            if ($favorite->getInstitution() === $this) {
                $favorite->setInstitution(null);
            }
        }

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): static
    {
        if (!$this->avis->contains($avi)) {
            $this->avis->add($avi);
            $avi->setInstitutions($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): static
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getInstitutions() === $this) {
                $avi->setInstitutions(null);
            }
        }

        return $this;
    }

    public function getSrcImg(): ?string
    {
        return $this->src_img;
    }

    public function setSrcImg(string $src_img): static
    {
        $this->src_img = $src_img;

        return $this;
    }

   
}
