<?php

namespace App\Repository;

use App\Entity\ListaCzynnikow;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ListaCzynnikow|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListaCzynnikow|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListaCzynnikow[]    findAll()
 * @method ListaCzynnikow[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListaCzynnikowRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListaCzynnikow::class);
    }

    public function countElements($formularz, $podgrupa, $typ)
    {
        $results = $this->createQueryBuilder('l')
            ->andWhere('l.formularz = :f')
            ->andWhere('l.podgrupa = :p')
            ->andWhere('l.typ = :t')
            ->setParameters([
                'f' => $formularz,
                'p' => $podgrupa,
                't' => $typ
            ])
            ->getQuery()
            ->getResult()
            ;

        return count($results);
    }

    // /**
    //  * @return ListaCzynnikow[] Returns an array of ListaCzynnikow objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ListaCzynnikow
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
