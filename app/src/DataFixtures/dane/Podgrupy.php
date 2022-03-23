<?php 

namespace App\DataFixtures\dane;

trait Podgrupy 
{
    public function getDanePodgrupy(): array
    {
        $array = [
            0 => [
                'nazwa' => 'Grunty inne niż przekazane w użytkowanie wieczyste',
                'status' => 1,
            ],
            1 => [
                'nazwa' => 'Grunty przekazane w użytkowanie wieczyste',
                'status' => 1,
            ],
            2 => [
                'nazwa' => 'Nieruchomości inwestycyjne',
                'status' => 1,
            ],
            3 => [
                'nazwa' => 'Budynki, lokale i obiekty inżynierii lądowej i wodnej',
                'status' => 1,
            ],
            4 => [
                'nazwa' => 'Pozostałe środki trwałe',
                'status' => 1,
            ],
            5 => [
                'nazwa' => 'Należności długoterminowe',
                'status' => 1,
            ],
            6 => [
                'nazwa' => 'Wartości niematerialne i prawne',
                'status' => 1,
            ],
            7 => [
                'nazwa' => 'Długoterminowe aktywa finansowe',
                'status' => 1,
            ]
        ];

        return $array;
    }
}