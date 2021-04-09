<?php

namespace App\Entity;

use App\Repository\DysfonctionnementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=DysfonctionnementRepository::class)
 */
class Dysfonctionnement
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typenotification;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numerocnil;

    /**
     * @ORM\Column(type="datetime")
     */
    private $CreatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $PublishedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $ClosedAt;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="dysfonctionnementsdeclarant")
     */
    private $declarant;


    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mesuresecu;


    /**
     * @ORM\ManyToOne(targetEntity=MapsiCustomer::class, inversedBy="dysfonctionnements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $consequence;

    /**
     * @ORM\ManyToMany(targetEntity=Tier::class, inversedBy="dysfonctionnements")
     */
    private $tiers;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="dysfonctionnementsresponsable")
     */
    private $responsable;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="dysfonctionnementssuppleant")
     */
    private $suppleant;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="dysfonctionnementspublisher")
     */
    private $publisher;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Gedmo\Slug(fields={"designation"})
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $ValidatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="dysfonctionnementsvalidator")
     */
    private $validator;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $validationstatut;

    /**
     * @ORM\ManyToMany(targetEntity=Flux::class, inversedBy="dysfonctionnementsfluxes")
     */
    private $traitements;

    /**
     * @ORM\ManyToMany(targetEntity=People::class, inversedBy="dysfonctionnementspeoples")
     */
    private $peoples;

    /**
     * @ORM\ManyToMany(targetEntity=TypeConformite::class, inversedBy="dysfonctionnements")
     */
    private $typeconformite;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $UpdatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $ReportedAt;

    /**
     * @ORM\ManyToMany(targetEntity=VisiteSite::class, mappedBy="dysfonctionnements")
     */
    private $visiteSites;

    public function __construct()
    {
        $this->tiers = new ArrayCollection();
        $this->traitements = new ArrayCollection();
        $this->peoples = new ArrayCollection();
        $this->typeconformite = new ArrayCollection();
        $this->visiteSites = new ArrayCollection();
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

    public function getTypenotification(): ?string
    {
        return $this->typenotification;
    }

    public function setTypenotification(?string $typenotification): self
    {
        $this->typenotification = $typenotification;

        return $this;
    }

    public function getNumerocnil(): ?string
    {
        return $this->numerocnil;
    }

    public function setNumerocnil(?string $numerocnil): self
    {
        $this->numerocnil = $numerocnil;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeInterface $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

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

    public function getClosedAt(): ?\DateTimeInterface
    {
        return $this->ClosedAt;
    }

    public function setClosedAt(?\DateTimeInterface $ClosedAt): self
    {
        $this->ClosedAt = $ClosedAt;

        return $this;
    }

    public function getDeclarant(): ?People
    {
        return $this->declarant;
    }

    public function setDeclarant(?People $declarant): self
    {
        $this->declarant = $declarant;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMesuresecu(): ?string
    {
        return $this->mesuresecu;
    }

    public function setMesuresecu(?string $mesuresecu): self
    {
        $this->mesuresecu = $mesuresecu;

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

    public function getConsequence(): ?string
    {
        return $this->consequence;
    }

    public function setConsequence(?string $consequence): self
    {
        $this->consequence = $consequence;

        return $this;
    }

    /**
     * @return Collection|Tier[]
     */
    public function getTiers(): Collection
    {
        return $this->tiers;
    }

    public function addTier(Tier $tier): self
    {
        if (!$this->tiers->contains($tier)) {
            $this->tiers[] = $tier;
        }

        return $this;
    }

    public function removeTier(Tier $tier): self
    {
        $this->tiers->removeElement($tier);

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

    public function getPublisher(): ?People
    {
        return $this->publisher;
    }

    public function setPublisher(?People $publisher): self
    {
        $this->publisher = $publisher;

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

    public function getValidatedAt(): ?\DateTimeInterface
    {
        return $this->ValidatedAt;
    }

    public function setValidatedAt(?\DateTimeInterface $ValidatedAt): self
    {
        $this->ValidatedAt = $ValidatedAt;

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

    /**
     * @return Collection|Flux[]
     */
    public function getTraitements(): Collection
    {
        return $this->traitements;
    }

    public function addTraitement(Flux $traitement): self
    {
        if (!$this->traitements->contains($traitement)) {
            $this->traitements[] = $traitement;
        }

        return $this;
    }

    public function removeTraitement(Flux $traitement): self
    {
        $this->traitements->removeElement($traitement);

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $UpdatedAt): self
    {
        $this->UpdatedAt = $UpdatedAt;

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

    /**
     * @return Collection|VisiteSite[]
     */
    public function getVisiteSites(): Collection
    {
        return $this->visiteSites;
    }

    public function addVisiteSite(VisiteSite $visiteSite): self
    {
        if (!$this->visiteSites->contains($visiteSite)) {
            $this->visiteSites[] = $visiteSite;
            $visiteSite->addDysfonctionnement($this);
        }

        return $this;
    }

    public function removeVisiteSite(VisiteSite $visiteSite): self
    {
        if ($this->visiteSites->removeElement($visiteSite)) {
            $visiteSite->removeDysfonctionnement($this);
        }

        return $this;
    }
}
