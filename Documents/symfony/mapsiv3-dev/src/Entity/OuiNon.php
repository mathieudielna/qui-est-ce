<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OuiNonRepository")
 */
class OuiNon
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
     * @ORM\OneToMany(targetEntity="App\Entity\Activite", mappedBy="pca")
     */
    private $activites;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Systeme", mappedBy="secours")
     */
    private $systemessecoursouinon;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flux", mappedBy="transferthorsue")
     */
    private $fluxtransferthorsue;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flux", mappedBy="accordcollecte")
     */
    private $fluxaccordcollecte;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flux", mappedBy="accordutilisation")
     */
    private $fluxaccordutilisation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flux", mappedBy="dcpsstraitant")
     */
    private $fluxdcpsstraitant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer")
     */
    private $customer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flux", mappedBy="dpia")
     */
    private $dpiafluxes;


    public function __construct()
    {
        $this->activites = new ArrayCollection();
        $this->systemessecoursouinon = new ArrayCollection();
        $this->fluxtransferthorsue = new ArrayCollection();
        $this->fluxaccordcollecte = new ArrayCollection();
        $this->fluxaccordutilisation = new ArrayCollection();
        $this->fluxdcpsstraitant = new ArrayCollection();
        $this->dpiafluxes = new ArrayCollection();
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
            $activite->setPca($this);
        }

        return $this;
    }

    public function removeActivite(Activite $activite): self
    {
        if ($this->activites->contains($activite)) {
            $this->activites->removeElement($activite);
            // set the owning side to null (unless already changed)
            if ($activite->getPca() === $this) {
                $activite->setPca(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Systeme[]
     */
    public function getSystemessecoursouinon(): Collection
    {
        return $this->systemessecoursouinon;
    }

    public function addSystemessecoursouinon(Systeme $systemessecoursouinon): self
    {
        if (!$this->systemessecoursouinon->contains($systemessecoursouinon)) {
            $this->systemessecoursouinon[] = $systemessecoursouinon;
            $systemessecoursouinon->setSecours($this);
        }

        return $this;
    }

    public function removeSystemessecoursouinon(Systeme $systemessecoursouinon): self
    {
        if ($this->systemessecoursouinon->contains($systemessecoursouinon)) {
            $this->systemessecoursouinon->removeElement($systemessecoursouinon);
            // set the owning side to null (unless already changed)
            if ($systemessecoursouinon->getSecours() === $this) {
                $systemessecoursouinon->setSecours(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection|Flux[]
     */
    public function getFluxtransferthorsue(): Collection
    {
        return $this->fluxtransferthorsue;
    }

    public function addFluxtransferthorsue(Flux $fluxtransferthorsue): self
    {
        if (!$this->fluxtransferthorsue->contains($fluxtransferthorsue)) {
            $this->fluxtransferthorsue[] = $fluxtransferthorsue;
            $fluxtransferthorsue->setTransferthorsue($this);
        }

        return $this;
    }

    public function removeFluxtransferthorsue(Flux $fluxtransferthorsue): self
    {
        if ($this->fluxtransferthorsue->contains($fluxtransferthorsue)) {
            $this->fluxtransferthorsue->removeElement($fluxtransferthorsue);
            // set the owning side to null (unless already changed)
            if ($fluxtransferthorsue->getTransferthorsue() === $this) {
                $fluxtransferthorsue->setTransferthorsue(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Flux[]
     */
    public function getFluxaccordcollecte(): Collection
    {
        return $this->fluxaccordcollecte;
    }

    public function addFluxaccordcollecte(Flux $fluxaccordcollecte): self
    {
        if (!$this->fluxaccordcollecte->contains($fluxaccordcollecte)) {
            $this->fluxaccordcollecte[] = $fluxaccordcollecte;
            $fluxaccordcollecte->setAccordcollecte($this);
        }

        return $this;
    }

    public function removeFluxaccordcollecte(Flux $fluxaccordcollecte): self
    {
        if ($this->fluxaccordcollecte->contains($fluxaccordcollecte)) {
            $this->fluxaccordcollecte->removeElement($fluxaccordcollecte);
            // set the owning side to null (unless already changed)
            if ($fluxaccordcollecte->getAccordcollecte() === $this) {
                $fluxaccordcollecte->setAccordcollecte(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Flux[]
     */
    public function getFluxaccordutilisation(): Collection
    {
        return $this->fluxaccordutilisation;
    }

    public function addFluxaccordutilisation(Flux $fluxaccordutilisation): self
    {
        if (!$this->fluxaccordutilisation->contains($fluxaccordutilisation)) {
            $this->fluxaccordutilisation[] = $fluxaccordutilisation;
            $fluxaccordutilisation->setAccordutilisation($this);
        }

        return $this;
    }

    public function removeFluxaccordutilisation(Flux $fluxaccordutilisation): self
    {
        if ($this->fluxaccordutilisation->contains($fluxaccordutilisation)) {
            $this->fluxaccordutilisation->removeElement($fluxaccordutilisation);
            // set the owning side to null (unless already changed)
            if ($fluxaccordutilisation->getAccordutilisation() === $this) {
                $fluxaccordutilisation->setAccordutilisation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Flux[]
     */
    public function getFluxdcpsstraitant(): Collection
    {
        return $this->fluxdcpsstraitant;
    }

    public function addFluxdcpsstraitant(Flux $fluxdcpsstraitant): self
    {
        if (!$this->fluxdcpsstraitant->contains($fluxdcpsstraitant)) {
            $this->fluxdcpsstraitant[] = $fluxdcpsstraitant;
            $fluxdcpsstraitant->setDcpsstraitant($this);
        }

        return $this;
    }

    public function removeFluxdcpsstraitant(Flux $fluxdcpsstraitant): self
    {
        if ($this->fluxdcpsstraitant->contains($fluxdcpsstraitant)) {
            $this->fluxdcpsstraitant->removeElement($fluxdcpsstraitant);
            // set the owning side to null (unless already changed)
            if ($fluxdcpsstraitant->getDcpsstraitant() === $this) {
                $fluxdcpsstraitant->setDcpsstraitant(null);
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

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection|Flux[]
     */
    public function getDpiafluxes(): Collection
    {
        return $this->dpiafluxes;
    }

    public function addDpiaflux(Flux $dpiaflux): self
    {
        if (!$this->dpiafluxes->contains($dpiaflux)) {
            $this->dpiafluxes[] = $dpiaflux;
            $dpiaflux->setDpia($this);
        }

        return $this;
    }

    public function removeDpiaflux(Flux $dpiaflux): self
    {
        if ($this->dpiafluxes->contains($dpiaflux)) {
            $this->dpiafluxes->removeElement($dpiaflux);
            // set the owning side to null (unless already changed)
            if ($dpiaflux->getDpia() === $this) {
                $dpiaflux->setDpia(null);
            }
        }

        return $this;
    }

}
