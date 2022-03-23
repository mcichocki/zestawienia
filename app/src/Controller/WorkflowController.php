<?php

namespace App\Controller;

use App\Entity\Formularz;
use App\Entity\Przeplyw;
use App\Service\ZestawienieService;
use App\Repository\StatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Workflow\WorkflowInterface;

class WorkflowController extends AbstractController
{
    private WorkflowInterface $formularzStateMachine;
    private EntityManagerInterface $entityManager;
    private StatusRepository $statusRepository;
    private ZestawienieService $zestawienieService;

    public function __construct(
        WorkflowInterface $formularzStateMachine,
        EntityManagerInterface $entityManager,
        StatusRepository $statusRepository,
        ZestawienieService $zestawienieService
    )
    {
        $this->formularzStateMachine = $formularzStateMachine;
        $this->entityManager = $entityManager;
        $this->statusRepository = $statusRepository;
        $this->zestawienieService = $zestawienieService;
    }

    /**
     * @Route("/workflow/{id}/{to}", name="app_change")
     */
    public function workflow(Formularz $formularz, String $to): Response
    {
        try {
            $this->formularzStateMachine->apply($formularz, $to);
        } catch (\LogicException $exception) {
        }
        $this->entityManager->persist($formularz);

        $przeplyw = new Przeplyw();
        $przeplyw->setFormularz($formularz);

        switch($to) {
            case 'worker_to_supervisor_to_verify':
                $przeplyw->setStatus($this->statusRepository->findOneBy(['identyfikator' => 2]));
                $this->addFlash('success', 'Zestawienie zostało przekazane do akceptacji przełożonego');
                break;
            case 'supervisor_to_manager_to_accept':
                $przeplyw->setStatus($this->statusRepository->findOneBy(['identyfikator' => 3]));
                $this->addFlash('success', 'Zestawienie zostało wstępnie zaakceptowane i przekazane do akceptacji BPB');
                break;
            case 'manager_done':
                $przeplyw->setStatus($this->statusRepository->findOneBy(['identyfikator' => 4]));
                $this->addFlash('success', 'Zestawienie zostało zaakceptowane');
                break;
            case 'manager_to_worker_to_correct':
                $przeplyw->setStatus($this->statusRepository->findOneBy(['identyfikator' => 5]));
                $this->addFlash('success', 'Zestawienie zostało przekazane do poprawy');
                break;
            case 'supervisor_to_worker_to_correct':
                $przeplyw->setStatus($this->statusRepository->findOneBy(['identyfikator' => 6]));
                $this->addFlash('success', 'Zestawienie zostało cofnięte do poprawy przez pracownika');
                break;
        }

        $this->entityManager->persist($przeplyw);
        $this->entityManager->flush();
        $this->zestawienieService->delay(2);
        return $this->redirectToRoute('zestawienia_todo');
    }
}