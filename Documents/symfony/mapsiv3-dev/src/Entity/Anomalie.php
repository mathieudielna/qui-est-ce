<?php

namespace App\Entity;

use App\Repository\AnomalieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnomalieRepository::class)
 */
class Anomalie
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
     * @ORM\ManyToOne(targetEntity=people::class, inversedBy="anomaliesresponsable")
     */
    private $responsable;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="anomaliessuppleant")
     */
    private $suppleant;

    /**
     * @ORM\ManyToOne(targetEntity=TypeStatut::class, inversedBy="anomalies")
     */
    private $statut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $PublishedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $UpdatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=MapsiCustomer::class, inversedBy="anomalies")
     */
    private $customer;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToMany(targetEntity=Processus::class, inversedBy="anomalies")
     */
    private $processuses;

    /**
     * @ORM\ManyToMany(targetEntity=Activite::class, inversedBy="anomalies")
     */
    private $activites;

    /**
     * @ORM\ManyToMany(targetEntity=Application::class, inversedBy="anomalies")
     */
    private $applications;

    /**
     * @ORM\ManyToMany(targetEntity=action::class, inversedBy="anomalies")
     */
    private $actions;

    /**
     * @ORM\ManyToMany(targetEntity=People::class, inversedBy="contributeursanomalies")
     */
    private $contributeurs;

    /**
     * @ORM\Column(type="datetime")
     */
    private $CreatedAt;

    public function __construct()
    {
        $this->processuses = new ArrayCollection();
        $this->activites = new ArrayCollection();
        $this->applications = new ArrayCollection();
        $this->actions = new ArrayCollection();
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

    public function getResponsable(): ?people
    {
        return $this->responsable;
    }

    public function setResponsable(?people $responsable): self
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

    public function getStatut(): ?TypeStatut
    {
        return $this->statut;
    }

    public function setStatut(?TypeStatut $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->PublishedAt;
    }

    public function setPublishedAt(\DateTimeInterface $PublishedAt): self
    {
        $this->PublishedAt = $PublishedAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $UpdatedAt): self
    {
        $this->UpdatedAt = $UpdatedAt;

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
        if ($this->processuses->contains($processus)) {
            $this->processuses->removeElement($processus);
        }

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
        if ($this->activites->contains($activite)) {
            $this->activites->removeElement($activite);
        }

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
        if ($this->applications->contains($application)) {
            $this->applications->removeElement($application);
        }

        return $this;
    }

    /**
     * @return Collection|action[]
     */
    public function getActions(): Collection
    {
        return $this->actions;
    }

    public function addAction(action $action): self
    {
        if (!$this->actions->contains($action)) {
            $this->actions[] = $action;
        }

        return $this;
    }

    public function removeAction(action $action): self
    {
        if ($this->actions->contains($action)) {
            $this->actions->removeElement($action);
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeInterface $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }
}
