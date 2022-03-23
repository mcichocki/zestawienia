<?php

namespace App\Entity;

use App\Repository\WiadomoscRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WiadomoscRepository::class)
 * @ORM\Table(name="wiadomosci")
 */
class Wiadomosc
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
    private $tytul;

    /**
     * @ORM\Column(type="text")
     */
    private $tresc;

    /**
     * @ORM\Column(type="integer")
     */
    private $czyOdczytano = 0;

    /**
     * @ORM\ManyToOne(targetEntity=Uzytkownik::class, inversedBy="nadawca")
     * @ORM\JoinColumn(nullable=false)
     */
    private $odKogo;

    /**
     * @ORM\ManyToOne(targetEntity=Uzytkownik::class, inversedBy="odbiorca")
     * @ORM\JoinColumn(nullable=false)
     */
    private $doKogo;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dataWyslania;

    /**
     * @ORM\ManyToOne(targetEntity=Formularz::class, inversedBy="wiadomosci")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formularz;


    public function __construct()
    {
        $this->dataWyslania = new \DateTime("now");
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTytul(): ?string
    {
        return $this->tytul;
    }

    public function setTytul(string $tytul): self
    {
        $this->tytul = $tytul;

        return $this;
    }

    public function getTresc(): ?string
    {
        return $this->tresc;
    }

    public function setTresc(string $tresc): self
    {
        $this->tresc = $tresc;

        return $this;
    }

    public function getCzyOdczytano(): ?int
    {
        return $this->czyOdczytano;
    }

    public function setCzyOdczytano(int $czyOdczytano): self
    {
        $this->czyOdczytano = $czyOdczytano;

        return $this;
    }

    public function getOdKogo(): ?Uzytkownik
    {
        return $this->odKogo;
    }

    public function setOdKogo(?Uzytkownik $odKogo): self
    {
        $this->odKogo = $odKogo;

        return $this;
    }

    public function getDoKogo(): ?Uzytkownik
    {
        return $this->doKogo;
    }

    public function setDoKogo(?Uzytkownik $doKogo): self
    {
        $this->doKogo = $doKogo;

        return $this;
    }

    public function getDataWyslania(): ?\DateTimeInterface
    {
        return $this->dataWyslania;
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

}
