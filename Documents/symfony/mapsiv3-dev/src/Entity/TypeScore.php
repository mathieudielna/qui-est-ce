<?php

namespace App\Entity;

use App\Repository\TypeScoreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeScoreRepository::class)
 */
class TypeScore
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @ORM\ManyToOne(targetEntity=MapsiCustomer::class, inversedBy="typeScores")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

        /**
     * @ORM\OneToMany(targetEntity=Tier::class, mappedBy="score")
     */
    private $tiersscore;

    public function __construct()
    {
        $this->tiersscore = new ArrayCollection();
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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

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
     * @return Collection|Tier[]
     */
    public function getTiersscore(): Collection
    {
        return $this->tiersscore;
    }

    public function addTiersscore(Tier $tiersscore): self
    {
        if (!$this->tiersscore->contains($tiersscore)) {
            $this->tiersscore[] = $tiersscore;
            $tiersscore->setScore($this);
        }

        return $this;
    }

    public function removeTiersscore(Tier $tiersscore): self
    {
        if ($this->tiersscore->contains($tiersscore)) {
            $this->tiersscore->removeElement($tiersscore);
            // set the owning side to null (unless already changed)
            if ($tiersscore->getScore() === $this) {
                $tiersscore->setScore(null);
            }
        }

        return $this;
    }
}
