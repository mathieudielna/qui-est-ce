<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DataRepository")
 */
class Data
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
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer", inversedBy="data")
     */
    private $customer;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ObjetMetier", mappedBy="datas")
     */
    private $objetMetiers;

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
            $objetMetier->addData($this);
        }

        return $this;
    }

    public function removeObjetMetier(ObjetMetier $objetMetier): self
    {
        if ($this->objetMetiers->contains($objetMetier)) {
            $this->objetMetiers->removeElement($objetMetier);
            $objetMetier->removeData($this);
        }

        return $this;
    }
}
