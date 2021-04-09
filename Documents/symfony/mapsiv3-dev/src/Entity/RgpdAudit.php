<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RgpdAuditRepository")
 */
class RgpdAudit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Flux", inversedBy="rgpdAudits")
     */
    private $traitement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="rgpdAudits")
     */
    private $responsable;


    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $resultat;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Action", inversedBy="rgpdAudits")
     */
    private $actions;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer", inversedBy="rgpdAudits")
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeStatut", inversedBy="rgpdAudits")
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $resultatlight;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tier", inversedBy="rgpdAudits")
     */
    private $Tiers;

    /**
     * @ORM\ManyToMany(targetEntity=People::class, inversedBy="rgpdAuditscontributeurs")
     */
    private $contributeurs;

    public function __construct()
    {
        $this->traitement = new ArrayCollection();
        $this->actions = new ArrayCollection();
        $this->Tiers = new ArrayCollection();
        $this->contributeurs = new ArrayCollection();
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

    /**
     * @return Collection|Flux[]
     */
    public function getTraitement(): Collection
    {
        return $this->traitement;
    }

    public function addTraitement(Flux $traitement): self
    {
        if (!$this->traitement->contains($traitement)) {
            $this->traitement[] = $traitement;
        }

        return $this;
    }

    public function removeTraitement(Flux $traitement): self
    {
        if ($this->traitement->contains($traitement)) {
            $this->traitement->removeElement($traitement);
        }

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
        if ($this->actions->contains($action)) {
            $this->actions->removeElement($action);
        }

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

    public function getStatut(): ?TypeStatut
    {
        return $this->statut;
    }

    public function setStatut(?TypeStatut $statut): self
    {
        $this->statut = $statut;

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
     * @return Collection|Tier[]
     */
    public function getTiers(): Collection
    {
        return $this->Tiers;
    }

    public function addTier(Tier $tier): self
    {
        if (!$this->Tiers->contains($tier)) {
            $this->Tiers[] = $tier;
        }

        return $this;
    }

    public function removeTier(Tier $tier): self
    {
        if ($this->Tiers->contains($tier)) {
            $this->Tiers->removeElement($tier);
        }

        return $this;
    }

    /**
     * @return Collection|People[]
     */
    public function getContributeurs(): Collection
    {
        return $this->contributeurs;
    }

    public function addContributeur(People $contributeur): self
    {
        if (!$this->contributeurs->contains($contributeur)) {
            $this->contributeurs[] = $contributeur;
        }

        return $this;
    }

    public function removeContributeur(People $contributeur): self
    {
        if ($this->contributeurs->contains($contributeur)) {
            $this->contributeurs->removeElement($contributeur);
        }

        return $this;
    }
}
