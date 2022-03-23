<?php

namespace App\DataFixtures;

use App\Entity\FormaOrganizacyjna;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FormaOrganizacyjnaFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
//        $fo0 = new FormaOrganizacyjna();
//        $fo0->setNazwa("");
//        $fo0->setSkrot("JB");
//        $fo0->setStatus(1);
//        $fo0->setIdentyfikator(0);
//        $manager->persist($fo0);

        $fo1 = new FormaOrganizacyjna();
        $fo1->setNazwa("Jednostka budżetowa");
        $fo1->setSkrot("JB");
        $fo1->setStatus(1);
        $fo1->setIdentyfikator(1);
        $manager->persist($fo1);

        $fo2 = new FormaOrganizacyjna();
        $fo2->setNazwa("Samorządowy zakład budżetowy");
        $fo2->setSkrot("SZB");
        $fo2->setStatus(1);
        $fo2->setIdentyfikator(2);
        $manager->persist($fo2);

        $fo3 = new FormaOrganizacyjna();
        $fo3->setNazwa("Jednostka samorządu terytorialnego");
        $fo3->setSkrot("JST");
        $fo3->setStatus(1);
        $fo3->setIdentyfikator(3);
        $manager->persist($fo3);

        $manager->flush();
    }
}
