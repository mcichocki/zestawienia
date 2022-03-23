<?php

namespace App\Repository;

use App\Entity\FormaOrganizacyjna;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FormaOrganizacyjna|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormaOrganizacyjna|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormaOrganizacyjna[]    findAll()
 * @method FormaOrganizacyjna[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormaOrganizacyjnaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormaOrganizacyjna::class);
    }

    // /**
    //  * @return FormaOrganizacyjna[] Returns an array of FormaOrganizacyjna objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FormaOrganizacyjna
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
