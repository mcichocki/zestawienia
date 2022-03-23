<?php

namespace App\EventListener;

use Doctrine\ORM\EntityManagerInterface;

class SubgroupsListener
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}