<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeStatutRepository")
 */
class TypeStatut
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer")
     */
    private $customer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RgpdAccess", mappedBy="statut")
     */
    private $rgpdAccesses;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RgpdViolation", mappedBy="statut")
     */
    private $rgpdViolations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RgpdAudit", mappedBy="statut")
     */
    private $rgpdAudits;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PcaEvenement", mappedBy="statut")
     */
    private $pcaEvenements;

    /**
     * @ORM\OneToMany(targetEntity=Anomalie::class, mappedBy="statut")
     */
    private $anomalies;


	 public function __toString()
    {
        return $this->designation;
    }

    public function __construct()
    {
        $this->actions = new ArrayCollection();
        $this->rgpdAccesses = new ArrayCollection();
        $this->rgpdViolations = new ArrayCollection();
        $this->rgpdAudits = new ArrayCollection();
        $this->pcaEvenements = new ArrayCollection();
        $this->anomalies = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function setColor(string $color): self
    {
        $this->color = $color;

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

    /**
     * @return Collection|RgpdAccess[]
     */
    public function getRgpdAccesses(): Collection
    {
        return $this->rgpdAccesses;
    }

    public function addRgpdAccess(RgpdAccess $rgpdAccess): self
    {
        if (!$this->rgpdAccesses->contains($rgpdAccess)) {
            $this->rgpdAccesses[] = $rgpdAccess;
            $rgpdAccess->setStatut($this);
        }

        return $this;
    }

    public function removeRgpdAccess(RgpdAccess $rgpdAccess): self
    {
        if ($this->rgpdAccesses->contains($rgpdAccess)) {
            $this->rgpdAccesses->removeElement($rgpdAccess);
            // set the owning side to null (unless already changed)
            if ($rgpdAccess->getStatut() === $this) {
                $rgpdAccess->setStatut(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RgpdViolation[]
     */
    public function getRgpdViolations(): Collection
    {
        return $this->rgpdViolations;
    }

    public function addRgpdViolation(RgpdViolation $rgpdViolation): self
    {
        if (!$this->rgpdViolations->contains($rgpdViolation)) {
            $this->rgpdViolations[] = $rgpdViolation;
            $rgpdViolation->setStatut($this);
        }

        return $this;
    }

    public function removeRgpdViolation(RgpdViolation $rgpdViolation): self
    {
        if ($this->rgpdViolations->contains($rgpdViolation)) {
            $this->rgpdViolations->removeElement($rgpdViolation);
            // set the owning side to null (unless already changed)
            if ($rgpdViolation->getStatut() === $this) {
                $rgpdViolation->setStatut(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RgpdAudit[]
     */
    public function getRgpdAudits(): Collection
    {
        return $this->rgpdAudits;
    }

    public function addRgpdAudit(RgpdAudit $rgpdAudit): self
    {
        if (!$this->rgpdAudits->contains($rgpdAudit)) {
            $this->rgpdAudits[] = $rgpdAudit;
            $rgpdAudit->setStatut($this);
        }

        return $this;
    }

    public function removeRgpdAudit(RgpdAudit $rgpdAudit): self
    {
        if ($this->rgpdAudits->contains($rgpdAudit)) {
            $this->rgpdAudits->removeElement($rgpdAudit);
            // set the owning side to null (unless already changed)
            if ($rgpdAudit->getStatut() === $this) {
                $rgpdAudit->setStatut(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PcaEvenement[]
     */
    public function getPcaEvenements(): Collection
    {
        return $this->pcaEvenements;
    }

    public function addPcaEvenement(PcaEvenement $pcaEvenement): self
    {
        if (!$this->pcaEvenements->contains($pcaEvenement)) {
            $this->pcaEvenements[] = $pcaEvenement;
            $pcaEvenement->setStatut($this);
        }

        return $this;
    }

    public function removePcaEvenement(PcaEvenement $pcaEvenement): self
    {
        if ($this->pcaEvenements->contains($pcaEvenement)) {
            $this->pcaEvenements->removeElement($pcaEvenement);
            // set the owning side to null (unless already changed)
            if ($pcaEvenement->getStatut() === $this) {
                $pcaEvenement->setStatut(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Anomalie[]
     */
    public function getAnomalies(): Collection
    {
        return $this->anomalies;
    }

    public function addAnomaly(Anomalie $anomaly): self
    {
        if (!$this->anomalies->contains($anomaly)) {
            $this->anomalies[] = $anomaly;
            $anomaly->setStatut($this);
        }

        return $this;
    }

    public function removeAnomaly(Anomalie $anomaly): self
    {
        if ($this->anomalies->contains($anomaly)) {
            $this->anomalies->removeElement($anomaly);
            // set the owning side to null (unless already changed)
            if ($anomaly->getStatut() === $this) {
                $anomaly->setStatut(null);
            }
        }

        return $this;
    }


}
