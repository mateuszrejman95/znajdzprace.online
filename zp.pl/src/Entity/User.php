<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UzytkownikRepository")
 */
class User implements UserInterface
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
    private $imie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nazwisko;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $haslo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Oferta", mappedBy="uzytkownik", orphanRemoval=true)
     */
    private $oferty;

    /**
     * @ORM\Column(type="text")
     */
    private $roles = [];

    public function __construct()
    {
        $this->oferty = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImie(): ?string
    {
        return $this->imie;
    }

    public function setImie(string $imie): self
    {
        $this->imie = $imie;

        return $this;
    }

    public function getNazwisko(): ?string
    {
        return $this->nazwisko;
    }

    public function setNazwisko(?string $nazwisko): self
    {
        $this->nazwisko = $nazwisko;

        return $this;
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

    public function getHaslo(): ?string
    {
        return $this->haslo;
    }

    public function setHaslo(string $haslo): self
    {
        $this->haslo = $haslo;

        return $this;
    }

    /**
     * @return Collection|Oferta[]
     */
    public function getOferty(): Collection
    {
        return $this->oferty;
    }

    public function addOferty(Oferta $oferty): self
    {
        if (!$this->oferty->contains($oferty)) {
            $this->oferty[] = $oferty;
            $oferty->setUzytkownik($this);
        }

        return $this;
    }

    public function removeOferty(Oferta $oferty): self
    {
        if ($this->oferty->contains($oferty)) {
            $this->oferty->removeElement($oferty);
            // set the owning side to null (unless already changed)
            if ($oferty->getUzytkownik() === $this) {
                $oferty->setUzytkownik(null);
            }
        }

        return $this;
    }
    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
       $role  = $this->roles;
       $role[] = 'ROLE_UESR';
       return array_unique($role);
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->getHaslo();
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->getEmail();
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }

    public function setPassword($password)
    {
        $this->setHaslo($password);
        return $this;
    }

}
