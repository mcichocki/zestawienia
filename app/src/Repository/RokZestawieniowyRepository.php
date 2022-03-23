<?php

namespace App\Repository;

use App\Entity\RokZestawieniowy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RokZestawieniowy|null find($id, $lockMode = null, $lockVersion = null)
 * @method RokZestawieniowy|null findOneBy(array $criteria, array $orderBy = null)
 * @method RokZestawieniowy[]    findAll()
 * @method RokZestawieniowy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RokZestawieniowyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RokZestawieniowy::class);
    }

    public function getRokZestawieniowy()
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.status = :status')
            ->setParameter('status', 1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
