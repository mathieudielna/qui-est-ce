<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CriticiteRepository")
 */
class Criticite
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
     * @ORM\Column(type="string", length=255)
     */
    private $dureeheure;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Activite", mappedBy="dima1")
     */
    private $activites;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Activite", mappedBy="pdma1")
     */
    private $activitespdma;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Systeme", mappedBy="dima")
     */
    private $systemesdima;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Systeme", mappedBy="pdma")
     */
    private $systemespdma;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer")
     */
    private $customer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AppConnectActivite", mappedBy="dima")
     */
    private $appConnectActivites;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AppConnectActivite", mappedBy="pdma")
     */
    private $appConnectActivitespdma;

    /**
     * @ORM\OneToMany(targetEntity=PcaEvenementAppTrack::class, mappedBy="dima")
     */
    private $pcaevenementapptrackdima;

    /**
     * @ORM\OneToMany(targetEntity=PcaEvenementAppTrack::class, mappedBy="pdma")
     */
    private $pcavenementapptrackpdma;



   

    public function __construct()
    {
        $this->activites = new ArrayCollection();
        $this->activitespdma = new ArrayCollection();
        $this->pdma = new ArrayCollection();
        $this->systemes = new ArrayCollection();
        $this->systemesdima = new ArrayCollection();
        $this->systemespdma = new ArrayCollection();
        $this->appConnectActivites = new ArrayCollection();
        $this->appConnectActivitespdma = new ArrayCollection();
        $this->pcaevenementapptrackdima = new ArrayCollection();
        $this->pcavenementapptrackpdma = new ArrayCollection();
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

    public function getDureeheure(): ?string
    {
        return $this->dureeheure;
    }

    public function setDureeheure(string $dureeheure): self
    {
        $this->dureeheure = $dureeheure;

        return $this;
    }

    /**
     * @return Collection|Activite[]
     */
    public function getActivites(): Collection
    {
        return $this->activites;
    }

    public function addActivite(Activite $activite): self
    {
        if (!$this->activites->contains($activite)) {
            $this->activites[] = $activite;
            $activite->setDima1($this);
        }

        return $this;
    }

    public function removeActivite(Activite $activite): self
    {
        if ($this->activites->contains($activite)) {
            $this->activites->removeElement($activite);
            // set the owning side to null (unless already changed)
            if ($activite->getDima1() === $this) {
                $activite->setDima1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Activite[]
     */
    public function getActivitespdma(): Collection
    {
        return $this->activitespdma;
    }

    public function addActivitespdma(Activite $activitespdma): self
    {
        if (!$this->activitespdma->contains($activitespdma)) {
            $this->activitespdma[] = $activitespdma;
            $activitespdma->setPdma1($this);
        }

        return $this;
    }

    public function removeActivitespdma(Activite $activitespdma): self
    {
        if ($this->activitespdma->contains($activitespdma)) {
            $this->activitespdma->removeElement($activitespdma);
            // set the owning side to null (unless already changed)
            if ($activitespdma->getPdma1() === $this) {
                $activitespdma->setPdma1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Systeme[]
     */
    public function getSystemesdima(): Collection
    {
        return $this->systemesdima;
    }

    public function addSystemesdima(Systeme $systemesdima): self
    {
        if (!$this->systemesdima->contains($systemesdima)) {
            $this->systemesdima[] = $systemesdima;
            $systemesdima->setDima($this);
        }

        return $this;
    }

    public function removeSystemesdima(Systeme $systemesdima): self
    {
        if ($this->systemesdima->contains($systemesdima)) {
            $this->systemesdima->removeElement($systemesdima);
            // set the owning side to null (unless already changed)
            if ($systemesdima->getDima() === $this) {
                $systemesdima->setDima(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Systeme[]
     */
    public function getSystemespdma(): Collection
    {
        return $this->systemespdma;
    }

    public function addSystemespdma(Systeme $systemespdma): self
    {
        if (!$this->systemespdma->contains($systemespdma)) {
            $this->systemespdma[] = $systemespdma;
            $systemespdma->setPdma($this);
        }

        return $this;
    }

    public function removeSystemespdma(Systeme $systemespdma): self
    {
        if ($this->systemespdma->contains($systemespdma)) {
            $this->systemespdma->removeElement($systemespdma);
            // set the owning side to null (unless already changed)
            if ($systemespdma->getPdma() === $this) {
                $systemespdma->setPdma(null);
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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection|AppConnectActivite[]
     */
    public function getAppConnectActivites(): Collection
    {
        return $this->appConnectActivites;
    }

    public function addAppConnectActivite(AppConnectActivite $appConnectActivite): self
    {
        if (!$this->appConnectActivites->contains($appConnectActivite)) {
            $this->appConnectActivites[] = $appConnectActivite;
            $appConnectActivite->setDima($this);
        }

        return $this;
    }

    public function removeAppConnectActivite(AppConnectActivite $appConnectActivite): self
    {
        if ($this->appConnectActivites->contains($appConnectActivite)) {
            $this->appConnectActivites->removeElement($appConnectActivite);
            // set the owning side to null (unless already changed)
            if ($appConnectActivite->getDima() === $this) {
                $appConnectActivite->setDima(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AppConnectActivitepdma[]
     */
    public function getAppConnectActivitespdma(): Collection
    {
        return $this->appConnectActivitespdma;
    }

    public function addAppConnectActivitepdma(AppConnectActivite $appConnectActivitepdma): self
    {
        if (!$this->appConnectActivitespdma->contains($appConnectActivitepdma)) {
            $this->appConnectActivitespdma[] = $appConnectActivitepdma;
            $appConnectActivitepdma->setPdma($this);
        }

        return $this;
    }

    public function removeAppConnectActivitepdma(AppConnectActivite $appConnectActivitepdma): self
    {
        if ($this->appConnectActivitespdma->contains($appConnectActivitepdma)) {
            $this->appConnectActivitespdma->removeElement($appConnectActivitepdma);
            // set the owning side to null (unless already changed)
            if ($appConnectActivitepdma->getPdma() === $this) {
                $appConnectActivitepdma->setPdma(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PcaEvenementAppTrack[]
     */
    public function getPcaevenementapptrackdima(): Collection
    {
        return $this->pcaevenementapptrackdima;
    }

    public function addPcaevenementapptrackdima(PcaEvenementAppTrack $pcaevenementapptrackdima): self
    {
        if (!$this->pcaevenementapptrackdima->contains($pcaevenementapptrackdima)) {
            $this->pcaevenementapptrackdima[] = $pcaevenementapptrackdima;
            $pcaevenementapptrackdima->setDima($this);
        }

        return $this;
    }

    public function removePcaevenementapptrackdima(PcaEvenementAppTrack $pcaevenementapptrackdima): self
    {
        if ($this->pcaevenementapptrackdima->contains($pcaevenementapptrackdima)) {
            $this->pcaevenementapptrackdima->removeElement($pcaevenementapptrackdima);
            // set the owning side to null (unless already changed)
            if ($pcaevenementapptrackdima->getDima() === $this) {
                $pcaevenementapptrackdima->setDima(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PcaEvenementAppTrack[]
     */
    public function getPcavenementapptrackpdma(): Collection
    {
        return $this->pcavenementapptrackpdma;
    }

    public function addPcavenementapptrackpdma(PcaEvenementAppTrack $pcavenementapptrackpdma): self
    {
        if (!$this->pcavenementapptrackpdma->contains($pcavenementapptrackpdma)) {
            $this->pcavenementapptrackpdma[] = $pcavenementapptrackpdma;
            $pcavenementapptrackpdma->setPdma($this);
        }

        return $this;
    }

    public function removePcavenementapptrackpdma(PcaEvenementAppTrack $pcavenementapptrackpdma): self
    {
        if ($this->pcavenementapptrackpdma->contains($pcavenementapptrackpdma)) {
            $this->pcavenementapptrackpdma->removeElement($pcavenementapptrackpdma);
            // set the owning side to null (unless already changed)
            if ($pcavenementapptrackpdma->getPdma() === $this) {
                $pcavenementapptrackpdma->setPdma(null);
            }
        }

        return $this;
    }
   }
