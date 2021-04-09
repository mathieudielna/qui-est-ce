<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjetRepository")
 */
class Projet
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
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer", inversedBy="projets")
     */
    private $customer;

    /**
     * @ORM\Column(type="datetime")
     */
    private $PublishedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Axe", inversedBy="projets")
     */
    private $Axe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Metier", inversedBy="projets")
     */
    private $metier;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="projets")
     */
    private $pilote;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tier", inversedBy="projets")
     */
    private $tier;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Metier", mappedBy="projet")
     */
    private $contributeur;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $prerequis;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Risque", inversedBy="projets")
     */
    private $risques;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Action", mappedBy="projet")
     */
    private $actions;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $budget;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Program", inversedBy="projets")
     */
    private $program;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="projetsuppleant")
     */
    private $suppleant;

    /**
     * @ORM\ManyToMany(targetEntity=People::class, inversedBy="projetspeoples")
     */
    private $peoples;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="projetspublisher")
     */
    private $publisher;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="projetsreponsable")
     */
    private $responsable;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $ValidatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="projetsvalidator")
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;


    public function __construct()
    {
      
        $this->tier = new ArrayCollection();
        $this->contributeur = new ArrayCollection();
        $this->risques = new ArrayCollection();
        $this->actions = new ArrayCollection();
        $this->peoples = new ArrayCollection();
 

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

    public function getCustomer(): ?MapsiCustomer
    {
        return $this->customer;
    }

    public function setCustomer(?MapsiCustomer $customer): self
    {
        $this->customer = $customer;

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

    public function getAxe(): ?Axe
    {
        return $this->Axe;
    }

    public function setAxe(?Axe $Axe): self
    {
        $this->Axe = $Axe;

        return $this;
    }

    public function getMetier(): ?Metier
    {
        return $this->metier;
    }

    public function setMetier(?Metier $metier): self
    {
        $this->metier = $metier;

        return $this;
    }

    public function getPilote(): ?People
    {
        return $this->pilote;
    }

    public function setPilote(?People $pilote): self
    {
        $this->pilote = $pilote;

        return $this;
    }

    /**
     * @return Collection|Tier[]
     */
    public function getTier(): Collection
    {
        return $this->tier;
    }

    public function addTier(Tier $tier): self
    {
        if (!$this->tier->contains($tier)) {
            $this->tier[] = $tier;
        }

        return $this;
    }

    public function removeTier(Tier $tier): self
    {
        if ($this->tier->contains($tier)) {
            $this->tier->removeElement($tier);
        }

        return $this;
    }

    /**
     * @return Collection|Metier[]
     */
    public function getContributeur(): Collection
    {
        return $this->contributeur;
    }

    public function addContributeur(Metier $contributeur): self
    {
        if (!$this->contributeur->contains($contributeur)) {
            $this->contributeur[] = $contributeur;
            $contributeur->setProjet($this);
        }

        return $this;
    }

    public function removeContributeur(Metier $contributeur): self
    {
        if ($this->contributeur->contains($contributeur)) {
            $this->contributeur->removeElement($contributeur);
            // set the owning side to null (unless already changed)
            if ($contributeur->getProjet() === $this) {
                $contributeur->setProjet(null);
            }
        }

        return $this;
    }

    public function getPrerequis(): ?string
    {
        return $this->prerequis;
    }

    public function setPrerequis(?string $prerequis): self
    {
        $this->prerequis = $prerequis;

        return $this;
    }

    /**
     * @return Collection|Risque[]
     */
    public function getRisques(): Collection
    {
        return $this->risques;
    }

    public function addRisque(Risque $risque): self
    {
        if (!$this->risques->contains($risque)) {
            $this->risques[] = $risque;
        }

        return $this;
    }

    public function removeRisque(Risque $risque): self
    {
        if ($this->risques->contains($risque)) {
            $this->risques->removeElement($risque);
        }

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
            $action->setProjet($this);
        }

        return $this;
    }

    public function removeAction(Action $action): self
    {
        if ($this->actions->contains($action)) {
            $this->actions->removeElement($action);
            // set the owning side to null (unless already changed)
            if ($action->getProjet() === $this) {
                $action->setProjet(null);
            }
        }

        return $this;
    }

    public function getBudget(): ?string
    {
        return $this->budget;
    }

    public function setBudget(?string $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getProgram(): ?Program
    {
        return $this->program;
    }

    public function setProgram(?Program $program): self
    {
        $this->program = $program;

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
        if ($this->peoples->contains($people)) {
            $this->peoples->removeElement($people);
        }

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

    public function getResponsable(): ?People
    {
        return $this->responsable;
    }

    public function setResponsable(?People $responsable): self
    {
        $this->responsable = $responsable;

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }


}
