<?php

namespace App\Controller;

use App\DesignPatterns\OOP\Child;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DPController extends AbstractController
{
    public function __construct()
    {
    }

    /**
     * @Route("/wzorce-projektowe/oop", name="dp_oop")
     */
    public function oop()
    {
        $title = "Object Oriented Programming";

        $child = new Child();
        $child->checkVaccinations().'<br>';
        print_r($child->title).'<br>';
        print_r($child::TITLE).'<br>';

        if ($child instanceof Child) {
            printf("instancja %s", $title);
        }
        //die;

        return $this->render('design_patterns/oop.html.twig', [
            'title' => $title
        ]);
    }

    /**
     * @Route("/wzorce-projektowe/solid", name="dp_solid")
     */
    public function SOLID()
    {
        $title = "Zasady SOLID";

        return $this->render('design_patterns/solid.html.twig', [
            'title' => $title
        ]);
    }

    /**
     * @Route("/wzorce-projektowe/wzorce", name="dp_wzorce")
     */
    public function wzorce()
    {
        $title = "Wzorce";

        return $this->render('design_patterns/wzorce.html.twig', [
            'title' => $title
        ]);
    }

//    /**
//     * @Route("/wzorce-projektowe/singleton", name="dp_singleton")
//     */
//    public function singleton()
//    {
//        $title = "Singleton";
//
//        return $this->render('design_patterns/wzorce/singleton.html.twig', [
//            'title' => $title
//        ]);
//    }

    /**
//     * @Route("/wzorce-projektowe/simple-factory", name="dp_simple_factory")
//     */
//    public function simpleFactory()
//    {
//        $title = "Simple Factory (prosta fabryka)";
//
//        return $this->render('design_patterns/wzorce/simple_factory.html.twig', [
//            'title' => $title
//        ]);
//    }
}