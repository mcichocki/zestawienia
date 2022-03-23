<?php

namespace App\DataFixtures;


use App\DataFixtures\dane\LataZestawieniowe;
use App\Entity\RokZestawieniowy;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RokZestawieniowyFixtures extends Fixture
{
    use LataZestawieniowe;
    
    public function load(ObjectManager $manager)
    {
        $array = $this->getLataZestawieniowe();
        
        for($i=0; $i<count($array); $i++) {
            $rok[$i] = new RokZestawieniowy();
            $rok[$i]->setRok($array[$i]['rok']);
            $rok[$i]->setIdentyfikator($array[$i]['identyfikator']);
            $rok[$i]->setStatus($array[$i]['status']);
            $rok[$i]->setKolejnosc($array[$i]['kolejnosc']);
            $rok[$i]->setRobocza($array[$i]['robocza']);
            $manager->persist($rok[$i]);
        }
        $manager->flush();
    }
}
