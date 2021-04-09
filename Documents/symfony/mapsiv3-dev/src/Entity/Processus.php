<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProcessusRepository")
 * @UniqueEntity(fields="designation", message="Ce non est déjà utilisé")
 */
class Processus
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank
     */
    private $designation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeProcessus", inversedBy="processuses")
     */
    private $typeprocessus;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="processusesresponsable")
     */
    private $responsable;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="processusessuppleant")
     */
    private $suppleant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Metier", inversedBy="processuses")
     */
    private $metier;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $pilotage;

    /**
     * @ORM\Column(type="datetime")
     */
    private $PublishedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Activite", mappedBy="processus")
     */
    private $activites;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Objectif", mappedBy="processus", orphanRemoval=true, cascade={"persist"})
     */
    private $objectifs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer", inversedBy="processuses")
     */
    private $customer;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Risque", mappedBy="processuses")
     */
    private $risques;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Action", mappedBy="processuses")
     */
    private $actions;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $code;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $finalite;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToMany(targetEntity=Anomalie::class, mappedBy="processuses")
     */
    private $anomalies;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $CreatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $UpdatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="publishedprocessuses")
     */
    private $Publisher;

    /**
     * @ORM\ManyToMany(targetEntity=People::class, inversedBy="processusespeoples")
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
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="processusesvalidator")
     */
    private $validator;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $validationstatut;

    /**
     * @ORM\ManyToMany(targetEntity=Audit::class, mappedBy="processuses")
     */
    private $auditsprocessus;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Gedmo\Slug(fields={"designation"})
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity=Reclamation::class, mappedBy="processuses")
     */
    private $reclamations;

    /**
     * @ORM\ManyToMany(targetEntity=Evenement::class, mappedBy="processuses")
     */
    private $evenementsprocessuses;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="processusesredacteur")
     */
    private $redacteur;

    /**
     * @ORM\OneToMany(targetEntity=AspectEnv::class, mappedBy="processuses")
     */
    private $aspectEnvs;

    public function __construct()
    {
        $this->activites = new ArrayCollection();
        $this->objectifs = new ArrayCollection();
        $this->risques = new ArrayCollection();
        $this->actions = new ArrayCollection();
        $this->anomalies = new ArrayCollection();
        $this->peoples = new ArrayCollection();
        $this->auditsprocessus = new ArrayCollection();
        $this->reclamations = new ArrayCollection();
        $this->evenementsprocessuses = new ArrayCollection();
        $this->aspectEnvs = new ArrayCollection();
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

    public function getTypeprocessus(): ?TypeProcessus
    {
        return $this->typeprocessus;
    }

    public function setTypeprocessus(?TypeProcessus $typeprocessus): self
    {
        $this->typeprocessus = $typeprocessus;

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

    public function getMetier(): ?Metier
    {
        return $this->metier;
    }

    public function setMetier(?Metier $metier): self
    {
        $this->metier = $metier;

        return $this;
    }

    public function getPilotage(): ?string
    {
        return $this->pilotage;
    }

    public function setPilotage(?string $pilotage): self
    {
        $this->pilotage = $pilotage;

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
            $activite->setProcessus($this);
        }

        return $this;
    }

    public function removeActivite(Activite $activite): self
    {
        if ($this->activites->contains($activite)) {
            $this->activites->removeElement($activite);
            // set the owning side to null (unless already changed)
            if ($activite->getProcessus() === $this) {
                $activite->setProcessus(null);
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
            $objectif->setProcessus($this);
        }

        return $this;
    }

    public function removeObjectif(Objectif $objectif): self
    {
        if ($this->objectifs->contains($objectif)) {
            $this->objectifs->removeElement($objectif);
            // set the owning side to null (unless already changed)
            if ($objectif->getProcessus() === $this) {
                $objectif->setProcessus(null);
            }
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
            $risque->addProcessus($this);
        }

        return $this;
    }

    public function removeRisque(Risque $risque): self
    {
        if ($this->risques->contains($risque)) {
            $this->risques->removeElement($risque);
            $risque->removeProcessus($this);
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
            $action->addProcessus($this);
        }

        return $this;
    }

    public function removeAction(Action $action): self
    {
        if ($this->actions->contains($action)) {
            $this->actions->removeElement($action);
            $action->removeProcessus($this);
        }

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

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
            $anomaly->addProcessus($this);
        }

        return $this;
    }

    public function removeAnomaly(Anomalie $anomaly): self
    {
        if ($this->anomalies->contains($anomaly)) {
            $this->anomalies->removeElement($anomaly);
            $anomaly->removeProcessus($this);
        }

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $UpdatedAt): self
    {
        $this->UpdatedAt = $UpdatedAt;

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
     * @return Collection|Audit[]
     */
    public function getAuditsprocessus(): Collection
    {
        return $this->auditsprocessus;
    }

    public function addAuditsprocessu(Audit $auditsprocessu): self
    {
        if (!$this->auditsprocessus->contains($auditsprocessu)) {
            $this->auditsprocessus[] = $auditsprocessu;
            $auditsprocessu->addProcessus($this);
        }

        return $this;
    }

    public function removeAuditsprocessu(Audit $auditsprocessu): self
    {
        if ($this->auditsprocessus->removeElement($auditsprocessu)) {
            $auditsprocessu->removeProcessus($this);
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
            $reclamation->addProcessus($this);
        }

        return $this;
    }

    public function removeReclamation(Reclamation $reclamation): self
    {
        if ($this->reclamations->removeElement($reclamation)) {
            $reclamation->removeProcessus($this);
        }

        return $this;
    }

    /**
     * @return Collection|Evenement[]
     */
    public function getEvenementsprocessuses(): Collection
    {
        return $this->evenementsprocessuses;
    }

    public function addEvenementsprocessus(Evenement $evenementsprocessus): self
    {
        if (!$this->evenementsprocessuses->contains($evenementsprocessus)) {
            $this->evenementsprocessuses[] = $evenementsprocessus;
            $evenementsprocessus->addProcessus($this);
        }

        return $this;
    }

    public function removeEvenementsprocessus(Evenement $evenementsprocessus): self
    {
        if ($this->evenementsprocessuses->removeElement($evenementsprocessus)) {
            $evenementsprocessus->removeProcessus($this);
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
            $aspectEnv->setProcessuses($this);
        }

        return $this;
    }

    public function removeAspectEnv(AspectEnv $aspectEnv): self
    {
        if ($this->aspectEnvs->removeElement($aspectEnv)) {
            // set the owning side to null (unless already changed)
            if ($aspectEnv->getProcessuses() === $this) {
                $aspectEnv->setProcessuses(null);
            }
        }

        return $this;
    }
}
