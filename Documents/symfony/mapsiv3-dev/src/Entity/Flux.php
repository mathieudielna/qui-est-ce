<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FluxRepository")
 */
class Flux
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $finalite;

    /**
     * @ORM\Column(type="datetime")
     */
    private $PublishedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="fluxsresponsable")
     */
    private $responsable;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeStatutrgpd", inversedBy="fluxes")
     */
    private $statutrgpd;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="fluxssuppleant")
     */
    private $suppleant;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Application", inversedBy="fluxes")
     */
    private $applications;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Metier", inversedBy="fluxes")
     */
    private $destin;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tier", inversedBy="fluxes")
     */
    private $destext;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TypeSupport", inversedBy="fluxs")
     */
    private $supports;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypePriorite", inversedBy="fluxes")
     */
    private $criticite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeDuree", inversedBy="fluxes")
     */
    private $dureeconservation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OuiNon", inversedBy="fluxtransferthorsue")
     */
    private $transferthorsue;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TypePeriodicite", inversedBy="fluxes")
     */
    private $periodicites;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TypeActeur", inversedBy="fluxes")
     */
    private $personneconcerne;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TypeDcpjuridique", inversedBy="fluxes")
     */
    private $dcpjuridique;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OuiNon", inversedBy="fluxaccordcollecte")
     */
    private $accordcollecte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OuiNon", inversedBy="fluxaccordutilisation")
     */
    private $accordutilisation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OuiNon", inversedBy="fluxdcpsstraitant")
     */
    private $dcpsstraitant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sstraitant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer", inversedBy="fluxes")
     */
    private $customer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FluxConnectActivite", mappedBy="flux", orphanRemoval=true, cascade={"persist"})
     */
    private $fluxConnectActivites;
	
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Metier", inversedBy="expinfluxes")
     * @ORM\JoinTable(name="fluxexpin",
	 *      joinColumns={@ORM\JoinColumn(name="flux_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@ORM\JoinColumn(name="metier_id", referencedColumnName="id")}
	 *      )
     */
    private $expin;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tier", inversedBy="expoutfluxes")
     * @ORM\JoinTable(name="fluxexpout",
	 *      joinColumns={@ORM\JoinColumn(name="flux_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@ORM\JoinColumn(name="tier_id", referencedColumnName="id")}
	 *      )
     */
    private $expout;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ObjetMetier", inversedBy="fluxes")
     */
    private $objetmetiers;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Action", mappedBy="fluxes")
     */
    private $actions;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OuiNon", inversedBy="dpiafluxes")
     */
    private $dpia;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TypeDcpsensible", inversedBy="fluxes")
     */
    private $dcpsensible;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TypeDcpsecu", inversedBy="fluxes")
     */
    private $dcpsecu;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $rgpdregistre;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\RgpdViolation", mappedBy="traitement")
     */
    private $rgpdViolations;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\RgpdAccess", mappedBy="traitement")
     */
    private $rgpdAccesses;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\RgpdAudit", mappedBy="traitement")
     */
    private $rgpdAudits;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TypeTraitementrgpd", inversedBy="fluxes")
     */
    private $typetraitementrgpds;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="fluxes")
     */
    private $publisher;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $CreatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=People::class, inversedBy="peoplesfluxes")
     */
    private $peoples;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $ValidatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="fluxesvalidator")
     */
    private $validator;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $validationstatut;

    /**
     * @ORM\ManyToMany(targetEntity=Risque::class, inversedBy="fluxes")
     */
    private $risques;

    /**
     * @ORM\ManyToMany(targetEntity=Audit::class, mappedBy="traitements")
     */
    private $auditsflux;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Gedmo\Slug(fields={"designation"})
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity=Dysfonctionnement::class, mappedBy="traitements")
     */
    private $dysfonctionnementsfluxes;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="fluxesredacteur")
     */
    private $redacteur;

    /**
     * @ORM\ManyToMany(targetEntity=Evenement::class, mappedBy="fluxes")
     */
    private $evenementsfluxes;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $UpdatedAt;

 

  

    public function __construct()
    {
       
        $this->applications = new ArrayCollection();
        $this->destin = new ArrayCollection();
        $this->destext = new ArrayCollection();
        $this->supports = new ArrayCollection();
        $this->periodicites = new ArrayCollection();
        $this->personneconcerne = new ArrayCollection();
        $this->dcpjuridique = new ArrayCollection();
        $this->fluxConnectActivites = new ArrayCollection();
        $this->expin = new ArrayCollection();
        $this->expout = new ArrayCollection();
        $this->objetmetiers = new ArrayCollection();
        $this->actions = new ArrayCollection();
        $this->dcpsensible = new ArrayCollection();
        $this->dcpsecu = new ArrayCollection();
        $this->rgpdViolations = new ArrayCollection();
        $this->rgpdAccesses = new ArrayCollection();
        $this->rgpdAudits = new ArrayCollection();
        $this->typetraitementrgpds = new ArrayCollection();
        $this->peoples = new ArrayCollection();
        $this->risques = new ArrayCollection();
        $this->auditsflux = new ArrayCollection();
        $this->dysfonctionnementsfluxes = new ArrayCollection();
        $this->evenementsfluxes = new ArrayCollection();


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

    public function getFinalite(): ?string
    {
        return $this->finalite;
    }

    public function setFinalite(?string $finalite): self
    {
        $this->finalite = $finalite;

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

    public function getResponsable(): ?People
    {
        return $this->responsable;
    }

    public function setResponsable(?People $responsable): self
    {
        $this->responsable = $responsable;

        return $this;
    }

    public function getStatutrgpd(): ?TypeStatutrgpd
    {
        return $this->statutrgpd;
    }

    public function setStatutrgpd(?TypeStatutrgpd $statutrgpd): self
    {
        $this->statutrgpd = $statutrgpd;

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
     * @return Collection|Metier[]
     */
    public function getDestin(): Collection
    {
        return $this->destin;
    }

    public function addDestin(Metier $destin): self
    {
        if (!$this->destin->contains($destin)) {
            $this->destin[] = $destin;
        }

        return $this;
    }

    public function removeDestin(Metier $destin): self
    {
        if ($this->destin->contains($destin)) {
            $this->destin->removeElement($destin);
        }

        return $this;
    }

    /**
     * @return Collection|Tier[]
     */
    public function getDestext(): Collection
    {
        return $this->destext;
    }

    public function addDestext(Tier $destext): self
    {
        if (!$this->destext->contains($destext)) {
            $this->destext[] = $destext;
        }

        return $this;
    }

    public function removeDestext(Tier $destext): self
    {
        if ($this->destext->contains($destext)) {
            $this->destext->removeElement($destext);
        }

        return $this;
    }

    /**
     * @return Collection|TypeSupport[]
     */
    public function getSupports(): Collection
    {
        return $this->supports;
    }

    public function addSupport(TypeSupport $support): self
    {
        if (!$this->supports->contains($support)) {
            $this->supports[] = $support;
        }

        return $this;
    }

    public function removeSupport(TypeSupport $support): self
    {
        if ($this->supports->contains($support)) {
            $this->supports->removeElement($support);
        }

        return $this;
    }

    public function getCriticite(): ?TypePriorite
    {
        return $this->criticite;
    }

    public function setCriticite(?TypePriorite $criticite): self
    {
        $this->criticite = $criticite;

        return $this;
    }

    public function getDcp(): ?OuiNon
    {
        return $this->dcp;
    }

    public function setDcp(?OuiNon $dcp): self
    {
        $this->dcp = $dcp;

        return $this;
    }


    public function getDureeconservation(): ?TypeDuree
    {
        return $this->dureeconservation;
    }

    public function setDureeconservation(?TypeDuree $dureeconservation): self
    {
        $this->dureeconservation = $dureeconservation;

        return $this;
    }

    public function getTransferthorsue(): ?OuiNon
    {
        return $this->transferthorsue;
    }

    public function setTransferthorsue(?OuiNon $transferthorsue): self
    {
        $this->transferthorsue = $transferthorsue;

        return $this;
    }

    /**
     * @return Collection|TypePeriodicite[]
     */
    public function getPeriodicites(): Collection
    {
        return $this->periodicites;
    }

    public function addPeriodicite(TypePeriodicite $periodicite): self
    {
        if (!$this->periodicites->contains($periodicite)) {
            $this->periodicites[] = $periodicite;
        }

        return $this;
    }

    public function removePeriodicite(TypePeriodicite $periodicite): self
    {
        if ($this->periodicites->contains($periodicite)) {
            $this->periodicites->removeElement($periodicite);
        }

        return $this;
    }

    /**
     * @return Collection|TypeActeur[]
     */
    public function getPersonneconcerne(): Collection
    {
        return $this->personneconcerne;
    }

    public function addPersonneconcerne(TypeActeur $personneconcerne): self
    {
        if (!$this->personneconcerne->contains($personneconcerne)) {
            $this->personneconcerne[] = $personneconcerne;
        }

        return $this;
    }

    public function removePersonneconcerne(TypeActeur $personneconcerne): self
    {
        if ($this->personneconcerne->contains($personneconcerne)) {
            $this->personneconcerne->removeElement($personneconcerne);
        }

        return $this;
    }

    /**
     * @return Collection|TypeDcpjuridique[]
     */
    public function getDcpjuridique(): Collection
    {
        return $this->dcpjuridique;
    }

    public function addDcpjuridique(TypeDcpjuridique $dcpjuridique): self
    {
        if (!$this->dcpjuridique->contains($dcpjuridique)) {
            $this->dcpjuridique[] = $dcpjuridique;
        }

        return $this;
    }

    public function removeDcpjuridique(TypeDcpjuridique $dcpjuridique): self
    {
        if ($this->dcpjuridique->contains($dcpjuridique)) {
            $this->dcpjuridique->removeElement($dcpjuridique);
        }

        return $this;
    }

    public function getAccordcollecte(): ?OuiNon
    {
        return $this->accordcollecte;
    }

    public function setAccordcollecte(?OuiNon $accordcollecte): self
    {
        $this->accordcollecte = $accordcollecte;

        return $this;
    }

    public function getAccordutilisation(): ?OuiNon
    {
        return $this->accordutilisation;
    }

    public function setAccordutilisation(?OuiNon $accordutilisation): self
    {
        $this->accordutilisation = $accordutilisation;

        return $this;
    }

    public function getDcpsstraitant(): ?OuiNon
    {
        return $this->dcpsstraitant;
    }

    public function setDcpsstraitant(?OuiNon $dcpsstraitant): self
    {
        $this->dcpsstraitant = $dcpsstraitant;

        return $this;
    }

    public function getSstraitant(): ?string
    {
        return $this->sstraitant;
    }

    public function setSstraitant(?string $sstraitant): self
    {
        $this->sstraitant = $sstraitant;

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
            $fluxConnectActivite->setFlux($this);
        }

        return $this;
    }

    public function removeFluxConnectActivite(FluxConnectActivite $fluxConnectActivite): self
    {
        if ($this->fluxConnectActivites->contains($fluxConnectActivite)) {
            $this->fluxConnectActivites->removeElement($fluxConnectActivite);
            // set the owning side to null (unless already changed)
            if ($fluxConnectActivite->getFlux() === $this) {
                $fluxConnectActivite->setFlux(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Metier[]
     */
    public function getExpin(): Collection
    {
        return $this->expin;
    }

    public function addExpin(Metier $expin): self
    {
        if (!$this->expin->contains($expin)) {
            $this->expin[] = $expin;
        }

        return $this;
    }

    public function removeExpin(Metier $expin): self
    {
        if ($this->expin->contains($expin)) {
            $this->expin->removeElement($expin);
        }

        return $this;
    }

    /**
     * @return Collection|Tier[]
     */
    public function getExpout(): Collection
    {
        return $this->expout;
    }

    public function addExpout(Tier $expout): self
    {
        if (!$this->expout->contains($expout)) {
            $this->expout[] = $expout;
        }

        return $this;
    }

    public function removeExpout(Tier $expout): self
    {
        if ($this->expout->contains($expout)) {
            $this->expout->removeElement($expout);
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

    public function getTransfertue(): ?OuiNon
    {
        return $this->transfertue;
    }

    /**
     * @return Collection|ObjetMetier[]
     */
    public function getObjetmetiers(): Collection
    {
        return $this->objetmetiers;
    }

    public function addObjetmetier(ObjetMetier $objetmetier): self
    {
        if (!$this->objetmetiers->contains($objetmetier)) {
            $this->objetmetiers[] = $objetmetier;
        }

        return $this;
    }

    public function removeObjetmetier(ObjetMetier $objetmetier): self
    {
        if ($this->objetmetiers->contains($objetmetier)) {
            $this->objetmetiers->removeElement($objetmetier);
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
            $action->addFlux($this);
        }

        return $this;
    }

    public function removeAction(Action $action): self
    {
        if ($this->actions->contains($action)) {
            $this->actions->removeElement($action);
            $action->removeFlux($this);
        }

        return $this;
    }

    public function getDpia(): ?OuiNon
    {
        return $this->dpia;
    }

    public function setDpia(?OuiNon $dpia): self
    {
        $this->dpia = $dpia;

        return $this;
    }

    /**
     * @return Collection|TypeDcpsensible[]
     */
    public function getDcpsensible(): Collection
    {
        return $this->dcpsensible;
    }

    public function addDcpsensible(TypeDcpsensible $dcpsensible): self
    {
        if (!$this->dcpsensible->contains($dcpsensible)) {
            $this->dcpsensible[] = $dcpsensible;
        }

        return $this;
    }

    public function removeDcpsensible(TypeDcpsensible $dcpsensible): self
    {
        if ($this->dcpsensible->contains($dcpsensible)) {
            $this->dcpsensible->removeElement($dcpsensible);
        }

        return $this;
    }

    /**
     * @return Collection|TypeDcpsecu[]
     */
    public function getDcpsecu(): Collection
    {
        return $this->dcpsecu;
    }

    public function addDcpsecu(TypeDcpsecu $dcpsecu): self
    {
        if (!$this->dcpsecu->contains($dcpsecu)) {
            $this->dcpsecu[] = $dcpsecu;
        }

        return $this;
    }

    public function removeDcpsecu(TypeDcpsecu $dcpsecu): self
    {
        if ($this->dcpsecu->contains($dcpsecu)) {
            $this->dcpsecu->removeElement($dcpsecu);
        }

        return $this;
    }

    public function getRgpdregistre()
    {
        return $this->rgpdregistre;
    }

    public function setRgpdregistre($rgpdregistre): self
    {
        $this->rgpdregistre = $rgpdregistre;

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
            $rgpdViolation->addTraitement($this);
        }

        return $this;
    }

    public function removeRgpdViolation(RgpdViolation $rgpdViolation): self
    {
        if ($this->rgpdViolations->contains($rgpdViolation)) {
            $this->rgpdViolations->removeElement($rgpdViolation);
            $rgpdViolation->removeTraitement($this);
        }

        return $this;
    }

    /**
     * @return Collection|RgpdAccess[]
     */
    public function getRgpdAccesses(): Collection
    {
        return $this->rgpdAccesses;
    }

    public function addRgpdAccess(RgpdAccess $rgpdAccess): self
    {
        if (!$this->rgpdAccesses->contains($rgpdAccess)) {
            $this->rgpdAccesses[] = $rgpdAccess;
            $rgpdAccess->addTraitement($this);
        }

        return $this;
    }

    public function removeRgpdAccess(RgpdAccess $rgpdAccess): self
    {
        if ($this->rgpdAccesses->contains($rgpdAccess)) {
            $this->rgpdAccesses->removeElement($rgpdAccess);
            $rgpdAccess->removeTraitement($this);
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
            $rgpdAudit->addTraitement($this);
        }

        return $this;
    }

    public function removeRgpdAudit(RgpdAudit $rgpdAudit): self
    {
        if ($this->rgpdAudits->contains($rgpdAudit)) {
            $this->rgpdAudits->removeElement($rgpdAudit);
            $rgpdAudit->removeTraitement($this);
        }

        return $this;
    }

    /**
     * @return Collection|TypeTraitementrgpd[]
     */
    public function getTypetraitementrgpds(): Collection
    {
        return $this->typetraitementrgpds;
    }

    public function addTypetraitementrgpd(TypeTraitementrgpd $typetraitementrgpd): self
    {
        if (!$this->typetraitementrgpds->contains($typetraitementrgpd)) {
            $this->typetraitementrgpds[] = $typetraitementrgpd;
        }

        return $this;
    }

    public function removeTypetraitementrgpd(TypeTraitementrgpd $typetraitementrgpd): self
    {
        if ($this->typetraitementrgpds->contains($typetraitementrgpd)) {
            $this->typetraitementrgpds->removeElement($typetraitementrgpd);
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(?\DateTimeInterface $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

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
     * @return Collection|Audit[]
     */
    public function getAuditsflux(): Collection
    {
        return $this->auditsflux;
    }

    public function addAuditsflux(Audit $auditsflux): self
    {
        if (!$this->auditsflux->contains($auditsflux)) {
            $this->auditsflux[] = $auditsflux;
            $auditsflux->addTraitement($this);
        }

        return $this;
    }

    public function removeAuditsflux(Audit $auditsflux): self
    {
        if ($this->auditsflux->removeElement($auditsflux)) {
            $auditsflux->removeTraitement($this);
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
    public function getDysfonctionnementsfluxes(): Collection
    {
        return $this->dysfonctionnementsfluxes;
    }

    public function addDysfonctionnementsflux(Dysfonctionnement $dysfonctionnementsflux): self
    {
        if (!$this->dysfonctionnementsfluxes->contains($dysfonctionnementsflux)) {
            $this->dysfonctionnementsfluxes[] = $dysfonctionnementsflux;
            $dysfonctionnementsflux->addTraitement($this);
        }

        return $this;
    }

    public function removeDysfonctionnementsflux(Dysfonctionnement $dysfonctionnementsflux): self
    {
        if ($this->dysfonctionnementsfluxes->removeElement($dysfonctionnementsflux)) {
            $dysfonctionnementsflux->removeTraitement($this);
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

    /**
     * @return Collection|Evenement[]
     */
    public function getEvenementsfluxes(): Collection
    {
        return $this->evenementsfluxes;
    }

    public function addEvenementsflux(Evenement $evenementsflux): self
    {
        if (!$this->evenementsfluxes->contains($evenementsflux)) {
            $this->evenementsfluxes[] = $evenementsflux;
            $evenementsflux->addFlux($this);
        }

        return $this;
    }

    public function removeEvenementsflux(Evenement $evenementsflux): self
    {
        if ($this->evenementsfluxes->removeElement($evenementsflux)) {
            $evenementsflux->removeFlux($this);
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

   
}
