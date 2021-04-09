<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MetierRepository")
 */
class Metier
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
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Flux", mappedBy="destin")
     */
    private $fluxes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Processus", mappedBy="metier")
     */
    private $processuses;

    /**
     * @ORM\Column(type="datetime")
     */
    private $PublishedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer", inversedBy="metiers")
     */
    private $customer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\People", mappedBy="metier")
     */
    private $peoples;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Risque", mappedBy="metiers")
     */
    private $risques;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Projet", mappedBy="metier")
     */
    private $projets;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Projet", inversedBy="contributeur")
     */
    private $projet;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Program", mappedBy="metier")
     */
    private $programs;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Flux", mappedBy="expin")
     */
    private $expinfluxes;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="metiersdirecteur")
     */
    private $directeur;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="metierssuppleant")
     */
    private $suppleant;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="metierspublisher")
     */
    private $Publisher;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Gedmo\Slug(fields={"designation"})
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="metiersresponsable")
     */
    private $responsable;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

   

    public function __construct()
    {
        $this->fluxes = new ArrayCollection();
        $this->processuses = new ArrayCollection();
        $this->peoples = new ArrayCollection();
        $this->risques = new ArrayCollection();
        $this->projets = new ArrayCollection();
        $this->programs = new ArrayCollection();
        $this->expinfluxes = new ArrayCollection();
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
            $flux->addDestin($this);
        }

        return $this;
    }

    public function removeFlux(Flux $flux): self
    {
        if ($this->fluxes->contains($flux)) {
            $this->fluxes->removeElement($flux);
            $flux->removeDestin($this);
        }

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
            $processus->setMetier($this);
        }

        return $this;
    }

    public function removeProcessus(Processus $processus): self
    {
        if ($this->processuses->contains($processus)) {
            $this->processuses->removeElement($processus);
            // set the owning side to null (unless already changed)
            if ($processus->getMetier() === $this) {
                $processus->setMetier(null);
            }
        }

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
            $people->setMetier($this);
        }

        return $this;
    }

    public function removePeople(People $people): self
    {
        if ($this->peoples->contains($people)) {
            $this->peoples->removeElement($people);
            // set the owning side to null (unless already changed)
            if ($people->getMetier() === $this) {
                $people->setMetier(null);
            }
        }

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
            $risque->addMetier($this);
        }

        return $this;
    }

    public function removeRisque(Risque $risque): self
    {
        if ($this->risques->contains($risque)) {
            $this->risques->removeElement($risque);
            $risque->removeMetier($this);
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
            $projet->setMetier($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): self
    {
        if ($this->projets->contains($projet)) {
            $this->projets->removeElement($projet);
            // set the owning side to null (unless already changed)
            if ($projet->getMetier() === $this) {
                $projet->setMetier(null);
            }
        }

        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): self
    {
        $this->projet = $projet;

        return $this;
    }

    /**
     * @return Collection|Program[]
     */
    public function getPrograms(): Collection
    {
        return $this->programs;
    }

    public function addProgram(Program $program): self
    {
        if (!$this->programs->contains($program)) {
            $this->programs[] = $program;
            $program->setMetier($this);
        }

        return $this;
    }

    public function removeProgram(Program $program): self
    {
        if ($this->programs->contains($program)) {
            $this->programs->removeElement($program);
            // set the owning side to null (unless already changed)
            if ($program->getMetier() === $this) {
                $program->setMetier(null);
            }
        }

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

    /**
     * @return Collection|Flux[]
     */
    public function getExpinfluxes(): Collection
    {
        return $this->expinfluxes;
    }

    public function addExpinflux(Flux $expinflux): self
    {
        if (!$this->expinfluxes->contains($expinflux)) {
            $this->expinfluxes[] = $expinflux;
            $expinflux->addExpin($this);
        }

        return $this;
    }

    public function removeExpinflux(Flux $expinflux): self
    {
        if ($this->expinfluxes->contains($expinflux)) {
            $this->expinfluxes->removeElement($expinflux);
            $expinflux->removeExpin($this);
        }

        return $this;
    }

    public function getDirecteur(): ?People
    {
        return $this->directeur;
    }

    public function setDirecteur(?People $directeur): self
    {
        $this->directeur = $directeur;

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

    public function getPublisher(): ?People
    {
        return $this->Publisher;
    }

    public function setPublisher(?People $Publisher): self
    {
        $this->Publisher = $Publisher;

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

    public function getResponsable(): ?People
    {
        return $this->responsable;
    }

    public function setResponsable(?People $responsable): self
    {
        $this->responsable = $responsable;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

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

}
