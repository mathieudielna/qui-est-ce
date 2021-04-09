<?php

namespace App\Entity;
use App\Entity\ObjetMetier;
use App\Entity\Flux;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\ChoiceList\Loader\ChoiceLoaderInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ActiviteRepository")
 * @UniqueEntity(fields="designation", message="Ce non est déjà utilisé")
 * @Vich\Uploadable
 */
class Activite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $designation;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="activites")
     */
    protected $responsable;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $equipe;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $periodepic;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $niveaureprise;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tier", inversedBy="activites", cascade={"persist"})
     */
    private $tiers;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ressource", inversedBy="activites", cascade={"persist"})
     */
    private $ressources;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Criticite", inversedBy="activites")
     */
    private $dima1;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Criticite", inversedBy="activitespdma")
     */
    private $pdma1;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OuiNon", inversedBy="activites")
     */
    private $pca;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="activitessuppleant")
     */
    private $suppleant;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Published_at;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $perteca;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $perteactivite;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NiveauImpact", inversedBy="activites")
     */
    private $impactimg;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $perturbationinterne;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $perturbationexterne;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $traitementarriere;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $alternativesecours;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $latencepca;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $traitementimmediat;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $conditionmaintien;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NiveauImpact", inversedBy="activitesimpactactionnaire")
     */
    private $impactactionnaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NiveauImpact", inversedBy="activitesimpactinterne")
     */
    private $ImpactInterne;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NiveauImpact", inversedBy="activitesbusinessfutur")
     */
    private $ActiviteBusinessfutur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NiveauImpact", inversedBy="Impact4h")
     */
    private $impact4h;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NiveauImpact", inversedBy="impact1j")
     */
    private $impact1j;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NiveauImpact", inversedBy="impact3j")
     */
    private $impact3j;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NiveauImpact", inversedBy="impact1s")
     */
    private $impact1s;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NiveauImpact", inversedBy="impact2s")
     */
    private $impact2s;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NiveauImpact", inversedBy="impact1m")
     */
    private $impact1m;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Processus", inversedBy="activites")
     */
    private $processus;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\People", inversedBy="activitespeople")
     */
    private $peoples;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OuiNon")
     */
    private $procedurepca;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer", inversedBy="activites")
     */
    private $customer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FluxConnectActivite", mappedBy="activite", orphanRemoval=true, cascade={"persist"})
     */
    private $fluxConnectActivites;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Activite")
     */
    private $previousactivites;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeActivite")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AppConnectActivite", mappedBy="activite", orphanRemoval=true, cascade={"persist"})
     */
    private $appConnectActivites;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NiveauImpact", inversedBy="activitesimpactcollaborateurs")
     */
    private $impactcollaborateur;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PcaEvenement", mappedBy="activites")
     */
    private $pcaEvenements;

    /**
     * @ORM\ManyToMany(targetEntity=Anomalie::class, mappedBy="activites")
     */
    private $anomalies;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $UpdatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $CreatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="publisheractivites")
     */
    private $publisher;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $ValidatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="activitesvalidator")
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
     * @ORM\ManyToMany(targetEntity=AspectEnv::class, mappedBy="activites")
     */
    private $aspectEnvs;

    /**
     * @ORM\ManyToMany(targetEntity=Evenement::class, mappedBy="activites")
     */
    private $evenements;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="activitesredacteur")
     */
    private $redacteur;

  

   
    public function __construct()
    {
      
        $this->tiers = new ArrayCollection();
        $this->ressources = new ArrayCollection();
        $this->peoples = new ArrayCollection();
        $this->fluxConnectActivites = new ArrayCollection();
        $this->previousactivites = new ArrayCollection();
        $this->appConnectActivites = new ArrayCollection();
        $this->pcaEvenements = new ArrayCollection();
        $this->anomalies = new ArrayCollection();
        $this->aspectEnvs = new ArrayCollection();
        $this->evenements = new ArrayCollection();


    }
	
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(?string $designation): self
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

    public function getResponsable(): ?People
    {
        return $this->responsable;
    }

    public function setResponsable(?People $responsable): self
    {
        $this->responsable = $responsable;

        return $this;
    }
    
    public function getEquipe(): ?string
    {
        return $this->equipe;
    }

    public function setEquipe(?string $equipe): self
    {
        $this->equipe = $equipe;

        return $this;
    }
    
    public function getPeriodepic(): ?string
    {
        return $this->periodepic;
    }

    public function setPeriodepic(?string $periodepic): self
    {
        $this->periodepic = $periodepic;

        return $this;
    }
    
    public function getNiveaureprise(): ?string
    {
        return $this->niveaureprise;
    }

    public function setNiveaureprise(?string $niveaureprise): self
    {
        $this->niveaureprise = $niveaureprise;

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
     
   
     public function getDima1(): ?Criticite
     {
         return $this->dima1;
     }

     public function setDima1(?Criticite $dima1): self
     {
         $this->dima1 = $dima1;

         return $this;
     }

     public function getPdma1(): ?Criticite
     {
         return $this->pdma1;
     }

     public function setPdma1(?Criticite $pdma1): self
     {
         $this->pdma1 = $pdma1;

         return $this;
     }

     public function getPca(): ?OuiNon
     {
         return $this->pca;
     }

     public function setPca(?OuiNon $pca): self
     {
         $this->pca = $pca;

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

     public function getCommentaire(): ?string
     {
         return $this->commentaire;
     }

     public function setCommentaire(?string $commentaire): self
     {
         $this->commentaire = $commentaire;

         return $this;
     }

     public function getPublishedAt(): ?\DateTimeInterface
     {
         return $this->Published_at;
     }

     public function setPublishedAt(\DateTimeInterface $Published_at): self
     {
         $this->Published_at = $Published_at;

         return $this;
     }

     public function getPerteca(): ?string
     {
         return $this->perteca;
     }

     public function setPerteca(?string $perteca): self
     {
         $this->perteca = $perteca;

         return $this;
     }

     public function getPerteactivite(): ?string
     {
         return $this->perteactivite;
     }

     public function setPerteactivite(?string $perteactivite): self
     {
         $this->perteactivite = $perteactivite;

         return $this;
     }

     public function getImpactimg(): ?NiveauImpact
     {
         return $this->impactimg;
     }

     public function setImpactimg(?NiveauImpact $impactimg): self
     {
         $this->impactimg = $impactimg;

         return $this;
     }

     public function getPerturbationinterne(): ?string
     {
         return $this->perturbationinterne;
     }

     public function setPerturbationinterne(string $perturbationinterne): self
     {
         $this->perturbationinterne = $perturbationinterne;

         return $this;
     }

     public function getPerturbationexterne(): ?string
     {
         return $this->perturbationexterne;
     }

     public function setPerturbationexterne(?string $perturbationexterne): self
     {
         $this->perturbationexterne = $perturbationexterne;

         return $this;
     }

     public function getTraitementarriere(): ?string
     {
         return $this->traitementarriere;
     }

     public function setTraitementarriere(?string $traitementarriere): self
     {
         $this->traitementarriere = $traitementarriere;

         return $this;
     }

     public function getAlternativesecours(): ?string
     {
         return $this->alternativesecours;
     }

     public function setAlternativesecours(?string $alternativesecours): self
     {
         $this->alternativesecours = $alternativesecours;

         return $this;
     }

     public function getLatencepca(): ?string
     {
         return $this->latencepca;
     }

     public function setLatencepca(?string $latencepca): self
     {
         $this->latencepca = $latencepca;

         return $this;
     }

     public function getTraitementimmediat(): ?string
     {
         return $this->traitementimmediat;
     }

     public function setTraitementimmediat(?string $traitementimmediat): self
     {
         $this->traitementimmediat = $traitementimmediat;

         return $this;
     }

     public function getConditionmaintien(): ?string
     {
         return $this->conditionmaintien;
     }

     public function setConditionmaintien(?string $conditionmaintien): self
     {
         $this->conditionmaintien = $conditionmaintien;

         return $this;
     }

     public function getImpactactionnaire(): ?NiveauImpact
     {
         return $this->impactactionnaire;
     }

     public function setImpactactionnaire(?NiveauImpact $impactactionnaire): self
     {
         $this->impactactionnaire = $impactactionnaire;

         return $this;
     }

     public function getImpactInterne(): ?NiveauImpact
     {
         return $this->ImpactInterne;
     }

     public function setImpactInterne(?NiveauImpact $ImpactInterne): self
     {
         $this->ImpactInterne = $ImpactInterne;

         return $this;
     }

     public function getActiviteBusinessfutur(): ?NiveauImpact
     {
         return $this->ActiviteBusinessfutur;
     }

     public function setActiviteBusinessfutur(?NiveauImpact $ActiviteBusinessfutur): self
     {
         $this->ActiviteBusinessfutur = $ActiviteBusinessfutur;

         return $this;
     }

     public function getImpact4h(): ?NiveauImpact
     {
         return $this->impact4h;
     }

     public function setImpact4h(?NiveauImpact $impact4h): self
     {
         $this->impact4h = $impact4h;

         return $this;
     }

     public function getImpact1j(): ?NiveauImpact
     {
         return $this->impact1j;
     }

     public function setImpact1j(?NiveauImpact $impact1j): self
     {
         $this->impact1j = $impact1j;

         return $this;
     }

     public function getImpact3j(): ?NiveauImpact
     {
         return $this->impact3j;
     }

     public function setImpact3j(?NiveauImpact $impact3j): self
     {
         $this->impact3j = $impact3j;

         return $this;
     }

     public function getImpact1s(): ?NiveauImpact
     {
         return $this->impact1s;
     }

     public function setImpact1s(?NiveauImpact $impact1s): self
     {
         $this->impact1s = $impact1s;

         return $this;
     }

     public function getImpact2s(): ?NiveauImpact
     {
         return $this->impact2s;
     }

     public function setImpact2s(?NiveauImpact $impact2s): self
     {
         $this->impact2s = $impact2s;

         return $this;
     }

     public function getImpact1m(): ?NiveauImpact
     {
         return $this->impact1m;
     }

     public function setImpact1m(?NiveauImpact $impact1m): self
     {
         $this->impact1m = $impact1m;

         return $this;
     }

     public function getFile(): ?string
     {
         return $this->file;
     }

     public function setFile(?string $file): self
     {
         $this->file = $file;

         return $this;
     }

     public function getMapsiCustomer(): ?MapsiCustomer
     {
         return $this->MapsiCustomer;
     }

     public function setMapsiCustomer(?MapsiCustomer $MapsiCustomer): self
     {
         $this->MapsiCustomer = $MapsiCustomer;

         return $this;
     }


     public function getProcessus(): ?Processus
     {
         return $this->processus;
     }

     public function setProcessus(?Processus $processus): self
     {
         $this->processus = $processus;

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

     public function getProcedurepca(): ?OuiNon
     {
         return $this->procedurepca;
     }

     public function setProcedurepca(?OuiNon $procedurepca): self
     {
         $this->procedurepca = $procedurepca;

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
      * @return Collection|FluxConnectActivite[]
      */
     public function getFluxConnectActivites(): Collection
     {
         return $this->fluxConnectActivites;
     }

     public function addFluxConnectActivite(FluxConnectActivite $fluxConnectActivite): self
     {
         if (!$this->fluxConnectActivites->contains($fluxConnectActivite)) {
             $this->fluxConnectActivites[] = $fluxConnectActivite;
             $fluxConnectActivite->setActivite($this);
         }

         return $this;
     }

     public function removeFluxConnectActivite(FluxConnectActivite $fluxConnectActivite): self
     {
         if ($this->fluxConnectActivites->contains($fluxConnectActivite)) {
             $this->fluxConnectActivites->removeElement($fluxConnectActivite);
             // set the owning side to null (unless already changed)
             if ($fluxConnectActivite->getActivite() === $this) {
                 $fluxConnectActivite->setActivite(null);
             }
         }

         return $this;
     }

     /**
      * @return Collection|self[]
      */
     public function getPreviousactivites(): Collection
     {
         return $this->previousactivites;
     }

     public function addPreviousactivite(self $previousactivite): self
     {
         if (!$this->previousactivites->contains($previousactivite)) {
             $this->previousactivites[] = $previousactivite;
         }

         return $this;
     }

     public function removePreviousactivite(self $previousactivite): self
     {
         if ($this->previousactivites->contains($previousactivite)) {
             $this->previousactivites->removeElement($previousactivite);
         }

         return $this;
     }

     public function getType(): ?TypeActivite
     {
         return $this->type;
     }

     public function setType(?TypeActivite $type): self
     {
         $this->type = $type;

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
             $appConnectActivite->setActivite($this);
         }

         return $this;
     }

     public function removeAppConnectActivite(AppConnectActivite $appConnectActivite): self
     {
         if ($this->appConnectActivites->contains($appConnectActivite)) {
             $this->appConnectActivites->removeElement($appConnectActivite);
             // set the owning side to null (unless already changed)
             if ($appConnectActivite->getActivite() === $this) {
                 $appConnectActivite->setActivite(null);
             }
         }

         return $this;
     }

     public function getImpactcollaborateur(): ?NiveauImpact
     {
         return $this->impactcollaborateur;
     }

     public function setImpactcollaborateur(?NiveauImpact $impactcollaborateur): self
     {
         $this->impactcollaborateur = $impactcollaborateur;

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
             $pcaEvenement->addActivite($this);
         }

         return $this;
     }

     public function removePcaEvenement(PcaEvenement $pcaEvenement): self
     {
         if ($this->pcaEvenements->contains($pcaEvenement)) {
             $this->pcaEvenements->removeElement($pcaEvenement);
             $pcaEvenement->removeActivite($this);
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
             $anomaly->addActivite($this);
         }

         return $this;
     }

     public function removeAnomaly(Anomalie $anomaly): self
     {
         if ($this->anomalies->contains($anomaly)) {
             $this->anomalies->removeElement($anomaly);
             $anomaly->removeActivite($this);
         }

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

     public function getCreatedAt(): ?\DateTimeInterface
     {
         return $this->CreatedAt;
     }

     public function setCreatedAt(?\DateTimeInterface $CreatedAt): self
     {
         $this->CreatedAt = $CreatedAt;

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
      * @return Collection|AspectEnv[]
      */
     public function getAspectEnvs(): Collection
     {
         return $this->aspectEnvs;
     }

     public function addAspectEnv(AspectEnv $aspectEnv): self
     {
         if (!$this->aspectEnvs->contains($aspectEnv)) {
             $this->aspectEnvs[] = $aspectEnv;
             $aspectEnv->addActivite($this);
         }

         return $this;
     }

     public function removeAspectEnv(AspectEnv $aspectEnv): self
     {
         if ($this->aspectEnvs->removeElement($aspectEnv)) {
             $aspectEnv->removeActivite($this);
         }

         return $this;
     }

     /**
      * @return Collection|Evenement[]
      */
     public function getEvenements(): Collection
     {
         return $this->evenements;
     }

     public function addEvenement(Evenement $evenement): self
     {
         if (!$this->evenements->contains($evenement)) {
             $this->evenements[] = $evenement;
             $evenement->addActivite($this);
         }

         return $this;
     }

     public function removeEvenement(Evenement $evenement): self
     {
         if ($this->evenements->removeElement($evenement)) {
             $evenement->removeActivite($this);
         }

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
