<?php

namespace App\Repository;

use App\Entity\Uzasadnienie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Uzasadnienie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Uzasadnienie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Uzasadnienie[]    findAll()
 * @method Uzasadnienie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UzasadnienieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Uzasadnienie::class);
    }

    // /**
    //  * @return Uzasadnienie[] Returns an array of Uzasadnienie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Uzasadnienie
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
