<?php

namespace App\Entity;

use App\Repository\CzatRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=CzatRepository::class)
 */
class Czat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", unique=true)
     */
    private int $id;

    /**
     * @ORM\Column(type="uuid", unique=true)
     */
    private $identyfikator;

    public function getId(): string
    {
        return $this->id;
    }

    public function __construct()
    {
        $this->identyfikator = Uuid::uuid4();
    }

    public function getIdentyfikator(): ?string
    {
        return $this->identyfikator;
    }

}
