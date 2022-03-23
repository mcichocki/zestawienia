<?php

namespace App\Repository;

use App\Entity\Jednostka;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Jednostka|null find($id, $lockMode = null, $lockVersion = null)
 * @method Jednostka|null findOneBy(array $criteria, array $orderBy = null)
 * @method Jednostka[]    findAll()
 * @method Jednostka[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JednostkaRepository extends ServiceEntityRepository
{
    protected $em;

    public function __construct(EntityManagerInterface $em, ManagerRegistry $registry)
    {
        parent::__construct($registry, Jednostka::class);
        $this->em = $em;
    }

    public function setEntityManager($object)
    {
        $this->em->persist($object);
        $this->em->flush();
    }

    // /**
    //  * @return Jednostka[] Returns an array of Jednostka objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Jednostka
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
