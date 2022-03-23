<?php

namespace App\Repository;

use App\Entity\Czat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Czat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Czat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Czat[]    findAll()
 * @method Czat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CzatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Czat::class);
    }

    // /**
    //  * @return Czat[] Returns an array of Czat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Czat
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
