<?php

namespace App\Controller;

use App\Entity\Czat;
use App\Entity\Wiadomosc;
use App\Repository\FormularzRepository;
use App\Repository\UzytkownikRepository;
use App\Repository\WiadomoscRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController 
{
    private EntityManagerInterface $entityManager;
    private WiadomoscRepository $wiadomoscRepository;

    public function __construct(EntityManagerInterface $entityManager, WiadomoscRepository $wiadomoscRepository)
    {
        $this->entityManager = $entityManager;
        $this->wiadomoscRepository = $wiadomoscRepository;
    }

    /**
     * @Route("/messages/post", name="messages_post")
     */
    public function postMessage(Request $request, UzytkownikRepository $uzytkownikRepository, FormularzRepository $formularzRepository)
    {
        $tresc = $request->request->get('tresc');
        $uzytkownik = $request->request->get('uzytkownik');
        $formularz = $request->request->get('formularz');
        $user = $uzytkownikRepository->find($uzytkownik);
        $form = $formularzRepository->find($formularz);

        $message = new Wiadomosc();
        $message->setTytul(".");
        $message->setTresc($tresc);
        $message->setOdKogo($user);
        $message->setDoKogo($user);
        $message->setFormularz($form);
        $chat = new Czat();
        $this->entityManager->persist($chat);
        $this->entityManager->persist($message);
        $this->entityManager->flush();

        $wiadomosci = $this->wiadomoscRepository->findBy([
            'formularz' => $form
        ], [ 'dataWyslania' => 'ASC']);

        $dane = [];

        for($i=0; $i<count($wiadomosci); $i++)
        {
            $data = [];
            $data['tresc'] = $wiadomosci[$i]->getTresc();
            $data['imie'] = $wiadomosci[$i]->getOdKogo()->getImie();
            $data['nazwisko'] = $wiadomosci[$i]->getOdKogo()->getNazwisko();
            $data['login'] = $wiadomosci[$i]->getOdKogo()->getLogin();
            $data['data'] = $wiadomosci[$i]->getDataWyslania()->format('d/m/Y H:i:s');
            $dane[] = $data;
        }

        return $this->json(['data' => $dane]);
    }
}