<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RgpdAccessRepository")
 */
class RgpdAccess
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeStatut", inversedBy="rgpdAccesses")
     */
    private $statut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $CreatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $PublishedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer", inversedBy="rgpdAccesses")
     */
    private $customer;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $ClosedAt;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\People", inversedBy="rgpdAccesses")
     */
    private $pilotes;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Flux", inversedBy="rgpdAccesses")
     */
    private $traitement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="rgpdAccessesResponsable")
     */
    private $responsable;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="rgpdAccessesSuppleant")
     */
    private $suppleant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\people", inversedBy="rgpdAccessesPublisher")
     */
    private $publisher;


    public function __construct()
    {
        $this->pilotes = new ArrayCollection();
        $this->traitement = new ArrayCollection();
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    public function getCustomer(): ?MapsiCustomer
    {
        return $this->customer;
    }

    public function setCustomer(?MapsiCustomer $customer): self
    {
        $this->customer = $customer;

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
     * @return Collection|People[]
     */
    public function getPilotes(): Collection
    {
        return $this->pilotes;
    }

    public function addPilote(People $pilote): self
    {
        if (!$this->pilotes->contains($pilote)) {
            $this->pilotes[] = $pilote;
        }

        return $this;
    }

    public function removePilote(People $pilote): self
    {
        if ($this->pilotes->contains($pilote)) {
            $this->pilotes->removeElement($pilote);
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

    public function getSuppleant(): ?People
    {
        return $this->suppleant;
    }

    public function setSuppleant(?People $suppleant): self
    {
        $this->suppleant = $suppleant;

        return $this;
    }

    public function getPublisher(): ?people
    {
        return $this->publisher;
    }

    public function setPublisher(?people $publisher): self
    {
        $this->publisher = $publisher;

        return $this;
    }


}
