<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PanstwoRepository")
 */
class Panstwo
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
     * @ORM\OneToMany(targetEntity="App\Entity\Wojewodztwo", mappedBy="panstwo", orphanRemoval=true)
     */
    private $wojewodztwa;

    public function __construct()
    {
        $this->wojewodztwa = new ArrayCollection();
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
     * @return Collection|Wojewodztwo[]
     */
    public function getWojewodztwa(): Collection
    {
        return $this->wojewodztwa;
    }

    public function addWojewodztwa(Wojewodztwo $wojewodztwa): self
    {
        if (!$this->wojewodztwa->contains($wojewodztwa)) {
            $this->wojewodztwa[] = $wojewodztwa;
            $wojewodztwa->setPanstwo($this);
        }

        return $this;
    }

    public function removeWojewodztwa(Wojewodztwo $wojewodztwa): self
    {
        if ($this->wojewodztwa->contains($wojewodztwa)) {
            $this->wojewodztwa->removeElement($wojewodztwa);
            // set the owning side to null (unless already changed)
            if ($wojewodztwa->getPanstwo() === $this) {
                $wojewodztwa->setPanstwo(null);
            }
        }

        return $this;
    }
}
