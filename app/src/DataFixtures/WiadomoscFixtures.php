<?php

namespace App\DataFixtures;

use App\Entity\Wiadomosc;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class WiadomoscFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
//        $wiadomosc = new Wiadomosc();
//        $wiadomosc->setTytul("Październikowe zestawienie");
//        $wiadomosc->setTresc("Sprawdziłam wysłane zestawienie, ale nie mogę odczytać formatu pliku.");
//        $wiadomosc->setCzyOdczytano(0);
//        $wiadomosc->setOdKogo($this->getReference(UzytkownikFixtures::NADAWCA));
//        $wiadomosc->setDoKogo($this->getReference(UzytkownikFixtures::ODBIORCA));
//        $wiadomosc->setFormularz(null);
//        $manager->persist($wiadomosc);
//        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UzytkownikFixtures::class
        ];
    }
}
