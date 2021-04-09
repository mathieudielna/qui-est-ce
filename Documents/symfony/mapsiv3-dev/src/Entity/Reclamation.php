<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=ReclamationRepository::class)
 */
class Reclamation
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
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="reclamationsresponsable")
     */
    private $responsable;

    /**
     * @ORM\ManyToMany(targetEntity=People::class, inversedBy="reclamationspeoples")
     */
    private $peoples;

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
    private $ValidatedAt;

    /**
     * @ORM\Column(type="string", length=255)
     * @Gedmo\Slug(fields={"designation"})
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $declarantnom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $declaranttel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $declarantemail;

    /**
     * @ORM\ManyToMany(targetEntity=Site::class, inversedBy="reclamations")
     */
    private $sites;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="reclamationspublisher")
     */
    private $publisher;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="reclamationsvalidator")
     */
    private $validator;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $validationstatut;

    /**
     * @ORM\ManyToMany(targetEntity=AspectEnv::class, inversedBy="reclamations")
     */
    private $aspectsenv;


    /**
     * @ORM\ManyToMany(targetEntity=Action::class, inversedBy="reclamations")
     */
    private $actions;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="reclamationspeople")
     */
    private $suppleant;

    /**
     * @ORM\ManyToMany(targetEntity=Processus::class, inversedBy="reclamations")
     */
    private $processuses;

    /**
     * @ORM\ManyToOne(targetEntity=MapsiCustomer::class, inversedBy="reclamations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\ManyToMany(targetEntity=TypeConformite::class, inversedBy="reclamationstypeconfo")
     */
    private $typeconformite;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="reclamationsredacteur")
     */
    private $redacteur;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToMany(targetEntity=TypeReclamation::class, inversedBy="reclamations")
     */
    private $typereclamations;

    /**
     * @ORM\ManyToOne(targetEntity=OuiNon::class)
     */
    private $anonyme;

    /**
     * @ORM\ManyToOne(targetEntity=OuiNon::class)
     */
    private $information;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $UpdatedAt;


    public function __construct()
    {
        $this->peoples = new ArrayCollection();
        $this->sites = new ArrayCollection();
        $this->aspectsenv = new ArrayCollection();
        $this->actions = new ArrayCollection();
        $this->processuses = new ArrayCollection();
        $this->typeconformite = new ArrayCollection();
        $this->typereclamations = new ArrayCollection();
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

    public function getResponsable(): ?People
    {
        return $this->responsable;
    }

    public function setResponsable(?People $responsable): self
    {
        $this->responsable = $responsable;

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

    public function getValidatedAt(): ?\DateTimeInterface
    {
        return $this->ValidatedAt;
    }

    public function setValidatedAt(?\DateTimeInterface $ValidatedAt): self
    {
        $this->ValidatedAt = $ValidatedAt;

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

    public function getDeclarantnom(): ?string
    {
        return $this->declarantnom;
    }

    public function setDeclarantnom(?string $declarantnom): self
    {
        $this->declarantnom = $declarantnom;

        return $this;
    }

    public function getDeclaranttel(): ?string
    {
        return $this->declaranttel;
    }

    public function setDeclaranttel(?string $declaranttel): self
    {
        $this->declaranttel = $declaranttel;

        return $this;
    }

    public function getDeclarantemail(): ?string
    {
        return $this->declarantemail;
    }

    public function setDeclarantemail(?string $declarantemail): self
    {
        $this->declarantemail = $declarantemail;

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

    public function getPublisher(): ?People
    {
        return $this->publisher;
    }

    public function setPublisher(?People $publisher): self
    {
        $this->publisher = $publisher;

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

    /**
     * @return Collection|AspectEnv[]
     */
    public function getAspectsenv(): Collection
    {
        return $this->aspectsenv;
    }

    public function addAspectsenv(AspectEnv $aspectsenv): self
    {
        if (!$this->aspectsenv->contains($aspectsenv)) {
            $this->aspectsenv[] = $aspectsenv;
        }

        return $this;
    }

    public function removeAspectsenv(AspectEnv $aspectsenv): self
    {
        $this->aspectsenv->removeElement($aspectsenv);

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

    public function getCustomer(): ?MapsiCustomer
    {
        return $this->customer;
    }

    public function setCustomer(?MapsiCustomer $customer): self
    {
        $this->customer = $customer;

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

    public function getRedacteur(): ?People
    {
        return $this->redacteur;
    }

    public function setRedacteur(?People $redacteur): self
    {
        $this->redacteur = $redacteur;

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

    /**
     * @return Collection|TypeReclamation[]
     */
    public function getTypereclamations(): Collection
    {
        return $this->typereclamations;
    }

    public function addTypereclamation(TypeReclamation $typereclamation): self
    {
        if (!$this->typereclamations->contains($typereclamation)) {
            $this->typereclamations[] = $typereclamation;
        }

        return $this;
    }

    public function removeTypereclamation(TypeReclamation $typereclamation): self
    {
        $this->typereclamations->removeElement($typereclamation);

        return $this;
    }

    public function getAnonyme(): ?OuiNon
    {
        return $this->anonyme;
    }

    public function setAnonyme(?OuiNon $anonyme): self
    {
        $this->anonyme = $anonyme;

        return $this;
    }

    public function getInformation(): ?OuiNon
    {
        return $this->information;
    }

    public function setInformation(?OuiNon $information): self
    {
        $this->information = $information;

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
}
