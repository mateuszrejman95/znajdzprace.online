<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApiTokenRepository")
 */
class ApiToken
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
    private $token;

    /**
     * @ORM\Column(type="datetime")
     */
    private $expiresAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Uzytkownik", inversedBy="apiTokens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $uzytkownik;

    /**
     * ApiToken constructor.
     * @param $user
     * @throws \Exception
     */
    public function __construct(Uzytkownik $user)
    {
        $this->token = bin2hex(random_bytes(60));
        $this->uzytkownik = $user;
        $this->expiresAt = new \DateTime('+1 hour');
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function getExpiresAt(): ?\DateTimeInterface
    {
        return $this->expiresAt;
    }

    public function getUser(): ?Uzytkownik
    {
        return $this->uzytkownik;
    }

    public function getUzytkownik(): ?Uzytkownik
    {
        return $this->uzytkownik;
    }

    public function isExpired(): bool
    {
        return $this->getExpiresAt() <= new \DateTime();
    }


}
