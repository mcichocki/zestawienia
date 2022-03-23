<?php

namespace App\Repository;

use App\Entity\Podsumowanie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Podsumowanie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Podsumowanie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Podsumowanie[]    findAll()
 * @method Podsumowanie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PodsumowanieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Podsumowanie::class);
    }

    // /**
    //  * @return Podsumowanie[] Returns an array of Podsumowanie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Podsumowanie
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
