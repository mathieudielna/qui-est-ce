<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NiveauImpactRepository")
 */
class NiveauImpact
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
     * @ORM\OneToMany(targetEntity="App\Entity\Activite", mappedBy="impactimg")
     */
    private $activites;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Activite", mappedBy="impactactionnaire")
     */
    private $activitesimpactactionnaire;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Activite", mappedBy="ImpactInterne")
     */
    private $activitesimpactinterne;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Activite", mappedBy="ActiviteBusinessfutur")
     */
    private $activitesbusinessfutur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Activite", mappedBy="impact4h")
     */
    private $Impact4h;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Activite", mappedBy="impact1j")
     */
    private $impact1j;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Activite", mappedBy="impact3j")
     */
    private $impact3j;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Activite", mappedBy="impact1s")
     */
    private $impact1s;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Activite", mappedBy="impact2s")
     */
    private $impact2s;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Activite", mappedBy="impact1m")
     */
    private $impact1m;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer")
     */
    private $customer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Activite", mappedBy="impactcollaborateur")
     */
    private $activitesimpactcollaborateurs;


    public function __construct()
    {
        $this->activites = new ArrayCollection();
        $this->activitesimpactactionnaire = new ArrayCollection();
        $this->activitesimpactinterne = new ArrayCollection();
        $this->activitesbusinessfutur = new ArrayCollection();
        $this->Impact4h = new ArrayCollection();
        $this->impact1j = new ArrayCollection();
        $this->impact3j = new ArrayCollection();
        $this->impact1s = new ArrayCollection();
        $this->impact2s = new ArrayCollection();
        $this->impact1m = new ArrayCollection();
        $this->activitesimpactcollaborateurs = new ArrayCollection();
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
     * @return Collection|Activite[]
     */
    public function getActivitesimpactactionnaire(): Collection
    {
        return $this->activitesimpactactionnaire;
    }

    public function addActivitesimpactactionnaire(Activite $activitesimpactactionnaire): self
    {
        if (!$this->activitesimpactactionnaire->contains($activitesimpactactionnaire)) {
            $this->activitesimpactactionnaire[] = $activitesimpactactionnaire;
            $activitesimpactactionnaire->setImpactactionnaire($this);
        }

        return $this;
    }

    public function removeActivitesimpactactionnaire(Activite $activitesimpactactionnaire): self
    {
        if ($this->activitesimpactactionnaire->contains($activitesimpactactionnaire)) {
            $this->activitesimpactactionnaire->removeElement($activitesimpactactionnaire);
            // set the owning side to null (unless already changed)
            if ($activitesimpactactionnaire->getImpactactionnaire() === $this) {
                $activitesimpactactionnaire->setImpactactionnaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Activite[]
     */
    public function getActivitesimpactinterne(): Collection
    {
        return $this->activitesimpactinterne;
    }

    public function addActivitesimpactinterne(Activite $activitesimpactinterne): self
    {
        if (!$this->activitesimpactinterne->contains($activitesimpactinterne)) {
            $this->activitesimpactinterne[] = $activitesimpactinterne;
            $activitesimpactinterne->setImpactInterne($this);
        }

        return $this;
    }

    public function removeActivitesimpactinterne(Activite $activitesimpactinterne): self
    {
        if ($this->activitesimpactinterne->contains($activitesimpactinterne)) {
            $this->activitesimpactinterne->removeElement($activitesimpactinterne);
            // set the owning side to null (unless already changed)
            if ($activitesimpactinterne->getImpactInterne() === $this) {
                $activitesimpactinterne->setImpactInterne(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Activite[]
     */
    public function getActivitesbusinessfutur(): Collection
    {
        return $this->activitesbusinessfutur;
    }

    public function addActivitesbusinessfutur(Activite $activitesbusinessfutur): self
    {
        if (!$this->activitesbusinessfutur->contains($activitesbusinessfutur)) {
            $this->activitesbusinessfutur[] = $activitesbusinessfutur;
            $activitesbusinessfutur->setActiviteBusinessfutur($this);
        }

        return $this;
    }

    public function removeActivitesbusinessfutur(Activite $activitesbusinessfutur): self
    {
        if ($this->activitesbusinessfutur->contains($activitesbusinessfutur)) {
            $this->activitesbusinessfutur->removeElement($activitesbusinessfutur);
            // set the owning side to null (unless already changed)
            if ($activitesbusinessfutur->getActiviteBusinessfutur() === $this) {
                $activitesbusinessfutur->setActiviteBusinessfutur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Activite[]
     */
    public function getImpact4h(): Collection
    {
        return $this->Impact4h;
    }

    public function addImpact4h(Activite $impact4h): self
    {
        if (!$this->Impact4h->contains($impact4h)) {
            $this->Impact4h[] = $impact4h;
            $impact4h->setImpact4h($this);
        }

        return $this;
    }

    public function removeImpact4h(Activite $impact4h): self
    {
        if ($this->Impact4h->contains($impact4h)) {
            $this->Impact4h->removeElement($impact4h);
            // set the owning side to null (unless already changed)
            if ($impact4h->getImpact4h() === $this) {
                $impact4h->setImpact4h(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Activite[]
     */
    public function getImpact1j(): Collection
    {
        return $this->impact1j;
    }

    public function addImpact1j(Activite $impact1j): self
    {
        if (!$this->impact1j->contains($impact1j)) {
            $this->impact1j[] = $impact1j;
            $impact1j->setImpact1j($this);
        }

        return $this;
    }

    public function removeImpact1j(Activite $impact1j): self
    {
        if ($this->impact1j->contains($impact1j)) {
            $this->impact1j->removeElement($impact1j);
            // set the owning side to null (unless already changed)
            if ($impact1j->getImpact1j() === $this) {
                $impact1j->setImpact1j(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Activite[]
     */
    public function getImpact3j(): Collection
    {
        return $this->impact3j;
    }

    public function addImpact3j(Activite $impact3j): self
    {
        if (!$this->impact3j->contains($impact3j)) {
            $this->impact3j[] = $impact3j;
            $impact3j->setImpact3j($this);
        }

        return $this;
    }

    public function removeImpact3j(Activite $impact3j): self
    {
        if ($this->impact3j->contains($impact3j)) {
            $this->impact3j->removeElement($impact3j);
            // set the owning side to null (unless already changed)
            if ($impact3j->getImpact3j() === $this) {
                $impact3j->setImpact3j(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Activite[]
     */
    public function getImpact1s(): Collection
    {
        return $this->impact1s;
    }

    public function addImpact1(Activite $impact1): self
    {
        if (!$this->impact1s->contains($impact1)) {
            $this->impact1s[] = $impact1;
            $impact1->setImpact1s($this);
        }

        return $this;
    }

    public function removeImpact1(Activite $impact1): self
    {
        if ($this->impact1s->contains($impact1)) {
            $this->impact1s->removeElement($impact1);
            // set the owning side to null (unless already changed)
            if ($impact1->getImpact1s() === $this) {
                $impact1->setImpact1s(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Activite[]
     */
    public function getImpact2s(): Collection
    {
        return $this->impact2s;
    }

    public function addImpact2(Activite $impact2): self
    {
        if (!$this->impact2s->contains($impact2)) {
            $this->impact2s[] = $impact2;
            $impact2->setImpact2s($this);
        }

        return $this;
    }

    public function removeImpact2(Activite $impact2): self
    {
        if ($this->impact2s->contains($impact2)) {
            $this->impact2s->removeElement($impact2);
            // set the owning side to null (unless already changed)
            if ($impact2->getImpact2s() === $this) {
                $impact2->setImpact2s(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Activite[]
     */
    public function getImpact1m(): Collection
    {
        return $this->impact1m;
    }

    public function addImpact1m(Activite $impact1m): self
    {
        if (!$this->impact1m->contains($impact1m)) {
            $this->impact1m[] = $impact1m;
            $impact1m->setImpact1m($this);
        }

        return $this;
    }

    public function removeImpact1m(Activite $impact1m): self
    {
        if ($this->impact1m->contains($impact1m)) {
            $this->impact1m->removeElement($impact1m);
            // set the owning side to null (unless already changed)
            if ($impact1m->getImpact1m() === $this) {
                $impact1m->setImpact1m(null);
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
     * @return Collection|Activite[]
     */
    public function getActivitesimpactcollaborateurs(): Collection
    {
        return $this->activitesimpactcollaborateurs;
    }

    public function addActivitesimpactcollaborateur(Activite $activitesimpactcollaborateur): self
    {
        if (!$this->activitesimpactcollaborateurs->contains($activitesimpactcollaborateur)) {
            $this->activitesimpactcollaborateurs[] = $activitesimpactcollaborateur;
            $activitesimpactcollaborateur->setImpactcollaborateur($this);
        }

        return $this;
    }

    public function removeActivitesimpactcollaborateur(Activite $activitesimpactcollaborateur): self
    {
        if ($this->activitesimpactcollaborateurs->contains($activitesimpactcollaborateur)) {
            $this->activitesimpactcollaborateurs->removeElement($activitesimpactcollaborateur);
            // set the owning side to null (unless already changed)
            if ($activitesimpactcollaborateur->getImpactcollaborateur() === $this) {
                $activitesimpactcollaborateur->setImpactcollaborateur(null);
            }
        }

        return $this;
    }

}
