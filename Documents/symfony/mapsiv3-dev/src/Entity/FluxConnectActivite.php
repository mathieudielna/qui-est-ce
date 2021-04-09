<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FluxConnectActiviteRepository")
 */
class FluxConnectActivite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Flux", inversedBy="fluxConnectActivites", cascade={"persist"})
     */
    private $flux;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Activite", inversedBy="fluxConnectActivites", cascade={"persist"})
     */
    private $activite;

    /**
     * @ORM\ManyToOne(targetEntity=TypeDirection::class, inversedBy="fluxConnectActivites")
     */
    private $direction;



    public function __construct()
    {
     
    }

    public function getFlux(): ?Flux
    {
        return $this->flux;
    }

    public function setFlux(?Flux $flux): self
    {
        $this->flux = $flux;

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

    public function getDirection(): ?TypeDirection
    {
        return $this->direction;
    }

    public function setDirection(?TypeDirection $direction): self
    {
        $this->direction = $direction;

        return $this;
    }

  
}
