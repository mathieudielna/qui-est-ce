<?php

namespace App\Entity;

use App\Repository\AspectEnvRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=AspectEnvRepository::class)
 */
class AspectEnv
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="aspectEnvsresponsable")
     */
    private $responsable;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="aspectEnvssuppleant")
     */
    private $suppleant;

    /**
     * @ORM\ManyToMany(targetEntity=Action::class, inversedBy="aspectEnvs")
     */
    private $Actions;

    /**
     * @ORM\ManyToMany(targetEntity=People::class, inversedBy="aspectEnvspeoples")
     */
    private $peoples;

    /**
     * @ORM\ManyToMany(targetEntity=Activite::class, inversedBy="aspectEnvs")
     */
    private $activites;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="aspectEnvsValidator")
     */
    private $validator;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $validationstatut;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Gedmo\Slug(fields={"designation"})
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=MapsiCustomer::class, inversedBy="aspectEnvs")
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="aspectEnvspublisher")
     */
    private $publisher;

    /**
     * @ORM\OneToMany(targetEntity=Impact::class, mappedBy="aspectenv", orphanRemoval=true, cascade={"persist"})
     */
    private $impacts;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $ReportedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $criticite;

    /**
     * @ORM\ManyToOne(targetEntity=TypeAspectEnv::class, inversedBy="aspectEnvs")
     */
    private $typeaspectenv;

    /**
     * @ORM\ManyToMany(targetEntity=Reclamation::class, mappedBy="aspectsenv")
     */
    private $reclamations;

    /**
     * @ORM\ManyToOne(targetEntity=Processus::class, inversedBy="aspectEnvs")
     */
    private $processuses;

    public function __construct()
    {
        $this->Actions = new ArrayCollection();
        $this->peoples = new ArrayCollection();
        $this->activites = new ArrayCollection();
        $this->impacts = new ArrayCollection();
        $this->reclamations = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

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
     * @return Collection|Action[]
     */
    public function getActions(): Collection
    {
        return $this->Actions;
    }

    public function addAction(Action $action): self
    {
        if (!$this->Actions->contains($action)) {
            $this->Actions[] = $action;
        }

        return $this;
    }

    public function removeAction(Action $action): self
    {
        $this->Actions->removeElement($action);

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

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): self
    {
        $this->statut = $statut;

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

    public function getValidationstatut(): ?string
    {
        return $this->validationstatut;
    }

    public function setValidationstatut(?string $validationstatut): self
    {
        $this->validationstatut = $validationstatut;

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

    public function getCustomer(): ?MapsiCustomer
    {
        return $this->customer;
    }

    public function setCustomer(?MapsiCustomer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getPublisher(): ?People
    {
        return $this->publisher;
    }

    public function setPublisher(?People $publisher): self
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * @return Collection|Impact[]
     */
    public function getImpacts(): Collection
    {
        return $this->impacts;
    }

    public function addImpact(Impact $impact): self
    {
        if (!$this->impacts->contains($impact)) {
            $this->impacts[] = $impact;
            $impact->setAspectenv($this);
        }

        return $this;
    }

    public function removeImpact(Impact $impact): self
    {
        if ($this->impacts->removeElement($impact)) {
            // set the owning side to null (unless already changed)
            if ($impact->getAspectenv() === $this) {
                $impact->setAspectenv(null);
            }
        }

        return $this;
    }

    public function getReportedAt(): ?\DateTimeInterface
    {
        return $this->ReportedAt;
    }

    public function setReportedAt(?\DateTimeInterface $ReportedAt): self
    {
        $this->ReportedAt = $ReportedAt;

        return $this;
    }

    public function getCriticite(): ?string
    {
        return $this->criticite;
    }

    public function setCriticite(?string $criticite): self
    {
        $this->criticite = $criticite;

        return $this;
    }

    public function getTypeaspectenv(): ?TypeAspectEnv
    {
        return $this->typeaspectenv;
    }

    public function setTypeaspectenv(?TypeAspectEnv $typeaspectenv): self
    {
        $this->typeaspectenv = $typeaspectenv;

        return $this;
    }

    /**
     * @return Collection|Reclamation[]
     */
    public function getReclamations(): Collection
    {
        return $this->reclamations;
    }

    public function addReclamation(Reclamation $reclamation): self
    {
        if (!$this->reclamations->contains($reclamation)) {
            $this->reclamations[] = $reclamation;
            $reclamation->addAspectsenv($this);
        }

        return $this;
    }

    public function removeReclamation(Reclamation $reclamation): self
    {
        if ($this->reclamations->removeElement($reclamation)) {
            $reclamation->removeAspectsenv($this);
        }

        return $this;
    }

    public function getProcessuses(): ?Processus
    {
        return $this->processuses;
    }

    public function setProcessuses(?Processus $processuses): self
    {
        $this->processuses = $processuses;

        return $this;
    }
}
