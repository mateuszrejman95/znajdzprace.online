<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OfertaRepository")
 */
class Oferta
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
    private $tytul;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Uzytkownik", inversedBy="oferty")
     * @ORM\JoinColumn(nullable=false)
     */
    private $uzytkownik;

    /**
     * @ORM\Column(type="datetime")
     */
    private $data_dodania;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $tresc;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Kategoria", inversedBy="oferty")
     */
    private $kategoria;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Miasto", inversedBy="oferty")
     */
    private $lokalizacja;

    /**
     * @ORM\Column(type="boolean")
     */
    private $aktywna;

    public function __construct()
    {
        $this->kategoria = new ArrayCollection();
        $this->lokalizacja = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTytul(): ?string
    {
        return $this->tytul;
    }

    public function setTytul(string $tytul): self
    {
        $this->tytul = $tytul;

        return $this;
    }

    public function getUzytkownik(): ?Uzytkownik
    {
        return $this->uzytkownik;
    }

    public function setUzytkownik(?Uzytkownik $uzytkownik): self
    {
        $this->uzytkownik = $uzytkownik;

        return $this;
    }

    public function getDataDodania(): ?\DateTimeInterface
    {
        return $this->data_dodania;
    }

    public function setDataDodania(\DateTimeInterface $data_dodania): self
    {
        $this->data_dodania = $data_dodania;

        return $this;
    }

    public function getTresc(): ?string
    {
        return $this->tresc;
    }

    public function setTresc(?string $tresc): self
    {
        $this->tresc = $tresc;

        return $this;
    }

    /**
     * @return Collection|Kategoria[]
     */
    public function getKategoria(): Collection
    {
        return $this->kategoria;
    }

    public function addKategorium(Kategoria $kategorium): self
    {
        if (!$this->kategoria->contains($kategorium)) {
            $this->kategoria[] = $kategorium;
        }

        return $this;
    }

    public function removeKategorium(Kategoria $kategorium): self
    {
        if ($this->kategoria->contains($kategorium)) {
            $this->kategoria->removeElement($kategorium);
        }

        return $this;
    }

    /**
     * @return Collection|Miasto[]
     */
    public function getLokalizacja(): Collection
    {
        return $this->lokalizacja;
    }

    public function addLokalizacja(Miasto $lokalizacja): self
    {
        if (!$this->lokalizacja->contains($lokalizacja)) {
            $this->lokalizacja[] = $lokalizacja;
        }

        return $this;
    }

    public function removeLokalizacja(Miasto $lokalizacja): self
    {
        if ($this->lokalizacja->contains($lokalizacja)) {
            $this->lokalizacja->removeElement($lokalizacja);
        }

        return $this;
    }

    public function getAktywna(): ?bool
    {
        return $this->aktywna;
    }

    public function setAktywna(bool $aktywna): self
    {
        $this->aktywna = $aktywna;

        return $this;
    }
}
