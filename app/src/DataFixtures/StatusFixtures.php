<?php

namespace App\DataFixtures;

use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatusFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $array = [
            0 => [
                "tresc" => "<b>Utworzenie</b> nowego zestawienia",
                "icon" => "fas fa-plus",
                "identyfikator" => "1",
                "klasa" => "bg-blue"
            ],
            1 => [
                "tresc" => "<b>Wysłanie</b> do akceptacji przez przełożonego",
                "icon" => "fas fa-user",
                "identyfikator" => "2",
                "klasa" => "bg-warning"
            ],
            2 => [
                "tresc" => "<b>Akceptacja</b> zestawienia przez przełożonego, wysłanie do akceptacji przez dyrektora BPB",
                "icon" => "fas fa-check-circle",
                "identyfikator" => "3",
                "klasa" => "bg-info"
            ],
            3 => [
                "tresc" => "<b>Akceptacja</b> zestawienia przez dyrektora BPB",
                "icon" => "fas fa-check",
                "identyfikator" => "4",
                "klasa" => "bg-success"
            ],
            4 => [
                "tresc" => "<b>Cofnięcie</b> zestawienia przez dyrektora BPB, do poprawy przez pracownika",
                "icon" => "fas fa-times",
                "identyfikator" => "5",
                "klasa" => "bg-danger"
            ],
            5 => [
                "tresc" => "<b>Cofnięcie</b> zestawienia przez przełożonego, do poprawy przez pracownika",
                "icon" => "fas fa-times",
                "identyfikator" => "6",
                "klasa" => "bg-danger"
            ]
        ];

        for($i=0; $i<count($array); $i++)
        {
            $status[$i] = new Status();
            $status[$i]->setTresc($array[$i]['tresc']);
            $status[$i]->setIcon($array[$i]['icon']);
            $status[$i]->setIdentyfikator($array[$i]['identyfikator']);
            $status[$i]->setKlasa($array[$i]['klasa']);
            $manager->persist($status[$i]);
        }
        $manager->flush();
    }
}
