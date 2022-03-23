<?php 

namespace App\DataFixtures\dane;

trait Uzytkownicy 
{
    private static string $password = "1234";
    private static string $domainPass = 'F0xGr23x03ab2';
    private static int $status = 1;
    private static int $konto_testowe = 0;

    public function getDaneUzytkownicy(): array
    {
        $array = [
            0 => [
                "imie" => "Jan",
                "nazwisko" => "Kowalski",
                "email" => "j.kowalski@um.warszawa.pl",
                "login" => "j.kowalski",
                "rola" => ["ROLE_WORKER"],
                "haslo" => self::$password,
                "status" => self::$status,
                "typ_konta" => self::$konto_testowe,
                "data_utworzenia" => new \DateTime("2021-04-17 09:52:30")
            ],
            1 => [
                "imie" => "Anna",
                "nazwisko" => "Nowak",
                "email" => "a.nowak@um.warszawa.pl",
                "login" => "a.nowak",
                "rola" => ["ROLE_SUPERVISOR"],
                "haslo" => self::$password,
                "status" => self::$status,
                "typ_konta" => self::$konto_testowe,
                "data_utworzenia" => new \DateTime("2020-10-02 13:49:25")
            ],
            2 => [
                "imie" => "Tomasz",
                "nazwisko" => "Jackowski",
                "email" => "t.jackowski@um.warszawa.pl",
                "login" => "t.jackowski",
                "rola" => ["ROLE_MANAGER"],
                "haslo" => self::$password,
                "status" => self::$status,
                "typ_konta" => self::$konto_testowe,
                "data_utworzenia" => new \DateTime("2021-04-17 10:54:13")
            ],
            3 => [
                "imie" => "Bartosz",
                "nazwisko" => "Majcher",
                "email" => "b.majcher@um.warszawa.pl",
                "login" => "admin",
                "rola" => ["ROLE_ADMIN"],
                "haslo" => self::$password,
                "status" => self::$status,
                "typ_konta" => self::$konto_testowe,
                "data_utworzenia" => new \DateTime("2021-07-20 15:12:39")
            ],
            4 => [
                "imie" => "Mateusz",
                "nazwisko" => "Cichocki",
                "email" => "m.cichocki@um.warszawa.pl",
                "login" => "m.cichocki",
                "rola" => ["ROLE_WORKER"],
                "haslo" => self::$domainPass,
                "status" => self::$status,
                "typ_konta" => 1,
                "data_utworzenia" => new \DateTime("now")
            ],
        ];

        return $array;
    }
}