<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\ChoiceList\Loader\ChoiceLoaderInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SystemeRepository")
 */
class Systeme
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $role;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $modele;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $processeur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ram;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Application", inversedBy="systemes")
     */
    private $applications;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Criticite", inversedBy="systemesdima")
     */
    private $dima;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Criticite", inversedBy="systemespdma")
     */
    private $pdma;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="systemesresponsable")
     */
    private $responsable;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="systemessuppleant")
     */
    private $suppleant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeSysteme", inversedBy="systemes")
     */
    private $typesysteme;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Site", inversedBy="systemes")
     */
    private $localisation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OuiNon", inversedBy="systemessecoursouinon")
     */
    private $secours;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $partitionnement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypePlateforme", inversedBy="systemes")
     */
    private $plateforme;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $raid;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="datetime")
     */
    private $PublishedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeOs")
     */
    private $os;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer", inversedBy="systemes")
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OuiNon")
     */
    private $srvhote;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OuiNon")
     */
    private $replicat;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Systeme")
     */
    private $systemeconnexes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Systeme")
	 * @ORM\JoinTable(name="systemehost",
	 *      joinColumns={@ORM\JoinColumn(name="systeme_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@ORM\JoinColumn(name="host_id", referencedColumnName="id")}
	 *      )
     */
    private $host;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Systeme")
     * @ORM\JoinTable(name="systemestorage",
	 *      joinColumns={@ORM\JoinColumn(name="systeme_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@ORM\JoinColumn(name="storage_id", referencedColumnName="id")}
	 *      )
     */
    private $storages;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PcaEvenement", mappedBy="systemes")
     */
    private $pcaEvenements;

    /**
     * @ORM\OneToMany(targetEntity=PcaEvenementServTrack::class, mappedBy="systeme")
     */
    private $pcaEvenementServTracks;

    /**
     * @ORM\ManyToMany(targetEntity=people::class, inversedBy="systemespeoples")
     */
    private $peoples;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="systemespublisher")
     */
    private $publisher;

    /**
     * @ORM\ManyToOne(targetEntity=OnOff::class, inversedBy="systemes")
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
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="systemesvalidator")
     */
    private $validator;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $validationstatut;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Gedmo\Slug(fields={"designation"})
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity=Evenement::class, mappedBy="systemes")
     */
    private $evenementssystemes;

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
        $this->applications = new ArrayCollection();
        $this->systemeconnexes = new ArrayCollection();
        $this->host = new ArrayCollection();
        $this->storages = new ArrayCollection();
        $this->pcaEvenements = new ArrayCollection();
        $this->pcaEvenementServTracks = new ArrayCollection();
        $this->peoples = new ArrayCollection();
        $this->evenementssystemes = new ArrayCollection();
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

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(?string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getProcesseur(): ?string
    {
        return $this->processeur;
    }

    public function setProcesseur(?string $processeur): self
    {
        $this->processeur = $processeur;

        return $this;
    }

    public function getRam(): ?string
    {
        return $this->ram;
    }

    public function setRam(?string $ram): self
    {
        $this->ram = $ram;

        return $this;
    }

    /**
     * @return Collection|application[]
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    public function addApplication(application $application): self
    {
        if (!$this->applications->contains($application)) {
            $this->applications[] = $application;
        }

        return $this;
    }

    public function removeApplication(application $application): self
    {
        if ($this->applications->contains($application)) {
            $this->applications->removeElement($application);
        }

        return $this;
    }

    public function getDima(): ?Criticite
    {
        return $this->dima;
    }

    public function setDima(?Criticite $dima): self
    {
        $this->dima = $dima;

        return $this;
    }

    public function getPdma(): ?Criticite
    {
        return $this->pdma;
    }

    public function setPdma(?Criticite $pdma): self
    {
        $this->pdma = $pdma;

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

    public function getTypesysteme(): ?TypeSysteme
    {
        return $this->typesysteme;
    }

    public function setTypesysteme(?TypeSysteme $typesysteme): self
    {
        $this->typesysteme = $typesysteme;

        return $this;
    }

    public function getLocalisation(): ?Site
    {
        return $this->localisation;
    }

    public function setLocalisation(?Site $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getSecours(): ?OuiNon
    {
        return $this->secours;
    }

    public function setSecours(?OuiNon $secours): self
    {
        $this->secours = $secours;

        return $this;
    }

    public function getPartitionnement(): ?string
    {
        return $this->partitionnement;
    }

    public function setPartitionnement(?string $partitionnement): self
    {
        $this->partitionnement = $partitionnement;

        return $this;
    }

    public function getPlateforme(): ?TypePlateforme
    {
        return $this->plateforme;
    }

    public function setPlateforme(?TypePlateforme $plateforme): self
    {
        $this->plateforme = $plateforme;

        return $this;
    }

    public function getRaid(): ?string
    {
        return $this->raid;
    }

    public function setRaid(string $raid): self
    {
        $this->raid = $raid;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getSystemeconnexe(): Collection
    {
        return $this->systemeconnexe;
    }

    public function addSystemeconnexe(self $systemeconnexe): self
    {
        if (!$this->systemeconnexe->contains($systemeconnexe)) {
            $this->systemeconnexe[] = $systemeconnexe;
        }

        return $this;
    }

    public function removeSystemeconnexe(self $systemeconnexe): self
    {
        if ($this->systemeconnexe->contains($systemeconnexe)) {
            $this->systemeconnexe->removeElement($systemeconnexe);
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

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->PublishedAt;
    }

    public function setPublishedAt(\DateTimeInterface $PublishedAt): self
    {
        $this->PublishedAt = $PublishedAt;

        return $this;
    }

    public function getOs(): ?TypeOs
    {
        return $this->os;
    }

    public function setOs(?TypeOs $os): self
    {
        $this->os = $os;

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

    public function getSrvhote(): ?OuiNon
    {
        return $this->srvhote;
    }

    public function setSrvhote(?OuiNon $srvhote): self
    {
        $this->srvhote = $srvhote;

        return $this;
    }

    public function getReplicat(): ?OuiNon
    {
        return $this->replicat;
    }

    public function setReplicat(?OuiNon $replicat): self
    {
        $this->replicat = $replicat;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getSystemeconnexes(): Collection
    {
        return $this->systemeconnexes;
    }
	
    public function addSystemeconnex(self $systemeconnex): self
    {
        if (!$this->systemeconnexes->contains($systemeconnex)) {
            $this->systemeconnexes[] = $systemeconnex;
            $systemeconnex->addSystemeconnex($this);
        }

        return $this;
    }

    public function removeSystemeconnex(self $systemeconnex): self
    {
        if ($this->systemeconnexes->contains($systemeconnex)) {
            $this->systemeconnexes->removeElement($systemeconnex);
            $systemeconnex->removeSystemeconnex($this);
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getHost(): Collection
    {
        return $this->host;
    }

    public function addHost(self $host): self
    {
        if (!$this->host->contains($host)) {
            $this->host[] = $host;
            $host->addHost($this);
        }

        return $this;
    }

    public function removeHost(self $host): self
    {
        if ($this->host->contains($host)) {
            $this->host->removeElement($host);
            $host->removeHost($this);
            
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getStorages(): Collection
    {
        return $this->storages;
    }

    public function addStorage(self $storage): self
    {
        if (!$this->storages->contains($storage)) {
            $this->storages[] = $storage;
            $storage->addStorage($this);
        }

        return $this;
    }

    public function removeStorage(self $storage): self
    {
        if ($this->storages->contains($storage)) {
            $this->storages->removeElement($storage);
            $storage->removeStorage($this);
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
            $pcaEvenement->addSysteme($this);
        }

        return $this;
    }

    public function removePcaEvenement(PcaEvenement $pcaEvenement): self
    {
        if ($this->pcaEvenements->contains($pcaEvenement)) {
            $this->pcaEvenements->removeElement($pcaEvenement);
            $pcaEvenement->removeSysteme($this);
        }

        return $this;
    }

    /**
     * @return Collection|PcaEvenementServTrack[]
     */
    public function getPcaEvenementServTracks(): Collection
    {
        return $this->pcaEvenementServTracks;
    }

    public function addPcaEvenementServTrack(PcaEvenementServTrack $pcaEvenementServTrack): self
    {
        if (!$this->pcaEvenementServTracks->contains($pcaEvenementServTrack)) {
            $this->pcaEvenementServTracks[] = $pcaEvenementServTrack;
            $pcaEvenementServTrack->setSysteme($this);
        }

        return $this;
    }

    public function removePcaEvenementServTrack(PcaEvenementServTrack $pcaEvenementServTrack): self
    {
        if ($this->pcaEvenementServTracks->contains($pcaEvenementServTrack)) {
            $this->pcaEvenementServTracks->removeElement($pcaEvenementServTrack);
            // set the owning side to null (unless already changed)
            if ($pcaEvenementServTrack->getSysteme() === $this) {
                $pcaEvenementServTrack->setSysteme(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|people[]
     */
    public function getPeoples(): Collection
    {
        return $this->peoples;
    }

    public function addPeople(people $people): self
    {
        if (!$this->peoples->contains($people)) {
            $this->peoples[] = $people;
        }

        return $this;
    }

    public function removePeople(people $people): self
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
    public function getEvenementssystemes(): Collection
    {
        return $this->evenementssystemes;
    }

    public function addEvenementssysteme(Evenement $evenementssysteme): self
    {
        if (!$this->evenementssystemes->contains($evenementssysteme)) {
            $this->evenementssystemes[] = $evenementssysteme;
            $evenementssysteme->addSysteme($this);
        }

        return $this;
    }

    public function removeEvenementssysteme(Evenement $evenementssysteme): self
    {
        if ($this->evenementssystemes->removeElement($evenementssysteme)) {
            $evenementssysteme->removeSysteme($this);
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
