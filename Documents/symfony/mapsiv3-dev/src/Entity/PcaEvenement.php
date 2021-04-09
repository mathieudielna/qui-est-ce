<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\ChoiceList\ArrayChoiceList;
use Symfony\Component\Form\ChoiceList\Loader\ChoiceLoaderInterface;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\FormTypeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PcaEvenementRepository")
 */
class PcaEvenement
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Systeme", inversedBy="pcaEvenements")
     */
    private $systemes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Application", inversedBy="pcaEvenements")
     */
    private $applications;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Activite", inversedBy="pcaEvenements")
     */
    private $activites;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer", inversedBy="pcaEvenements")
     */
    private $customer;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $CreatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $PublishedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $ClosedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $StartAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $FinishAt;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tier", inversedBy="pcaEvenements")
     */
    private $tiers;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Site", inversedBy="pcaEvenements")
     */
    private $sites;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeStatut", inversedBy="pcaEvenements")
     */
    private $statut;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TypePcaEvenement", inversedBy="pcaEvenements")
     */
    private $typeevenements;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="pcaEvenementsResponbable")
     */
    private $responsable;

    /**
     * @ORM\ManyToMany(targetEntity=People::class, inversedBy="pcaEvenementsContributeurs")
     */
    private $contributeurs;

    /**
     * @ORM\ManyToOne(targetEntity=People::class)
     */
    private $suppleant;

    /**
     * @ORM\OneToMany(targetEntity=PcaEvenementAppTrack::class, mappedBy="PcaEve", cascade={"persist"})
     */
    private $AppTrack;

    /**
     * @ORM\OneToMany(targetEntity=PcaEvenementServTrack::class, mappedBy="pcaeve", cascade={"persist"})
     */
    private $pcaEvenementServTracks;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $objectif;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $scenario;

    /**
     * @ORM\OneToMany(targetEntity=PcaEvenementChronoPrepa::class, mappedBy="pcaevenement", orphanRemoval=true)
     */
    private $pcaevenementchronoprepa;

    public function __construct()
    {
        $this->systemes = new ArrayCollection();
        $this->applications = new ArrayCollection();
        $this->activites = new ArrayCollection();
        $this->tiers = new ArrayCollection();
        $this->sites = new ArrayCollection();
        $this->typeevenements = new ArrayCollection();
        $this->contributeurs = new ArrayCollection();
        $this->AppTrack = new ArrayCollection();
        $this->pcaEvenementServTracks = new ArrayCollection();
        $this->pcaevenementchronoprepa = new ArrayCollection();
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
     * @return Collection|Systeme[]
     */
    public function getSystemes(): Collection
    {
        return $this->systemes;
    }

    public function addSysteme(Systeme $systeme): self
    {
        if (!$this->systemes->contains($systeme)) {
            $this->systemes[] = $systeme;
        }

        return $this;
    }

    public function removeSysteme(Systeme $systeme): self
    {
        if ($this->systemes->contains($systeme)) {
            $this->systemes->removeElement($systeme);
        }

        return $this;
    }

    /**
     * @return Collection|Application[]
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    public function addApplication(Application $application): self
    {
        if (!$this->applications->contains($application)) {
            $this->applications[] = $application;
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->applications->contains($application)) {
            $this->applications->removeElement($application);
        }

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
        }

        return $this;
    }

    public function removeActivite(Activite $activite): self
    {
        if ($this->activites->contains($activite)) {
            $this->activites->removeElement($activite);
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(?\DateTimeInterface $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->PublishedAt;
    }

    public function setPublishedAt(?\DateTimeInterface $PublishedAt): self
    {
        $this->PublishedAt = $PublishedAt;

        return $this;
    }

    public function getClosedAt(): ?\DateTimeInterface
    {
        return $this->ClosedAt;
    }

    public function setClosedAt(?\DateTimeInterface $ClosedAt): self
    {
        $this->ClosedAt = $ClosedAt;

        return $this;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->StartAt;
    }

    public function setStartAt(?\DateTimeInterface $StartAt): self
    {
        $this->StartAt = $StartAt;

        return $this;
    }

    public function getFinishAt(): ?\DateTimeInterface
    {
        return $this->FinishAt;
    }

    public function setFinishAt(?\DateTimeInterface $FinishAt): self
    {
        $this->FinishAt = $FinishAt;

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

    /**
     * @return Collection|People[]
     */
    public function getContributeurs(): Collection
    {
        return $this->contributeurs;
    }

    public function addContributeur(People $contributeur): self
    {
        if (!$this->contributeurs->contains($contributeur)) {
            $this->contributeurs[] = $contributeur;
        }

        return $this;
    }

    public function removeContributeur(People $contributeur): self
    {
        if ($this->contributeurs->contains($contributeur)) {
            $this->contributeurs->removeElement($contributeur);
        }

        return $this;
    }

    /**
     * @return Collection|Tier[]
     */
    public function getTiers(): Collection
    {
        return $this->tiers;
    }

    public function addTier(Tier $tier): self
    {
        if (!$this->tiers->contains($tier)) {
            $this->tiers[] = $tier;
        }

        return $this;
    }

    public function removeTier(Tier $tier): self
    {
        if ($this->tiers->contains($tier)) {
            $this->tiers->removeElement($tier);
        }

        return $this;
    }

    /**
     * @return Collection|Site[]
     */
    public function getSites(): Collection
    {
        return $this->sites;
    }

    public function addSite(Site $site): self
    {
        if (!$this->sites->contains($site)) {
            $this->sites[] = $site;
        }

        return $this;
    }

    public function removeSite(Site $site): self
    {
        if ($this->sites->contains($site)) {
            $this->sites->removeElement($site);
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

    public function getStatut(): ?TypeStatut
    {
        return $this->statut;
    }

    public function setStatut(?TypeStatut $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection|TypePcaEvenement[]
     */
    public function getTypeevenements(): Collection
    {
        return $this->typeevenements;
    }

    public function addTypeevenement(TypePcaEvenement $typeevenement): self
    {
        if (!$this->typeevenements->contains($typeevenement)) {
            $this->typeevenements[] = $typeevenement;
        }

        return $this;
    }

    public function removeTypeevenement(TypePcaEvenement $typeevenement): self
    {
        if ($this->typeevenements->contains($typeevenement)) {
            $this->typeevenements->removeElement($typeevenement);
        }

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

    /**
     * @return Collection|PcaEvenementAppTrack[]
     */
    public function getAppTrack(): Collection
    {
        return $this->AppTrack;
    }

    public function addAppTrack(PcaEvenementAppTrack $appTrack): self
    {
        if (!$this->AppTrack->contains($appTrack)) {
            $this->AppTrack[] = $appTrack;
            $appTrack->setPcaEve($this);
        }

        return $this;
    }

    public function removeAppTrack(PcaEvenementAppTrack $appTrack): self
    {
        if ($this->AppTrack->contains($appTrack)) {
            $this->AppTrack->removeElement($appTrack);
            // set the owning side to null (unless already changed)
            if ($appTrack->getPcaEve() === $this) {
                $appTrack->setPcaEve(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PcaEvenementServTrack[]
     */
    public function getPcaEvenementServTracks(): Collection
    {
        return $this->pcaEvenementServTracks;
    }

    public function addPcaEvenementServTrack(PcaEvenementServTrack $pcaEvenementServTrack): self
    {
        if (!$this->pcaEvenementServTracks->contains($pcaEvenementServTrack)) {
            $this->pcaEvenementServTracks[] = $pcaEvenementServTrack;
            $pcaEvenementServTrack->setPcaeve($this);
        }

        return $this;
    }

    public function removePcaEvenementServTrack(PcaEvenementServTrack $pcaEvenementServTrack): self
    {
        if ($this->pcaEvenementServTracks->contains($pcaEvenementServTrack)) {
            $this->pcaEvenementServTracks->removeElement($pcaEvenementServTrack);
            // set the owning side to null (unless already changed)
            if ($pcaEvenementServTrack->getPcaeve() === $this) {
                $pcaEvenementServTrack->setPcaeve(null);
            }
        }

        return $this;
    }

    public function getObjectif(): ?string
    {
        return $this->objectif;
    }

    public function setObjectif(?string $objectif): self
    {
        $this->objectif = $objectif;

        return $this;
    }

    public function getScenario(): ?string
    {
        return $this->scenario;
    }

    public function setScenario(?string $scenario): self
    {
        $this->scenario = $scenario;

        return $this;
    }

    /**
     * @return Collection|PcaEvenementChronoPrepa[]
     */
    public function getPcaevenementchronoprepa(): Collection
    {
        return $this->pcaevenementchronoprepa;
    }

    public function addPcaevenementchronoprepa(PcaEvenementChronoPrepa $pcaevenementchronoprepa): self
    {
        if (!$this->pcaevenementchronoprepa->contains($pcaevenementchronoprepa)) {
            $this->pcaevenementchronoprepa[] = $pcaevenementchronoprepa;
            $pcaevenementchronoprepa->setPcaevenement($this);
        }

        return $this;
    }

    public function removePcaevenementchronoprepa(PcaEvenementChronoPrepa $pcaevenementchronoprepa): self
    {
        if ($this->pcaevenementchronoprepa->contains($pcaevenementchronoprepa)) {
            $this->pcaevenementchronoprepa->removeElement($pcaevenementchronoprepa);
            // set the owning side to null (unless already changed)
            if ($pcaevenementchronoprepa->getPcaevenement() === $this) {
                $pcaevenementchronoprepa->setPcaevenement(null);
            }
        }

        return $this;
    }
}
