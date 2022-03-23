<?php

namespace App\Controller;

use App\Repository\RokZestawieniowyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class RokController extends AbstractController
{

    private $rokZestawieniowyRepository;
    private $em;

    public function __construct(RokZestawieniowyRepository $rokZestawieniowyRepository, EntityManagerInterface $em)
    {
        $this->rokZestawieniowyRepository = $rokZestawieniowyRepository;
        $this->em = $em;
    }

    /**
     * @Route("/rok/dashboard", name="rok_dashboard")
     */
    public function dashboard( ) {

        $years = $this->rokZestawieniowyRepository->findBy([], ['kolejnosc' => 'DESC']);

        return $this->render("rok/dashboard.html.twig", [
            "title" => "Rok zestawieniowy",
            "years" => $years
        ]);
    }

    /**
     * @Route("/rok/update", name="rok_update")
     */
    public function update(Request $request) {
        $id = $request->request->get('id');

        $toDisable = $this->rokZestawieniowyRepository->findBy([
            'status' => 1
        ]);

        foreach($toDisable as $disabled) {
            $disabled->setStatus(0);
            $disabled->setRobocza("Nieaktywny");
            $this->em->persist($disabled);
        }

        $rok = $this->rokZestawieniowyRepository->find($id);
        $rok->setStatus(1);
        $rok->setRobocza("Aktywny");

        $this->em->persist($rok);
        $this->em->flush();

        return $this->json(['message' => 'Rok zestawieniowy został ustawiony']);
    }

    /**
     * @Route("/rok/disable", name="rok_disable")
     */
    public function disable() {
        $toDisable = $this->rokZestawieniowyRepository->findBy([
            'status' => 1
        ]);
        foreach($toDisable as $disabled) {
            $disabled->setStatus(0);
            $disabled->setRobocza("Nieaktywny");
            $this->em->persist($disabled);
        }
        $this->em->flush();
        return $this->json(['message' => 'Rok zestawieniowy został wyłączony']);
    }
}