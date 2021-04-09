<?php

namespace App\Entity;
use App\Entity\Risque;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\ChoiceList\Loader\ChoiceLoaderInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActionRepository")
 */
class Action
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
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="actionsresponsable")
     */
    private $responsable;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="actionssuppleant")
     */
    private $suppleant;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TypeConformite", inversedBy="actions")
     */
    private $typeconformite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypePriorite", inversedBy="actions")
     */
    private $priorite;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datedebut;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datefin;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\People", inversedBy="actionspeople")
     */
    private $people;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $progression;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $PublishedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $domaineprojet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer", inversedBy="actions")
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeAction")
     */
    private $typeaction;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Site", inversedBy="actions")
     */
    private $sites;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Processus", inversedBy="actions")
     */
    private $processuses;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Risque", inversedBy="actions")
     */
    private $risques;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Axe", inversedBy="actions")
     */
    private $axes;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datefinrevue;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datefinreelle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Projet", inversedBy="actions")
     */
    private $projet;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reference;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $budget;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $etp;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\JalonConnectAction", mappedBy="action", orphanRemoval=true, cascade={"persist"})
     */
    private $jalonConnectActions;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $archive;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypePhase", inversedBy="actions")
     */
    private $phase;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Actionstrat", mappedBy="actions")
     */
    private $actionstrats;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Application", inversedBy="actions")
     */
    private $applications;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Flux", inversedBy="actions")
     */
    private $fluxes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\RgpdAudit", mappedBy="actions")
     */
    private $rgpdAudits;

    /**
     * @ORM\ManyToMany(targetEntity=Anomalie::class, mappedBy="actions")
     */
    private $anomalies;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="actionspublisher")
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
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="actionsvalidator")
     */
    private $validator;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $validationstatut;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statutaction;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Gedmo\Slug(fields={"designation"})
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity=Audit::class, mappedBy="actions")
     */
    private $auditsaction;

    /**
     * @ORM\ManyToMany(targetEntity=AspectEnv::class, mappedBy="Actions")
     */
    private $aspectEnvs;

    /**
     * @ORM\ManyToMany(targetEntity=Reclamation::class, mappedBy="actions")
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
        $this->typeconformite = new ArrayCollection();
        $this->people = new ArrayCollection();
        $this->sites = new ArrayCollection();
        $this->processuses = new ArrayCollection();
        $this->risques = new ArrayCollection();
        $this->axes = new ArrayCollection();
        $this->jalonConnectActions = new ArrayCollection();
        $this->actionstrats = new ArrayCollection();
        $this->applications = new ArrayCollection();
        $this->fluxes = new ArrayCollection();
        $this->rgpdAudits = new ArrayCollection();
        $this->anomalies = new ArrayCollection();
        $this->auditsaction = new ArrayCollection();
        $this->aspectEnvs = new ArrayCollection();
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
     * @return Collection|TypeConformite[]
     */
    public function getTypeconformite(): Collection
    {
        return $this->typeconformite;
    }

    public function addTypeconformite(TypeConformite $typeconformite): self
    {
        if (!$this->typeconformite->contains($typeconformite)) {
            $this->typeconformite[] = $typeconformite;
        }

        return $this;
    }

    public function removeTypeconformite(TypeConformite $typeconformite): self
    {
        if ($this->typeconformite->contains($typeconformite)) {
            $this->typeconformite->removeElement($typeconformite);
        }

        return $this;
    }

    public function getPriorite(): ?TypePriorite
    {
        return $this->priorite;
    }

    public function setPriorite(?TypePriorite $priorite): self
    {
        $this->priorite = $priorite;

        return $this;
    }


    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(?\DateTimeInterface $datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->datefin;
    }

    public function setDatefin(?\DateTimeInterface $datefin): self
    {
        $this->datefin = $datefin;

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
        }

        return $this;
    }

    public function removePerson(People $person): self
    {
        if ($this->people->contains($person)) {
            $this->people->removeElement($person);
        }

        return $this;
    }

    public function getProgression(): ?string
    {
        return $this->progression;
    }

    public function setProgression(?string $progression): self
    {
        $this->progression = $progression;

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

    public function getDomaineprojet(): ?string
    {
        return $this->domaineprojet;
    }

    public function setDomaineprojet(?string $domaineprojet): self
    {
        $this->domaineprojet = $domaineprojet;

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

    public function getTypeaction(): ?TypeAction
    {
        return $this->typeaction;
    }

    public function setTypeaction(?TypeAction $typeaction): self
    {
        $this->typeaction = $typeaction;

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
        }

        return $this;
    }

    public function removeSite(Site $site): self
    {
        if ($this->sites->contains($site)) {
            $this->sites->removeElement($site);
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
     * @return Collection|Axe[]
     */
    public function getAxes(): Collection
    {
        return $this->axes;
    }

    public function addAxe(Axe $axe): self
    {
        if (!$this->axes->contains($axe)) {
            $this->axes[] = $axe;
        }

        return $this;
    }

    public function removeAxe(Axe $axe): self
    {
        if ($this->axes->contains($axe)) {
            $this->axes->removeElement($axe);
        }

        return $this;
    }

    public function getDatefinrevue(): ?\DateTimeInterface
    {
        return $this->datefinrevue;
    }

    public function setDatefinrevue(?\DateTimeInterface $datefinrevue): self
    {
        $this->datefinrevue = $datefinrevue;

        return $this;
    }

    public function getDatefinreelle(): ?\DateTimeInterface
    {
        return $this->datefinreelle;
    }

    public function setDatefinreelle(?\DateTimeInterface $datefinreelle): self
    {
        $this->datefinreelle = $datefinreelle;

        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): self
    {
        $this->projet = $projet;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): self
    {
        $this->reference = $reference;

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

    public function getEtp(): ?string
    {
        return $this->etp;
    }

    public function setEtp(?string $etp): self
    {
        $this->etp = $etp;

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
            $jalonConnectAction->setAction($this);
        }

        return $this;
    }

    public function removeJalonConnectAction(JalonConnectAction $jalonConnectAction): self
    {
        if ($this->jalonConnectActions->contains($jalonConnectAction)) {
            $this->jalonConnectActions->removeElement($jalonConnectAction);
            // set the owning side to null (unless already changed)
            if ($jalonConnectAction->getAction() === $this) {
                $jalonConnectAction->setAction(null);
            }
        }

        return $this;
    }

    public function getArchive(): ?string
    {
        return $this->archive;
    }

    public function setArchive(?string $archive): self
    {
        $this->archive = $archive;

        return $this;
    }

    public function getPhase(): ?TypePhase
    {
        return $this->phase;
    }

    public function setPhase(?TypePhase $phase): self
    {
        $this->phase = $phase;

        return $this;
    }

    /**
     * @return Collection|Actionstrat[]
     */
    public function getActionstrats(): Collection
    {
        return $this->actionstrats;
    }

    public function addActionstrat(Actionstrat $actionstrat): self
    {
        if (!$this->actionstrats->contains($actionstrat)) {
            $this->actionstrats[] = $actionstrat;
            $actionstrat->addAction($this);
        }

        return $this;
    }

    public function removeActionstrat(Actionstrat $actionstrat): self
    {
        if ($this->actionstrats->contains($actionstrat)) {
            $this->actionstrats->removeElement($actionstrat);
            $actionstrat->removeAction($this);
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
        }

        return $this;
    }

    public function removeFlux(Flux $flux): self
    {
        if ($this->fluxes->contains($flux)) {
            $this->fluxes->removeElement($flux);
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
            $rgpdAudit->addAction($this);
        }

        return $this;
    }

    public function removeRgpdAudit(RgpdAudit $rgpdAudit): self
    {
        if ($this->rgpdAudits->contains($rgpdAudit)) {
            $this->rgpdAudits->removeElement($rgpdAudit);
            $rgpdAudit->removeAction($this);
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
            $anomaly->addAction($this);
        }

        return $this;
    }

    public function removeAnomaly(Anomalie $anomaly): self
    {
        if ($this->anomalies->contains($anomaly)) {
            $this->anomalies->removeElement($anomaly);
            $anomaly->removeAction($this);
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

    public function getStatutaction(): ?string
    {
        return $this->statutaction;
    }

    public function setStatutaction(?string $statutaction): self
    {
        $this->statutaction = $statutaction;

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
     * @return Collection|Audit[]
     */
    public function getAuditsaction(): Collection
    {
        return $this->auditsaction;
    }

    public function addAuditsaction(Audit $auditsaction): self
    {
        if (!$this->auditsaction->contains($auditsaction)) {
            $this->auditsaction[] = $auditsaction;
            $auditsaction->addAction($this);
        }

        return $this;
    }

    public function removeAuditsaction(Audit $auditsaction): self
    {
        if ($this->auditsaction->removeElement($auditsaction)) {
            $auditsaction->removeAction($this);
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
            $aspectEnv->addAction($this);
        }

        return $this;
    }

    public function removeAspectEnv(AspectEnv $aspectEnv): self
    {
        if ($this->aspectEnvs->removeElement($aspectEnv)) {
            $aspectEnv->removeAction($this);
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
            $reclamation->addAction($this);
        }

        return $this;
    }

    public function removeReclamation(Reclamation $reclamation): self
    {
        if ($this->reclamations->removeElement($reclamation)) {
            $reclamation->removeAction($this);
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
