<?php

namespace App\Entity;

use App\Repository\TypeNonConformiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeNonConformiteRepository::class)
 */
class TypeNonConformite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $designation;

    /**
     * @ORM\OneToMany(targetEntity=NonConformite::class, mappedBy="severite")
     */
    private $nonConformitesaudit;

    public function __construct()
    {
        $this->nonConformitesaudit = new ArrayCollection();
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

    /**
     * @return Collection|NonConformite[]
     */
    public function getNonConformitesaudit(): Collection
    {
        return $this->nonConformitesaudit;
    }

    public function addNonConformitesaudit(NonConformite $nonConformitesaudit): self
    {
        if (!$this->nonConformitesaudit->contains($nonConformitesaudit)) {
            $this->nonConformitesaudit[] = $nonConformitesaudit;
            $nonConformitesaudit->setSeverite($this);
        }

        return $this;
    }

    public function removeNonConformitesaudit(NonConformite $nonConformitesaudit): self
    {
        if ($this->nonConformitesaudit->removeElement($nonConformitesaudit)) {
            // set the owning side to null (unless already changed)
            if ($nonConformitesaudit->getSeverite() === $this) {
                $nonConformitesaudit->setSeverite(null);
            }
        }

        return $this;
    }
}
