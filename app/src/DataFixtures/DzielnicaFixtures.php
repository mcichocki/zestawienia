<?php

namespace App\DataFixtures;

use App\DataFixtures\dane\Dzielnice;
use App\Entity\Dzielnica;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DzielnicaFixtures extends Fixture
{
    use Dzielnice;

    public const BEMOWO = 'dzielnica-bemowo';
    public const BIALOLEKA = 'dzielnica-bialoleka';
    public const BIELANY = 'dzielnica-bielany';
    public const MOKOTOW = 'dzielnica-mokotow';
    public const OCHOTA = 'dzielnica-ochota';
    public const PRAGA_PLD = 'dzielnica-praga-pld';
    public const PRAGA_PLN = 'dzielnica-praca-pln';
    public const REMBERTOW = 'dzielnica-rembertow';
    public const SRODMIESCIE = 'dzielnica-srodmiescie';
    public const TARGOWEK = 'dzielnica-targowek';
    public const URSUS = 'dzielnica-ursus';
    public const URSYNOW = 'dzielnica-ursynow';
    public const WAWER = 'dzielnica-wawer';
    public const WESOLA = 'dzielnica-wesola';
    public const WILANOW = 'dzielnica-wilanow';
    public const WLOCHY = 'dzielnica-wlochy';
    public const WOLA = 'dzielnica-wola';
    public const ZOLIBORZ = 'dzielnica-zoliborz';
    public const M_ST_WARSZAWA = 'dzielnica-m-st-warszawa';
    public const URZAD_MIASTA = 'dzielnica-urzad-miasta';

    public function load(ObjectManager $manager)
    {
        $dzielnice = $this->getDaneDzielnic();        

        for($i=0; $i<count($dzielnice); $i++) {
            $nowa_dzielnica[$i] = new Dzielnica();
            $nowa_dzielnica[$i]->setNazwa($dzielnice[$i]["nazwa"]);
            $nowa_dzielnica[$i]->setRobocza($dzielnice[$i]["robocza"]);
            $nowa_dzielnica[$i]->setStatus($dzielnice[$i]["status"]);
            $nowa_dzielnica[$i]->setIdentyfikator($dzielnice[$i]["identyfikator"]);
            $nowa_dzielnica[$i]->setSymbol($dzielnice[$i]["symbol"]);
            $manager->persist($nowa_dzielnica[$i]);
        }
        $manager->flush();

        $this->addReference(self::BEMOWO, $nowa_dzielnica[0]);
        $this->addReference(self::BIALOLEKA, $nowa_dzielnica[1]);
        $this->addReference(self::BIELANY, $nowa_dzielnica[2]);
        $this->addReference(self::MOKOTOW, $nowa_dzielnica[3]);
        $this->addReference(self::OCHOTA, $nowa_dzielnica[4]);
        $this->addReference(self::PRAGA_PLD, $nowa_dzielnica[5]);
        $this->addReference(self::PRAGA_PLN, $nowa_dzielnica[6]);
        $this->addReference(self::REMBERTOW, $nowa_dzielnica[7]);
        $this->addReference(self::SRODMIESCIE, $nowa_dzielnica[8]);
        $this->addReference(self::TARGOWEK, $nowa_dzielnica[9]);
        $this->addReference(self::URSUS, $nowa_dzielnica[10]);
        $this->addReference(self::URSYNOW, $nowa_dzielnica[11]);
        $this->addReference(self::WAWER, $nowa_dzielnica[12]);
        $this->addReference(self::WESOLA, $nowa_dzielnica[13]);
        $this->addReference(self::WILANOW, $nowa_dzielnica[14]);
        $this->addReference(self::WLOCHY, $nowa_dzielnica[15]);
        $this->addReference(self::WOLA, $nowa_dzielnica[16]);
        $this->addReference(self::ZOLIBORZ, $nowa_dzielnica[17]);
        $this->addReference(self::M_ST_WARSZAWA, $nowa_dzielnica[18]);
        $this->addReference(self::URZAD_MIASTA, $nowa_dzielnica[19]);
    }
}
