<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UzytkownikRepository")
 */
class Uzytkownik
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
}
