<?php

namespace App\DataFixtures\dane;

trait Grupy 
{
    public function getDaneGrupy(): array
    {
        $array = [
            0 => [
                'nazwa' => 'Grunty',
                'robocza' => 'grunty',
                'status' => 1,
            ],
            1 => [
                'nazwa' => 'Nieruchomości inwestycyjne',
                'robocza' => 'nieruchomosci_inwestycyjne',
                'status' => 1,
            ],
            2 => [
                'nazwa' => 'Budynki, lokale i obiekty inżynierii lądowej i wodnej',
                'robocza' => 'budynki_lokale_i_obiekty_inzyniernii_ladowej_i_wodnej',
                'status' => 1,
            ],
            3 => [
                'nazwa' => 'Pozostałe środki trwałe',
                'robocza' => 'pozostale_srodki_trwale',
                'status' => 1,
            ],
            4 => [
                'nazwa' => 'Środki trwałe w budowie i zaliczki na ich poczet',
                'robocza' => 'srodki_trwale_w_budowie_i_zaliczki_na_ich_poczet',
                'status' => 1,
            ],
            5 => [
                'nazwa' => 'Należności długoterminowe',
                'robocza' => 'naleznosci_dlugoterminowe',
                'status' => 1,
            ],
            6 => [
                'nazwa' => 'Wartości niematerialne i prawne',
                'robocza' => 'wartosci_niematerialne_i_prawne',
                'status' => 1,
            ],
            7 => [
                'nazwa' => 'Długoterminowe aktywa finansowe',
                'robocza' => 'dlugoterminowe_aktywa_finansowe',
                'status' => 1,
            ]
        ];

        return $array;
    }
}
