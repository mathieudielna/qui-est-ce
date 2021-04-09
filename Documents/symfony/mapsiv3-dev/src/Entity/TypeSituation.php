<?php

namespace App\Entity;

use App\Repository\TypeSituationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeSituationRepository::class)
 */
class TypeSituation
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
     * @ORM\OneToMany(targetEntity=Impact::class, mappedBy="typesituation")
     */
    private $impacts;

    public function __construct()
    {
        $this->impacts = new ArrayCollection();
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

    /**
     * @return Collection|Impact[]
     */
    public function getImpacts(): Collection
    {
        return $this->impacts;
    }

    public function addImpact(Impact $impact): self
    {
        if (!$this->impacts->contains($impact)) {
            $this->impacts[] = $impact;
            $impact->setTypesituation($this);
        }

        return $this;
    }

    public function removeImpact(Impact $impact): self
    {
        if ($this->impacts->removeElement($impact)) {
            // set the owning side to null (unless already changed)
            if ($impact->getTypesituation() === $this) {
                $impact->setTypesituation(null);
            }
        }

        return $this;
    }
}
