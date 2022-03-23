<?php

namespace App\Entity;

use App\Repository\KorektaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KorektaRepository::class)
 * @ORM\Table(name="korekty")
 */
class Korekta
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $informacja;

    /**
     * @ORM\Column(type="datetime")
     */
    private $data;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=2)
     */
    private $aktualnaWartosc;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=2)
     */
    private $nowaWartosc;

    /**
     * @ORM\ManyToOne(targetEntity=Uzytkownik::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $weryfikujacy;

    /**
     * @ORM\OneToMany(targetEntity=Zestawienie::class, mappedBy="korekta")
     */
    private $zestawienia;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=2, nullable=true)
     */
    private $suma;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=2, nullable=true)
     */
    private $nowaSuma;

    public function __construct()
    {
        $this->data = new \DateTime("now");
        $this->zestawienia = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormularz(): ?Formularz
    {
        return $this->formularz;
    }

    public function setFormularz(?Formularz $formularz): self
    {
        $this->formularz = $formularz;

        return $this;
    }

    public function getInformacja(): ?string
    {
        return $this->informacja;
    }

    public function setInformacja(?string $informacja): self
    {
        $this->informacja = $informacja;

        return $this;
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function getAktualnaWartosc(): ?string
    {
        return $this->aktualnaWartosc;
    }

    public function setAktualnaWartosc(string $aktualnaWartosc): self
    {
        $this->aktualnaWartosc = $aktualnaWartosc;

        return $this;
    }

    public function getNowaWartosc(): ?string
    {
        return $this->nowaWartosc;
    }

    public function setNowaWartosc(string $nowaWartosc): self
    {
        $this->nowaWartosc = $nowaWartosc;

        return $this;
    }

    public function getWeryfikujacy(): ?Uzytkownik
    {
        return $this->weryfikujacy;
    }

    public function setWeryfikujacy(?Uzytkownik $weryfikujacy): self
    {
        $this->weryfikujacy = $weryfikujacy;

        return $this;
    }

    public function getZestawienie(): ?Zestawienie
    {
        return $this->zestawienie;
    }

    public function setZestawienie(?Zestawienie $zestawienie): self
    {
        $this->zestawienie = $zestawienie;

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
            $zestawienium->setKorekta($this);
        }

        return $this;
    }

    public function removeZestawienium(Zestawienie $zestawienium): self
    {
        if ($this->zestawienia->removeElement($zestawienium)) {
            // set the owning side to null (unless already changed)
            if ($zestawienium->getKorekta() === $this) {
                $zestawienium->setKorekta(null);
            }
        }

        return $this;
    }

    public function getSuma(): ?string
    {
        return $this->suma;
    }

    public function setSuma(?string $suma): self
    {
        $this->suma = $suma;

        return $this;
    }

    public function getNowaSuma(): ?string
    {
        return $this->nowaSuma;
    }

    public function setNowaSuma(?string $nowaSuma): self
    {
        $this->nowaSuma = $nowaSuma;

        return $this;
    }
}
