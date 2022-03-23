<?php

namespace App\Entity;

use App\Repository\FormaOrganizacyjnaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormaOrganizacyjnaRepository::class)
 * @ORM\Table(name="formy_organizacyjne")
 */
class FormaOrganizacyjna
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $identyfikator;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $skrot;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=Jednostka::class, mappedBy="formaOrganizacyjna")
     */
    private $jednostki;

    /**
     * @ORM\OneToMany(targetEntity=Formularz::class, mappedBy="formaOrganizacyjnaRokPoprzedni")
     */
    private $formularzeV1;

    /**
     * @ORM\OneToMany(targetEntity=Formularz::class, mappedBy="formaOrganizacyjnaRokAktualny")
     */
    private $formularzeV2;

    public function __construct()
    {
        $this->jednostki = new ArrayCollection();
        $this->formularzeV1 = new ArrayCollection();
        $this->formularzeV2 = new ArrayCollection();
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

    public function getIdentyfikator(): ?int
    {
        return $this->identyfikator;
    }

    public function setIdentyfikator(?int $identyfikator): self
    {
        $this->identyfikator = $identyfikator;

        return $this;
    }

    public function getSkrot(): ?string
    {
        return $this->skrot;
    }

    public function setSkrot(?string $skrot): self
    {
        $this->skrot = $skrot;

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
            $jednostki->setFormaOrganizacyjna($this);
        }

        return $this;
    }

    public function removeJednostki(Jednostka $jednostki): self
    {
        if ($this->jednostki->removeElement($jednostki)) {
            // set the owning side to null (unless already changed)
            if ($jednostki->getFormaOrganizacyjna() === $this) {
                $jednostki->setFormaOrganizacyjna(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nazwa;
    }

    /**
     * @return Collection|Formularz[]
     */
    public function getFormularzeV1(): Collection
    {
        return $this->formularzeV1;
    }

    public function addFormularzeV1(Formularz $formularzeV1): self
    {
        if (!$this->formularzeV1->contains($formularzeV1)) {
            $this->formularzeV1[] = $formularzeV1;
            $formularzeV1->setFormaOrganizacyjnaRokPoprzedni($this);
        }

        return $this;
    }

    public function removeFormularzeV1(Formularz $formularzeV1): self
    {
        if ($this->formularzeV1->removeElement($formularzeV1)) {
            // set the owning side to null (unless already changed)
            if ($formularzeV1->getFormaOrganizacyjnaRokPoprzedni() === $this) {
                $formularzeV1->setFormaOrganizacyjnaRokPoprzedni(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Formularz[]
     */
    public function getFormularzeV2(): Collection
    {
        return $this->formularzeV2;
    }

    public function addFormularzeV2(Formularz $formularzeV2): self
    {
        if (!$this->formularzeV2->contains($formularzeV2)) {
            $this->formularzeV2[] = $formularzeV2;
            $formularzeV2->setFormaOrganizacyjnaRokAktualny($this);
        }

        return $this;
    }

    public function removeFormularzeV2(Formularz $formularzeV2): self
    {
        if ($this->formularzeV2->removeElement($formularzeV2)) {
            // set the owning side to null (unless already changed)
            if ($formularzeV2->getFormaOrganizacyjnaRokAktualny() === $this) {
                $formularzeV2->setFormaOrganizacyjnaRokAktualny(null);
            }
        }

        return $this;
    }
}
