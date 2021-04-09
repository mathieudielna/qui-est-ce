<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ObjetMetierRepository")
 */
class ObjetMetier
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
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer", inversedBy="objetMetiers")
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeSupport", inversedBy="objetMetiers")
     */
    private $typesupport;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="objetMetiers")
     */
    private $responsable;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="objetMetiersSuppleants")
     */
    private $suppleant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeOm", inversedBy="objetMetiers")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OuiNon")
     */
    private $dcp;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OuiNon")
     */
    private $dcpsensible;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Application", inversedBy="objetMetiers")
     */
    private $applications;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Flux", mappedBy="objetmetiers")
     */
    private $fluxes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Data", inversedBy="objetMetiers")
     */
    private $datas;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TypePrevention", inversedBy="objetMetiers")
     */
    private $mesuresprev;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="objetMetierspublisher")
     */
    private $publisher;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $PublishedAt;

    /**
     * @ORM\ManyToMany(targetEntity=People::class, inversedBy="objetmetierspeoples")
     */
    private $peoples;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $ValidatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=people::class, inversedBy="objetmetiersvalidator")
     */
    private $validator;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $validationstatut;

    /**
     * @ORM\ManyToOne(targetEntity=TypeStatutrgpd::class, inversedBy="objetMetiers")
     */
    private $statutrgpd;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Gedmo\Slug(fields={"designation"})
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="objetMetiersredacteur")
     */
    private $redacteur;

    /**
     * @ORM\ManyToMany(targetEntity=Evenement::class, mappedBy="objetmetiers")
     */
    private $evenementsobjetmetiers;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $UpdatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $CreatedAt;


    public function __construct()
    {
        $this->applications = new ArrayCollection();
        $this->fluxes = new ArrayCollection();
        $this->datas = new ArrayCollection();
        $this->mesuresprev = new ArrayCollection();
        $this->peoples = new ArrayCollection();
        $this->evenementsobjetmetiers = new ArrayCollection();
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

    public function getTypesupport(): ?TypeSupport
    {
        return $this->typesupport;
    }

    public function setTypesupport(?TypeSupport $typesupport): self
    {
        $this->typesupport = $typesupport;

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

    public function getType(): ?TypeOm
    {
        return $this->type;
    }

    public function setType(?TypeOm $type): self
    {
        $this->type = $type;

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

    public function getDcpsensible(): ?OuiNon
    {
        return $this->dcpsensible;
    }

    public function setDcpsensible(?OuiNon $dcpsensible): self
    {
        $this->dcpsensible = $dcpsensible;

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
            $flux->addObjetmetier($this);
        }

        return $this;
    }

    public function removeFlux(Flux $flux): self
    {
        if ($this->fluxes->contains($flux)) {
            $this->fluxes->removeElement($flux);
            $flux->removeObjetmetier($this);
        }

        return $this;
    }

    /**
     * @return Collection|Data[]
     */
    public function getDatas(): Collection
    {
        return $this->datas;
    }

    public function addData(Data $data): self
    {
        if (!$this->datas->contains($data)) {
            $this->datas[] = $data;
        }

        return $this;
    }

    public function removeData(Data $data): self
    {
        if ($this->datas->contains($data)) {
            $this->datas->removeElement($data);
        }

        return $this;
    }

    /**
     * @return Collection|TypePrevention[]
     */
    public function getMesuresprev(): Collection
    {
        return $this->mesuresprev;
    }

    public function addMesuresprev(TypePrevention $mesuresprev): self
    {
        if (!$this->mesuresprev->contains($mesuresprev)) {
            $this->mesuresprev[] = $mesuresprev;
        }

        return $this;
    }

    public function removeMesuresprev(TypePrevention $mesuresprev): self
    {
        if ($this->mesuresprev->contains($mesuresprev)) {
            $this->mesuresprev->removeElement($mesuresprev);
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

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->PublishedAt;
    }

    public function setPublishedAt(?\DateTimeInterface $PublishedAt): self
    {
        $this->PublishedAt = $PublishedAt;

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

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

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

    public function getValidator(): ?people
    {
        return $this->validator;
    }

    public function setValidator(?people $validator): self
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

    public function getStatutrgpd(): ?TypeStatutrgpd
    {
        return $this->statutrgpd;
    }

    public function setStatutrgpd(?TypeStatutrgpd $statutrgpd): self
    {
        $this->statutrgpd = $statutrgpd;

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
    public function getEvenementsobjetmetiers(): Collection
    {
        return $this->evenementsobjetmetiers;
    }

    public function addEvenementsobjetmetier(Evenement $evenementsobjetmetier): self
    {
        if (!$this->evenementsobjetmetiers->contains($evenementsobjetmetier)) {
            $this->evenementsobjetmetiers[] = $evenementsobjetmetier;
            $evenementsobjetmetier->addObjetmetier($this);
        }

        return $this;
    }

    public function removeEvenementsobjetmetier(Evenement $evenementsobjetmetier): self
    {
        if ($this->evenementsobjetmetiers->removeElement($evenementsobjetmetier)) {
            $evenementsobjetmetier->removeObjetmetier($this);
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


}
