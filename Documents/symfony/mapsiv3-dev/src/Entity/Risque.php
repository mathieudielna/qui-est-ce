<?php

namespace App\Entity;
use App\Entity\Action;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\ChoiceList\Loader\ChoiceLoaderInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RisqueRepository")
 */
class Risque
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
     * @ORM\Column(type="datetime")
     */
    private $PublishedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="risquesresponsable")
     */
    private $responsable;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="risquessuppleant")
     */
    private $suppleant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer", inversedBy="risques")
     */
    private $customer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $probabilite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $impact;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $reduction;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $controle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OuiNon")
     */
    private $acceptation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeRisque", inversedBy="risques")
     */
    private $typerisque;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $evaluation;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Processus", inversedBy="risques")
     */
    private $processuses;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Metier", inversedBy="risques")
     */
    private $metiers;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Action", mappedBy="risques")
     */
    private $actions;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Projet", mappedBy="risques")
     */
    private $projets;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TypeConformite", inversedBy="risques")
     */
    private $typeconformite;

    /**
     * @ORM\ManyToOne(targetEntity=TypeStatutRisque::class, inversedBy="risques")
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $score;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $impactcible;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $probabilitecible;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $scorecible;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $CreatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="risquespublisher")
     */
    private $publisher;

    /**
     * @ORM\ManyToMany(targetEntity=Flux::class, mappedBy="risques")
     */
    private $fluxes;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=People::class, inversedBy="risquespeoples")
     */
    private $peoples;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;



    public function __construct()
    {
        $this->processuses = new ArrayCollection();
        $this->metiers = new ArrayCollection();
        $this->actions = new ArrayCollection();
        $this->projets = new ArrayCollection();
        $this->typeconformite = new ArrayCollection();
        $this->fluxes = new ArrayCollection();
        $this->peoples = new ArrayCollection();

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
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->PublishedAt;
    }

    public function setPublishedAt(\DateTimeInterface $PublishedAt): self
    {
        $this->PublishedAt = $PublishedAt;

        return $this;
    }

    public function getResponsable(): ?People
    {
        return $this->responsable;
    }

    public function setResponsable(?People $responsable): self
    {
        $this->responsable = $responsable;

        return $this;
    }

    public function getSuppleant(): ?People
    {
        return $this->suppleant;
    }

    public function setSuppleant(?People $suppleant): self
    {
        $this->suppleant = $suppleant;

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

    public function getProbabilite(): ?string
    {
        return $this->probabilite;
    }

    public function setProbabilite(?string $probabilite): self
    {
        $this->probabilite = $probabilite;

        return $this;
    }

    public function getImpact(): ?string
    {
        return $this->impact;
    }

    public function setImpact(?string $impact): self
    {
        $this->impact = $impact;

        return $this;
    }

    public function getReduction(): ?string
    {
        return $this->reduction;
    }

    public function setReduction(?string $reduction): self
    {
        $this->reduction = $reduction;

        return $this;
    }

    public function getControle(): ?string
    {
        return $this->controle;
    }

    public function setControle(?string $controle): self
    {
        $this->controle = $controle;

        return $this;
    }

    public function getAcceptation(): ?OuiNon
    {
        return $this->acceptation;
    }

    public function setAcceptation(?OuiNon $acceptation): self
    {
        $this->acceptation = $acceptation;

        return $this;
    }

    public function getTyperisque(): ?TypeRisque
    {
        return $this->typerisque;
    }

    public function setTyperisque(?TypeRisque $typerisque): self
    {
        $this->typerisque = $typerisque;

        return $this;
    }

    public function getEvaluation(): ?string
    {
        return $this->evaluation;
    }

    public function setEvaluation(?string $evaluation): self
    {
        $this->evaluation = $evaluation;

        return $this;
    }

    /**
     * @return Collection|Processus[]
     */
    public function getProcessuses(): Collection
    {
        return $this->processuses;
    }

    public function addProcessus(Processus $processus): self
    {
        if (!$this->processuses->contains($processus)) {
            $this->processuses[] = $processus;
        }

        return $this;
    }

    public function removeProcessus(Processus $processus): self
    {
        if ($this->processuses->contains($processus)) {
            $this->processuses->removeElement($processus);
        }

        return $this;
    }

    /**
     * @return Collection|Metier[]
     */
    public function getMetiers(): Collection
    {
        return $this->metiers;
    }

    public function addMetier(Metier $metier): self
    {
        if (!$this->metiers->contains($metier)) {
            $this->metiers[] = $metier;
        }

        return $this;
    }

    public function removeMetier(Metier $metier): self
    {
        if ($this->metiers->contains($metier)) {
            $this->metiers->removeElement($metier);
        }

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
            $action->addRisque($this);
        }

        return $this;
    }

    public function removeAction(Action $action): self
    {
        if ($this->actions->contains($action)) {
            $this->actions->removeElement($action);
            $action->removeRisque($this);
        }

        return $this;
    }

    /**
     * @return Collection|Projet[]
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projet $projet): self
    {
        if (!$this->projets->contains($projet)) {
            $this->projets[] = $projet;
            $projet->addRisque($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): self
    {
        if ($this->projets->contains($projet)) {
            $this->projets->removeElement($projet);
            $projet->removeRisque($this);
        }

        return $this;
    }

    /**
     * @return Collection|TypeConformite[]
     */
    public function getTypeconformite(): Collection
    {
        return $this->typeconformite;
    }

    public function addTypeconformite(TypeConformite $typeconformite): self
    {
        if (!$this->typeconformite->contains($typeconformite)) {
            $this->typeconformite[] = $typeconformite;
        }

        return $this;
    }

    public function removeTypeconformite(TypeConformite $typeconformite): self
    {
        if ($this->typeconformite->contains($typeconformite)) {
            $this->typeconformite->removeElement($typeconformite);
        }

        return $this;
    }

    public function getStatut(): ?TypeStatutRisque
    {
        return $this->statut;
    }

    public function setStatut(?TypeStatutRisque $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(?string $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getImpactcible(): ?string
    {
        return $this->impactcible;
    }

    public function setImpactcible(?string $impactcible): self
    {
        $this->impactcible = $impactcible;

        return $this;
    }

    public function getProbabilitecible(): ?string
    {
        return $this->probabilitecible;
    }

    public function setProbabilitecible(?string $probabilitecible): self
    {
        $this->probabilitecible = $probabilitecible;

        return $this;
    }

    public function getScorecible(): ?string
    {
        return $this->scorecible;
    }

    public function setScorecible(?string $scorecible): self
    {
        $this->scorecible = $scorecible;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(?\DateTimeInterface $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getPublisher(): ?People
    {
        return $this->publisher;
    }

    public function setPublisher(?People $publisher): self
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * @return Collection|Flux[]
     */
    public function getFluxes(): Collection
    {
        return $this->fluxes;
    }

    public function addFlux(Flux $flux): self
    {
        if (!$this->fluxes->contains($flux)) {
            $this->fluxes[] = $flux;
            $flux->addRisque($this);
        }

        return $this;
    }

    public function removeFlux(Flux $flux): self
    {
        if ($this->fluxes->contains($flux)) {
            $this->fluxes->removeElement($flux);
            $flux->removeRisque($this);
        }

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|People[]
     */
    public function getPeoples(): Collection
    {
        return $this->peoples;
    }

    public function addPeople(People $people): self
    {
        if (!$this->peoples->contains($people)) {
            $this->peoples[] = $people;
        }

        return $this;
    }

    public function removePeople(People $people): self
    {
        $this->peoples->removeElement($people);

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

}
