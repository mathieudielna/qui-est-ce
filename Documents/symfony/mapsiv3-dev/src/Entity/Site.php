<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SiteRepository")
 */
class Site
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
     * @ORM\OneToMany(targetEntity="App\Entity\Systeme", mappedBy="localisation")
     */
    private $systemes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeSite", inversedBy="sites")
     */
    private $typedesite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="sitesresponsable")
     */
    private $responsable;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="sitessuppleant")
     */
    private $suppleant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telstandard;

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
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Site", inversedBy="sites")
     */
    private $sitesecours;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Site", mappedBy="sitesecours")
     */
    private $sites;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer", inversedBy="sites")
     */
    private $customer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $latlng;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Action", mappedBy="sites")
     */
    private $actions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\People", mappedBy="site")
     */
    private $peoples;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ressource", mappedBy="site")
     */
    private $ressources;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PcaEvenement", mappedBy="sites")
     */
    private $pcaEvenements;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $PublishedAt;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="sitespublisher")
     */
    private $Publisher;

    /**
     * @ORM\ManyToMany(targetEntity=Audit::class, mappedBy="sites")
     */
    private $auditssite;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Gedmo\Slug(fields={"designation"})
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity=VisiteSite::class, mappedBy="sites")
     */
    private $visiteSites;

    /**
     * @ORM\ManyToMany(targetEntity=Reclamation::class, mappedBy="sites")
     */
    private $reclamations;

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
        $this->systemes = new ArrayCollection();
        $this->sitesecours = new ArrayCollection();
        $this->sites = new ArrayCollection();
        $this->actions = new ArrayCollection();
        $this->peoples = new ArrayCollection();
        $this->ressources = new ArrayCollection();
        $this->pcaEvenements = new ArrayCollection();
        $this->auditssite = new ArrayCollection();
        $this->visiteSites = new ArrayCollection();
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

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Systeme[]
     */
    public function getSystemes(): Collection
    {
        return $this->systemes;
    }

    public function addSysteme(Systeme $systeme): self
    {
        if (!$this->systemes->contains($systeme)) {
            $this->systemes[] = $systeme;
            $systeme->setLocalisation($this);
        }

        return $this;
    }

    public function removeSysteme(Systeme $systeme): self
    {
        if ($this->systemes->contains($systeme)) {
            $this->systemes->removeElement($systeme);
            // set the owning side to null (unless already changed)
            if ($systeme->getLocalisation() === $this) {
                $systeme->setLocalisation(null);
            }
        }

        return $this;
    }

    public function getTypedesite(): ?TypeSite
    {
        return $this->typedesite;
    }

    public function setTypedesite(?TypeSite $typedesite): self
    {
        $this->typedesite = $typedesite;

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

    public function getTelstandard(): ?string
    {
        return $this->telstandard;
    }

    public function setTelstandard(?string $telstandard): self
    {
        $this->telstandard = $telstandard;

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
     * @return Collection|self[]
     */
    public function getSitesecours(): Collection
    {
        return $this->sitesecours;
    }

    public function addSitesecour(self $sitesecour): self
    {
        if (!$this->sitesecours->contains($sitesecour)) {
            $this->sitesecours[] = $sitesecour;
        }

        return $this;
    }

    public function removeSitesecour(self $sitesecour): self
    {
        if ($this->sitesecours->contains($sitesecour)) {
            $this->sitesecours->removeElement($sitesecour);
        }

        return $this;
    }
    
      

    /**
     * @return Collection|self[]
     */
    public function getSites(): Collection
    {
        return $this->sites;
    }

    public function addSite(self $site): self
    {
        if (!$this->sites->contains($site)) {
            $this->sites[] = $site;
            $site->addSitesecour($this);
        }

        return $this;
    }

    public function removeSite(self $site): self
    {
        if ($this->sites->contains($site)) {
            $this->sites->removeElement($site);
            $site->removeSitesecour($this);
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

    public function getLatlng(): ?string
    {
        return $this->latlng;
    }

    public function setLatlng(?string $latlng): self
    {
        $this->latlng = $latlng;

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
            $action->addSite($this);
        }

        return $this;
    }

    public function removeAction(Action $action): self
    {
        if ($this->actions->contains($action)) {
            $this->actions->removeElement($action);
            $action->removeSite($this);
        }

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
            $people->setSite($this);
        }

        return $this;
    }

    public function removePeople(People $people): self
    {
        if ($this->peoples->contains($people)) {
            $this->peoples->removeElement($people);
            // set the owning side to null (unless already changed)
            if ($people->getSite() === $this) {
                $people->setSite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ressource[]
     */
    public function getRessources(): Collection
    {
        return $this->ressources;
    }

    public function addRessource(Ressource $ressource): self
    {
        if (!$this->ressources->contains($ressource)) {
            $this->ressources[] = $ressource;
            $ressource->setSite($this);
        }

        return $this;
    }

    public function removeRessource(Ressource $ressource): self
    {
        if ($this->ressources->contains($ressource)) {
            $this->ressources->removeElement($ressource);
            // set the owning side to null (unless already changed)
            if ($ressource->getSite() === $this) {
                $ressource->setSite(null);
            }
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
            $pcaEvenement->addSite($this);
        }

        return $this;
    }

    public function removePcaEvenement(PcaEvenement $pcaEvenement): self
    {
        if ($this->pcaEvenements->contains($pcaEvenement)) {
            $this->pcaEvenements->removeElement($pcaEvenement);
            $pcaEvenement->removeSite($this);
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

    /**
     * @return Collection|Audit[]
     */
    public function getAuditssite(): Collection
    {
        return $this->auditssite;
    }

    public function addAuditssite(Audit $auditssite): self
    {
        if (!$this->auditssite->contains($auditssite)) {
            $this->auditssite[] = $auditssite;
            $auditssite->addSite($this);
        }

        return $this;
    }

    public function removeAuditssite(Audit $auditssite): self
    {
        if ($this->auditssite->removeElement($auditssite)) {
            $auditssite->removeSite($this);
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
            $visiteSite->addSite($this);
        }

        return $this;
    }

    public function removeVisiteSite(VisiteSite $visiteSite): self
    {
        if ($this->visiteSites->removeElement($visiteSite)) {
            $visiteSite->removeSite($this);
        }

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
            $reclamation->addSite($this);
        }

        return $this;
    }

    public function removeReclamation(Reclamation $reclamation): self
    {
        if ($this->reclamations->removeElement($reclamation)) {
            $reclamation->removeSite($this);
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
