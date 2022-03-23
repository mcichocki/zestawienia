<?php 

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

class Builder
{
    protected $zestawienia;
    protected $nazwa;
    protected $uzasadnienia;
    protected $podsumowanie;

    public function __construct()
    {
        $this->zestawienia = new ArrayCollection();
        $this->nazwa = new ArrayCollection();
        $this->uzasadnienia = new ArrayCollection();
        $this->podsumowanie = new ArrayCollection();
    }

    public function getNazwa(): Collection
    {
        return $this->nazwa;
    }

    public function getUzasadnienia(): Collection
    {
        return $this->uzasadnienia;
    }

    public function getZestawienia(): Collection
    {
        return $this->zestawienia;
    }

    public function getPodsumowanie(): Collection
    {
        return $this->podsumowanie;
    }
}