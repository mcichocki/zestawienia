<?php

namespace App\Entity;

use App\Repository\RokZestawieniowyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RokZestawieniowyRepository::class)
 * @ORM\Table(name="lata_zestawieniowe")
 */
class RokZestawieniowy
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $rok;

    /**
     * @ORM\Column(type="integer")
     */
    private $identyfikator;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     */
    private $kolejnosc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $robocza;

    /**
     * @ORM\OneToMany(targetEntity=Formularz::class, mappedBy="rokZestawieniowy")
     */
    private $formularze;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rozpoczetych;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ukonczonych;

    public function __construct()
    {
        $this->formularze = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRok(): ?int
    {
        return $this->rok;
    }

    public function setRok(int $rok): self
    {
        $this->rok = $rok;

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

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

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

    /**
     * @return Collection|Formularz[]
     */
    public function getFormularze(): Collection
    {
        return $this->formularze;
    }

    public function addFormularze(Formularz $formularze): self
    {
        if (!$this->formularze->contains($formularze)) {
            $this->formularze[] = $formularze;
            $formularze->setRokZestawieniowy($this);
        }

        return $this;
    }

    public function removeFormularze(Formularz $formularze): self
    {
        if ($this->formularze->removeElement($formularze)) {
            // set the owning side to null (unless already changed)
            if ($formularze->getRokZestawieniowy() === $this) {
                $formularze->setRokZestawieniowy(null);
            }
        }

        return $this;
    }

    public function getRozpoczetych(): ?int
    {
        return $this->rozpoczetych;
    }

    public function setRozpoczetych(?int $rozpoczetych): self
    {
        $this->rozpoczetych = $rozpoczetych;

        return $this;
    }

    public function getUkonczonych(): ?int
    {
        return $this->ukonczonych;
    }

    public function setUkonczonych(?int $ukonczonych): self
    {
        $this->ukonczonych = $ukonczonych;

        return $this;
    }
}
