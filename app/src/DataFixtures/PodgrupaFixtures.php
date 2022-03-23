<?php

namespace App\DataFixtures;

use App\Entity\Podgrupa;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class PodgrupaFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $array = [
            0 => [
                'nazwa' => 'Grunty inne niż przekazane w użytkowanie wieczyste',
                'robocza' => "grunty_inne_niz_przekazane_w_uzytkowanie_wieczyste",
                'status' => 1,
                'grupa' => $this->getReference(GrupaFixtures::GRUPA_GRUNTY),
                'kolejnosc' => 3,
            ],
            1 => [
                'nazwa' => 'Grunty przekazane w użytkowanie wieczyste',
                'robocza' => "grunty_przekazane_w_uzytkowanie_wieczyste",
                'status' => 1,
                'grupa' => $this->getReference(GrupaFixtures::GRUPA_GRUNTY),
                'kolejnosc' => 2,
            ],
            2 => [
                'nazwa' => 'Nieruchomości inwestycyjne',
                'robocza' => "nieruchomosci_inwestycyjne",
                'status' => 1,
                'grupa' => $this->getReference(GrupaFixtures::GRUPA_NIERUCHOMOSCI),
                'kolejnosc' => 4,
            ],
            3 => [
                'nazwa' => 'Budynki, lokale i obiekty inżynierii lądowej i wodnej',
                'robocza' => "budynki_lokale_i_obiekty_inzynierii_ladowej_i_wodnej",
                'status' => 1,
                'grupa' => $this->getReference(GrupaFixtures::GRUPA_BUDYNKI),
                'kolejnosc' => 1,
            ],
            4 => [
                'nazwa' => 'Pozostałe środki trwałe',
                'robocza' => "pozostale_srodki_trwale",
                'status' => 1,
                'grupa' => $this->getReference(GrupaFixtures::GRUPA_POZOSTALE_SRODKI_TRWALE),
                'kolejnosc' => 7,
            ],
            5 => [
                'nazwa' => 'Środki trwałe w budowie i zaliczki na ich poczet',
                'robocza' => "srodki_trwale_w_budowie_i_zaliczki_na_ich_poczet",
                'status' => 1,
                'grupa' => $this->getReference(GrupaFixtures::GRUPA_SRODKI_TRWALE_W_BUDOWIE),
                'kolejnosc' => 8,
            ],
            6 => [
                'nazwa' => 'Należności długoterminowe',
                'robocza' => "naleznosci_dlugoterminowe",
                'status' => 1,
                'grupa' => $this->getReference(GrupaFixtures::GRUPA_NALEZNOSCI_DLUGOTERMINOWE),
                'kolejnosc' => 5,
            ],
            7 => [
                'nazwa' => 'Wartości niematerialne i prawne',
                'robocza' => "wartosci_niematerialne_i_prawne",
                'status' => 1,
                'grupa' => $this->getReference(GrupaFixtures::GRUPA_WARTOSCI_NIEMATERIALNE),
                'kolejnosc' => 9,
            ],
            8 => [
                'nazwa' => 'Długoterminowe aktywa finansowe',
                'robocza' => "dlugoterminowe_aktywa_finansowe",
                'status' => 1,
                'grupa' => $this->getReference(GrupaFixtures::GRUPA_DLUGOTERMINOWE_AKTYWA),
                'kolejnosc' => 6,
            ]
        ];

        for($i=0; $i<count($array); $i++) {
            $podgrupa[$i] = new Podgrupa();
            $podgrupa[$i]->setGrupa($array[$i]['grupa']);
            $podgrupa[$i]->setNazwa($array[$i]['nazwa']);
            $podgrupa[$i]->setRobocza($array[$i]['robocza']);
            $podgrupa[$i]->setStatus($array[$i]['status']);
            $podgrupa[$i]->setKolejnosc($array[$i]['kolejnosc']);
            $manager->persist($podgrupa[$i]);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            GrupaFixtures::class
        ];
    }
}
