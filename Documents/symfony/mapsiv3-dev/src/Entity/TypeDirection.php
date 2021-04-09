<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeDirectionRepository")
 */
class TypeDirection
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
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer")
     */
    private $customer;

    /**
     * @ORM\OneToMany(targetEntity=FluxConnectActivite::class, mappedBy="direction")
     */
    private $fluxConnectActivites;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $code;




    public function __construct()
    {
        $this->fluxConnectActivites = new ArrayCollection();
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
     * @return Collection|FluxConnectActivite[]
     */
    public function getFluxConnectActivites(): Collection
    {
        return $this->fluxConnectActivites;
    }

    public function addFluxConnectActivite(FluxConnectActivite $fluxConnectActivite): self
    {
        if (!$this->fluxConnectActivites->contains($fluxConnectActivite)) {
            $this->fluxConnectActivites[] = $fluxConnectActivite;
            $fluxConnectActivite->setDirection($this);
        }

        return $this;
    }

    public function removeFluxConnectActivite(FluxConnectActivite $fluxConnectActivite): self
    {
        if ($this->fluxConnectActivites->contains($fluxConnectActivite)) {
            $this->fluxConnectActivites->removeElement($fluxConnectActivite);
            // set the owning side to null (unless already changed)
            if ($fluxConnectActivite->getDirection() === $this) {
                $fluxConnectActivite->setDirection(null);
            }
        }

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
 
}
