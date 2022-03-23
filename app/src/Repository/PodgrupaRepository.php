<?php

namespace App\Repository;

use App\Entity\Podgrupa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Podgrupa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Podgrupa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Podgrupa[]    findAll()
 * @method Podgrupa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PodgrupaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Podgrupa::class);
    }

    public function findByPodgrupaActivated()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.status = :status')
            ->setParameter('status', 1)
            ->orderBy('p.kolejnosc', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Podgrupa
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
