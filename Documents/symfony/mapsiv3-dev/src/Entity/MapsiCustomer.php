<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass="App\Repository\MapsiCustomerRepository")
 * @Vich\Uploadable
 */
class MapsiCustomer implements \Serializable
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $www;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Messagestart;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="customer")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Activite", mappedBy="customer")
     */
    private $activites;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Processus", mappedBy="customer")
     */
    private $processuses;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Metier", mappedBy="customer")
     */
    private $metiers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flux", mappedBy="customer")
     */
    private $fluxes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Site", mappedBy="customer")
     */
    private $sites;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ObjetMetier", mappedBy="customer")
     */
    private $objetMetiers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Systeme", mappedBy="customer")
     */
    private $systemes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Application", mappedBy="customer")
     */
    private $applications;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Risque", mappedBy="customer")
     */
    private $risques;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Action", mappedBy="customer")
     */
    private $actions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\People", mappedBy="customer")
     */
    private $people;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ressource", mappedBy="customer")
     */
    private $ressources;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tier", mappedBy="customer")
     */
    private $tiers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TypeSite", mappedBy="customer")
     */
    private $typeSites;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TypeProcessus", mappedBy="customer")
     */
    private $typeProcessuses;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Projet", mappedBy="customer")
     */
    private $projets;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TypeOm", mappedBy="customer")
     */
    private $typeOms;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TypeTier", mappedBy="customer")
     */
    private $typeTiers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TypePhase", mappedBy="customer")
     */
    private $typePhases;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\JalonConnectAction", mappedBy="mcustomer")
     */
    private $jalonConnectActions;
    
	/**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="mapsicustomer_image", fileNameProperty="image.name", size="image.size", mimeType="image.mimeType", originalName="image.originalName", dimensions="image.dimensions")
     * 
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     * @var EmbeddedFile
     */
    private $image;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Program", mappedBy="customer")
     */
    private $programs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TypeRag", mappedBy="customer")
     */
    private $typeRags;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TypeDcpsensible", mappedBy="customer")
     */
    private $typeDcpsensibles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TypeDcpsecu", mappedBy="customer")
     */
    private $typeDcpsecus;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RgpdAccess", mappedBy="customer")
     */
    private $rgpdAccesses;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RgpdViolation", mappedBy="customer")
     */
    private $rgpdViolations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RgpdAudit", mappedBy="customer")
     */
    private $rgpdAudits;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Data", mappedBy="customer")
     */
    private $data;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TypePrevention", mappedBy="customer")
     */
    private $typePreventions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TypeTraitementrgpd", mappedBy="customer")
     */
    private $typeTraitementrgpds;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PcaEvenement", mappedBy="customer")
     */
    private $pcaEvenements;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TypePcaEvenement", mappedBy="customer")
     */
    private $typePcaEvenements;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Log", mappedBy="customer")
     */
    private $logs;

    /**
     * @ORM\OneToMany(targetEntity=Anomalie::class, mappedBy="customer")
     */
    private $anomalies;

    /**
     * @ORM\OneToMany(targetEntity=Controle::class, mappedBy="customer")
     */
    private $controles;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="mapsiCustomersDPO")
     */
    private $dpo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codepostal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @ORM\OneToMany(targetEntity=TypeStatutPca::class, mappedBy="customer")
     */
    private $typeStatutPcas;

    /**
     * @ORM\OneToMany(targetEntity=TypeScore::class, mappedBy="customer")
     */
    private $typeScores;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="mapsiCustomerRSE")
     */
    private $rse;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="mapsiCustomerResponsable")
     */
    private $responsable;

    /**
     * @ORM\OneToMany(targetEntity=Policy::class, mappedBy="customer")
     */
    private $policies;

    /**
     * @ORM\OneToMany(targetEntity=TypeStatutRisque::class, mappedBy="customer")
     */
    private $typeStatutRisques;

    /**
     * @ORM\OneToMany(targetEntity=Objectif::class, mappedBy="customer")
     */
    private $objectifs;

    /**
     * @ORM\OneToMany(targetEntity=PcaEvenementChronoPrepa::class, mappedBy="customer")
     */
    private $pcaEvenementChronoPrepas;

    /**
     * @ORM\OneToMany(targetEntity=Audit::class, mappedBy="customer")
     */
    private $auditscustomer;

    /**
     * @ORM\OneToMany(targetEntity=NonConformite::class, mappedBy="customer")
     */
    private $nonConformites;

    /**
     * @ORM\OneToMany(targetEntity=Dysfonctionnement::class, mappedBy="customer")
     */
    private $dysfonctionnements;

    /**
     * @ORM\OneToMany(targetEntity=AspectEnv::class, mappedBy="customer")
     */
    private $aspectEnvs;

    /**
     * @ORM\OneToMany(targetEntity=Impact::class, mappedBy="customer")
     */
    private $impacts;

    /**
     * @ORM\OneToMany(targetEntity=VisiteSite::class, mappedBy="customer")
     */
    private $visiteSites;

    /**
     * @ORM\OneToMany(targetEntity=Reclamation::class, mappedBy="customer")
     */
    private $reclamations;

    /**
     * @ORM\OneToMany(targetEntity=TypeReclamation::class, mappedBy="customer")
     */
    private $typeReclamations;

    /**
     * @ORM\OneToMany(targetEntity=Evenement::class, mappedBy="customer")
     */
    private $evenements;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sigle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siren;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siret;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nafape;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tva;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $creationAt;
   


    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->activites = new ArrayCollection();
        $this->processuses = new ArrayCollection();
        $this->metiers = new ArrayCollection();
        $this->fluxes = new ArrayCollection();
        $this->sites = new ArrayCollection();
        $this->objetMetiers = new ArrayCollection();
        $this->systemes = new ArrayCollection();
        $this->applications = new ArrayCollection();
        $this->risques = new ArrayCollection();
        $this->actions = new ArrayCollection();
        $this->people = new ArrayCollection();
        $this->ressources = new ArrayCollection();
        $this->tiers = new ArrayCollection();
        $this->typeSites = new ArrayCollection();
        $this->typeProcessuses = new ArrayCollection();
        $this->projets = new ArrayCollection();
        $this->typeOms = new ArrayCollection();
        $this->typeTiers = new ArrayCollection();
        $this->typePhases = new ArrayCollection();
        $this->jalonConnectActions = new ArrayCollection();
        $this->image = new EmbeddedFile();
        $this->programs = new ArrayCollection();
        $this->typeRags = new ArrayCollection();
        $this->typeDcpsensibles = new ArrayCollection();
        $this->typeDcpsecus = new ArrayCollection();
        $this->rgpdAccesses = new ArrayCollection();
        $this->rgpdViolations = new ArrayCollection();
        $this->rgpdAudits = new ArrayCollection();
        $this->data = new ArrayCollection();
        $this->typePreventions = new ArrayCollection();
        $this->typeTraitementrgpds = new ArrayCollection();
        $this->pcaEvenements = new ArrayCollection();
        $this->typePcaEvenements = new ArrayCollection();
        $this->logs = new ArrayCollection();
        $this->anomalies = new ArrayCollection();
        $this->controles = new ArrayCollection();
        $this->typeStatutPcas = new ArrayCollection();
        $this->typeScores = new ArrayCollection();
        $this->policies = new ArrayCollection();
        $this->typeStatutRisques = new ArrayCollection();
        $this->objectifs = new ArrayCollection();
        $this->pcaEvenementChronoPrepas = new ArrayCollection();
        $this->auditscustomer = new ArrayCollection();
        $this->nonConformites = new ArrayCollection();
        $this->dysfonctionnements = new ArrayCollection();
        $this->aspectEnvs = new ArrayCollection();
        $this->impacts = new ArrayCollection();
        $this->visiteSites = new ArrayCollection();
        $this->reclamations = new ArrayCollection();
        $this->typeReclamations = new ArrayCollection();
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

    public function getWww(): ?string
    {
        return $this->www;
    }

    public function setWww(?string $www): self
    {
        $this->www = $www;

        return $this;
    }

    public function getMessagestart(): ?string
    {
        return $this->Messagestart;
    }

    public function setMessagestart(?string $Messagestart): self
    {
        $this->Messagestart = $Messagestart;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCustomer($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getCustomer() === $this) {
                $user->setCustomer(null);
            }
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
            $activite->setCustomer($this);
        }

        return $this;
    }

    public function removeActivite(Activite $activite): self
    {
        if ($this->activites->contains($activite)) {
            $this->activites->removeElement($activite);
            // set the owning side to null (unless already changed)
            if ($activite->getCustomer() === $this) {
                $activite->setCustomer(null);
            }
        }

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
            $processus->setCustomer($this);
        }

        return $this;
    }

    public function removeProcessus(Processus $processus): self
    {
        if ($this->processuses->contains($processus)) {
            $this->processuses->removeElement($processus);
            // set the owning side to null (unless already changed)
            if ($processus->getCustomer() === $this) {
                $processus->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Metier[]
     */
    public function getMetiers(): Collection
    {
        return $this->metiers;
    }

    public function addMetier(Metier $metier): self
    {
        if (!$this->metiers->contains($metier)) {
            $this->metiers[] = $metier;
            $metier->setCustomer($this);
        }

        return $this;
    }

    public function removeMetier(Metier $metier): self
    {
        if ($this->metiers->contains($metier)) {
            $this->metiers->removeElement($metier);
            // set the owning side to null (unless already changed)
            if ($metier->getCustomer() === $this) {
                $metier->setCustomer(null);
            }
        }

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
            $flux->setCustomer($this);
        }

        return $this;
    }

    public function removeFlux(Flux $flux): self
    {
        if ($this->fluxes->contains($flux)) {
            $this->fluxes->removeElement($flux);
            // set the owning side to null (unless already changed)
            if ($flux->getCustomer() === $this) {
                $flux->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Site[]
     */
    public function getSites(): Collection
    {
        return $this->sites;
    }

    public function addSite(Site $site): self
    {
        if (!$this->sites->contains($site)) {
            $this->sites[] = $site;
            $site->setCustomer($this);
        }

        return $this;
    }

    public function removeSite(Site $site): self
    {
        if ($this->sites->contains($site)) {
            $this->sites->removeElement($site);
            // set the owning side to null (unless already changed)
            if ($site->getCustomer() === $this) {
                $site->setCustomer(null);
            }
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
            $objetMetier->setCustomer($this);
        }

        return $this;
    }

    public function removeObjetMetier(ObjetMetier $objetMetier): self
    {
        if ($this->objetMetiers->contains($objetMetier)) {
            $this->objetMetiers->removeElement($objetMetier);
            // set the owning side to null (unless already changed)
            if ($objetMetier->getCustomer() === $this) {
                $objetMetier->setCustomer(null);
            }
        }

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
            $systeme->setCustomer($this);
        }

        return $this;
    }

    public function removeSysteme(Systeme $systeme): self
    {
        if ($this->systemes->contains($systeme)) {
            $this->systemes->removeElement($systeme);
            // set the owning side to null (unless already changed)
            if ($systeme->getCustomer() === $this) {
                $systeme->setCustomer(null);
            }
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
            $application->setCustomer($this);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->applications->contains($application)) {
            $this->applications->removeElement($application);
            // set the owning side to null (unless already changed)
            if ($application->getCustomer() === $this) {
                $application->setCustomer(null);
            }
        }

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
            $risque->setCustomer($this);
        }

        return $this;
    }

    public function removeRisque(Risque $risque): self
    {
        if ($this->risques->contains($risque)) {
            $this->risques->removeElement($risque);
            // set the owning side to null (unless already changed)
            if ($risque->getCustomer() === $this) {
                $risque->setCustomer(null);
            }
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
            $action->setCustomer($this);
        }

        return $this;
    }

    public function removeAction(Action $action): self
    {
        if ($this->actions->contains($action)) {
            $this->actions->removeElement($action);
            // set the owning side to null (unless already changed)
            if ($action->getCustomer() === $this) {
                $action->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|People[]
     */
    public function getPeople(): Collection
    {
        return $this->people;
    }

    public function addPerson(People $person): self
    {
        if (!$this->people->contains($person)) {
            $this->people[] = $person;
            $person->setCustomer($this);
        }

        return $this;
    }

    public function removePerson(People $person): self
    {
        if ($this->people->contains($person)) {
            $this->people->removeElement($person);
            // set the owning side to null (unless already changed)
            if ($person->getCustomer() === $this) {
                $person->setCustomer(null);
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
            $ressource->setCustomer($this);
        }

        return $this;
    }

    public function removeRessource(Ressource $ressource): self
    {
        if ($this->ressources->contains($ressource)) {
            $this->ressources->removeElement($ressource);
            // set the owning side to null (unless already changed)
            if ($ressource->getCustomer() === $this) {
                $ressource->setCustomer(null);
            }
        }

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
            $tier->setCustomer($this);
        }

        return $this;
    }

    public function removeTier(Tier $tier): self
    {
        if ($this->tiers->contains($tier)) {
            $this->tiers->removeElement($tier);
            // set the owning side to null (unless already changed)
            if ($tier->getCustomer() === $this) {
                $tier->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TypeSite[]
     */
    public function getTypeSites(): Collection
    {
        return $this->typeSites;
    }

    public function addTypeSite(TypeSite $typeSite): self
    {
        if (!$this->typeSites->contains($typeSite)) {
            $this->typeSites[] = $typeSite;
            $typeSite->setCustomer($this);
        }

        return $this;
    }

    public function removeTypeSite(TypeSite $typeSite): self
    {
        if ($this->typeSites->contains($typeSite)) {
            $this->typeSites->removeElement($typeSite);
            // set the owning side to null (unless already changed)
            if ($typeSite->getCustomer() === $this) {
                $typeSite->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TypeProcessus[]
     */
    public function getTypeProcessuses(): Collection
    {
        return $this->typeProcessuses;
    }

    public function addTypeProcessus(TypeProcessus $typeProcessus): self
    {
        if (!$this->typeProcessuses->contains($typeProcessus)) {
            $this->typeProcessuses[] = $typeProcessus;
            $typeProcessus->setCustomer($this);
        }

        return $this;
    }

    public function removeTypeProcessus(TypeProcessus $typeProcessus): self
    {
        if ($this->typeProcessuses->contains($typeProcessus)) {
            $this->typeProcessuses->removeElement($typeProcessus);
            // set the owning side to null (unless already changed)
            if ($typeProcessus->getCustomer() === $this) {
                $typeProcessus->setCustomer(null);
            }
        }

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
            $projet->setCustomer($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): self
    {
        if ($this->projets->contains($projet)) {
            $this->projets->removeElement($projet);
            // set the owning side to null (unless already changed)
            if ($projet->getCustomer() === $this) {
                $projet->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TypeOm[]
     */
    public function getTypeOms(): Collection
    {
        return $this->typeOms;
    }

    public function addTypeOm(TypeOm $typeOm): self
    {
        if (!$this->typeOms->contains($typeOm)) {
            $this->typeOms[] = $typeOm;
            $typeOm->setCustomer($this);
        }

        return $this;
    }

    public function removeTypeOm(TypeOm $typeOm): self
    {
        if ($this->typeOms->contains($typeOm)) {
            $this->typeOms->removeElement($typeOm);
            // set the owning side to null (unless already changed)
            if ($typeOm->getCustomer() === $this) {
                $typeOm->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TypeTier[]
     */
    public function getTypeTiers(): Collection
    {
        return $this->typeTiers;
    }

    public function addTypeTier(TypeTier $typeTier): self
    {
        if (!$this->typeTiers->contains($typeTier)) {
            $this->typeTiers[] = $typeTier;
            $typeTier->setCustomer($this);
        }

        return $this;
    }

    public function removeTypeTier(TypeTier $typeTier): self
    {
        if ($this->typeTiers->contains($typeTier)) {
            $this->typeTiers->removeElement($typeTier);
            // set the owning side to null (unless already changed)
            if ($typeTier->getCustomer() === $this) {
                $typeTier->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TypePhase[]
     */
    public function getTypePhases(): Collection
    {
        return $this->typePhases;
    }

    public function addTypePhase(TypePhase $typePhase): self
    {
        if (!$this->typePhases->contains($typePhase)) {
            $this->typePhases[] = $typePhase;
            $typePhase->setCustomer($this);
        }

        return $this;
    }

    public function removeTypePhase(TypePhase $typePhase): self
    {
        if ($this->typePhases->contains($typePhase)) {
            $this->typePhases->removeElement($typePhase);
            // set the owning side to null (unless already changed)
            if ($typePhase->getCustomer() === $this) {
                $typePhase->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|JalonConnectAction[]
     */
    public function getJalonConnectActions(): Collection
    {
        return $this->jalonConnectActions;
    }

    public function addJalonConnectAction(JalonConnectAction $jalonConnectAction): self
    {
        if (!$this->jalonConnectActions->contains($jalonConnectAction)) {
            $this->jalonConnectActions[] = $jalonConnectAction;
            $jalonConnectAction->setMcustomer($this);
        }

        return $this;
    }

    public function removeJalonConnectAction(JalonConnectAction $jalonConnectAction): self
    {
        if ($this->jalonConnectActions->contains($jalonConnectAction)) {
            $this->jalonConnectActions->removeElement($jalonConnectAction);
            // set the owning side to null (unless already changed)
            if ($jalonConnectAction->getMcustomer() === $this) {
                $jalonConnectAction->setMcustomer(null);
            }
        }

        return $this;
    }
    
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|UploadedFile $imageFile
     */
    public function setImageFile(?File $imageFile = null)
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImage(EmbeddedFile $image)
    {
        $this->image = $image;
    }

    public function getImage(): ?EmbeddedFile
    {
        return $this->image;
    }
    
     /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->image,

        ));
    }
    
    
        /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,

        ) = unserialize($serialized);
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return Collection|Program[]
     */
    public function getPrograms(): Collection
    {
        return $this->programs;
    }

    public function addProgram(Program $program): self
    {
        if (!$this->programs->contains($program)) {
            $this->programs[] = $program;
            $program->setCustomer($this);
        }

        return $this;
    }

    public function removeProgram(Program $program): self
    {
        if ($this->programs->contains($program)) {
            $this->programs->removeElement($program);
            // set the owning side to null (unless already changed)
            if ($program->getCustomer() === $this) {
                $program->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TypeRag[]
     */
    public function getTypeRags(): Collection
    {
        return $this->typeRags;
    }

    public function addTypeRag(TypeRag $typeRag): self
    {
        if (!$this->typeRags->contains($typeRag)) {
            $this->typeRags[] = $typeRag;
            $typeRag->setCustomer($this);
        }

        return $this;
    }

    public function removeTypeRag(TypeRag $typeRag): self
    {
        if ($this->typeRags->contains($typeRag)) {
            $this->typeRags->removeElement($typeRag);
            // set the owning side to null (unless already changed)
            if ($typeRag->getCustomer() === $this) {
                $typeRag->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TypeDcpsensible[]
     */
    public function getTypeDcpsensibles(): Collection
    {
        return $this->typeDcpsensibles;
    }

    public function addTypeDcpsensible(TypeDcpsensible $typeDcpsensible): self
    {
        if (!$this->typeDcpsensibles->contains($typeDcpsensible)) {
            $this->typeDcpsensibles[] = $typeDcpsensible;
            $typeDcpsensible->setCustomer($this);
        }

        return $this;
    }

    public function removeTypeDcpsensible(TypeDcpsensible $typeDcpsensible): self
    {
        if ($this->typeDcpsensibles->contains($typeDcpsensible)) {
            $this->typeDcpsensibles->removeElement($typeDcpsensible);
            // set the owning side to null (unless already changed)
            if ($typeDcpsensible->getCustomer() === $this) {
                $typeDcpsensible->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TypeDcpsecu[]
     */
    public function getTypeDcpsecus(): Collection
    {
        return $this->typeDcpsecus;
    }

    public function addTypeDcpsecus(TypeDcpsecu $typeDcpsecus): self
    {
        if (!$this->typeDcpsecus->contains($typeDcpsecus)) {
            $this->typeDcpsecus[] = $typeDcpsecus;
            $typeDcpsecus->setCustomer($this);
        }

        return $this;
    }

    public function removeTypeDcpsecus(TypeDcpsecu $typeDcpsecus): self
    {
        if ($this->typeDcpsecus->contains($typeDcpsecus)) {
            $this->typeDcpsecus->removeElement($typeDcpsecus);
            // set the owning side to null (unless already changed)
            if ($typeDcpsecus->getCustomer() === $this) {
                $typeDcpsecus->setCustomer(null);
            }
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
            $rgpdAccess->setCustomer($this);
        }

        return $this;
    }

    public function removeRgpdAccess(RgpdAccess $rgpdAccess): self
    {
        if ($this->rgpdAccesses->contains($rgpdAccess)) {
            $this->rgpdAccesses->removeElement($rgpdAccess);
            // set the owning side to null (unless already changed)
            if ($rgpdAccess->getCustomer() === $this) {
                $rgpdAccess->setCustomer(null);
            }
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
            $rgpdViolation->setCustomer($this);
        }

        return $this;
    }

    public function removeRgpdViolation(RgpdViolation $rgpdViolation): self
    {
        if ($this->rgpdViolations->contains($rgpdViolation)) {
            $this->rgpdViolations->removeElement($rgpdViolation);
            // set the owning side to null (unless already changed)
            if ($rgpdViolation->getCustomer() === $this) {
                $rgpdViolation->setCustomer(null);
            }
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
            $rgpdAudit->setCustomer($this);
        }

        return $this;
    }

    public function removeRgpdAudit(RgpdAudit $rgpdAudit): self
    {
        if ($this->rgpdAudits->contains($rgpdAudit)) {
            $this->rgpdAudits->removeElement($rgpdAudit);
            // set the owning side to null (unless already changed)
            if ($rgpdAudit->getCustomer() === $this) {
                $rgpdAudit->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Data[]
     */
    public function getData(): Collection
    {
        return $this->data;
    }

    public function addData(Data $data): self
    {
        if (!$this->data->contains($data)) {
            $this->data[] = $data;
            $data->setCustomer($this);
        }

        return $this;
    }

    public function removeData(Data $data): self
    {
        if ($this->data->contains($data)) {
            $this->data->removeElement($data);
            // set the owning side to null (unless already changed)
            if ($data->getCustomer() === $this) {
                $data->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TypePrevention[]
     */
    public function getTypePreventions(): Collection
    {
        return $this->typePreventions;
    }

    public function addTypePrevention(TypePrevention $typePrevention): self
    {
        if (!$this->typePreventions->contains($typePrevention)) {
            $this->typePreventions[] = $typePrevention;
            $typePrevention->setCustomer($this);
        }

        return $this;
    }

    public function removeTypePrevention(TypePrevention $typePrevention): self
    {
        if ($this->typePreventions->contains($typePrevention)) {
            $this->typePreventions->removeElement($typePrevention);
            // set the owning side to null (unless already changed)
            if ($typePrevention->getCustomer() === $this) {
                $typePrevention->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TypeTraitementrgpd[]
     */
    public function getTypeTraitementrgpds(): Collection
    {
        return $this->typeTraitementrgpds;
    }

    public function addTypeTraitementrgpd(TypeTraitementrgpd $typeTraitementrgpd): self
    {
        if (!$this->typeTraitementrgpds->contains($typeTraitementrgpd)) {
            $this->typeTraitementrgpds[] = $typeTraitementrgpd;
            $typeTraitementrgpd->setCustomer($this);
        }

        return $this;
    }

    public function removeTypeTraitementrgpd(TypeTraitementrgpd $typeTraitementrgpd): self
    {
        if ($this->typeTraitementrgpds->contains($typeTraitementrgpd)) {
            $this->typeTraitementrgpds->removeElement($typeTraitementrgpd);
            // set the owning side to null (unless already changed)
            if ($typeTraitementrgpd->getCustomer() === $this) {
                $typeTraitementrgpd->setCustomer(null);
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
            $pcaEvenement->setCustomer($this);
        }

        return $this;
    }

    public function removePcaEvenement(PcaEvenement $pcaEvenement): self
    {
        if ($this->pcaEvenements->contains($pcaEvenement)) {
            $this->pcaEvenements->removeElement($pcaEvenement);
            // set the owning side to null (unless already changed)
            if ($pcaEvenement->getCustomer() === $this) {
                $pcaEvenement->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TypePcaEvenement[]
     */
    public function getTypePcaEvenements(): Collection
    {
        return $this->typePcaEvenements;
    }

    public function addTypePcaEvenement(TypePcaEvenement $typePcaEvenement): self
    {
        if (!$this->typePcaEvenements->contains($typePcaEvenement)) {
            $this->typePcaEvenements[] = $typePcaEvenement;
            $typePcaEvenement->setCustomer($this);
        }

        return $this;
    }

    public function removeTypePcaEvenement(TypePcaEvenement $typePcaEvenement): self
    {
        if ($this->typePcaEvenements->contains($typePcaEvenement)) {
            $this->typePcaEvenements->removeElement($typePcaEvenement);
            // set the owning side to null (unless already changed)
            if ($typePcaEvenement->getCustomer() === $this) {
                $typePcaEvenement->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Log[]
     */
    public function getLogs(): Collection
    {
        return $this->logs;
    }

    public function addLog(Log $log): self
    {
        if (!$this->logs->contains($log)) {
            $this->logs[] = $log;
            $log->setCustomer($this);
        }

        return $this;
    }

    public function removeLog(Log $log): self
    {
        if ($this->logs->contains($log)) {
            $this->logs->removeElement($log);
            // set the owning side to null (unless already changed)
            if ($log->getCustomer() === $this) {
                $log->setCustomer(null);
            }
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
            $anomaly->setCustomer($this);
        }

        return $this;
    }

    public function removeAnomaly(Anomalie $anomaly): self
    {
        if ($this->anomalies->contains($anomaly)) {
            $this->anomalies->removeElement($anomaly);
            // set the owning side to null (unless already changed)
            if ($anomaly->getCustomer() === $this) {
                $anomaly->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Controle[]
     */
    public function getControles(): Collection
    {
        return $this->controles;
    }

    public function addControle(Controle $controle): self
    {
        if (!$this->controles->contains($controle)) {
            $this->controles[] = $controle;
            $controle->setCustomer($this);
        }

        return $this;
    }

    public function removeControle(Controle $controle): self
    {
        if ($this->controles->contains($controle)) {
            $this->controles->removeElement($controle);
            // set the owning side to null (unless already changed)
            if ($controle->getCustomer() === $this) {
                $controle->setCustomer(null);
            }
        }

        return $this;
    }

    public function getDpo(): ?People
    {
        return $this->dpo;
    }

    public function setDpo(?People $dpo): self
    {
        $this->dpo = $dpo;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAdresse1(): ?string
    {
        return $this->adresse1;
    }

    public function setAdresse1(?string $adresse1): self
    {
        $this->adresse1 = $adresse1;

        return $this;
    }

    public function getAdresse2(): ?string
    {
        return $this->adresse2;
    }

    public function setAdresse2(?string $adresse2): self
    {
        $this->adresse2 = $adresse2;

        return $this;
    }

    public function getAdresse3(): ?string
    {
        return $this->adresse3;
    }

    public function setAdresse3(?string $adresse3): self
    {
        $this->adresse3 = $adresse3;

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

    /**
     * @return Collection|TypeStatutPca[]
     */
    public function getTypeStatutPcas(): Collection
    {
        return $this->typeStatutPcas;
    }

    public function addTypeStatutPca(TypeStatutPca $typeStatutPca): self
    {
        if (!$this->typeStatutPcas->contains($typeStatutPca)) {
            $this->typeStatutPcas[] = $typeStatutPca;
            $typeStatutPca->setCustomer($this);
        }

        return $this;
    }

    public function removeTypeStatutPca(TypeStatutPca $typeStatutPca): self
    {
        if ($this->typeStatutPcas->contains($typeStatutPca)) {
            $this->typeStatutPcas->removeElement($typeStatutPca);
            // set the owning side to null (unless already changed)
            if ($typeStatutPca->getCustomer() === $this) {
                $typeStatutPca->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TypeScore[]
     */
    public function getTypeScores(): Collection
    {
        return $this->typeScores;
    }

    public function addTypeScore(TypeScore $typeScore): self
    {
        if (!$this->typeScores->contains($typeScore)) {
            $this->typeScores[] = $typeScore;
            $typeScore->setCustomer($this);
        }

        return $this;
    }

    public function removeTypeScore(TypeScore $typeScore): self
    {
        if ($this->typeScores->contains($typeScore)) {
            $this->typeScores->removeElement($typeScore);
            // set the owning side to null (unless already changed)
            if ($typeScore->getCustomer() === $this) {
                $typeScore->setCustomer(null);
            }
        }

        return $this;
    }

    public function getRse(): ?People
    {
        return $this->rse;
    }

    public function setRse(?People $rse): self
    {
        $this->rse = $rse;

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
     * @return Collection|Policy[]
     */
    public function getPolicies(): Collection
    {
        return $this->policies;
    }

    public function addPolicy(Policy $policy): self
    {
        if (!$this->policies->contains($policy)) {
            $this->policies[] = $policy;
            $policy->setCustomer($this);
        }

        return $this;
    }

    public function removePolicy(Policy $policy): self
    {
        if ($this->policies->contains($policy)) {
            $this->policies->removeElement($policy);
            // set the owning side to null (unless already changed)
            if ($policy->getCustomer() === $this) {
                $policy->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TypeStatutRisque[]
     */
    public function getTypeStatutRisques(): Collection
    {
        return $this->typeStatutRisques;
    }

    public function addTypeStatutRisque(TypeStatutRisque $typeStatutRisque): self
    {
        if (!$this->typeStatutRisques->contains($typeStatutRisque)) {
            $this->typeStatutRisques[] = $typeStatutRisque;
            $typeStatutRisque->setCustomer($this);
        }

        return $this;
    }

    public function removeTypeStatutRisque(TypeStatutRisque $typeStatutRisque): self
    {
        if ($this->typeStatutRisques->contains($typeStatutRisque)) {
            $this->typeStatutRisques->removeElement($typeStatutRisque);
            // set the owning side to null (unless already changed)
            if ($typeStatutRisque->getCustomer() === $this) {
                $typeStatutRisque->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Objectif[]
     */
    public function getObjectifs(): Collection
    {
        return $this->objectifs;
    }

    public function addObjectif(Objectif $objectif): self
    {
        if (!$this->objectifs->contains($objectif)) {
            $this->objectifs[] = $objectif;
            $objectif->setCustomer($this);
        }

        return $this;
    }

    public function removeObjectif(Objectif $objectif): self
    {
        if ($this->objectifs->contains($objectif)) {
            $this->objectifs->removeElement($objectif);
            // set the owning side to null (unless already changed)
            if ($objectif->getCustomer() === $this) {
                $objectif->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PcaEvenementChronoPrepa[]
     */
    public function getPcaEvenementChronoPrepas(): Collection
    {
        return $this->pcaEvenementChronoPrepas;
    }

    public function addPcaEvenementChronoPrepa(PcaEvenementChronoPrepa $pcaEvenementChronoPrepa): self
    {
        if (!$this->pcaEvenementChronoPrepas->contains($pcaEvenementChronoPrepa)) {
            $this->pcaEvenementChronoPrepas[] = $pcaEvenementChronoPrepa;
            $pcaEvenementChronoPrepa->setCustomer($this);
        }

        return $this;
    }

    public function removePcaEvenementChronoPrepa(PcaEvenementChronoPrepa $pcaEvenementChronoPrepa): self
    {
        if ($this->pcaEvenementChronoPrepas->contains($pcaEvenementChronoPrepa)) {
            $this->pcaEvenementChronoPrepas->removeElement($pcaEvenementChronoPrepa);
            // set the owning side to null (unless already changed)
            if ($pcaEvenementChronoPrepa->getCustomer() === $this) {
                $pcaEvenementChronoPrepa->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Audit[]
     */
    public function getAuditscustomer(): Collection
    {
        return $this->auditscustomer;
    }

    public function addAuditscustomer(Audit $auditscustomer): self
    {
        if (!$this->auditscustomer->contains($auditscustomer)) {
            $this->auditscustomer[] = $auditscustomer;
            $auditscustomer->setCustomer($this);
        }

        return $this;
    }

    public function removeAuditscustomer(Audit $auditscustomer): self
    {
        if ($this->auditscustomer->removeElement($auditscustomer)) {
            // set the owning side to null (unless already changed)
            if ($auditscustomer->getCustomer() === $this) {
                $auditscustomer->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|NonConformite[]
     */
    public function getNonConformites(): Collection
    {
        return $this->nonConformites;
    }

    public function addNonConformite(NonConformite $nonConformite): self
    {
        if (!$this->nonConformites->contains($nonConformite)) {
            $this->nonConformites[] = $nonConformite;
            $nonConformite->setCustomer($this);
        }

        return $this;
    }

    public function removeNonConformite(NonConformite $nonConformite): self
    {
        if ($this->nonConformites->removeElement($nonConformite)) {
            // set the owning side to null (unless already changed)
            if ($nonConformite->getCustomer() === $this) {
                $nonConformite->setCustomer(null);
            }
        }

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
            $dysfonctionnement->setCustomer($this);
        }

        return $this;
    }

    public function removeDysfonctionnement(Dysfonctionnement $dysfonctionnement): self
    {
        if ($this->dysfonctionnements->removeElement($dysfonctionnement)) {
            // set the owning side to null (unless already changed)
            if ($dysfonctionnement->getCustomer() === $this) {
                $dysfonctionnement->setCustomer(null);
            }
        }

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
            $aspectEnv->setCustomer($this);
        }

        return $this;
    }

    public function removeAspectEnv(AspectEnv $aspectEnv): self
    {
        if ($this->aspectEnvs->removeElement($aspectEnv)) {
            // set the owning side to null (unless already changed)
            if ($aspectEnv->getCustomer() === $this) {
                $aspectEnv->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Impact[]
     */
    public function getImpacts(): Collection
    {
        return $this->impacts;
    }

    public function addImpact(Impact $impact): self
    {
        if (!$this->impacts->contains($impact)) {
            $this->impacts[] = $impact;
            $impact->setCustomer($this);
        }

        return $this;
    }

    public function removeImpact(Impact $impact): self
    {
        if ($this->impacts->removeElement($impact)) {
            // set the owning side to null (unless already changed)
            if ($impact->getCustomer() === $this) {
                $impact->setCustomer(null);
            }
        }

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
            $visiteSite->setCustomer($this);
        }

        return $this;
    }

    public function removeVisiteSite(VisiteSite $visiteSite): self
    {
        if ($this->visiteSites->removeElement($visiteSite)) {
            // set the owning side to null (unless already changed)
            if ($visiteSite->getCustomer() === $this) {
                $visiteSite->setCustomer(null);
            }
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
            $reclamation->setCustomer($this);
        }

        return $this;
    }

    public function removeReclamation(Reclamation $reclamation): self
    {
        if ($this->reclamations->removeElement($reclamation)) {
            // set the owning side to null (unless already changed)
            if ($reclamation->getCustomer() === $this) {
                $reclamation->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TypeReclamation[]
     */
    public function getTypeReclamations(): Collection
    {
        return $this->typeReclamations;
    }

    public function addTypeReclamation(TypeReclamation $typeReclamation): self
    {
        if (!$this->typeReclamations->contains($typeReclamation)) {
            $this->typeReclamations[] = $typeReclamation;
            $typeReclamation->setCustomer($this);
        }

        return $this;
    }

    public function removeTypeReclamation(TypeReclamation $typeReclamation): self
    {
        if ($this->typeReclamations->removeElement($typeReclamation)) {
            // set the owning side to null (unless already changed)
            if ($typeReclamation->getCustomer() === $this) {
                $typeReclamation->setCustomer(null);
            }
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
            $evenement->setCustomer($this);
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): self
    {
        if ($this->evenements->removeElement($evenement)) {
            // set the owning side to null (unless already changed)
            if ($evenement->getCustomer() === $this) {
                $evenement->setCustomer(null);
            }
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

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getSigle(): ?string
    {
        return $this->sigle;
    }

    public function setSigle(?string $sigle): self
    {
        $this->sigle = $sigle;

        return $this;
    }

    public function getSiren(): ?string
    {
        return $this->siren;
    }

    public function setSiren(?string $siren): self
    {
        $this->siren = $siren;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getNafape(): ?string
    {
        return $this->nafape;
    }

    public function setNafape(?string $nafape): self
    {
        $this->nafape = $nafape;

        return $this;
    }

    public function getTva(): ?string
    {
        return $this->tva;
    }

    public function setTva(?string $tva): self
    {
        $this->tva = $tva;

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

    public function getCreationAt(): ?\DateTimeInterface
    {
        return $this->creationAt;
    }

    public function setCreationAt(?\DateTimeInterface $creationAt): self
    {
        $this->creationAt = $creationAt;

        return $this;
    }

    

    

}
