<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeAxevoletRepository")
 */
class TypeAxevolet
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
     * @ORM\OneToMany(targetEntity="App\Entity\Axe", mappedBy="volet")
     */
    private $axes;

    public function __construct()
    {
        $this->axes = new ArrayCollection();
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
     * @return Collection|Axe[]
     */
    public function getAxes(): Collection
    {
        return $this->axes;
    }

    public function addAxe(Axe $axe): self
    {
        if (!$this->axes->contains($axe)) {
            $this->axes[] = $axe;
            $axe->setVolet($this);
        }

        return $this;
    }

    public function removeAxe(Axe $axe): self
    {
        if ($this->axes->contains($axe)) {
            $this->axes->removeElement($axe);
            // set the owning side to null (unless already changed)
            if ($axe->getVolet() === $this) {
                $axe->setVolet(null);
            }
        }

        return $this;
    }
}
