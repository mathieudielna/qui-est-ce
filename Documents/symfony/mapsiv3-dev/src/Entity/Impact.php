<?php

namespace App\Entity;

use App\Repository\ImpactRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=ImpactRepository::class)
 */
class Impact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
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
    private $gravite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $probabilite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sensibilite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $maitrise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $criticite;

    /**
     * @ORM\ManyToOne(targetEntity=MapsiCustomer::class, inversedBy="impacts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity=AspectEnv::class, inversedBy="impacts", cascade={"persist"})
     */
    private $aspectenv;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Gedmo\Slug(fields={"designation"})
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=TypeSituation::class, inversedBy="impacts")
     */
    private $typesituation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $critere;

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

    public function getGravite(): ?string
    {
        return $this->gravite;
    }

    public function setGravite(string $gravite): self
    {
        $this->gravite = $gravite;

        return $this;
    }

    public function getProbabilite(): ?string
    {
        return $this->probabilite;
    }

    public function setProbabilite(string $probabilite): self
    {
        $this->probabilite = $probabilite;

        return $this;
    }

    public function getSensibilite(): ?string
    {
        return $this->sensibilite;
    }

    public function setSensibilite(string $sensibilite): self
    {
        $this->sensibilite = $sensibilite;

        return $this;
    }

    public function getMaitrise(): ?string
    {
        return $this->maitrise;
    }

    public function setMaitrise(string $maitrise): self
    {
        $this->maitrise = $maitrise;

        return $this;
    }

    public function getCriticite(): ?string
    {
        return $this->criticite;
    }

    public function setCriticite(string $criticite): self
    {
        $this->criticite = $criticite;

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

    public function getAspectenv(): ?AspectEnv
    {
        return $this->aspectenv;
    }

    public function setAspectenv(?AspectEnv $aspectenv): self
    {
        $this->aspectenv = $aspectenv;

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

    public function getTypeaspectenv(): ?TypeAspectEnv
    {
        return $this->typeaspectenv;
    }

    public function setTypeaspectenv(?TypeAspectEnv $typeaspectenv): self
    {
        $this->typeaspectenv = $typeaspectenv;

        return $this;
    }

    public function getTypesituation(): ?TypeSituation
    {
        return $this->typesituation;
    }

    public function setTypesituation(?TypeSituation $typesituation): self
    {
        $this->typesituation = $typesituation;

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

    public function getCritere(): ?string
    {
        return $this->critere;
    }

    public function setCritere(?string $critere): self
    {
        $this->critere = $critere;

        return $this;
    }
}
