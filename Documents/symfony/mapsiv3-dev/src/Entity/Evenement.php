<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 */
class Evenement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $designation;

    /**
     * @ORM\ManyToOne(targetEntity=MapsiCustomer::class, inversedBy="evenements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=TypeConformite::class, inversedBy="evenements")
     */
    private $typeconformite;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="evenementsresponsable")
     */
    private $responsable;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="evenementssuppleant")
     */
    private $suppleant;

    /**
     * @ORM\ManyToMany(targetEntity=People::class, inversedBy="evenementspeoples")
     */
    private $peoples;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $CreatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $UpdatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $PublishedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $ValidatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $StartAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $FinishAt;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="evenementsvalidator")
     */
    private $validator;

    /**
     * @ORM\ManyToMany(targetEntity=Processus::class, inversedBy="evenementsprocessuses")
     */
    private $processuses;

    /**
     * @ORM\ManyToMany(targetEntity=Activite::class, inversedBy="evenements")
     */
    private $activites;

    /**
     * @ORM\ManyToMany(targetEntity=ObjetMetier::class, inversedBy="evenementsobjetmetiers")
     */
    private $objetmetiers;

    /**
     * @ORM\ManyToMany(targetEntity=Flux::class, inversedBy="evenementsfluxes")
     */
    private $fluxes;

    /**
     * @ORM\ManyToMany(targetEntity=Application::class, inversedBy="evenementsapplications")
     */
    private $applications;

    /**
     * @ORM\ManyToMany(targetEntity=Systeme::class, inversedBy="evenementssystemes")
     */
    private $systemes;

    public function __construct()
    {
        $this->typeconformite = new ArrayCollection();
        $this->peoples = new ArrayCollection();
        $this->processuses = new ArrayCollection();
        $this->activites = new ArrayCollection();
        $this->objetmetiers = new ArrayCollection();
        $this->fluxes = new ArrayCollection();
        $this->applications = new ArrayCollection();
        $this->systemes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getCustomer(): ?MapsiCustomer
    {
        return $this->customer;
    }

    public function setCustomer(?MapsiCustomer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|TypeConformite[]
     */
    public function getTypeconformite(): Collection
    {
        return $this->typeconformite;
    }

    public function addTypeconformite(TypeConformite $typeconformite): self
    {
        if (!$this->typeconformite->contains($typeconformite)) {
            $this->typeconformite[] = $typeconformite;
        }

        return $this;
    }

    public function removeTypeconformite(TypeConformite $typeconformite): self
    {
        $this->typeconformite->removeElement($typeconformite);

        return $this;
    }

    public function getResponsable(): ?People
    {
        return $this->responsable;
    }

    public function setResponsable(?People $responsable): self
    {
        $this->responsable = $responsable;

        return $this;
    }

    public function getSuppleant(): ?People
    {
        return $this->suppleant;
    }

    public function setSuppleant(?People $suppleant): self
    {
        $this->suppleant = $suppleant;

        return $this;
    }

    /**
     * @return Collection|People[]
     */
    public function getPeoples(): Collection
    {
        return $this->peoples;
    }

    public function addPeople(People $people): self
    {
        if (!$this->peoples->contains($people)) {
            $this->peoples[] = $people;
        }

        return $this;
    }

    public function removePeople(People $people): self
    {
        $this->peoples->removeElement($people);

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(?\DateTimeInterface $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $UpdatedAt): self
    {
        $this->UpdatedAt = $UpdatedAt;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->PublishedAt;
    }

    public function setPublishedAt(?\DateTimeInterface $PublishedAt): self
    {
        $this->PublishedAt = $PublishedAt;

        return $this;
    }

    public function getValidatedAt(): ?\DateTimeInterface
    {
        return $this->ValidatedAt;
    }

    public function setValidatedAt(?\DateTimeInterface $ValidatedAt): self
    {
        $this->ValidatedAt = $ValidatedAt;

        return $this;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->StartAt;
    }

    public function setStartAt(?\DateTimeInterface $StartAt): self
    {
        $this->StartAt = $StartAt;

        return $this;
    }

    public function getFinishAt(): ?\DateTimeInterface
    {
        return $this->FinishAt;
    }

    public function setFinishAt(?\DateTimeInterface $FinishAt): self
    {
        $this->FinishAt = $FinishAt;

        return $this;
    }

    public function getValidator(): ?People
    {
        return $this->validator;
    }

    public function setValidator(?People $validator): self
    {
        $this->validator = $validator;

        return $this;
    }

    /**
     * @return Collection|Processus[]
     */
    public function getProcessuses(): Collection
    {
        return $this->processuses;
    }

    public function addProcessus(Processus $processus): self
    {
        if (!$this->processuses->contains($processus)) {
            $this->processuses[] = $processus;
        }

        return $this;
    }

    public function removeProcessus(Processus $processus): self
    {
        $this->processuses->removeElement($processus);

        return $this;
    }

    /**
     * @return Collection|Activite[]
     */
    public function getActivites(): Collection
    {
        return $this->activites;
    }

    public function addActivite(Activite $activite): self
    {
        if (!$this->activites->contains($activite)) {
            $this->activites[] = $activite;
        }

        return $this;
    }

    public function removeActivite(Activite $activite): self
    {
        $this->activites->removeElement($activite);

        return $this;
    }

    /**
     * @return Collection|ObjetMetier[]
     */
    public function getObjetmetiers(): Collection
    {
        return $this->objetmetiers;
    }

    public function addObjetmetier(ObjetMetier $objetmetier): self
    {
        if (!$this->objetmetiers->contains($objetmetier)) {
            $this->objetmetiers[] = $objetmetier;
        }

        return $this;
    }

    public function removeObjetmetier(ObjetMetier $objetmetier): self
    {
        $this->objetmetiers->removeElement($objetmetier);

        return $this;
    }

    /**
     * @return Collection|Flux[]
     */
    public function getFluxes(): Collection
    {
        return $this->fluxes;
    }

    public function addFlux(Flux $flux): self
    {
        if (!$this->fluxes->contains($flux)) {
            $this->fluxes[] = $flux;
        }

        return $this;
    }

    public function removeFlux(Flux $flux): self
    {
        $this->fluxes->removeElement($flux);

        return $this;
    }

    /**
     * @return Collection|Application[]
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    public function addApplication(Application $application): self
    {
        if (!$this->applications->contains($application)) {
            $this->applications[] = $application;
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        $this->applications->removeElement($application);

        return $this;
    }

    /**
     * @return Collection|Systeme[]
     */
    public function getSystemes(): Collection
    {
        return $this->systemes;
    }

    public function addSysteme(Systeme $systeme): self
    {
        if (!$this->systemes->contains($systeme)) {
            $this->systemes[] = $systeme;
        }

        return $this;
    }

    public function removeSysteme(Systeme $systeme): self
    {
        $this->systemes->removeElement($systeme);

        return $this;
    }
}
