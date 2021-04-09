<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeConformiteRepository")
 */
class TypeConformite
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Action", mappedBy="typeconformite")
     */
    private $actions;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer")
     */
    private $customer;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Risque", mappedBy="typeconformite")
     */
    private $risques;

    /**
     * @ORM\ManyToMany(targetEntity=Audit::class, mappedBy="typeconformite")
     */
    private $auditstypeconformite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity=Dysfonctionnement::class, mappedBy="typeconformite")
     */
    private $dysfonctionnements;

    /**
     * @ORM\ManyToMany(targetEntity=VisiteSite::class, mappedBy="typeconformite")
     */
    private $visitesitestypeconformite;

    /**
     * @ORM\ManyToMany(targetEntity=Reclamation::class, mappedBy="typeconformite")
     */
    private $reclamationstypeconfo;

    /**
     * @ORM\ManyToMany(targetEntity=Evenement::class, mappedBy="typeconformite")
     */
    private $evenements;

    /**
     * @ORM\ManyToMany(targetEntity=Controle::class, mappedBy="typeconformite")
     */
    private $controles;

    /**
     * @ORM\ManyToMany(targetEntity=Objectif::class, mappedBy="typeconformites")
     */
    private $objectifs;

    public function __construct()
    {
        $this->actions = new ArrayCollection();
        $this->risques = new ArrayCollection();
        $this->auditstypeconformite = new ArrayCollection();
        $this->dysfonctionnements = new ArrayCollection();
        $this->visitesitestypeconformite = new ArrayCollection();
        $this->reclamationstypeconfo = new ArrayCollection();
        $this->evenements = new ArrayCollection();
        $this->controles = new ArrayCollection();
        $this->objectifs = new ArrayCollection();
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

    /**
     * @return Collection|Action[]
     */
    public function getActions(): Collection
    {
        return $this->actions;
    }

    public function addAction(Action $action): self
    {
        if (!$this->actions->contains($action)) {
            $this->actions[] = $action;
            $action->addTypeconformite($this);
        }

        return $this;
    }

    public function removeAction(Action $action): self
    {
        if ($this->actions->contains($action)) {
            $this->actions->removeElement($action);
            $action->removeTypeconformite($this);
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

    /**
     * @return Collection|Risque[]
     */
    public function getRisques(): Collection
    {
        return $this->risques;
    }

    public function addRisque(Risque $risque): self
    {
        if (!$this->risques->contains($risque)) {
            $this->risques[] = $risque;
            $risque->addTypeconformite($this);
        }

        return $this;
    }

    public function removeRisque(Risque $risque): self
    {
        if ($this->risques->contains($risque)) {
            $this->risques->removeElement($risque);
            $risque->removeTypeconformite($this);
        }

        return $this;
    }

    /**
     * @return Collection|Audit[]
     */
    public function getAuditstypeconformite(): Collection
    {
        return $this->auditstypeconformite;
    }

    public function addAuditstypeconformite(Audit $auditstypeconformite): self
    {
        if (!$this->auditstypeconformite->contains($auditstypeconformite)) {
            $this->auditstypeconformite[] = $auditstypeconformite;
            $auditstypeconformite->addTypeconformite($this);
        }

        return $this;
    }

    public function removeAuditstypeconformite(Audit $auditstypeconformite): self
    {
        if ($this->auditstypeconformite->removeElement($auditstypeconformite)) {
            $auditstypeconformite->removeTypeconformite($this);
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Dysfonctionnement[]
     */
    public function getDysfonctionnements(): Collection
    {
        return $this->dysfonctionnements;
    }

    public function addDysfonctionnement(Dysfonctionnement $dysfonctionnement): self
    {
        if (!$this->dysfonctionnements->contains($dysfonctionnement)) {
            $this->dysfonctionnements[] = $dysfonctionnement;
            $dysfonctionnement->addTypeconformite($this);
        }

        return $this;
    }

    public function removeDysfonctionnement(Dysfonctionnement $dysfonctionnement): self
    {
        if ($this->dysfonctionnements->removeElement($dysfonctionnement)) {
            $dysfonctionnement->removeTypeconformite($this);
        }

        return $this;
    }

    /**
     * @return Collection|VisiteSite[]
     */
    public function getVisitesitestypeconformite(): Collection
    {
        return $this->visitesitestypeconformite;
    }

    public function addVisitesitestypeconformite(VisiteSite $visitesitestypeconformite): self
    {
        if (!$this->visitesitestypeconformite->contains($visitesitestypeconformite)) {
            $this->visitesitestypeconformite[] = $visitesitestypeconformite;
            $visitesitestypeconformite->addTypeconformite($this);
        }

        return $this;
    }

    public function removeVisitesitestypeconformite(VisiteSite $visitesitestypeconformite): self
    {
        if ($this->visitesitestypeconformite->removeElement($visitesitestypeconformite)) {
            $visitesitestypeconformite->removeTypeconformite($this);
        }

        return $this;
    }



    /**
     * @return Collection|Reclamation[]
     */
    public function getReclamationstypeconfo(): Collection
    {
        return $this->reclamationstypeconfo;
    }

    public function addReclamationstypeconfo(Reclamation $reclamationstypeconfo): self
    {
        if (!$this->reclamationstypeconfo->contains($reclamationstypeconfo)) {
            $this->reclamationstypeconfo[] = $reclamationstypeconfo;
            $reclamationstypeconfo->addTypeconformite($this);
        }

        return $this;
    }

    public function removeReclamationstypeconfo(Reclamation $reclamationstypeconfo): self
    {
        if ($this->reclamationstypeconfo->removeElement($reclamationstypeconfo)) {
            $reclamationstypeconfo->removeTypeconformite($this);
        }

        return $this;
    }

    /**
     * @return Collection|Evenement[]
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    public function addEvenement(Evenement $evenement): self
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements[] = $evenement;
            $evenement->addTypeconformite($this);
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): self
    {
        if ($this->evenements->removeElement($evenement)) {
            $evenement->removeTypeconformite($this);
        }

        return $this;
    }

    /**
     * @return Collection|Controle[]
     */
    public function getControles(): Collection
    {
        return $this->controles;
    }

    public function addControle(Controle $controle): self
    {
        if (!$this->controles->contains($controle)) {
            $this->controles[] = $controle;
            $controle->addTypeconformite($this);
        }

        return $this;
    }

    public function removeControle(Controle $controle): self
    {
        if ($this->controles->removeElement($controle)) {
            $controle->removeTypeconformite($this);
        }

        return $this;
    }

    /**
     * @return Collection|Objectif[]
     */
    public function getObjectifs(): Collection
    {
        return $this->objectifs;
    }

    public function addObjectif(Objectif $objectif): self
    {
        if (!$this->objectifs->contains($objectif)) {
            $this->objectifs[] = $objectif;
            $objectif->addTypeconformite($this);
        }

        return $this;
    }

    public function removeObjectif(Objectif $objectif): self
    {
        if ($this->objectifs->removeElement($objectif)) {
            $objectif->removeTypeconformite($this);
        }

        return $this;
    }
}
