<?php

namespace App\Entity;

use App\Repository\PodsumowanieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PodsumowanieRepository::class)
 */
class Podsumowanie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=2, nullable=true)
     */
    private $sumaBudynki;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=2, nullable=true)
     */
    private $sumaGrunty;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=2, nullable=true)
     */
    private $sumaNieruchomosciInwestycyjne;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=2, nullable=true)
     */
    private $sumaNaleznosciDlugoterminowe;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=2, nullable=true)
     */
    private $sumaDlugoterminoweAktywaFinansowe;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=2, nullable=true)
     */
    private $sumaPozostaleSrodkiTrwale;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=2, nullable=true)
     */
    private $sumaSrodkiTrwale;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=2, nullable=true)
     */
    private $sumaWartosciNiematerialne;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=2, nullable=true)
     */
    private $sumaRokPoprzedni;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=2, nullable=true)
     */
    private $sumaRokBiezacy;

    /**
     * @ORM\ManyToOne(targetEntity=Formularz::class, inversedBy="podsumowania")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formularz;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=2, nullable=true)
     */
    private $sumaGruntyPrzekazaneUzytkowanieWieczyste;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=2, nullable=true)
     */
    private $sumaGruntyInneNizPrzekazaneUzytkowanieWieczyste;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=2, nullable=true)
     */
    private $sumaGruntyRokPoprzedni;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSumaBudynki(): ?string
    {
        return $this->sumaBudynki;
    }

    public function setSumaBudynki(?string $sumaBudynki): self
    {
        $this->sumaBudynki = $sumaBudynki;

        return $this;
    }

    public function getSumaGrunty(): ?string
    {
        return $this->sumaGrunty;
    }

    public function setSumaGrunty(?string $sumaGrunty): self
    {
        $this->sumaGrunty = $sumaGrunty;

        return $this;
    }

    public function getSumaNieruchomosciInwestycyjne(): ?string
    {
        return $this->sumaNieruchomosciInwestycyjne;
    }

    public function setSumaNieruchomosciInwestycyjne(?string $sumaNieruchomosciInwestycyjne): self
    {
        $this->sumaNieruchomosciInwestycyjne = $sumaNieruchomosciInwestycyjne;

        return $this;
    }

    public function getSumaNaleznosciDlugoterminowe(): ?string
    {
        return $this->sumaNaleznosciDlugoterminowe;
    }

    public function setSumaNaleznosciDlugoterminowe(?string $sumaNaleznosciDlugoterminowe): self
    {
        $this->sumaNaleznosciDlugoterminowe = $sumaNaleznosciDlugoterminowe;

        return $this;
    }

    public function getSumaDlugoterminoweAktywaFinansowe(): ?string
    {
        return $this->sumaDlugoterminoweAktywaFinansowe;
    }

    public function setSumaDlugoterminoweAktywaFinansowe(?string $sumaDlugoterminoweAktywaFinansowe): self
    {
        $this->sumaDlugoterminoweAktywaFinansowe = $sumaDlugoterminoweAktywaFinansowe;

        return $this;
    }

    public function getSumaPozostaleSrodkiTrwale(): ?string
    {
        return $this->sumaPozostaleSrodkiTrwale;
    }

    public function setSumaPozostaleSrodkiTrwale(?string $sumaPozostaleSrodkiTrwale): self
    {
        $this->sumaPozostaleSrodkiTrwale = $sumaPozostaleSrodkiTrwale;

        return $this;
    }

    public function getSumaSrodkiTrwale(): ?string
    {
        return $this->sumaSrodkiTrwale;
    }

    public function setSumaSrodkiTrwale(?string $sumaSrodkiTrwale): self
    {
        $this->sumaSrodkiTrwale = $sumaSrodkiTrwale;

        return $this;
    }

    public function getSumaWartosciNiematerialne(): ?string
    {
        return $this->sumaWartosciNiematerialne;
    }

    public function setSumaWartosciNiematerialne(?string $sumaWartosciNiematerialne): self
    {
        $this->sumaWartosciNiematerialne = $sumaWartosciNiematerialne;

        return $this;
    }

    public function getSumaRokPoprzedni(): ?string
    {
        return $this->sumaRokPoprzedni;
    }

    public function setSumaRokPoprzedni(?string $sumaRokPoprzedni): self
    {
        $this->sumaRokPoprzedni = $sumaRokPoprzedni;

        return $this;
    }

    public function getSumaRokBiezacy(): ?string
    {
        return $this->sumaRokBiezacy;
    }

    public function setSumaRokBiezacy(?string $sumaRokBiezacy): self
    {
        $this->sumaRokBiezacy = $sumaRokBiezacy;

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

    public function getSumaGruntyPrzekazaneUzytkowanieWieczyste(): ?string
    {
        return $this->sumaGruntyPrzekazaneUzytkowanieWieczyste;
    }

    public function setSumaGruntyPrzekazaneUzytkowanieWieczyste(?string $sumaGruntyPrzekazaneUzytkowanieWieczyste): self
    {
        $this->sumaGruntyPrzekazaneUzytkowanieWieczyste = $sumaGruntyPrzekazaneUzytkowanieWieczyste;

        return $this;
    }

    public function getSumaGruntyInneNizPrzekazaneUzytkowanieWieczyste(): ?string
    {
        return $this->sumaGruntyInneNizPrzekazaneUzytkowanieWieczyste;
    }

    public function setSumaGruntyInneNizPrzekazaneUzytkowanieWieczyste(?string $sumaGruntyInneNizPrzekazaneUzytkowanieWieczyste): self
    {
        $this->sumaGruntyInneNizPrzekazaneUzytkowanieWieczyste = $sumaGruntyInneNizPrzekazaneUzytkowanieWieczyste;

        return $this;
    }

    public function getSumaGruntyRokPoprzedni(): ?string
    {
        return $this->sumaGruntyRokPoprzedni;
    }

    public function setSumaGruntyRokPoprzedni(?string $sumaGruntyRokPoprzedni): self
    {
        $this->sumaGruntyRokPoprzedni = $sumaGruntyRokPoprzedni;

        return $this;
    }
}
