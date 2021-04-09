<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeStatutrgpdRepository")
 */
class TypeStatutrgpd
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
     * @ORM\OneToMany(targetEntity="App\Entity\Flux", mappedBy="statutrgpd")
     */
    private $fluxes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer")
     */
    private $customer;

    /**
     * @ORM\OneToMany(targetEntity=ObjetMetier::class, mappedBy="statutrgpd")
     */
    private $objetMetiers;

    public function __construct()
    {
        $this->fluxes = new ArrayCollection();
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
    public function getFluxes(): Collection
    {
        return $this->fluxes;
    }

    public function addFlux(Flux $flux): self
    {
        if (!$this->fluxes->contains($flux)) {
            $this->fluxes[] = $flux;
            $flux->setStatutrgpd($this);
        }

        return $this;
    }

    public function removeFlux(Flux $flux): self
    {
        if ($this->fluxes->contains($flux)) {
            $this->fluxes->removeElement($flux);
            // set the owning side to null (unless already changed)
            if ($flux->getStatutrgpd() === $this) {
                $flux->setStatutrgpd(null);
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
            $objetMetier->setStatut($this);
        }

        return $this;
    }

    public function removeObjetMetier(ObjetMetier $objetMetier): self
    {
        if ($this->objetMetiers->contains($objetMetier)) {
            $this->objetMetiers->removeElement($objetMetier);
            // set the owning side to null (unless already changed)
            if ($objetMetier->getStatut() === $this) {
                $objetMetier->setStatut(null);
            }
        }

        return $this;
    }
}
