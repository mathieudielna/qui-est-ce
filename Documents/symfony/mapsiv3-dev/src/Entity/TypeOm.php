<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeOmRepository")
 */
class TypeOm
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
    private $couleur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ObjetMetier", mappedBy="type")
     */
    private $objetMetiers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer", inversedBy="typeOms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    public function __construct()
    {
        $this->objetMetiers = new ArrayCollection();
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

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(?string $couleur): self
    {
        $this->couleur = $couleur;

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
            $objetMetier->setType($this);
        }

        return $this;
    }

    public function removeObjetMetier(ObjetMetier $objetMetier): self
    {
        if ($this->objetMetiers->contains($objetMetier)) {
            $this->objetMetiers->removeElement($objetMetier);
            // set the owning side to null (unless already changed)
            if ($objetMetier->getType() === $this) {
                $objetMetier->setType(null);
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
}
