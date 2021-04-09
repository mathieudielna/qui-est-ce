<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeTierRepository")
 */
class TypeTier
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
     * @ORM\Column(type="string", length=255)
     */
    private $couleur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer", inversedBy="typeTiers")
     */
    private $customer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tier", mappedBy="type")
     */
    private $tiers;

    public function __construct()
    {
        $this->tiers = new ArrayCollection();
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

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

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
     * @return Collection|Tier[]
     */
    public function getTiers(): Collection
    {
        return $this->tiers;
    }

    public function addTier(Tier $tier): self
    {
        if (!$this->tiers->contains($tier)) {
            $this->tiers[] = $tier;
            $tier->setType($this);
        }

        return $this;
    }

    public function removeTier(Tier $tier): self
    {
        if ($this->tiers->contains($tier)) {
            $this->tiers->removeElement($tier);
            // set the owning side to null (unless already changed)
            if ($tier->getType() === $this) {
                $tier->setType(null);
            }
        }

        return $this;
    }
}
