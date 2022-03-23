<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Zestawienie;

class ZestawieniePersister implements DataPersisterInterface
{
    public function supports($data): bool
    {
        return $data instanceof Zestawienie;
        // TODO: Implement supports() method.
    }

    public function persist($data)
    {
        // TODO: Implement persist() method.
    }

    public function remove($data)
    {
        // TODO: Implement remove() method.
    }

}