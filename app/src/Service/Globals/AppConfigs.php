<?php

namespace App\Service\Globals;

use App\Entity\Formularz;
use App\Repository\FormularzRepository;
use App\Repository\RokZestawieniowyRepository;
use App\Repository\UzytkownikRepository;
use App\Repository\WiadomoscRepository;
use App\Service\ZestawienieService;
use Symfony\Component\Security\Core\Security;

class AppConfigs
{
    private $wiadomoscRepository;
    private $uzytkownikRepository;
    private $formularzRepository;
    private $security;
    private $rokZestawieniowyRepository;
    private $zestawienieService;

    public function __construct(
        Security $security,
        WiadomoscRepository $wiadomoscRepository,
        UzytkownikRepository $uzytkownikRepository,
        FormularzRepository $formularzRepository,
        RokZestawieniowyRepository $rokZestawieniowyRepository,
        ZestawienieService $zestawienieService
    )
    {
        $this->security = $security;
        $this->wiadomoscRepository = $wiadomoscRepository;
        $this->uzytkownikRepository = $uzytkownikRepository;
        $this->formularzRepository = $formularzRepository;
        $this->rokZestawieniowyRepository = $rokZestawieniowyRepository;
        $this->zestawienieService = $zestawienieService;
    }

    public function getRokZestawieniowy()
    {
        $rok = ($this->rokZestawieniowyRepository->getRokZestawieniowy()) ? $this->rokZestawieniowyRepository->getRokZestawieniowy()->getRok() : null;
        return $rok;
    }

    public function rok()
    {
        $rok = new \DateTime();
        return $rok->format('Y');
    }

    public function author()
    {
        return "Mateusz Cichocki";
    }

    public function getCountToDoForms()
    {
        $formularze = $this->zestawienieService->displayToDoForms();
        return count($formularze);
    }

    public function getCountInAcceptForms()
    {
        $formularze = $this->zestawienieService->displayInAcceptForms();
        return count($formularze);
    }

    public function getCountDoneForms()
    {
        $formularze = $this->zestawienieService->displayDoneForms();
        return count($formularze);
    }

    public function getListOfUsers()
    {
        $uzytkownicy = $this->uzytkownikRepository->findAllActiveOfUsers();

        return $uzytkownicy;
    }

    public function getUnreadMessages() {
        
        $returned = [];
        $nieprzeczytane_wiadomosci = $this->wiadomoscRepository->findBy([
            'doKogo' => $this->security->getUser(),
            'czyOdczytano' => 0
        ], ['dataWyslania' => 'DESC']
        );

        $returned['counter'] = count($nieprzeczytane_wiadomosci);
        $returned['messages'] = $nieprzeczytane_wiadomosci;

        if($returned['counter'] == 1) 
            $returned['text'] = "Wiadomość";
        else 
            $returned['text'] = "Wiadomości";

        return $returned;
    }
}