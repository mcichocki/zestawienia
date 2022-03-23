<?php

namespace App\Twig;

use App\Repository\ListaCzynnikowRepository;
use App\Repository\RokZestawieniowyRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    private $listaCzynnikowRepository;

    public function __construct(ListaCzynnikowRepository $listaCzynnikowRepository)
    {
        $this->listaCzynnikowRepository = $listaCzynnikowRepository;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('year', [$this, 'getYear']),
            new TwigFunction('area', [$this, 'calculateArea']),
            new TwigFunction('zliczanieCzynnikow', [$this, 'zliczCzynniki']),
        ];
    }

    public function getFilters()
    {
        return [
            new TwigFilter('message', [$this, 'shortMessage']),
            new TwigFilter('brkLine', [$this, 'newLine']),
            new TwigFilter('decRole', [$this, 'decodeRole']),
        ];
    }

    public function calculateArea(int $width, int $length)
    {
        return $width * $length;
    }

    public function zliczCzynniki($formularz, $podgrupa, $typ)
    {
        return $this->listaCzynnikowRepository->countElements($formularz, $podgrupa, $typ);
    }

    public function newLine($string)
    {
        $newStr = $string;
        if( strlen($string) > 40) {
            $newStr = explode( "\n", wordwrap($string, 40));

            if($newStr[1]){
                $newStr = $newStr[0]."<br>".$newStr[1];
            }
            elseif($newStr[1] && $newStr[2])
                $newStr = $newStr[0]."<br>".$newStr[1]."<br>".$newStr[2];
        }   

        return $newStr;
    }

    public function shortMessage($string)
    {
        $newStr = $string;
        if( strlen($string) > 40) {
            $newStr = explode( "\n", wordwrap($string, 40));
            $newStr = $newStr[0] . '...';
        }
        return $newStr;
    }

    public function decodeRole($role)
    {
        $name = "";
        switch($role) {
            case "ROLE_WORKER": 
                $name = "Pracownik w dzielnicy";
            break;
            case "ROLE_SUPERVISOR":
                $name = "Dyrektor w dzielnicy";
            break;    
            case "ROLE_MANAGER":  
                $name = "Dyrektor BPB";
            break;
            case "ROLE_ADMIN":
                $name = "Administrator";
            break;
            case "ROLE_SUPER_ADMIN":
                $name = "Super Administrator";
            break;
        }
        
        return $name;
    }
}