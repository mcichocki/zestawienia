<?php

namespace App\Controller;

use App\Repository\DzielnicaRepository;
use App\Repository\JednostkaRepository;
use App\Repository\RokZestawieniowyRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 *  @IsGranted("ROLE_MANAGER")
 */
class ManagerController extends AbstractController
{
    private $dzielnicaRepository;
    private $jednostkaRepository;
    private $rokZestawieniowyRepository;

    public function __construct(
        DzielnicaRepository $dzielnicaRepository,
        JednostkaRepository $jednostkaRepository,
        RokZestawieniowyRepository $rokZestawieniowyRepository
    )
    {
        $this->dzielnicaRepository = $dzielnicaRepository;
        $this->jednostkaRepository = $jednostkaRepository;
        $this->rokZestawieniowyRepository = $rokZestawieniowyRepository;
    }

    /** 
     * @Route("/manager", name="manager_index")
     */
    public function index()
    {
        $dzielnice = $this->dzielnicaRepository->findBy(['status' => 1]);
        return $this->render("manager/index.html.twig", [
            'dzielnice' => $dzielnice,
            'identyfikator' => 0,
            'rokZestawieniowy' => $this->rokZestawieniowyRepository->findOneBy(['status' => 1])
        ]);
    }

    /**
     * @Route("/manager/search", name="manager_search")
     */
    public function search(Request $request)
    {
        $id = $request->request->get('id');
        $data = [];
        $dzielnica = $this->dzielnicaRepository->find($id);
        $jednostki = $this->jednostkaRepository->findBy([
            'dzielnica' => $dzielnica
        ]);

        for($i=0; $i<count($jednostki); $i++) {
            $array = [];
            $array['id'] = $jednostki[$i]->getId();
            $array['nazwa'] = $jednostki[$i]->getNazwa();
            $data[] = $array;
        }

        return $this->json([
            'data' => $data,
            'dzielnica' => $dzielnica->getNazwa()
        ]);
    }
}