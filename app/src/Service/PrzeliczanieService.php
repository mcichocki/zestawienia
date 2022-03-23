<?php

namespace App\Service;

use App\Repository\PodgrupaRepository;

class PrzeliczanieService
{
    private PodgrupaRepository $podgrupaRepository;

    public function __construct(PodgrupaRepository $podgrupaRepository)
    {
        $this->podgrupaRepository = $podgrupaRepository;
    }

    public function przeliczCalosc($request)
    {
        $data = [];
        $wartosc = [];
        $podgrupy = $this->podgrupaRepository->findBy(['status' => 1], ['kolejnosc' => 'ASC']);
        // https://minikalkulator.pl/kalkulator-procentowy
        // Obliczanie o ile procent liczba różni się od drugiej liczby
        // ((b – a) / a ) * 100
        // Np. w jednym sklepie kilogram ziemniaków kosztuje 1,55 zł a w drugim 1,78 zł:
        // ((1.78 – 1.55) / 1.55) * 100 = 14.84

        $suma_rok_poprzedni  = null;
        $suma_rok_aktualny   = null;
        $p_grunty_przekazane = 0;
        $z_grunty_przekazane = 0;
        $p_grunty_inne_niz_przekazane = 0;
        $z_grunty_inne_niz_przekazane = 0;

        for($i=0; $i < count($podgrupy); $i++) {
            $rok_z = $request->request->get('rok_zestawieniowy')[$i];
            $rok_p = $request->request->get('rok_poprzedni')[$i];

            $suma_rok_poprzedni += $rok_p;
            $suma_rok_aktualny  += $rok_z;

            $array = [];
            $wartosc = (float)($rok_z) - (float)($rok_p);
            $array['r_poprzedni'] = $rok_p;
            $array['r_aktualny']  = $rok_z;

            if($podgrupy[$i]->getRobocza() == 'grunty_przekazane_w_uzytkowanie_wieczyste') {
                $p_grunty_przekazane = $rok_p;
                $z_grunty_przekazane = $rok_z;
            }
            if($podgrupy[$i]->getRobocza() == 'grunty_inne_niz_przekazane_w_uzytkowanie_wieczyste') {
                $p_grunty_inne_niz_przekazane = $rok_p;
                $z_grunty_inne_niz_przekazane = $rok_z;
            }
            $array['suma'] = $podgrupy[$i]->getRobocza();
            $array['wartosc'] = number_format($wartosc, 2, '.', '');
            $array['procent'] = $this->calculate($rok_p, $rok_z);
            $data[] = $array;
        }

        $suma_grunty_rok_poprzedni = $p_grunty_przekazane + $p_grunty_inne_niz_przekazane;
        $array = [];
        $array['suma'] = 'suma_grunty_rok_poprzedni';
        $array['wartosc'] = number_format($suma_grunty_rok_poprzedni, 2, '.', '');
        $data[] = $array;

        $suma_grunty = $z_grunty_przekazane + $z_grunty_inne_niz_przekazane;
        $array = [];
        $array['suma'] = 'suma_grunty';
        $array['wartosc'] = number_format($suma_grunty, 2, '.', '');
        $data[] = $array;

        $array = [];
        $array['suma'] = 'suma_rok_aktualny';
        $array['wartosc'] = number_format($suma_rok_aktualny, 2, '.', '');
        $data[] = $array;

        $array = [];
        $array['suma'] = 'suma_rok_poprzedni';
        $array['wartosc'] = number_format($suma_rok_poprzedni, 2, '.', '');
        $data[] = $array;

        return $data;
    }

    private function calculate($v_poprzedni, $v_zestawieniowy)
    {
        $calc = null;

        if ($v_zestawieniowy == 0 && $v_poprzedni == 0) {
            $calc = 0;
        }
        else if($v_zestawieniowy == 0) {
            $calc = -100;
        }
        else {
            $calc = (1 - $v_poprzedni / $v_zestawieniowy) * 100;
        }

        return number_format($calc, 2, '.', '');
    }
}