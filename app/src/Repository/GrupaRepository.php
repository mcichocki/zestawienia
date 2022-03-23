<?php

namespace App\Repository;

use App\Entity\Grupa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Grupa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Grupa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Grupa[]    findAll()
 * @method Grupa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GrupaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Grupa::class);
    }

    public function getGroupsByStatus() {
        return $this->createQueryBuilder('g')
        ->where('g.status = :status')
        ->setParameter('status', 1)
        ->getQuery()
        ->getResult();
    }

    // /**
    //  * @return Grupa[] Returns an array of Grupa objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Grupa
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
