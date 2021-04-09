<?php

namespace App\Entity;

use App\Repository\AuditRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Entity(repositoryClass=AuditRepository::class)
 */
class Audit
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
     * @ORM\Column(type="datetime", nullable=true)
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
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="auditsresponsable")
     */
    private $responsable;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="auditssuppleant")
     */
    private $suppleant;

    /**
     * @ORM\ManyToMany(targetEntity=People::class, inversedBy="auditspeoples")
     */
    private $Peoples;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $resultat;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $resultatlight;

    /**
     * @ORM\ManyToMany(targetEntity=TypeConformite::class, inversedBy="auditstypeconformite")
     */
    private $typeconformite;

    /**
     * @ORM\ManyToMany(targetEntity=Processus::class, inversedBy="auditsprocessus")
     */
    private $processuses;

    /**
     * @ORM\ManyToMany(targetEntity=Site::class, inversedBy="auditssite")
     */
    private $sites;

    /**
     * @ORM\ManyToMany(targetEntity=Tier::class, inversedBy="auditstier")
     */
    private $tiers;

    /**
     * @ORM\ManyToMany(targetEntity=Flux::class, inversedBy="auditsflux")
     */
    private $traitements;

    /**
     * @ORM\ManyToMany(targetEntity=Action::class, inversedBy="auditsaction")
     */
    private $actions;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $ValidatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="auditsvalidator")
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
     * @ORM\ManyToOne(targetEntity=MapsiCustomer::class, inversedBy="auditscustomer")
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="auditspublisher")
     */
    private $publisher;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $PreparedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $StartedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $FinishedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $ReportedAt;

    /**
     * @ORM\ManyToOne(targetEntity=TypeAudit::class, inversedBy="audits")
     */
    private $typeaudit;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $progres;

    /**
     * @ORM\OneToMany(targetEntity=NonConformite::class, mappedBy="audit", orphanRemoval=true, cascade={"persist"})
     */
    private $nonconformites;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $auditeur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $organisme;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;


    public function __construct()
    {
        $this->Peoples = new ArrayCollection();
        $this->typeconformite = new ArrayCollection();
        $this->processuses = new ArrayCollection();
        $this->sites = new ArrayCollection();
        $this->tiers = new ArrayCollection();
        $this->traitements = new ArrayCollection();
        $this->actions = new ArrayCollection();
        $this->nonconformites = new ArrayCollection();
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(?\DateTimeInterface $CreatedAt): self
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
        return $this->Peoples;
    }

    public function addPeople(People $people): self
    {
        if (!$this->Peoples->contains($people)) {
            $this->Peoples[] = $people;
        }

        return $this;
    }

    public function removePeople(People $people): self
    {
        $this->Peoples->removeElement($people);

        return $this;
    }

    public function getResultat(): ?string
    {
        return $this->resultat;
    }

    public function setResultat(?string $resultat): self
    {
        $this->resultat = $resultat;

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

    public function getResultatlight(): ?string
    {
        return $this->resultatlight;
    }

    public function setResultatlight(?string $resultatlight): self
    {
        $this->resultatlight = $resultatlight;

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
     * @return Collection|Site[]
     */
    public function getSites(): Collection
    {
        return $this->sites;
    }

    public function addSite(Site $site): self
    {
        if (!$this->sites->contains($site)) {
            $this->sites[] = $site;
        }

        return $this;
    }

    public function removeSite(Site $site): self
    {
        $this->sites->removeElement($site);

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
     * @return Collection|Action[]
     */
    public function getActions(): Collection
    {
        return $this->actions;
    }

    public function addAction(Action $action): self
    {
        if (!$this->actions->contains($action)) {
            $this->actions[] = $action;
        }

        return $this;
    }

    public function removeAction(Action $action): self
    {
        $this->actions->removeElement($action);

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

    public function getPreparedAt(): ?\DateTimeInterface
    {
        return $this->PreparedAt;
    }

    public function setPreparedAt(?\DateTimeInterface $PreparedAt): self
    {
        $this->PreparedAt = $PreparedAt;

        return $this;
    }

    public function getStartedAt(): ?\DateTimeInterface
    {
        return $this->StartedAt;
    }

    public function setStartedAt(?\DateTimeInterface $StartedAt): self
    {
        $this->StartedAt = $StartedAt;

        return $this;
    }

    public function getFinishedAt(): ?\DateTimeInterface
    {
        return $this->FinishedAt;
    }

    public function setFinishedAt(?\DateTimeInterface $FinishedAt): self
    {
        $this->FinishedAt = $FinishedAt;

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

    public function getTypeaudit(): ?TypeAudit
    {
        return $this->typeaudit;
    }

    public function setTypeaudit(?TypeAudit $typeaudit): self
    {
        $this->typeaudit = $typeaudit;

        return $this;
    }

    public function getProgres(): ?string
    {
        return $this->progres;
    }

    public function setProgres(?string $progres): self
    {
        $this->progres = $progres;

        return $this;
    }

    /**
     * @return Collection|NonConformite[]
     */
    public function getNonconformites(): Collection
    {
        return $this->nonconformites;
    }

    public function addNonconformite(NonConformite $nonconformite): self
    {
        if (!$this->nonconformites->contains($nonconformite)) {
            $this->nonconformites[] = $nonconformite;
            $nonconformite->setAudit($this);
        }

        return $this;
    }

    public function removeNonconformite(NonConformite $nonconformite): self
    {
        if ($this->nonconformites->removeElement($nonconformite)) {
            // set the owning side to null (unless already changed)
            if ($nonconformite->getAudit() === $this) {
                $nonconformite->setAudit(null);
            }
        }

        return $this;
    }

    public function getAuditeur(): ?string
    {
        return $this->auditeur;
    }

    public function setAuditeur(?string $auditeur): self
    {
        $this->auditeur = $auditeur;

        return $this;
    }

    public function getOrganisme(): ?string
    {
        return $this->organisme;
    }

    public function setOrganisme(?string $organisme): self
    {
        $this->organisme = $organisme;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

}
