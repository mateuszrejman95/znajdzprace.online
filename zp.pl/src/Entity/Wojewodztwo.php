<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WojewodztwoRepository")
 */
class Wojewodztwo
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Panstwo", inversedBy="wojewodztwa")
     * @ORM\JoinColumn(nullable=false)
     */
    private $panstwo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Miasto", mappedBy="wojewodztwo", orphanRemoval=true)
     */
    private $miasta;

    public function __construct()
    {
        $this->miasta = new ArrayCollection();
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

    public function getPanstwo(): ?Panstwo
    {
        return $this->panstwo;
    }

    public function setPanstwo(?Panstwo $panstwo): self
    {
        $this->panstwo = $panstwo;

        return $this;
    }

    /**
     * @return Collection|Miasto[]
     */
    public function getMiasta(): Collection
    {
        return $this->miasta;
    }

    public function addMiastum(Miasto $miastum): self
    {
        if (!$this->miasta->contains($miastum)) {
            $this->miasta[] = $miastum;
            $miastum->setWojewodztwo($this);
        }

        return $this;
    }

    public function removeMiastum(Miasto $miastum): self
    {
        if ($this->miasta->contains($miastum)) {
            $this->miasta->removeElement($miastum);
            // set the owning side to null (unless already changed)
            if ($miastum->getWojewodztwo() === $this) {
                $miastum->setWojewodztwo(null);
            }
        }

        return $this;
    }
}
