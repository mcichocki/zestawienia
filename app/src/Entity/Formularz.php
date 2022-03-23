<?php

namespace App\Entity;

use App\Repository\FormularzRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormularzRepository::class)
 * @ORM\Table(name="formularze")
 * @ORM\EntityListeners({"App\Doctrine\FormularzListener"})
 */
class Formularz
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Jednostka::class, inversedBy="formularze")
     * @ORM\JoinColumn(nullable=false)
     */
    private $jednostka;

    /**
     * @ORM\ManyToOne(targetEntity=Uzytkownik::class, inversedBy="formularze")
     */
    private $worker;

    /**
     * @ORM\ManyToOne(targetEntity=RokZestawieniowy::class, inversedBy="formularze")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rokZestawieniowy;

    /**
     * @ORM\ManyToOne(targetEntity=FormaOrganizacyjna::class, inversedBy="formularzeV1")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formaOrganizacyjnaRokPoprzedni;

    /**
     * @ORM\ManyToOne(targetEntity=FormaOrganizacyjna::class, inversedBy="formularzeV2")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formaOrganizacyjnaRokAktualny;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dataUtworzenia;

    /**
     * @ORM\OneToMany(targetEntity=Zestawienie::class, mappedBy="formularz", cascade={"remove"})
     */
    private $zestawienia;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     *
     * @var string
     */
    protected $state;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $notatka;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $sumaRokAktualny;

    public function __construct()
    {
        $this->zestawienia = new ArrayCollection();
        $this->dataUtworzenia = new \DateTime("now");
    }

    /**
     * @ORM\OneToMany(targetEntity=Przeplyw::class, mappedBy="formularz", cascade={"remove"}, fetch="EAGER")
     */
    public $przeplywy;

    /**
     * @ORM\OneToMany(targetEntity=Podsumowanie::class, mappedBy="formularz", cascade={"remove"})
     */
    public $podsumowania;

    /**
     * @ORM\OneToMany(targetEntity=ListaCzynnikow::class, mappedBy="formularz", cascade={"remove"})
     */
    public $czynniki;

    /**
     * @ORM\OneToMany(targetEntity=Wiadomosc::class, mappedBy="formularz", cascade={"remove"})
     */
    public $wiadomosci;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJednostka(): ?Jednostka
    {
        return $this->jednostka;
    }

    public function setJednostka(?Jednostka $jednostka): self
    {
        $this->jednostka = $jednostka;

        return $this;
    }

    public function getWorker(): ?Uzytkownik
    {
        return $this->worker;
    }

    public function setWorker(?Uzytkownik $worker): self
    {
        $this->worker = $worker;

        return $this;
    }

    public function getRokZestawieniowy(): ?RokZestawieniowy
    {
        return $this->rokZestawieniowy;
    }

    public function setRokZestawieniowy(?RokZestawieniowy $rokZestawieniowy): self
    {
        $this->rokZestawieniowy = $rokZestawieniowy;

        return $this;
    }

    public function getFormaOrganizacyjnaRokPoprzedni(): ?FormaOrganizacyjna
    {
        return $this->formaOrganizacyjnaRokPoprzedni;
    }

    public function setFormaOrganizacyjnaRokPoprzedni(?FormaOrganizacyjna $formaOrganizacyjnaRokPoprzedni): self
    {
        $this->formaOrganizacyjnaRokPoprzedni = $formaOrganizacyjnaRokPoprzedni;

        return $this;
    }

    public function getFormaOrganizacyjnaRokAktualny(): ?FormaOrganizacyjna
    {
        return $this->formaOrganizacyjnaRokAktualny;
    }

    public function setFormaOrganizacyjnaRokAktualny(?FormaOrganizacyjna $formaOrganizacyjnaRokAktualny): self
    {
        $this->formaOrganizacyjnaRokAktualny = $formaOrganizacyjnaRokAktualny;

        return $this;
    }

    public function getDataUtworzenia(): ?\DateTimeInterface
    {
        return $this->dataUtworzenia;
    }

    public function setDataUtworzenia(\DateTimeInterface $dataUtworzenia): self
    {
        $this->dataUtworzenia = $dataUtworzenia;

        return $this;
    }

    /**
     * @return Collection|Zestawienie[]
     */
    public function getZestawienia(): Collection
    {
        return $this->zestawienia;
    }

    /**
     * @return Collection|Podsumowanie[]
     */
    public function getPodsumowania(): Collection
    {
        return $this->podsumowania;
    }

    public function addZestawienie(Zestawienie $zest): self
    {
        if (!$this->zestawienia->contains($zest)) {
            $this->zestawienia[] = $zest;
            $zest->setFormularz($this);
        }

        return $this;
    }

    public function removeZestawienie(Zestawienie $zest): self
    {
        if ($this->zestawienia->removeElement($zest)) {
            // set the owning side to null (unless already changed)
            if ($zest->getFormularz() === $this) {
                $zest->setFormularz(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param string $state
     *
     * @return Workflowable
     */
    public function setState(string $state,  $context = []): self
    {
        $this->state = $state;

        return $this;
    }

    public function getNotatka(): ?string
    {
        return $this->notatka;
    }

    public function setNotatka(?string $notatka): self
    {
        $this->notatka = $notatka;

        return $this;
    }

    public function getSumaRokAktualny(): ?float
    {
        return $this->sumaRokAktualny;
    }

    public function setSumaRokAktualny(?float $sumaRokAktualny): self
    {
        $this->sumaRokAktualny = $sumaRokAktualny;

        return $this;
    }
}
