<?php

namespace App\Entity;

use App\Repository\PcaEvenementChronoPrepaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PcaEvenementChronoPrepaRepository::class)
 */
class PcaEvenementChronoPrepa
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
    private $tache;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $TargetedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity=people::class, inversedBy="pcaEvenementChronoPrepas")
     */
    private $responsable;

    /**
     * @ORM\ManyToOne(targetEntity=MapsiCustomer::class, inversedBy="pcaEvenementChronoPrepas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity=Pcaevenement::class, inversedBy="pcaevenementchronoprepa")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pcaevenement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTache(): ?string
    {
        return $this->tache;
    }

    public function setTache(string $tache): self
    {
        $this->tache = $tache;

        return $this;
    }

    public function getTargetedAt(): ?\DateTimeInterface
    {
        return $this->TargetedAt;
    }

    public function setTargetedAt(?\DateTimeInterface $TargetedAt): self
    {
        $this->TargetedAt = $TargetedAt;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getResponsable(): ?people
    {
        return $this->responsable;
    }

    public function setResponsable(?people $responsable): self
    {
        $this->responsable = $responsable;

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

    public function getPcaevenement(): ?Pcaevenement
    {
        return $this->pcaevenement;
    }

    public function setPcaevenement(?Pcaevenement $pcaevenement): self
    {
        $this->pcaevenement = $pcaevenement;

        return $this;
    }
}
