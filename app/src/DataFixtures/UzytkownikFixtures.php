<?php

namespace App\DataFixtures;

use App\DataFixtures\dane\Uzytkownicy;
use App\Entity\Uzytkownik;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UzytkownikFixtures extends Fixture implements DependentFixtureInterface
{
    use Uzytkownicy;
    private $passwordHasher;

    public const NADAWCA = 'relation-nadawca';
    public const ODBIORCA = 'relation-odbiorca';

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $uzytkownicy = $this->getDaneUzytkownicy();
        
        for($i=0; $i<count($uzytkownicy); $i++) {
            $uzytkownik[$i] = new Uzytkownik();
            $uzytkownik[$i]->setImie($uzytkownicy[$i]['imie']);
            $uzytkownik[$i]->setNazwisko($uzytkownicy[$i]['nazwisko']);
            $uzytkownik[$i]->setEmail($uzytkownicy[$i]['email']);
            $uzytkownik[$i]->setLogin($uzytkownicy[$i]['login']);
            $uzytkownik[$i]->setRoles($uzytkownicy[$i]['rola']);
            $password = $this->passwordHasher->hashPassword($uzytkownik[$i], $uzytkownicy[$i]['haslo']);
            $uzytkownik[$i]->setPassword($password);
            if($uzytkownicy[$i]['rola'] == ["ROLE_WORKER"] || $uzytkownicy[$i]['rola'] == ["ROLE_SUPERVISOR"])
                $uzytkownik[$i]->setDzielnica($this->getReference(DzielnicaFixtures::BEMOWO));
            else 
                $uzytkownik[$i]->setDzielnica(NULL);

            $uzytkownik[$i]->setStatus($uzytkownicy[$i]['status']);
            $uzytkownik[$i]->setCzyDomenowy($uzytkownicy[$i]['typ_konta']);
            $uzytkownik[$i]->setKiedyUtworzony($uzytkownicy[$i]['data_utworzenia']);
            $manager->persist($uzytkownik[$i]);
        }
        $manager->flush();

        $this->addReference(self::NADAWCA, $uzytkownik[1]);
        $this->addReference(self::ODBIORCA, $uzytkownik[0]);
    }
    public function getDependencies()
    {
        return [
            DzielnicaFixtures::class
        ];
    }
}
