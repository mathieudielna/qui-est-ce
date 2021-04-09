<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeRagRepository")
 */
class TypeRag
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
    private $color;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $icon;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer", inversedBy="typeRags")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\JalonConnectAction", mappedBy="rag")
     */
    private $jalonConnectActions;

    public function __construct()
    {
        $this->jalonConnectActions = new ArrayCollection();
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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

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
     * @return Collection|JalonConnectAction[]
     */
    public function getJalonConnectActions(): Collection
    {
        return $this->jalonConnectActions;
    }

    public function addJalonConnectAction(JalonConnectAction $jalonConnectAction): self
    {
        if (!$this->jalonConnectActions->contains($jalonConnectAction)) {
            $this->jalonConnectActions[] = $jalonConnectAction;
            $jalonConnectAction->setRag($this);
        }

        return $this;
    }

    public function removeJalonConnectAction(JalonConnectAction $jalonConnectAction): self
    {
        if ($this->jalonConnectActions->contains($jalonConnectAction)) {
            $this->jalonConnectActions->removeElement($jalonConnectAction);
            // set the owning side to null (unless already changed)
            if ($jalonConnectAction->getRag() === $this) {
                $jalonConnectAction->setRag(null);
            }
        }

        return $this;
    }
}
