<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\ChoiceList\ArrayChoiceList;
use Symfony\Component\Form\ChoiceList\Loader\ChoiceLoaderInterface;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\FormTypeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ApplicationRepository")
 */
class Application
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3, max=255, minMessage="Votre titre doit faire au moins 3 caractères")
     */
    private $designation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeAppli", inversedBy="applications")
     * @ORM\JoinColumn(nullable=true)
     */
    private $typeAppli;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Systeme", mappedBy="applications")
     */
    private $systemes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $editeur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="applicationsresponsable")
     */
    private $responsable;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="applicationssuppleant")
     */
    private $suppleant;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Flux", mappedBy="applications")
     */
    private $fluxes;

    /**
     * @ORM\Column(type="datetime")
     */
    private $PublishedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer", inversedBy="applications")
     */
    private $customer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AppConnectActivite", mappedBy="application", orphanRemoval=true, cascade={"persist"})
     */
    private $appConnectActivites;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $prerequisite;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ressource", inversedBy="applications")
     */
    private $ressources;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Application")
     */
    private $applicationlink;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ObjetMetier", mappedBy="applications")
     */
    private $objetMetiers;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Action", mappedBy="applications")
     */
    private $actions;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PcaEvenement", mappedBy="applications")
     */
    private $pcaEvenements;

    /**
     * @ORM\ManyToMany(targetEntity=Anomalie::class, mappedBy="applications")
     */
    private $anomalies;

    /**
     * @ORM\OneToMany(targetEntity=PcaEvenementAppTrack::class, mappedBy="Application", orphanRemoval=true, cascade={"persist"})
     */
    private $pcaEvenementAppTracks;

    /**
     * @ORM\ManyToMany(targetEntity=People::class, inversedBy="applicationspeoples")
     */
    private $peoples;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="applicationpublisher")
     */
    private $publisher;

    /**
     * @ORM\ManyToOne(targetEntity=OnOff::class, inversedBy="applications")
     */
    private $statutrun;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $ValidatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="applicationsvalidator")
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
     * @ORM\ManyToMany(targetEntity=Evenement::class, mappedBy="applications")
     */
    private $evenementsapplications;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="applicationsredacteur")
     */
    private $redacteur;



	public function __construct()
                                              {
                                                  $this->systemes = new ArrayCollection();
                                                  $this->fluxes = new ArrayCollection();
                                                  $this->appConnectActivites = new ArrayCollection();
                                                  $this->ressources = new ArrayCollection();
                                                  $this->applicationlink = new ArrayCollection();
                                                  $this->objetMetiers = new ArrayCollection();
                                                  $this->actions = new ArrayCollection();
                                                  $this->pcaEvenements = new ArrayCollection();
                                                  $this->anomalies = new ArrayCollection();
                                                  $this->pcaEvenementAppTracks = new ArrayCollection();
                                                  $this->peoples = new ArrayCollection();
                                                  $this->evenementsapplications = new ArrayCollection();
                                              }

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getDesignations()
    {
        $this->designations = new ArrayCollection();
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


    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getTypeAppli(): ?TypeAppli
    {
        return $this->typeAppli;
    }

    public function setTypeAppli(?TypeAppli $typeAppli): self
    {
        $this->typeAppli = $typeAppli;

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
              $systeme->addApplication($this);
          }

          return $this;
      }

      public function removeSysteme(Systeme $systeme): self
      {
          if ($this->systemes->contains($systeme)) {
              $this->systemes->removeElement($systeme);
              $systeme->removeApplication($this);
          }

          return $this;
      }

      public function getEditeur(): ?string
      {
          return $this->editeur;
      }

      public function setEditeur(?string $editeur): self
      {
          $this->editeur = $editeur;

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
              $flux->addApplication($this);
          }

          return $this;
      }

      public function removeFlux(Flux $flux): self
      {
          if ($this->fluxes->contains($flux)) {
              $this->fluxes->removeElement($flux);
              $flux->removeApplication($this);
          }

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
       * @return Collection|AppConnectActivite[]
       */
      public function getAppConnectActivites(): Collection
      {
          return $this->appConnectActivites;
      }

      public function addAppConnectActivite(AppConnectActivite $appConnectActivite): self
      {
          if (!$this->appConnectActivites->contains($appConnectActivite)) {
              $this->appConnectActivites[] = $appConnectActivite;
              $appConnectActivite->setApplication($this);
          }

          return $this;
      }

      public function removeAppConnectActivite(AppConnectActivite $appConnectActivite): self
      {
          if ($this->appConnectActivites->contains($appConnectActivite)) {
              $this->appConnectActivites->removeElement($appConnectActivite);
              // set the owning side to null (unless already changed)
              if ($appConnectActivite->getApplication() === $this) {
                  $appConnectActivite->setApplication(null);
              }
          }

          return $this;
      }

      public function getPrerequisite(): ?string
      {
          return $this->prerequisite;
      }

      public function setPrerequisite(?string $prerequisite): self
      {
          $this->prerequisite = $prerequisite;

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
          }

          return $this;
      }

      public function removeRessource(Ressource $ressource): self
      {
          if ($this->ressources->contains($ressource)) {
              $this->ressources->removeElement($ressource);
          }

          return $this;
      }

      /**
       * @return Collection|self[]
       */
      public function getApplicationlink(): Collection
      {
          return $this->applicationlink;
      }

	  /**
     * @param  Application $application
     * @return void
     */
      public function addApplicationlink(self $applicationlink): self
      {
          if (!$this->applicationlink->contains($applicationlink)) {
              $this->applicationlink[] = $applicationlink;
              $applicationlink->addApplicationlink($this);
              
          }

          return $this;
      }

      public function removeApplicationlink(self $applicationlink): self
      {
          if ($this->applicationlink->contains($applicationlink)) {
              $this->applicationlink->removeElement($applicationlink);
              $applicationlink->removeApplicationlink($this);
          }

          return $this;
      }

      /**
       * @return Collection|ObjetMetier[]
       */
      public function getObjetMetiers(): Collection
      {
          return $this->objetMetiers;
      }

      public function addObjetMetier(ObjetMetier $objetMetier): self
      {
          if (!$this->objetMetiers->contains($objetMetier)) {
              $this->objetMetiers[] = $objetMetier;
              $objetMetier->addApplication($this);
          }

          return $this;
      }

      public function removeObjetMetier(ObjetMetier $objetMetier): self
      {
          if ($this->objetMetiers->contains($objetMetier)) {
              $this->objetMetiers->removeElement($objetMetier);
              $objetMetier->removeApplication($this);
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
              $action->addApplication($this);
          }

          return $this;
      }

      public function removeAction(Action $action): self
      {
          if ($this->actions->contains($action)) {
              $this->actions->removeElement($action);
              $action->removeApplication($this);
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
              $pcaEvenement->addApplication($this);
          }

          return $this;
      }

      public function removePcaEvenement(PcaEvenement $pcaEvenement): self
      {
          if ($this->pcaEvenements->contains($pcaEvenement)) {
              $this->pcaEvenements->removeElement($pcaEvenement);
              $pcaEvenement->removeApplication($this);
          }

          return $this;
      }

      /**
       * @return Collection|Anomalie[]
       */
      public function getAnomalies(): Collection
      {
          return $this->anomalies;
      }

      public function addAnomaly(Anomalie $anomaly): self
      {
          if (!$this->anomalies->contains($anomaly)) {
              $this->anomalies[] = $anomaly;
              $anomaly->addApplication($this);
          }

          return $this;
      }

      public function removeAnomaly(Anomalie $anomaly): self
      {
          if ($this->anomalies->contains($anomaly)) {
              $this->anomalies->removeElement($anomaly);
              $anomaly->removeApplication($this);
          }

          return $this;
      }

      /**
       * @return Collection|PcaEvenementAppTrack[]
       */
      public function getPcaEvenementAppTracks(): Collection
      {
          return $this->pcaEvenementAppTracks;
      }

      public function addPcaEvenementAppTrack(PcaEvenementAppTrack $pcaEvenementAppTrack): self
      {
          if (!$this->pcaEvenementAppTracks->contains($pcaEvenementAppTrack)) {
              $this->pcaEvenementAppTracks[] = $pcaEvenementAppTrack;
              $pcaEvenementAppTrack->setApplication($this);
          }

          return $this;
      }

      public function removePcaEvenementAppTrack(PcaEvenementAppTrack $pcaEvenementAppTrack): self
      {
          if ($this->pcaEvenementAppTracks->contains($pcaEvenementAppTrack)) {
              $this->pcaEvenementAppTracks->removeElement($pcaEvenementAppTrack);
              // set the owning side to null (unless already changed)
              if ($pcaEvenementAppTrack->getApplication() === $this) {
                  $pcaEvenementAppTrack->setApplication(null);
              }
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

      public function getStatutrun(): ?OnOff
      {
          return $this->statutrun;
      }

      public function setStatutrun(?OnOff $statutrun): self
      {
          $this->statutrun = $statutrun;

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

      /**
       * @return Collection|Evenement[]
       */
      public function getEvenementsapplications(): Collection
      {
          return $this->evenementsapplications;
      }

      public function addEvenementsapplication(Evenement $evenementsapplication): self
      {
          if (!$this->evenementsapplications->contains($evenementsapplication)) {
              $this->evenementsapplications[] = $evenementsapplication;
              $evenementsapplication->addApplication($this);
          }

          return $this;
      }

      public function removeEvenementsapplication(Evenement $evenementsapplication): self
      {
          if ($this->evenementsapplications->removeElement($evenementsapplication)) {
              $evenementsapplication->removeApplication($this);
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

      public function getRedacteur(): ?People
      {
          return $this->redacteur;
      }

      public function setRedacteur(?People $redacteur): self
      {
          $this->redacteur = $redacteur;

          return $this;
      }



      
}
