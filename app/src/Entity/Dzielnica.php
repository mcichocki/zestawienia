<?php

namespace App\Entity;

use App\Repository\DzielnicaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DzielnicaRepository::class)
 * @ORM\Table(name="dzielnice")
 */
class Dzielnica
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nazwa;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $robocza;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     */
    private $identyfikator;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $symbol;

    /**
     * @ORM\OneToMany(targetEntity=Jednostka::class, mappedBy="dzielnica")
     */
    private $jednostki;

    /**
     * @ORM\OneToMany(targetEntity=Uzytkownik::class, mappedBy="dzielnica")
     */
    private $uzytkownicy;

    public function __construct()
    {
        $this->jednostki = new ArrayCollection();
        $this->uzytkownicy = new ArrayCollection();
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

    public function getRobocza(): ?string
    {
        return $this->robocza;
    }

    public function setRobocza(string $robocza): self
    {
        $this->robocza = $robocza;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

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

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(?string $symbol): self
    {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * @return Collection|Jednostka[]
     */
    public function getJednostki(): Collection
    {
        return $this->jednostki;
    }

    public function addJednostki(Jednostka $jednostki): self
    {
        if (!$this->jednostki->contains($jednostki)) {
            $this->jednostki[] = $jednostki;
            $jednostki->setDzielnica($this);
        }

        return $this;
    }

    public function removeJednostki(Jednostka $jednostki): self
    {
        if ($this->jednostki->removeElement($jednostki)) {
            // set the owning side to null (unless already changed)
            if ($jednostki->getDzielnica() === $this) {
                $jednostki->setDzielnica(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nazwa;
    }

    /**
     * @return Collection|Uzytkownik[]
     */
    public function getUzytkownicy(): Collection
    {
        return $this->uzytkownicy;
    }

    public function addUzytkownicy(Uzytkownik $uzytkownicy): self
    {
        if (!$this->uzytkownicy->contains($uzytkownicy)) {
            $this->uzytkownicy[] = $uzytkownicy;
            $uzytkownicy->setDzielnica($this);
        }

        return $this;
    }

    public function removeUzytkownicy(Uzytkownik $uzytkownicy): self
    {
        if ($this->uzytkownicy->removeElement($uzytkownicy)) {
            // set the owning side to null (unless already changed)
            if ($uzytkownicy->getDzielnica() === $this) {
                $uzytkownicy->setDzielnica(null);
            }
        }

        return $this;
    }
}
