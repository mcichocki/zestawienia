<?php

namespace App\DesignPatterns\OOP;

class Child extends Person
{
    public string $title = "Dziedziczenie";
    public const TITLE = "Dziedziczenie";

    public function checkVaccinations()
    {
        parent::checkVaccinations();
        print("ffff");
    }
}