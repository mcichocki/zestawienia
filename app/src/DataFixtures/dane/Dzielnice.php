<?php

namespace App\DataFixtures\dane;

trait Dzielnice 
{
    public function getDaneDzielnic(): array
    {
        $dzielnice = [
            0 => [
                "nazwa" => "Bemowo",
                "robocza" => "BEMOWO",
                "status" => 1,
                "identyfikator" => 1,
                "symbol" => "BEM"
            ],
            1 => [
                "nazwa" => "Białołęka",
                "robocza" => "BIAŁOŁĘKA",
                "status" => 1,
                "identyfikator" => 2,
                "symbol" => "BIA"
            ],
            2 => [
                "nazwa" => "Bielany",
                "robocza" => "BIELANY",
                "status" => 1,
                "identyfikator" => 3,
                "symbol" => "BIE"
            ],
            3 => [
                "nazwa" => "Mokotów",
                "robocza" => "MOKOTÓW",
                "status" => 1,
                "identyfikator" => 4,
                "symbol" => "MOK"
            ],
            4 => [
                "nazwa" => "Ochota",
                "robocza" => "OCHOTA",
                "status" => 1,
                "identyfikator" => 5,
                "symbol" => "OCH"
            ],
            5 => [
                "nazwa" => "Praga-Południe",
                "robocza" => "PRAGA-POŁUDNIE",
                "status" => 1,
                "identyfikator" => 6,
                "symbol" => "PRD"
            ],
            6 => [
                "nazwa" => "Praga-Północ",
                "robocza" => "PRAGA-PÓŁNOC",
                "status" => 1,
                "identyfikator" => 7,
                "symbol" => "PRN"
            ],
            7 => [
                "nazwa" => "Rembertów",
                "robocza" => "REMBERTÓW",
                "status" => 1,
                "identyfikator" => 8,
                "symbol" => "REM"
            ],
            8 => [
                "nazwa" => "Śródmieście",
                "robocza" => "ŚRÓDMIEŚCIE",
                "status" => 1,
                "identyfikator" => 9,
                "symbol" => "ŚRÓ"
            ],
            9 => [
                "nazwa" => "Targówek",
                "robocza" => "TARGÓWEK",
                "status" => 1,
                "identyfikator" => 10,
                "symbol" => "TAR"
            ],
            10 => [
                "nazwa" => "Ursus",
                "robocza" => "URSUS",
                "status" => 1,
                "identyfikator" => 11,
                "symbol" => "URS"
            ],
            11 => [
                "nazwa" => "Ursynów",
                "robocza" => "URSYNÓW",
                "status" => 1,
                "identyfikator" => 12,
                "symbol" => "URN"
            ],
            12 => [
                "nazwa" => "Wawer",
                "robocza" => "WAWER",
                "status" => 1,
                "identyfikator" => 13,
                "symbol" => "WAW"
            ],
            13 => [
                "nazwa" => "Wesoła",
                "robocza" => "WESOŁA",
                "status" => 1,
                "identyfikator" => 14,
                "symbol" => "WES"
            ],
            14 => [
                "nazwa" => "Wilanów",
                "robocza" => "WILANÓW",
                "status" => 1,
                "identyfikator" => 15,
                "symbol" => "WIL"
            ],
            15 => [
                "nazwa" => "Włochy",
                "robocza" => "WŁOCHY",
                "status" => 1,
                "identyfikator" => 16,
                "symbol" => "WŁO"
            ],
            16 => [
                "nazwa" => "Wola",
                "robocza" => "WOLA",
                "status" => 1,
                "identyfikator" => 17,
                "symbol" => "WOL"
            ],
            17 => [
                "nazwa" => "Żoliborz",
                "robocza" => "ŻOLIBORZ",
                "status" => 1,
                "identyfikator" => 18,
                "symbol" => "ŻOL"
            ],
            18 => [
                "nazwa" => "Miasto st. Warszawa",
                "robocza" => "MIASTO ST. WARSZAWA",
                "status" => 1,
                "identyfikator" => -99,
                "symbol" => ""
            ],
            19 => [
                "nazwa" => "Urząd Miasta",
                "robocza" => "URZĄD MIASTA",
                "status" => 1,
                "identyfikator" => 0,
                "symbol" => ""
            ],
            // 20 => [
            //     "nazwa" => "Dzielnicowe Biuro Finansów Oświaty - Bemowo m.st. Warszawy",
            //     "robocza" => "DZIELNICOWE BIURO FINANSÓW OŚWIATY - BEMOWO M.ST WARSZAWY",
            //     "status" => 1,
            //     "identyfikator" => 30,
            //     "symbol" => "DBFO/BEM"
            // ],
            // 21 => [
            //     "nazwa" => "Dzielnicowe Biuro Finansów Oświaty - Białołęka m.st. Warszawy",
            //     "robocza" => "",
            //     "status" => 1,
            //     "identyfikator" => 35,
            //     "symbol" => "DBFO/BIA"
            // ],
            // 22 => [
            //     "nazwa" => "Dzielnicowe Biuro Finansów Oświaty - Bielany m.st. Warszawy",
            //     "robocza" => "",
            //     "status" => 1,
            //     "identyfikator" => 39,
            //     "symbol" => "DBFO/BIE"
            // ],
            // 23 => [
            //     "nazwa" => "Dzielnicowe Biuro Finansów Oświaty - Mokotów m.st. Warszawy",
            //     "robocza" => "",
            //     "status" => 1,
            //     "identyfikator" => 44,
            //     "symbol" => "DBFO/MOK"
            // ],
            // 24 => [
            //     "nazwa" => "Dzielnicowe Biuro Finansów Oświaty - Ochota m.st. Warszawy",
            //     "robocza" => "",
            //     "status" => 1,
            //     "identyfikator" => 46,
            //     "symbol" => "DBFO/OCH"
            // ],
            // 25 => [
            //     "nazwa" => "Dzielnicowe Biuro Finansów Oświaty - Praga Południe m.st. Warszawy",
            //     "robocza" => "",
            //     "status" => 1,
            //     "identyfikator" => 51,
            //     "symbol" => "DBFO/PRD"
            // ],
            // 26 => [
            //     "nazwa" => "Dzielnicowe Biuro Finansów Oświaty - Praga Północ m.st. Warszawy",
            //     "robocza" => "",
            //     "status" => 1,
            //     "identyfikator" => 55,
            //     "symbol" => "DBFO/PRN"
            // ],
            // 27 => [
            //     "nazwa" => "Dzielnicowe Biuro Finansów Oświaty - Rembertów m.st. Warszawy",
            //     "robocza" => "",
            //     "status" => 1,
            //     "identyfikator" => 60,
            //     "symbol" => "DBFO/REM"
            // ],
            // 28 => [
            //     "nazwa" => "Dzielnicowe Biuro Finansów Oświaty - Śródmieście m.st. Warszawy",
            //     "robocza" => "",
            //     "status" => 1,
            //     "identyfikator" => 63,
            //     "symbol" => "DBFO/ŚRO"
            // ],
            // 29 => [
            //     "nazwa" => "Zakład Gospodarowania Nieruchomościami w Dzielnicy Śródmieście m.st. Warszawy",
            //     "robocza" => "",
            //     "status" => 1,
            //     "identyfikator" => 64,
            //     "symbol" => "ZGN/ŚRÓ"
            // ],
            // 30 => [
            //     "nazwa" => "",
            //     "robocza" => "",
            //     "status" => 1,
            //     "identyfikator" => 51,
            //     "symbol" => "DBFO/PRD"
            // ],

        ];

        return $dzielnice;
    }
}
