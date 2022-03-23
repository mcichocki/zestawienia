<?php

namespace App\DataFixtures\dane;

trait LataZestawieniowe 
{
    private static $str_aktywny = "Aktywny";
    private static $str_nieaktywny = "Nieaktywny";
    private static $nieaktywny = 0;
    private static $aktywny = 1;

    public function getLataZestawieniowe(): array
    {
        $array = [
            0 => [
                'rok' => 2015,
                'identyfikator' => 1,
                'status' => self::$nieaktywny,
                'kolejnosc' => 1,
                'robocza' => self::$str_nieaktywny,
            ],
            1 => [
                'rok' => 2016,
                'identyfikator' => 2,
                'status' => self::$nieaktywny,
                'kolejnosc' => 2,
                'robocza' => self::$str_nieaktywny,
            ],
            2 => [
                'rok' => 2017,
                'identyfikator' => 3,
                'status' => self::$nieaktywny,
                'kolejnosc' => 3,
                'robocza' => self::$str_nieaktywny,
            ],
            3 => [
                'rok' => 2018,
                'identyfikator' => 4,
                'status' => self::$nieaktywny,
                'kolejnosc' => 4,
                'robocza' => self::$str_nieaktywny,
            ],
            4 => [
                'rok' => 2019,
                'identyfikator' => 5,
                'status' => self::$nieaktywny,
                'kolejnosc' => 5,
                'robocza' => self::$str_nieaktywny,
            ],
            5 => [
                'rok' => 2020,
                'identyfikator' => 6,
                'status' => self::$aktywny,
                'kolejnosc' => 6,
                'robocza' => self::$str_aktywny,
            ],
            6 => [
                'rok' => 2021,
                'identyfikator' => 7,
                'status' => self::$nieaktywny,
                'kolejnosc' => 7,
                'robocza' => self::$str_nieaktywny,
            ],
            7 => [
                'rok' => 2022,
                'identyfikator' => 8,
                'status' => self::$nieaktywny,
                'kolejnosc' => 8,
                'robocza' => self::$str_nieaktywny,
            ],
            8 => [
                'rok' => 2023,
                'identyfikator' => 9,
                'status' => self::$nieaktywny,
                'kolejnosc' => 9,
                'robocza' => self::$str_nieaktywny,
            ],
            9 => [
                'rok' => 2024,
                'identyfikator' => 10,
                'status' => self::$nieaktywny,
                'kolejnosc' => 10,
                'robocza' => self::$str_nieaktywny,
            ],
            10 => [
                'rok' => 2025,
                'identyfikator' => 11,
                'status' => self::$nieaktywny,
                'kolejnosc' => 11,
                'robocza' => self::$str_nieaktywny,
            ],
            11 => [
                'rok' => 2026,
                'identyfikator' => 12,
                'status' => self::$nieaktywny,
                'kolejnosc' => 12,
                'robocza' => self::$str_nieaktywny,
            ],
            12 => [
                'rok' => 2027,
                'identyfikator' => 13,
                'status' => self::$nieaktywny,
                'kolejnosc' => 13,
                'robocza' => self::$str_nieaktywny,
            ],
            13 => [
                'rok' => 2028,
                'identyfikator' => 14,
                'status' => self::$nieaktywny,
                'kolejnosc' => 14,
                'robocza' => self::$str_nieaktywny,
            ],
            14 => [
                'rok' => 2029,
                'identyfikator' => 15,
                'status' => self::$nieaktywny,
                'kolejnosc' => 15,
                'robocza' => self::$str_nieaktywny,
            ],
            15 => [
                'rok' => 2030,
                'identyfikator' => 16,
                'status' => self::$nieaktywny,
                'kolejnosc' => 16,
                'robocza' => self::$str_nieaktywny,
            ]
        ];

        return $array;
    }
}
