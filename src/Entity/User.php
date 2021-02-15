<?php

namespace App\Entity;

use DateTimeInterface;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use App\Entity\Adress;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @var integer the id
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * 
     * @var string the email
     */
    private string $email;
    
    /**
     * @ORM\Column(type="string")
     * 
     * @var string the hashed password
     */
    private string $password;

    /**
     * @ORM\Column(type="json")
     * @var array<string> The list of roles
     */
    private Array $roles = [];

    /**
     * @ORM\Column(type="string")
     * 
     * @var string the civility
     */
    private string $civility;

    /**
     * @ORM\Column(type="string")
     * 
     * @var string the firstname
     */
    private string $firstname;

    /**
     * @ORM\Column(type="string")
     * 
     * @var string the lastname
     */
    private string $lastname;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Adress::class, mappedBy="user", orphanRemoval=true)
     * 
     * @var ArrayCollection<int, Adress>
     */
    private Collection $adresses;

    public function __construct()
    {
        $this->adresses = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    // email
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    
    // password
    public function getPassword(): string
    {
        return (string) $this->password;
    }
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


    /**
     * Get the value of civility
     *
     * @return string
     */
    public function getCivility() : string 
    {
        return $this->civility;
    }

    /**
     * @param string $civility
     * @return self
     */
    public function setCivility(string $civility) : self
    {
        $this->civility = $civility;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastname() : string 
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return self
     */
    public function setLastname(string $lastname) : self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname() : string 
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return self
     */
    public function setFirstname(string $firstname) : self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return string
     */
    public function getIdentity() : string
    {
        return $this->civility . ' ' . $this->firstname . ' ' . $this->lastname;
    }


    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }
    /**
     * @return array<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param array<string> $roles
     */
    public function setRoles(array $roles = ['ROLE_USER']): self
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials():void
    {

    }

    /**
     * @return Collection<int, Adress>
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adress $adress): self
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses[] = $adress;
            $adress->setUser($this);
        }

        return $this;
    }

    public function removeAdress(Adress $adress): self
    {
        $this->adresses->removeElement($adress);
        return $this;
    }
}
