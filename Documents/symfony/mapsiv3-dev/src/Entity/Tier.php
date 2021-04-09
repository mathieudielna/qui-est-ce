<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TierRepository")
 */
class Tier
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Activite", mappedBy="tiers", cascade={"persist"})
     */
    private $activites;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Flux", mappedBy="destext")
     */
    private $fluxes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer", inversedBy="tiers")
     */
    private $customer;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Projet", mappedBy="tier")
     */
    private $projets;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeTier", inversedBy="tiers")
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Flux", mappedBy="expout")
     */
    private $expoutfluxes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\RgpdViolation", mappedBy="tiers")
     */
    private $rgpdViolations;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\RgpdAudit", mappedBy="Tiers")
     */
    private $rgpdAudits;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PcaEvenement", mappedBy="tiers")
     */
    private $pcaEvenements;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codepostal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pays;

    /**
     * @ORM\ManyToOne(targetEntity=TypeScore::class, inversedBy="tiersscore")
     */
    private $score;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $scoringjustif;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="tiersresponsable")
     */
    private $responsable;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="tierssuppleant")
     */
    private $suppleant;

    /**
     * @ORM\ManyToMany(targetEntity=People::class, inversedBy="tierspeoples")
     */
    private $peoples;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $PublishedAt;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="tierspublisher")
     */
    private $Publisher;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToMany(targetEntity=Audit::class, mappedBy="tiers")
     */
    private $auditstier;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Gedmo\Slug(fields={"designation"})
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity=Dysfonctionnement::class, mappedBy="tiers")
     */
    private $dysfonctionnements;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    public function __construct()
    {
        $this->activites = new ArrayCollection();
        $this->fluxes = new ArrayCollection();
        $this->projets = new ArrayCollection();
        $this->expoutfluxes = new ArrayCollection();
        $this->rgpdViolations = new ArrayCollection();
        $this->rgpdAudits = new ArrayCollection();
        $this->pcaEvenements = new ArrayCollection();
        $this->peoples = new ArrayCollection();
        $this->auditstier = new ArrayCollection();
        $this->dysfonctionnements = new ArrayCollection();
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
            $activite->addTier($this);
        }

        return $this;
    }

    public function removeActivite(Activite $activite): self
    {
        if ($this->activites->contains($activite)) {
            $this->activites->removeElement($activite);
            $activite->removeTier($this);
        }

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
    public function getFluxes(): Collection
    {
        return $this->fluxes;
    }

    public function addFlux(Flux $flux): self
    {
        if (!$this->fluxes->contains($flux)) {
            $this->fluxes[] = $flux;
            $flux->addDestext($this);
        }

        return $this;
    }

    public function removeFlux(Flux $flux): self
    {
        if ($this->fluxes->contains($flux)) {
            $this->fluxes->removeElement($flux);
            $flux->removeDestext($this);
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

    /**
     * @return Collection|Projet[]
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projet $projet): self
    {
        if (!$this->projets->contains($projet)) {
            $this->projets[] = $projet;
            $projet->addTier($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): self
    {
        if ($this->projets->contains($projet)) {
            $this->projets->removeElement($projet);
            $projet->removeTier($this);
        }

        return $this;
    }

    public function getType(): ?TypeTier
    {
        return $this->type;
    }

    public function setType(?TypeTier $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Flux[]
     */
    public function getExpoutfluxes(): Collection
    {
        return $this->expoutfluxes;
    }

    public function addExpoutflux(Flux $expoutflux): self
    {
        if (!$this->expoutfluxes->contains($expoutflux)) {
            $this->expoutfluxes[] = $expoutflux;
            $expoutflux->addExpout($this);
        }

        return $this;
    }

    public function removeExpoutflux(Flux $expoutflux): self
    {
        if ($this->expoutfluxes->contains($expoutflux)) {
            $this->expoutfluxes->removeElement($expoutflux);
            $expoutflux->removeExpout($this);
        }

        return $this;
    }

    /**
     * @return Collection|RgpdViolation[]
     */
    public function getRgpdViolations(): Collection
    {
        return $this->rgpdViolations;
    }

    public function addRgpdViolation(RgpdViolation $rgpdViolation): self
    {
        if (!$this->rgpdViolations->contains($rgpdViolation)) {
            $this->rgpdViolations[] = $rgpdViolation;
            $rgpdViolation->addTier($this);
        }

        return $this;
    }

    public function removeRgpdViolation(RgpdViolation $rgpdViolation): self
    {
        if ($this->rgpdViolations->contains($rgpdViolation)) {
            $this->rgpdViolations->removeElement($rgpdViolation);
            $rgpdViolation->removeTier($this);
        }

        return $this;
    }

    /**
     * @return Collection|RgpdAudit[]
     */
    public function getRgpdAudits(): Collection
    {
        return $this->rgpdAudits;
    }

    public function addRgpdAudit(RgpdAudit $rgpdAudit): self
    {
        if (!$this->rgpdAudits->contains($rgpdAudit)) {
            $this->rgpdAudits[] = $rgpdAudit;
            $rgpdAudit->addTier($this);
        }

        return $this;
    }

    public function removeRgpdAudit(RgpdAudit $rgpdAudit): self
    {
        if ($this->rgpdAudits->contains($rgpdAudit)) {
            $this->rgpdAudits->removeElement($rgpdAudit);
            $rgpdAudit->removeTier($this);
        }

        return $this;
    }

    /**
     * @return Collection|PcaEvenement[]
     */
    public function getPcaEvenements(): Collection
    {
        return $this->pcaEvenements;
    }

    public function addPcaEvenement(PcaEvenement $pcaEvenement): self
    {
        if (!$this->pcaEvenements->contains($pcaEvenement)) {
            $this->pcaEvenements[] = $pcaEvenement;
            $pcaEvenement->addTier($this);
        }

        return $this;
    }

    public function removePcaEvenement(PcaEvenement $pcaEvenement): self
    {
        if ($this->pcaEvenements->contains($pcaEvenement)) {
            $this->pcaEvenements->removeElement($pcaEvenement);
            $pcaEvenement->removeTier($this);
        }

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodepostal(): ?string
    {
        return $this->codepostal;
    }

    public function setCodepostal(?string $codepostal): self
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getScore(): ?TypeScore
    {
        return $this->score;
    }

    public function setScore(?TypeScore $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getScoringjustif(): ?string
    {
        return $this->scoringjustif;
    }

    public function setScoringjustif(?string $scoringjustif): self
    {
        $this->scoringjustif = $scoringjustif;

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
        if ($this->peoples->contains($people)) {
            $this->peoples->removeElement($people);
        }

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

    public function getPublisher(): ?People
    {
        return $this->Publisher;
    }

    public function setPublisher(?People $Publisher): self
    {
        $this->Publisher = $Publisher;

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
     * @return Collection|Audit[]
     */
    public function getAuditstier(): Collection
    {
        return $this->auditstier;
    }

    public function addAuditstier(Audit $auditstier): self
    {
        if (!$this->auditstier->contains($auditstier)) {
            $this->auditstier[] = $auditstier;
            $auditstier->addTier($this);
        }

        return $this;
    }

    public function removeAuditstier(Audit $auditstier): self
    {
        if ($this->auditstier->removeElement($auditstier)) {
            $auditstier->removeTier($this);
        }

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

    /**
     * @return Collection|Dysfonctionnement[]
     */
    public function getDysfonctionnements(): Collection
    {
        return $this->dysfonctionnements;
    }

    public function addDysfonctionnement(Dysfonctionnement $dysfonctionnement): self
    {
        if (!$this->dysfonctionnements->contains($dysfonctionnement)) {
            $this->dysfonctionnements[] = $dysfonctionnement;
            $dysfonctionnement->addTier($this);
        }

        return $this;
    }

    public function removeDysfonctionnement(Dysfonctionnement $dysfonctionnement): self
    {
        if ($this->dysfonctionnements->removeElement($dysfonctionnement)) {
            $dysfonctionnement->removeTier($this);
        }

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
