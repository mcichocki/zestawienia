<?php

namespace App\Controller;

use App\Entity\ListaCzynnikow;
use App\Repository\FormularzRepository;
use App\Repository\JednostkaRepository;
use App\Repository\ListaCzynnikowRepository;
use App\Repository\PodgrupaRepository;
use App\Repository\RokZestawieniowyRepository;
use App\Repository\UzytkownikRepository;
use App\Repository\ZestawienieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ApiController extends AbstractController
{
    private ZestawienieRepository $zestawienieRepository;
    private PodgrupaRepository $podgrupaRepository;
    private FormularzRepository $formularzRepository;
    private UzytkownikRepository $uzytkownikRepository;
    private EntityManagerInterface $entityManager;
    private Security $security;
    private JednostkaRepository $jednostkaRepository;
    private RokZestawieniowyRepository $rokZestawieniowyRepository;

    public function __construct(
        Security $security,
        EntityManagerInterface $entityManager,
        ZestawienieRepository $zestawienieRepository,
        PodgrupaRepository $podgrupaRepository,
        FormularzRepository $formularzRepository,
        UzytkownikRepository $uzytkownikRepository,
        JednostkaRepository $jednostkaRepository,
        RokZestawieniowyRepository $rokZestawieniowyRepository
    )
    {
        $this->zestawienieRepository = $zestawienieRepository;
        $this->podgrupaRepository = $podgrupaRepository;
        $this->formularzRepository = $formularzRepository;
        $this->uzytkownikRepository = $uzytkownikRepository;
        $this->entityManager = $entityManager;
        $this->security = $security;
        $this->jednostkaRepository = $jednostkaRepository;
        $this->rokZestawieniowyRepository = $rokZestawieniowyRepository;
    }
    /**
     * @Route("/estimates/getv1", name="estimates_get_v1")
     */
    public function getEstimatesV1()
    {
        $dzielnica = $this->security->getUser()->getDzielnica();
        $jednostki = $this->jednostkaRepository->findBy([
            'dzielnica' => $dzielnica
        ]);

        $rokZestawieniowy = $this->rokZestawieniowyRepository->findOneBy(['status' => 1]);

        $formularze = $this->formularzRepository->findBy([
            'jednostka' => $jednostki,
            'rokZestawieniowy' => $rokZestawieniowy
        ]);

        $data = [];
        for($i=0; $i<count($formularze); $i++) {
            $in = [];
            $nazwa = $formularze[$i]->getJednostka()->getNazwa();
            $in['podgrupa'] = (strlen($nazwa) < 60) ? $nazwa : substr($nazwa, 0, 60).'...';
            $in['kwota'] = $formularze[$i]->getPodsumowania()[0]->getSumaRokBiezacy();
            $data[] = $in;
        }
        return $this->json(['data' => $data]);
    }


    /**
     * @Route("/estimates/getv2", name="estimates_get_v2")
     */
    public function getEstimatesV2(Request $request, FormularzRepository $formularzRepository)
    {
        $id = $request->request->get('formularz');
        $formularz = $formularzRepository->find($id);

        $zestawienia = $this->zestawienieRepository->findBy([
            'formularz' => $formularz
        ]);

        $data = [];
        for($i=0; $i<count($zestawienia); $i++) {
            $in = [];
            $in['podgrupa'] = $zestawienia[$i]->getPodgrupa()->getNazwa();
            $in['kwota'] = $zestawienia[$i]->getWartoscRokZestawieniowy();
            $data[] = $in;
        }
        return $this->json(['data' => $data]);
    }

    /**
     * @Route("/czynniki/get", name="czynniki_get")
     */
    public function getCzynniki(Request $request, ListaCzynnikowRepository $listaCzynnikowRepository)
    {
        $podgrupa = $request->request->get('podgrupa');
        $formularz = $request->request->get('formularz');
        $czynnik_typ = $request->request->get('czynnik');

        $data = $listaCzynnikowRepository->findBy([
            'podgrupa' => $podgrupa,
            'typ' => $czynnik_typ,
            'formularz' => $formularz
        ], [
            'data' => 'DESC'
        ]);

        $dane = [];
        for($i=0; $i <count($data); $i++) {
            $daneA = [];
            $daneA['tresc'] = $data[$i]->getTresc();
            $dane[] = $daneA;
        }

        return $this->json(['data' => $dane]);
    }

    /**
     * @Route("/czynniki/post", name="czynniki_post")
     */
    public function postCzynniki(Request $request, ListaCzynnikowRepository $listaCzynnikowRepository)
    {
        $podgrupa = $request->request->get('podgrupa');
        $formularz = $request->request->get('formularz');
        $czynnik_typ = $request->request->get('czynnik');
        $uzytkownik = $request->request->get('uzytkownik');
        $tresc = $request->request->get('tresc');

        $podgrupa  = $this->podgrupaRepository->find($podgrupa);
        $formularz = $this->formularzRepository->find($formularz);
        $pracownik = $this->uzytkownikRepository->find($uzytkownik);
        $czynnik = new ListaCzynnikow();
        $czynnik->setTyp($czynnik_typ);
        $czynnik->setPodgrupa($podgrupa);
        $czynnik->setFormularz($formularz);
        $czynnik->setPracownik($pracownik);
        $czynnik->setTresc($tresc);

        $this->entityManager->persist($czynnik);
        $this->entityManager->flush();

        $data = $listaCzynnikowRepository->findBy([
            'podgrupa' => $podgrupa,
            'typ' => $czynnik_typ,
            'formularz' => $formularz
        ], [
            'data' => 'DESC'
        ]);

        $dane = [];
        for($i=0; $i <count($data); $i++) {
            $daneA = [];
            $daneA['tresc'] = $data[$i]->getTresc();
            $dane[] = $daneA;
        }
        return $this->json(['data' => $dane]);
    }
}