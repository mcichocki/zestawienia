<?php

namespace App\Repository;

use App\Entity\Powiadomienie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Powiadomienie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Powiadomienie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Powiadomienie[]    findAll()
 * @method Powiadomienie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PowiadomienieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Powiadomienie::class);
    }

    // /**
    //  * @return Powiadomienie[] Returns an array of Powiadomienie objects
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
    public function findOneBySomeField($value): ?Powiadomienie
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
