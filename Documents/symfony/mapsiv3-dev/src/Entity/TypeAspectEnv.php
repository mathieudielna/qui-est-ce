<?php

namespace App\Entity;

use App\Repository\TypeAspectEnvRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeAspectEnvRepository::class)
 */
class TypeAspectEnv
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
     * @ORM\OneToMany(targetEntity=AspectEnv::class, mappedBy="typeaspectenv")
     */
    private $aspectEnvs;

    public function __construct()
    {
        $this->impacts = new ArrayCollection();
        $this->aspectEnvs = new ArrayCollection();
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
     * @return Collection|AspectEnv[]
     */
    public function getAspectEnvs(): Collection
    {
        return $this->aspectEnvs;
    }

    public function addAspectEnv(AspectEnv $aspectEnv): self
    {
        if (!$this->aspectEnvs->contains($aspectEnv)) {
            $this->aspectEnvs[] = $aspectEnv;
            $aspectEnv->addType($this);
        }

        return $this;
    }

    public function removeAspectEnv(AspectEnv $aspectEnv): self
    {
        if ($this->aspectEnvs->removeElement($aspectEnv)) {
            $aspectEnv->removeType($this);
        }

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
            $impact->setTypeaspectenv($this);
        }

        return $this;
    }

    public function removeImpact(Impact $impact): self
    {
        if ($this->impacts->removeElement($impact)) {
            // set the owning side to null (unless already changed)
            if ($impact->getTypeaspectenv() === $this) {
                $impact->setTypeaspectenv(null);
            }
        }

        return $this;
    }
}
