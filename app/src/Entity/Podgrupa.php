<?php

namespace App\Entity;

use App\Repository\PodgrupaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PodgrupaRepository::class)
 * @ORM\Table(name="podgrupy")
 */
class Podgrupa
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
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Grupa::class, inversedBy="podgrupa")
     * @ORM\JoinColumn(nullable=false)
     */
    private $grupa;

    /**
     * @ORM\OneToMany(targetEntity=Zestawienie::class, mappedBy="podgrupa", orphanRemoval=true)
     */
    private $zestawienia;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    private $kolejnosc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $robocza;

    public function __construct()
    {
        $this->zestawienia = new ArrayCollection();
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

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getGrupa(): ?Grupa
    {
        return $this->grupa;
    }

    public function setGrupa(?Grupa $grupa): self
    {
        $this->grupa = $grupa;

        return $this;
    }

    /**
     * @return Collection|Zestawienie[]
     */
    public function getZestawienia(): Collection
    {
        return $this->zestawienia;
    }

    public function addZestawienium(Zestawienie $zestawienium): self
    {
        if (!$this->zestawienia->contains($zestawienium)) {
            $this->zestawienia[] = $zestawienium;
            $zestawienium->setPodgrupa($this);
        }

        return $this;
    }

    public function removeZestawienium(Zestawienie $zestawienium): self
    {
        if ($this->zestawienia->removeElement($zestawienium)) {
            // set the owning side to null (unless already changed)
            if ($zestawienium->getPodgrupa() === $this) {
                $zestawienium->setPodgrupa(null);
            }
        }

        return $this;
    }

    public function getKolejnosc(): ?int
    {
        return $this->kolejnosc;
    }

    public function setKolejnosc(int $kolejnosc): self
    {
        $this->kolejnosc = $kolejnosc;

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
}
