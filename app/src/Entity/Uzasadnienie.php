<?php

namespace App\Entity;

use App\Repository\UzasadnienieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UzasadnienieRepository::class)
 * @ORM\Table(name="uzasadnienia")
 */
class Uzasadnienie
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
    private $komentarzPozytywny;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $komentarzNegatywny;

    /**
     * @ORM\ManyToOne(targetEntity=Zestawienie::class, inversedBy="uzasadnienia")
     * @ORM\JoinColumn(nullable=false)
     */
    private $zestawienie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKomentarzPozytywny(): ?string
    {
        return $this->komentarzPozytywny;
    }

    public function setKomentarzPozytywny(?string $komentarzPozytywny): self
    {
        $this->komentarzPozytywny = $komentarzPozytywny;

        return $this;
    }

    public function getKomentarzNegatywny(): ?string
    {
        return $this->komentarzNegatywny;
    }

    public function setKomentarzNegatywny(?string $komentarzNegatywny): self
    {
        $this->komentarzNegatywny = $komentarzNegatywny;

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
}
