<?php

namespace App\Doctrine;

use App\Entity\Formularz;
use App\Entity\Podsumowanie;
use App\Entity\Przeplyw;
use App\Entity\Zestawienie;
use App\Repository\RokZestawieniowyRepository;
use App\Repository\StatusRepository;
use App\Service\ZestawienieService;
use Symfony\Component\Security\Core\Security;

class FormularzListener
{
    private $security;
    private RokZestawieniowyRepository $rok;
    private ZestawienieService $zestawienieService;
    private StatusRepository $statusRepository;

    public function __construct(Security $security, ZestawienieService $zestawienieService, RokZestawieniowyRepository $rok, StatusRepository $statusRepository)
    {
        $this->security = $security;
        $this->rok = $rok;
        $this->zestawienieService = $zestawienieService;
        $this->statusRepository = $statusRepository;
    }

    public function prePersist(Formularz $formularz)
    {
        $formularz->setWorker($this->security->getUser());
        $formularz->setRokZestawieniowy($this->rok->getRokZestawieniowy());
    }

    public function postPersist(Formularz $formularz)
    {
        $podgrupy = $this->zestawienieService->getPodgrupy();

        for($i=0; $i<count($podgrupy); $i++) {
            $zestawienie[$i] = new Zestawienie();
            $zestawienie[$i]->setFormularz($formularz);
            $zestawienie[$i]->setPodgrupa($podgrupy[$i]);
            $zestawienie[$i]->setWartoscRokPoprzedni(0);
            $zestawienie[$i]->setWartoscRokZestawieniowy(0);
            $zestawienie[$i]->setWartoscRoznicaKwot(0);
            $zestawienie[$i]->setWartoscProcentowa(0);
            $this->zestawienieService->save($zestawienie[$i]);
        }

        $podsumowanie = new Podsumowanie();
        $podsumowanie->setFormularz($formularz);
        $this->zestawienieService->save($podsumowanie);

        $przeplyw = new Przeplyw();
        $przeplyw->setFormularz($formularz);
        $przeplyw->setStatus($this->statusRepository->findOneBy(['identyfikator' => 1]));
        $this->zestawienieService->save($przeplyw);
    }
}