<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RgpdViolationRepository")
 */
class RgpdViolation
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typenotification;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numerocnil;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="rgpdViolations")
     */
    private $declarant;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\People", inversedBy="rgpdContriViolations")
     */
    private $contributeur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $mesuresecu;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Flux", inversedBy="rgpdViolations")
     */
    private $traitement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer", inversedBy="rgpdViolations")
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeStatut", inversedBy="rgpdViolations")
     */
    private $statut;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $consequence;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tier", inversedBy="rgpdViolations")
     */
    private $tiers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="rgpdViolationsresponsable")
     */
    private $responsable;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="rgpdViolationsSuppleant")
     */
    private $suppleant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="rgpdViolationsPublisher")
     */
    private $publisher;


    public function __construct()
    {
        $this->contributeur = new ArrayCollection();
        $this->traitement = new ArrayCollection();
        $this->tiers = new ArrayCollection();
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

    public function getDeclarant(): ?People
    {
        return $this->declarant;
    }

    public function setDeclarant(?People $declarant): self
    {
        $this->declarant = $declarant;

        return $this;
    }

    /**
     * @return Collection|People[]
     */
    public function getContributeur(): Collection
    {
        return $this->contributeur;
    }

    public function addContributeur(People $contributeur): self
    {
        if (!$this->contributeur->contains($contributeur)) {
            $this->contributeur[] = $contributeur;
        }

        return $this;
    }

    public function removeContributeur(People $contributeur): self
    {
        if ($this->contributeur->contains($contributeur)) {
            $this->contributeur->removeElement($contributeur);
        }

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

    public function getMesuresecu(): ?string
    {
        return $this->mesuresecu;
    }

    public function setMesuresecu(?string $mesuresecu): self
    {
        $this->mesuresecu = $mesuresecu;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
        if ($this->tiers->contains($tier)) {
            $this->tiers->removeElement($tier);
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

}
