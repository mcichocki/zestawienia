<?php

namespace App\Repository;

use App\Entity\Zestawienie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Zestawienie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Zestawienie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Zestawienie[]    findAll()
 * @method Zestawienie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZestawienieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Zestawienie::class);
    }

    public function findByTableOfGroups($formularz)
    {
        $array = [];
        $arr = $this->createQueryBuilder('z')
            ->leftJoin('z.podgrupa', 'p')
            ->andWhere('z.formularz = :form')
            ->andWhere('p.status = :status')
            ->setParameters([
                'form' => $formularz,
                'status' => 1
            ])
            ->orderBy('p.kolejnosc', 'ASC')
            ->getQuery()
            ->getResult()
        ;
        $array['zestawienia'] = $arr;
        return $array;
    }

    public function getKorekty($formularz)
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.formularz = :formularz')
            ->andWhere('z.korekta is not NULL')
            ->setParameter('formularz', $formularz)
//            ->orderBy('p.kolejnosc', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findPodgrupyDlaKorekt($id)
    {
        return $this->createQueryBuilder('z')
            ->leftJoin('z.podgrupa', 'p')
            ->select('p.id, p.nazwa')
            ->andWhere('z.formularz = :formularz')
            ->andWhere('z.korekta is NULL')
            ->setParameter('formularz', $id)
            ->orderBy('p.kolejnosc', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

}
