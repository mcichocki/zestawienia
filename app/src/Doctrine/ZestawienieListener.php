<?php

namespace App\Doctrine;

use App\Entity\Zestawienie;

class ZestawienieListener
{
    public function prePersist(Zestawienie $zestawienie)
    {
//        dd($zestawienie);
    }
}