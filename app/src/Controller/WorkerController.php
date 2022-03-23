<?php

namespace App\Controller;

use App\Repository\JednostkaRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Security;

/**
 *  @IsGranted("ROLE_WORKER")
 */
class WorkerController extends AbstractController
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /** 
     * @Route("/worker", name="worker_index")
     */
    public function index()
    {
        $identyfikator = $this->security->getUser()->getDzielnica()->getIdentyfikator();
        return $this->render("worker/index.html.twig", [
            'identyfikator' => $identyfikator
        ]);
    }

    /**
     * @Route("/worker/jednostki", name="jednostki_worker")
     */
    public function jednostki(JednostkaRepository $jednostkaRepository)
    {
        $identyfikator = $this->security->getUser()->getDzielnica()->getIdentyfikator();

        $jednostki = $jednostkaRepository->findBy([
            'urzadID' => $identyfikator
        ]);

        return $this->render("worker/jednostki.html.twig", [
            'jednostki' => $jednostki
        ]);
    }
}