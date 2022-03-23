<?php

namespace App\DataFixtures;

use App\Entity\Grupa;
use App\DataFixtures\dane\Grupy;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GrupaFixtures extends Fixture
{
    use Grupy;

    public const GRUPA_GRUNTY = 'relation-grunty';
    public const GRUPA_NIERUCHOMOSCI = 'relation-nieruchomosci';
    public const GRUPA_BUDYNKI = 'relation-budynki';
    public const GRUPA_POZOSTALE_SRODKI_TRWALE = 'relation-pozostale-srodki-trwale';
    public const GRUPA_SRODKI_TRWALE_W_BUDOWIE = 'relation-srodki-trwale-w-budowie';
    public const GRUPA_NALEZNOSCI_DLUGOTERMINOWE = 'relation-naleznosci-dlugoterminowe';
    public const GRUPA_WARTOSCI_NIEMATERIALNE = 'relation-wartosci-niematerialne';
    public const GRUPA_DLUGOTERMINOWE_AKTYWA = 'relation-dlugoterminowe-aktywa';
    
    public function load(ObjectManager $manager)
    {
        $array = $this->getDaneGrupy();
        
        for($i=0; $i<count($array); $i++) {
            $grupa[$i] = new Grupa();
            $grupa[$i]->setNazwa($array[$i]['nazwa']);
            $grupa[$i]->setStatus($array[$i]['status']);
            $grupa[$i]->setRobocza($array[$i]['robocza']);
            $manager->persist($grupa[$i]);
        }
        $manager->flush();

        $this->addReference(self::GRUPA_GRUNTY, $grupa[0]);
        $this->addReference(self::GRUPA_NIERUCHOMOSCI, $grupa[1]);
        $this->addReference(self::GRUPA_BUDYNKI, $grupa[2]);
        $this->addReference(self::GRUPA_POZOSTALE_SRODKI_TRWALE, $grupa[3]);
        $this->addReference(self::GRUPA_SRODKI_TRWALE_W_BUDOWIE, $grupa[4]);
        $this->addReference(self::GRUPA_NALEZNOSCI_DLUGOTERMINOWE, $grupa[5]);
        $this->addReference(self::GRUPA_WARTOSCI_NIEMATERIALNE, $grupa[6]);
        $this->addReference(self::GRUPA_DLUGOTERMINOWE_AKTYWA, $grupa[7]);
    }
}
