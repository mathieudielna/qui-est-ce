<?php

namespace App\Entity;

use App\Repository\ControleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ControleRepository::class)
 */
class Controle
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
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="auteurcontrole")
     */
    private $auteur;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $finalite;

    /**
     * @ORM\ManyToMany(targetEntity=TypePeriodicite::class, inversedBy="controles")
     */
    private $periodicites;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $materialisationctrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $support;

    /**
     * @ORM\ManyToOne(targetEntity=MapsiCustomer::class, inversedBy="controles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\Column(type="datetime")
     */
    private $CreatedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $PublishedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $UpdatedAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="controlesresponsable")
     */
    private $responsable;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="controlessuppleant")
     */
    private $suppleant;

    /**
     * @ORM\ManyToMany(targetEntity=People::class, inversedBy="controlespeoples")
     */
    private $peoples;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="controlespublisher")
     */
    private $publisher;

    /**
     * @ORM\ManyToMany(targetEntity=TypeConformite::class, inversedBy="controles")
     */
    private $typeconformite;

    public function __construct()
    {
        $this->periodicites = new ArrayCollection();
        $this->peoples = new ArrayCollection();
        $this->typeconformite = new ArrayCollection();
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

    public function getAuteur(): ?People
    {
        return $this->auteur;
    }

    public function setAuteur(?People $auteur): self
    {
        $this->auteur = $auteur;

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

    public function getMaterialisationctrl(): ?string
    {
        return $this->materialisationctrl;
    }

    public function setMaterialisationctrl(?string $materialisationctrl): self
    {
        $this->materialisationctrl = $materialisationctrl;

        return $this;
    }

    public function getSupport(): ?string
    {
        return $this->support;
    }

    public function setSupport(?string $support): self
    {
        $this->support = $support;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeInterface $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $UpdatedAt): self
    {
        $this->UpdatedAt = $UpdatedAt;

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
        $this->peoples->removeElement($people);

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
        $this->typeconformite->removeElement($typeconformite);

        return $this;
    }
}
