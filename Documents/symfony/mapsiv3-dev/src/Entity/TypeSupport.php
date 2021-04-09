<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeSupportRepository")
 */
class TypeSupport
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Flux", mappedBy="supports")
     */
    private $fluxs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer")
     */
    private $customer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ObjetMetier", mappedBy="typesupport")
     */
    private $objetMetiers;


    public function __construct()
    {
        $this->fluxes = new ArrayCollection();
        $this->fluxs = new ArrayCollection();
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

    /**
     * @return Collection|Flux[]
     */
    public function getFluxs(): Collection
    {
        return $this->fluxs;
    }

    public function addFlux(Flux $flux): self
    {
        if (!$this->fluxs->contains($flux)) {
            $this->fluxs[] = $flux;
            $flux->addSupport($this);
        }

        return $this;
    }

    public function removeFlux(Flux $flux): self
    {
        if ($this->fluxs->contains($flux)) {
            $this->fluxs->removeElement($flux);
            $flux->removeSupport($this);
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
            $objetMetier->setTypesupport($this);
        }

        return $this;
    }

    public function removeObjetMetier(ObjetMetier $objetMetier): self
    {
        if ($this->objetMetiers->contains($objetMetier)) {
            $this->objetMetiers->removeElement($objetMetier);
            // set the owning side to null (unless already changed)
            if ($objetMetier->getTypesupport() === $this) {
                $objetMetier->setTypesupport(null);
            }
        }

        return $this;
    }

  
}
