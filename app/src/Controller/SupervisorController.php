<?php

namespace App\Controller;

use App\Repository\JednostkaRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Security;

/**
 *  @IsGranted("ROLE_SUPERVISOR")
 */
class SupervisorController extends AbstractController
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /** 
     * @Route("/supervisor", name="supervisor_index")
     */
    public function index()
    {
        $identyfikator = $this->security->getUser()->getDzielnica()->getIdentyfikator();
        return $this->render("supervisor/index.html.twig", [
            'identyfikator' => $identyfikator
        ]);
    }

    /**
     * @Route("/supervisor/jednostki", name="jednostki_supervisor")
     */
    public function jednostki(JednostkaRepository $jednostkaRepository)
    {
        $identyfikator = $this->security->getUser()->getDzielnica()->getIdentyfikator();

        $jednostki = $jednostkaRepository->findBy([
            'urzadID' => $identyfikator
        ]);

        return $this->render("supervisor/jednostki.html.twig", [
            'jednostki' => $jednostki
        ]);
    }
}