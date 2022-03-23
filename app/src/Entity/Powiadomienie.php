<?php

namespace App\Entity;

use App\Repository\PowiadomienieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PowiadomienieRepository::class)
 * @ORM\Table(name="powiadomienia")
 */
class Powiadomienie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    public function getId(): ?int
    {
        return $this->id;
    }
}
