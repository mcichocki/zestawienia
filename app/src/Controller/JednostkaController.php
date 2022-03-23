<?php

namespace App\Controller;

use App\Entity\Formularz;
use App\Entity\Grupa;
use App\Entity\Jednostka;
use App\Form\JednostkaType;
use App\Repository\FormularzRepository;
use App\Repository\GrupaRepository;
use App\Repository\JednostkaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class JednostkaController extends AbstractController 
{
    private $em;
    private $jednostkaRepository;
    private FormularzRepository $formularzRepository;
    private GrupaRepository $grupaRepository;

    public function __construct(EntityManagerInterface $em, JednostkaRepository $jednostkaRepository, FormularzRepository $formularzRepository, GrupaRepository $grupaRepository)
    {
        $this->em = $em;
        $this->jednostkaRepository = $jednostkaRepository;
        $this->formularzRepository = $formularzRepository;

        $this->grupaRepository = $grupaRepository;
    }

    /**
     * @Route("/jednostki/index", name="jednostki_index")
     */
    public function index()
    {
        return $this->render("jednostki/index.html.twig");
    }

    /**
     * @Route("/jednostki/get", name="jednostki_group")
     */
    public function jednostki(Request $request)
    {
        $identyfikator = $request->getContent();
        $jednostki = $this->jednostkaRepository->findBy([
            'urzadID' => $identyfikator
        ]);

        $data = [];
        for($i=0; $i<count($jednostki); $i++) {
            $item = [];
            $item['id'] = $jednostki[$i]->getId();
            $item['nazwa'] = $jednostki[$i]->getNazwa();
            $data[] = $item;
        }
        return $this->json($data);
    }

    /**
     * @Route("/jednostki/create", name="jednostki_create")
     * @IsGranted("ROLE_ADMIN")
     */
    public function create(Request $request)
    {
        $jednostka = new Jednostka();

        $form = $this->createForm(JednostkaType::class, $jednostka);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $jednostka = $form->getData();
            $this->jednostkaRepository->setEntityManager($jednostka);
            $this->addFlash("success", "Dodano jednostkę do bazy danych!");
            return $this->redirectToRoute('jednostki_index');
        }

        return $this->render("jednostki/create.html.twig", [
            'form' => $form->createView()
        ]);
    }
    /** 
     * @Route("/jednostki/edit/{id}", "jednostki_edit")
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, $id)
    {

    }

    /**
     * @Route("/jednostki/delete", name="jednostki_delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete()
    {
        $jednostki = $this->em->getRepository(Jednostka::class)->findAll();

        foreach ($jednostki as $jednostka) {
            $this->em->remove($jednostka);
        }
        $this->em->flush();

        return $this->json(['message' => 'Wszystkie jednostki zostały usunięte pomyślnie!'], Response::HTTP_OK);
    }


    /**
     * @Route("/_api/get/jednostki", name="api_get_jednostki")
     */
    public function apiJednostki()
    {
        $jednostki = $this->jednostkaRepository->findAll();
        
        $array = [];
        
        for($i=0; $i<count($jednostki); $i++) {
            $y = [];
            $y[] = $jednostki[$i]->getId();
            $y[] = $jednostki[$i]->getNazwa();
            $y[] = $jednostki[$i]->getUlica();
            $y[] = $jednostki[$i]->getNumer();
            $y[] = $jednostki[$i]->getKodPocztowy();
            $y[] = $jednostki[$i]->getIdentyfikator();
            $y[] = $jednostki[$i]->getMiasto();
            $array[] = $y;

        }

        return $this->json(["data" => $array]);        
    }
}