<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Entity(repositoryClass="App\Repository\JalonConnectActionRepository")
 */
class JalonConnectAction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Action", inversedBy="jalonConnectActions")
     */
    private $action;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $jalon;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="integer", length=3, nullable=true)
     */
    private $progression;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datereelle;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $daterevue;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $budget;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $etp;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $fini;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer", inversedBy="jalonConnectActions")
     */
    private $mcustomer;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $topjalon;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="jalonresponsable")
     */
    private $responsable;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datedebut;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeRag", inversedBy="jalonConnectActions")
     */
    private $rag;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $PublishedAt;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="jalonConnectActionspublisher")
     */
    private $publisher;

    /**
     * @ORM\ManyToMany(targetEntity=People::class, inversedBy="jalonConnectActionspeoples")
     */
    private $peoples;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="jalonConnectActionssuppleant")
     */
    private $suppleant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $ValidatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="jalonConnectActionsvalidator")
     */
    private $validator;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $validationstatut;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statuttache;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Gedmo\Slug(fields={"jalon"})
     */
    private $slug;

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
        $this->peoples = new ArrayCollection();
    }
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAction(): ?Action
    {
        return $this->action;
    }

    public function setAction(?Action $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function getJalon(): ?string
    {
        return $this->jalon;
    }

    public function setJalon(string $jalon): self
    {
        $this->jalon = $jalon;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getProgression(): ?string
    {
        return $this->progression;
    }

    public function setProgression(?string $progression): self
    {
        $this->progression = $progression;

        return $this;
    }

    public function getDatereelle(): ?\DateTimeInterface
    {
        return $this->datereelle;
    }

    public function setDatereelle(?\DateTimeInterface $datereelle): self
    {
        $this->datereelle = $datereelle;

        return $this;
    }

    public function getDaterevue(): ?\DateTimeInterface
    {
        return $this->daterevue;
    }

    public function setDaterevue(?\DateTimeInterface $daterevue): self
    {
        $this->daterevue = $daterevue;

        return $this;
    }

    public function getBudget(): ?string
    {
        return $this->budget;
    }

    public function setBudget(?string $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getEtp(): ?string
    {
        return $this->etp;
    }

    public function setEtp(?string $etp): self
    {
        $this->etp = $etp;

        return $this;
    }

    public function getFini(): ?bool
    {
        return $this->fini;
    }

    public function setFini(?bool $fini): self
    {
        $this->fini = $fini;

        return $this;
    }

    public function getMcustomer(): ?MapsiCustomer
    {
        return $this->mcustomer;
    }

    public function setMcustomer(?MapsiCustomer $mcustomer): self
    {
        $this->mcustomer = $mcustomer;

        return $this;
    }

    public function getTopjalon(): ?bool
    {
        return $this->topjalon;
    }

    public function setTopjalon(?bool $topjalon): self
    {
        $this->topjalon = $topjalon;

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

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(?\DateTimeInterface $datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getRag(): ?TypeRag
    {
        return $this->rag;
    }

    public function setRag(?TypeRag $rag): self
    {
        $this->rag = $rag;

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
        if ($this->peoples->contains($people)) {
            $this->peoples->removeElement($people);
        }

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

    public function getSuppleant(): ?People
    {
        return $this->suppleant;
    }

    public function setSuppleant(?People $suppleant): self
    {
        $this->suppleant = $suppleant;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getValidatedAt(): ?\DateTimeInterface
    {
        return $this->ValidatedAt;
    }

    public function setValidatedAt(?\DateTimeInterface $ValidatedAt): self
    {
        $this->ValidatedAt = $ValidatedAt;

        return $this;
    }

    public function getValidator(): ?People
    {
        return $this->validator;
    }

    public function setValidator(?People $validator): self
    {
        $this->validator = $validator;

        return $this;
    }

    public function getValidationstatut(): ?string
    {
        return $this->validationstatut;
    }

    public function setValidationstatut(?string $validationstatut): self
    {
        $this->validationstatut = $validationstatut;

        return $this;
    }

    public function getStatuttache(): ?string
    {
        return $this->statuttache;
    }

    public function setStatuttache(?string $statuttache): self
    {
        $this->statuttache = $statuttache;

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
