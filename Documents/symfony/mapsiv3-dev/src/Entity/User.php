<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
	 fields={"email"},
	 message= "Cet email est déjà utilisé"
 )
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit faire au moins 8 caractères")
     */
    private $password;
    
     /**
     * @Assert\EqualTo(propertyPath="password", message="Vos mots de passe doivent être identiques")
     */
    public $confirm_password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TypeRole", inversedBy="users")
     */
    private $userRoles;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\People", inversedBy="user")
     */
    private $people;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $landing;
    
    public function __construct()
    {
        $this->userRoles = new ArrayCollection();
        $this->customer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->email;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    
    public function eraseCredentials()  {}
    
    public function getSalt()  {}
    
    public function setSalt(string $email): self
    {
        $this->salt = $email;

        return $this;
    }
    
    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }


    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

  /**
   * @return Collection|TypeRole[]
   */
  public function getUserRoles(): Collection
  {
      return $this->userRoles;
  }

  public function addUserRole(TypeRole $userRole): self
  {
      if (!$this->userRoles->contains($userRole)) {
          $this->userRoles[] = $userRole;
      }

      return $this;
  }

  public function removeUserRole(TypeRole $userRole): self
  {
      if ($this->userRoles->contains($userRole)) {
          $this->userRoles->removeElement($userRole);
      }

      return $this;
  }
  
  public function getRoles()  {
		 
	    $roles = $this->userRoles->map(function($role){
		    return $role->getDesignation();
	    })->toArray();
	    /**$roles[] = 'ROLE_USER';**/
	    
	    return $roles;
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

  public function getPeople(): ?People
  {
      return $this->people;
  }

  public function setPeople(?People $people): self
  {
      $this->people = $people;

      return $this;
  }

  public function getLanding(): ?string
  {
      return $this->landing;
  }

  public function setLanding(?string $landing): self
  {
      $this->landing = $landing;

      return $this;
  }
   
	public function serialize()
         	{
         	    return serialize([
         	        $this->id,
         	        $this->email,
         	        $this->password,
         	    ]);
         	}
	 
	public function unserialize($serialized)
         	{
         	    list (
         	        $this->id,
         	        $this->email,
         	        $this->password,
         	        ) = unserialize($serialized);
         	}

}
