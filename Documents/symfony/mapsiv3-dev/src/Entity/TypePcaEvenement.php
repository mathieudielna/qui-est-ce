<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypePcaEvenementRepository")
 */
class TypePcaEvenement
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
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer", inversedBy="typePcaEvenements")
     */
    private $customer;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PcaEvenement", mappedBy="typeevenements")
     */
    private $pcaEvenements;

    public function __construct()
    {
        $this->pcaEvenements = new ArrayCollection();
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

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
            $pcaEvenement->addTypeevenement($this);
        }

        return $this;
    }

    public function removePcaEvenement(PcaEvenement $pcaEvenement): self
    {
        if ($this->pcaEvenements->contains($pcaEvenement)) {
            $this->pcaEvenements->removeElement($pcaEvenement);
            $pcaEvenement->removeTypeevenement($this);
        }

        return $this;
    }
}
