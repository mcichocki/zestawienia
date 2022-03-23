<?php

namespace App\Repository;

use App\Entity\Przeplyw;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Przeplyw|null find($id, $lockMode = null, $lockVersion = null)
 * @method Przeplyw|null findOneBy(array $criteria, array $orderBy = null)
 * @method Przeplyw[]    findAll()
 * @method Przeplyw[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrzeplywRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Przeplyw::class);
    }

    // /**
    //  * @return Przeplyw[] Returns an array of Przeplyw objects
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
    public function findOneBySomeField($value): ?Przeplyw
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
