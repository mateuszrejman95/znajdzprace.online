<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\KategoriaRepository")
 */
class Kategoria
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
    private $nazwa;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Oferta", mappedBy="kategoria")
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

    public function getNazwa(): ?string
    {
        return $this->nazwa;
    }

    public function setNazwa(string $nazwa): self
    {
        $this->nazwa = $nazwa;

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
            $oferty->addKategorium($this);
        }

        return $this;
    }

    public function removeOferty(Oferta $oferty): self
    {
        if ($this->oferty->contains($oferty)) {
            $this->oferty->removeElement($oferty);
            $oferty->removeKategorium($this);
        }

        return $this;
    }
}
