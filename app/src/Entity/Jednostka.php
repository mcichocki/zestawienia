<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\JednostkaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JednostkaRepository::class)
 * @ORM\Table(name="jednostki")
 */
class Jednostka
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
    private $nazwa;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ulica;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $numer;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $kodPocztowy;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $identyfikator;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $miasto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nazwaPelna;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $symbol;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $urzadID;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $formaOrganizacyjnaIDF;

    /**
     * @ORM\ManyToOne(targetEntity=Dzielnica::class, inversedBy="jednostki")
     */
    private $dzielnica;

    /**
     * @ORM\ManyToOne(targetEntity=FormaOrganizacyjna::class, inversedBy="jednostki")
     */
    private $formaOrganizacyjna;

    /**
     * @ORM\OneToMany(targetEntity=Formularz::class, mappedBy="jednostka", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $formularze;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $appV1;

    public function __construct()
    {
        $this->formularze = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazwa(): ?string
    {
        return $this->nazwa;
    }

    public function setNazwa(?string $nazwa): self
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    public function getUlica(): ?string
    {
        return $this->ulica;
    }

    public function setUlica(?string $ulica): self
    {
        $this->ulica = $ulica;

        return $this;
    }

    public function getNumer(): ?string
    {
        return $this->numer;
    }

    public function setNumer(?string $numer): self
    {
        $this->numer = $numer;

        return $this;
    }

    public function getKodPocztowy(): ?string
    {
        return $this->kodPocztowy;
    }

    public function setKodPocztowy(?string $kodPocztowy): self
    {
        $this->kodPocztowy = $kodPocztowy;

        return $this;
    }

    public function getIdentyfikator(): ?int
    {
        return $this->identyfikator;
    }

    public function setIdentyfikator(?int $identyfikator): self
    {
        $this->identyfikator = $identyfikator;

        return $this;
    }

    public function getMiasto(): ?string
    {
        return $this->miasto;
    }

    public function setMiasto(?string $miasto): self
    {
        $this->miasto = $miasto;

        return $this;
    }

    public function getNazwaPelna(): ?string
    {
        return $this->nazwaPelna;
    }

    public function setNazwaPelna(?string $nazwaPelna): self
    {
        $this->nazwaPelna = $nazwaPelna;

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

    public function getUrzadID(): ?int
    {
        return $this->urzadID;
    }

    public function setUrzadID(?int $urzadID): self
    {
        $this->urzadID = $urzadID;

        return $this;
    }

    public function getFormaOrganizacyjnaIDF(): ?int
    {
        return $this->formaOrganizacyjnaIDF;
    }

    public function setFormaOrganizacyjnaIDF(?int $formaOrganizacyjnaIDF): self
    {
        $this->formaOrganizacyjnaIDF = $formaOrganizacyjnaIDF;

        return $this;
    }

    public function getDzielnica(): ?Dzielnica
    {
        return $this->dzielnica;
    }

    public function setDzielnica(?Dzielnica $dzielnica): self
    {
        $this->dzielnica = $dzielnica;

        return $this;
    }

    public function getFormaOrganizacyjna(): ?FormaOrganizacyjna
    {
        return $this->formaOrganizacyjna;
    }

    public function setFormaOrganizacyjna(?FormaOrganizacyjna $formaOrganizacyjna): self
    {
        $this->formaOrganizacyjna = $formaOrganizacyjna;

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
            $formularze->setJednostka($this);
        }

        return $this;
    }

    public function removeFormularze(Formularz $formularze): self
    {
        if ($this->formularze->removeElement($formularze)) {
            // set the owning side to null (unless already changed)
            if ($formularze->getJednostka() === $this) {
                $formularze->setJednostka(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nazwa;
    }

    public function getAppV1(): ?int
    {
        return $this->appV1;
    }

    public function setAppV1(?int $appV1): self
    {
        $this->appV1 = $appV1;

        return $this;
    }
}
