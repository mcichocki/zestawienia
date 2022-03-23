<?php

namespace App\Repository;

use App\Entity\Dzielnica;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Dzielnica|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dzielnica|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dzielnica[]    findAll()
 * @method Dzielnica[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DzielnicaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dzielnica::class);
    }

    // /**
    //  * @return Dzielnica[] Returns an array of Dzielnica objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Dzielnica
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
