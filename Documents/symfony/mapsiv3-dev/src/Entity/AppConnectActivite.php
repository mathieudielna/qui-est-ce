<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AppConnectActiviteRepository")
 */
class AppConnectActivite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Application", inversedBy="appConnectActivites", cascade={"persist"})
     */
    private $application;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Activite", inversedBy="appConnectActivites", cascade={"persist"})
     */
    private $activite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Criticite", inversedBy="appConnectActivites", cascade={"persist"})
     */
    private $dima;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Criticite", inversedBy="appConnectActivitespdma", cascade={"persist"})
     */
    private $pdma;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApplication(): ?Application
    {
        return $this->application;
    }

    public function setApplication(?Application $application): self
    {
        $this->application = $application;

        return $this;
    }

    public function getActivite(): ?Activite
    {
        return $this->activite;
    }

    public function setActivite(?Activite $activite): self
    {
        $this->activite = $activite;

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
}
