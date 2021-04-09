<?php

namespace App\Entity;

use App\Repository\PcaEvenementServTrackRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PcaEvenementServTrackRepository::class)
 */
class PcaEvenementServTrack
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Systeme::class, inversedBy="pcaEvenementServTracks", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $systeme;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity=PcaEvenement::class, inversedBy="pcaEvenementServTracks", cascade={"persist"})
     */
    private $pcaeve;

    /**
     * @ORM\ManyToOne(targetEntity=Criticite::class, cascade={"persist"})
     */
    private $dima;

    /**
     * @ORM\ManyToOne(targetEntity=Criticite::class)
     * @ORM\JoinColumn(nullable=false), cascade={"persist"}
     */
    private $pdma;

    /**
     * @ORM\ManyToOne(targetEntity=TypeStatutPca::class, cascade={"persist"})
     */
    private $statut;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSysteme(): ?Systeme
    {
        return $this->systeme;
    }

    public function setSysteme(?Systeme $systeme): self
    {
        $this->systeme = $systeme;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getPcaeve(): ?PcaEvenement
    {
        return $this->pcaeve;
    }

    public function setPcaeve(?PcaEvenement $pcaeve): self
    {
        $this->pcaeve = $pcaeve;

        return $this;
    }

    public function getDima(): ?Criticite
    {
        return $this->dima;
    }

    public function setDima(?Criticite $dima): self
    {
        $this->dima = $dima;

        return $this;
    }

    public function getPdma(): ?Criticite
    {
        return $this->pdma;
    }

    public function setPdma(?Criticite $pdma): self
    {
        $this->pdma = $pdma;

        return $this;
    }

    public function getStatut(): ?TypeStatutPca
    {
        return $this->statut;
    }

    public function setStatut(?TypeStatutPca $statut): self
    {
        $this->statut = $statut;

        return $this;
    }
}
