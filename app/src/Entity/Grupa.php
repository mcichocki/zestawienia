<?php

namespace App\Entity;

use App\Repository\GrupaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GrupaRepository::class)
 * @ORM\Table(name="grupy")
 */
class Grupa
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
    private $nazwa;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=Podgrupa::class, mappedBy="grupa")
     */
    private $podgrupa;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $robocza;

    public function __construct()
    {
        $this->podgrupa = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazwa(): ?string
    {
        return $this->nazwa;
    }

    public function setNazwa(string $nazwa): self
    {
        $this->nazwa = $nazwa;

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
     * @return Collection|Podgrupa[]
     */
    public function getPodgrupa(): Collection
    {
        return $this->podgrupa;
    }

    public function addPodgrupa(Podgrupa $podgrupa): self
    {
        if (!$this->podgrupa->contains($podgrupa)) {
            $this->podgrupa[] = $podgrupa;
            $podgrupa->setGrupa($this);
        }

        return $this;
    }

    public function removePodgrupa(Podgrupa $podgrupa): self
    {
        if ($this->podgrupa->removeElement($podgrupa)) {
            // set the owning side to null (unless already changed)
            if ($podgrupa->getGrupa() === $this) {
                $podgrupa->setGrupa(null);
            }
        }

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
}
