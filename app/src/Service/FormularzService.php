<?php

namespace App\Service;

use App\Entity\Formularz;
use App\Entity\Zestawienie;
use App\Repository\GrupaRepository;
use App\Repository\PodgrupaRepository;
use App\Repository\ZestawienieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Security;

class FormularzService extends BaseService
{
    private $grupaRepository;
    private $podgrupaRepository;
    private $zestawienieRepository;

    public function __construct(
        ZestawienieRepository $zestawienieRepository,
        EntityManagerInterface $entityManager,
        LoggerInterface $logger,
        Security $security,
        GrupaRepository $grupaRepository,
        PodgrupaRepository $podgrupaRepository)
    {
        parent::__construct($entityManager, $logger, $security);
        $this->grupaRepository = $grupaRepository;

        $this->podgrupaRepository = $podgrupaRepository;
        $this->zestawienieRepository = $zestawienieRepository;
    }

    public function getFormularz($id)
    {
        return $this->getRepository(Formularz::class)->find($id);
    }

    public function getArchiwum($formularz)
    {
        $jednostka = $formularz->getJednostka() ?? null;
        return $this->getRepository(Formularz::class)->findArchives($jednostka);
    }

    public function getKorekty($formularz)
    {
        return $this->getRepository(Zestawienie::class)->getKorekty($formularz);
    }

    public function getGrupy()
    {
        return $this->grupaRepository->getGroupsByStatus();
    }

    public function getPodgrupyDlaKorekt($id)
    {
        return $this->zestawienieRepository->findPodgrupyDlaKorekt($id);
    }

}