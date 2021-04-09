<?php

namespace App\Entity;

use App\Repository\NonConformiteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NonConformiteRepository::class)
 */
class NonConformite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $CreatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $PublishedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $PreparedAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $progres;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $ptattention;

    /**
     * @ORM\ManyToOne(targetEntity=TypeNonConformite::class, inversedBy="nonConformitesaudit")
     */
    private $severite;

    /**
     * @ORM\ManyToOne(targetEntity=MapsiCustomer::class, inversedBy="nonConformites")
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity=Audit::class, inversedBy="nonconformites", cascade={"persist"})
     */
    private $audit;
    

  

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(?\DateTimeInterface $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

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

    public function getPreparedAt(): ?\DateTimeInterface
    {
        return $this->PreparedAt;
    }

    public function setPreparedAt(?\DateTimeInterface $PreparedAt): self
    {
        $this->PreparedAt = $PreparedAt;

        return $this;
    }

    public function getProgres(): ?string
    {
        return $this->progres;
    }

    public function setProgres(?string $progres): self
    {
        $this->progres = $progres;

        return $this;
    }

    public function getPtattention(): ?string
    {
        return $this->ptattention;
    }

    public function setPtattention(?string $ptattention): self
    {
        $this->ptattention = $ptattention;

        return $this;
    }

    public function getSeverite(): ?TypeNonConformite
    {
        return $this->severite;
    }

    public function setSeverite(?TypeNonConformite $severite): self
    {
        $this->severite = $severite;

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

    public function getAudit(): ?Audit
    {
        return $this->audit;
    }

    public function setAudit(?Audit $audit): self
    {
        $this->audit = $audit;

        return $this;
    }

}
