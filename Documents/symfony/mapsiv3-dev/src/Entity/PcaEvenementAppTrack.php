<?php

namespace App\Entity;

use App\Repository\PcaEvenementAppTrackRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PcaEvenementAppTrackRepository::class)
 */
class PcaEvenementAppTrack
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Application::class, inversedBy="pcaEvenementAppTracks", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Application;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Commentaire;

    /**
     * @ORM\ManyToOne(targetEntity=PcaEvenement::class, inversedBy="AppTrack", cascade={"persist"})
     */
    private $PcaEve;

    /**
     * @ORM\ManyToOne(targetEntity=Criticite::class, inversedBy="pcaevenementapptrackdima")
     */
    private $dima;

    /**
     * @ORM\ManyToOne(targetEntity=Criticite::class, inversedBy="pcavenementapptrackpdma")
     */
    private $pdma;

    /**
     * @ORM\ManyToOne(targetEntity=TypeStatutPca::class, inversedBy="pcaEvenementAppTracks")
     */
    private $statut;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getApplication(): ?Application
    {
        return $this->Application;
    }

    public function setApplication(?Application $Application): self
    {
        $this->Application = $Application;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->Commentaire;
    }

    public function setCommentaire(?string $Commentaire): self
    {
        $this->Commentaire = $Commentaire;

        return $this;
    }

    public function getPcaEve(): ?PcaEvenement
    {
        return $this->PcaEve;
    }

    public function setPcaEve(?PcaEvenement $PcaEve): self
    {
        $this->PcaEve = $PcaEve;

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
