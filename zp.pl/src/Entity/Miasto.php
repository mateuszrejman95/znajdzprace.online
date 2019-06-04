<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MiastoRepository")
 */
class Miasto
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Wojewodztwo", inversedBy="miasta")
     * @ORM\JoinColumn(nullable=false)
     */
    private $wojewodztwo;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Oferta", mappedBy="lokalizacja")
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

    public function getWojewodztwo(): ?Wojewodztwo
    {
        return $this->wojewodztwo;
    }

    public function setWojewodztwo(?Wojewodztwo $wojewodztwo): self
    {
        $this->wojewodztwo = $wojewodztwo;

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
            $oferty->addLokalizacja($this);
        }

        return $this;
    }

    public function removeOferty(Oferta $oferty): self
    {
        if ($this->oferty->contains($oferty)) {
            $this->oferty->removeElement($oferty);
            $oferty->removeLokalizacja($this);
        }

        return $this;
    }
}
