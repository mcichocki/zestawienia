<?php

namespace App\DataFixtures;

use App\Entity\Jednostka;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use League\Csv\Reader;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function load(ObjectManager $manager)
    {
        $reader = Reader::createFromPath($this->params->get('file_fixtures') . "/" . "jednostki.csv");

        $reader->setDelimiter(',');
        $reader->setHeaderOffset(0);
        $results = $reader->getRecords();

        foreach ($results as $row) {
            $jednostka = new Jednostka();
            $jednostka->setNazwa($row['jdn_nazwa']);
            $jednostka->setUlica($row['jdn_ulica']);
            $jednostka->setNumer($row['jdn_nr_bud']);
            $jednostka->setKodPocztowy($row['jdn_kod_pocztowy']);
            $jednostka->setIdentyfikator((int)$row['jdn_id']);
            $jednostka->setMiasto("Warszawa");
            $jednostka->setNazwaPelna($row['jdn_nazwa_pelna']);
            $jednostka->setSymbol($row['jdn_symbol']);
            $jdn = ($row['jdn_jdn_id'] == "NULL") ? null : (int)$row['jdn_jdn_id'];
            $dn = $this->checkDzielnica($jdn);
            $new = ($dn) ? $dn : null;
            $jednostka->setUrzadID($jdn);
            $jednostka->setDzielnica($new);

            $manager->persist($jednostka);
            $manager->flush();
        }
    }

    private function checkDzielnica($identifier) {
         switch($identifier) {
                case '1': return $this->getReference(DzielnicaFixtures::BEMOWO);
                case '2': return $this->getReference(DzielnicaFixtures::BIALOLEKA);
                case '3': return $this->getReference(DzielnicaFixtures::BIELANY);
                case '4': return $this->getReference(DzielnicaFixtures::MOKOTOW);
                case '5': return $this->getReference(DzielnicaFixtures::OCHOTA);
                case '6': return $this->getReference(DzielnicaFixtures::PRAGA_PLD);
                case '7': return $this->getReference(DzielnicaFixtures::PRAGA_PLN);
                case '8': return $this->getReference(DzielnicaFixtures::REMBERTOW);
                case '9': return $this->getReference(DzielnicaFixtures::SRODMIESCIE);
                case '10': return $this->getReference(DzielnicaFixtures::TARGOWEK);
                case '11': return $this->getReference(DzielnicaFixtures::URSUS);
                case '12': return $this->getReference(DzielnicaFixtures::URSYNOW);
                case '13': return $this->getReference(DzielnicaFixtures::WAWER);
                case '14': return $this->getReference(DzielnicaFixtures::WESOLA);
                case '15': return $this->getReference(DzielnicaFixtures::WILANOW);
                case '16': return $this->getReference(DzielnicaFixtures::WLOCHY);
                case '17': return $this->getReference(DzielnicaFixtures::WOLA);
                case '18': return $this->getReference(DzielnicaFixtures::ZOLIBORZ);
                case '-99': return $this->getReference(DzielnicaFixtures::M_ST_WARSZAWA);
                case '0': return $this->getReference(DzielnicaFixtures::URZAD_MIASTA);
                default: return null;
        }
    }

    public function getDependencies()
    {
        return [
            DzielnicaFixtures::class
        ];
    }
}

