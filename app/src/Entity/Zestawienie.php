<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ZestawienieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ZestawienieRepository::class)
 * @ORM\Table(name="zestawienia")
 */
class Zestawienie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Formularz::class, inversedBy="zestawienia")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formularz;

    /**
     * @ORM\ManyToOne(targetEntity=Podgrupa::class, inversedBy="zestawienia")
     * @ORM\JoinColumn(nullable=false)
     */
    private $podgrupa;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=2, nullable=true)
     */
    private $wartoscRokZestawieniowy;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=2, nullable=true)
     */
    private $wartoscRokPoprzedni;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=2, nullable=true)
     */
    private $wartoscRoznicaKwot;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=2, nullable=true)
     */
    private $wartoscProcentowa;

    /**
     * @ORM\OneToMany(targetEntity=Uzasadnienie::class, mappedBy="zestawienie")
     */
    private $uzasadnienia;

    /**
     * @ORM\ManyToOne(targetEntity=Korekta::class, inversedBy="zestawienia", cascade={"remove"})
     */
    private $korekta;

    public function __construct()
    {
        $this->uzasadnienia = new ArrayCollection();
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

    public function getPodgrupa(): ?Podgrupa
    {
        return $this->podgrupa;
    }

    public function setPodgrupa(?Podgrupa $podgrupa): self
    {
        $this->podgrupa = $podgrupa;

        return $this;
    }

    public function getWartoscRokZestawieniowy(): ?string
    {
        return $this->wartoscRokZestawieniowy;
    }

    public function setWartoscRokZestawieniowy(?string $wartoscRokZestawieniowy): self
    {
        $this->wartoscRokZestawieniowy = $wartoscRokZestawieniowy;

        return $this;
    }

    public function getWartoscRokPoprzedni(): ?string
    {
        return $this->wartoscRokPoprzedni;
    }

    public function setWartoscRokPoprzedni(?string $wartoscRokPoprzedni): self
    {
        $this->wartoscRokPoprzedni = $wartoscRokPoprzedni;

        return $this;
    }

    public function getWartoscRoznicaKwot(): ?string
    {
        return $this->wartoscRoznicaKwot;
    }

    public function setWartoscRoznicaKwot(?string $wartoscRoznicaKwot): self
    {
        $this->wartoscRoznicaKwot = $wartoscRoznicaKwot;

        return $this;
    }

    public function getWartoscProcentowa(): ?string
    {
        return $this->wartoscProcentowa;
    }

    public function setWartoscProcentowa(?string $wartoscProcentowa): self
    {
        $this->wartoscProcentowa = $wartoscProcentowa;

        return $this;
    }

    /**
     * @return Collection|Uzasadnienie[]
     */
    public function getUzasadnienia(): Collection
    {
        return $this->uzasadnienia;
    }

    public function addUzasadnienium(Uzasadnienie $uzasadnienium): self
    {
        if (!$this->uzasadnienia->contains($uzasadnienium)) {
            $this->uzasadnienia[] = $uzasadnienium;
            $uzasadnienium->setZestawienie($this);
        }

        return $this;
    }

    public function removeUzasadnienium(Uzasadnienie $uzasadnienium): self
    {
        if ($this->uzasadnienia->removeElement($uzasadnienium)) {
            // set the owning side to null (unless already changed)
            if ($uzasadnienium->getZestawienie() === $this) {
                $uzasadnienium->setZestawienie(null);
            }
        }

        return $this;
    }

    public function getKorekta(): ?Korekta
    {
        return $this->korekta;
    }

    public function setKorekta(?Korekta $korekta): self
    {
        $this->korekta = $korekta;

        return $this;
    }
}
