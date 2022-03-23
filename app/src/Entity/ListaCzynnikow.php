<?php

namespace App\Entity;

use App\Repository\ListaCzynnikowRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ListaCzynnikowRepository::class)
 */
class ListaCzynnikow
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $tresc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typ;

    /**
     * @ORM\Column(type="datetime")
     */
    private $data;

    /**
     * @ORM\ManyToOne(targetEntity=Uzytkownik::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $pracownik;

    /**
     * @ORM\ManyToOne(targetEntity=Podgrupa::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $podgrupa;

    /**
     * @ORM\ManyToOne(targetEntity=Formularz::class, inversedBy="czynniki")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formularz;

    public function __construct()
    {
        $this->data = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTyp(): ?string
    {
        return $this->typ;
    }

    public function setTyp(string $typ): self
    {
        $this->typ = $typ;

        return $this;
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function getPracownik(): ?Uzytkownik
    {
        return $this->pracownik;
    }

    public function setPracownik(?Uzytkownik $pracownik): self
    {
        $this->pracownik = $pracownik;

        return $this;
    }

    public function getPodgrupa(): ?Podgrupa
    {
        return $this->podgrupa;
    }

    public function setPodgrupa(?Podgrupa $podgrupa): self
    {
        $this->podgrupa = $podgrupa;

        return $this;
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
