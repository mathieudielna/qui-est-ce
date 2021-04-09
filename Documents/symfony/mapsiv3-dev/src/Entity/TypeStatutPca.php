<?php

namespace App\Entity;

use App\Repository\TypeStatutPcaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeStatutPcaRepository::class)
 */
class TypeStatutPca
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
     * @ORM\ManyToOne(targetEntity=MapsiCustomer::class, inversedBy="typeStatutPcas")
     */
    private $customer;

    /**
     * @ORM\OneToMany(targetEntity=PcaEvenementAppTrack::class, mappedBy="statut")
     */
    private $pcaEvenementAppTracks;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    public function __construct()
    {
        $this->pcaEvenementAppTracks = new ArrayCollection();
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
     * @return Collection|PcaEvenementAppTrack[]
     */
    public function getPcaEvenementAppTracks(): Collection
    {
        return $this->pcaEvenementAppTracks;
    }

    public function addPcaEvenementAppTrack(PcaEvenementAppTrack $pcaEvenementAppTrack): self
    {
        if (!$this->pcaEvenementAppTracks->contains($pcaEvenementAppTrack)) {
            $this->pcaEvenementAppTracks[] = $pcaEvenementAppTrack;
            $pcaEvenementAppTrack->setStatut($this);
        }

        return $this;
    }

    public function removePcaEvenementAppTrack(PcaEvenementAppTrack $pcaEvenementAppTrack): self
    {
        if ($this->pcaEvenementAppTracks->contains($pcaEvenementAppTrack)) {
            $this->pcaEvenementAppTracks->removeElement($pcaEvenementAppTrack);
            // set the owning side to null (unless already changed)
            if ($pcaEvenementAppTrack->getStatut() === $this) {
                $pcaEvenementAppTrack->setStatut(null);
            }
        }

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
}
