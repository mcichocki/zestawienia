<?php

namespace App\Entity;

use App\Repository\StatusRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatusRepository::class)
 * @ORM\Table("statusy")
 */
class Status
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tresc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $icon;

    /**
     * @ORM\Column(type="integer")
     */
    private $identyfikator;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $klasa;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function getIdentyfikator(): ?int
    {
        return $this->identyfikator;
    }

    public function setIdentyfikator(int $identyfikator): self
    {
        $this->identyfikator = $identyfikator;

        return $this;
    }

    public function getKlasa(): ?string
    {
        return $this->klasa;
    }

    public function setKlasa(?string $klasa): self
    {
        $this->klasa = $klasa;

        return $this;
    }
}
