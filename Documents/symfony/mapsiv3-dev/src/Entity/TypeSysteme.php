<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeSystemeRepository")
 */
class TypeSysteme
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $designation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Systeme", mappedBy="typesysteme")
     */
    private $systemes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer")
     */
    private $customer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;


    public function __construct()
    {
        $this->systemes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(?string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * @return Collection|Systeme[]
     */
    public function getSystemes(): Collection
    {
        return $this->systemes;
    }

    public function addSysteme(Systeme $systeme): self
    {
        if (!$this->systemes->contains($systeme)) {
            $this->systemes[] = $systeme;
            $systeme->setTypesysteme($this);
        }

        return $this;
    }

    public function removeSysteme(Systeme $systeme): self
    {
        if ($this->systemes->contains($systeme)) {
            $this->systemes->removeElement($systeme);
            // set the owning side to null (unless already changed)
            if ($systeme->getTypesysteme() === $this) {
                $systeme->setTypesysteme(null);
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

}
