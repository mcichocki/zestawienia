<?php

namespace App\Repository;

use App\Entity\Formularz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Formularz|null find($id, $lockMode = null, $lockVersion = null)
 * @method Formularz|null findOneBy(array $criteria, array $orderBy = null)
 * @method Formularz[]    findAll()
 * @method Formularz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormularzRepository extends ServiceEntityRepository
{
    private $rokZestawieniowy;

    public function __construct(ManagerRegistry $registry, RokZestawieniowyRepository $rokZestawieniowyRepository)
    {
        parent::__construct($registry, Formularz::class);
        $this->rokZestawieniowy = $rokZestawieniowyRepository;
    }

    /****************************
     *
     * --- Worker - Pracownik ---
     *
    ****************************/

    //Formularze do realizacji
    public function findFormsToDoForWorker($worker)
    {
        return $this->createQueryBuilder('f')
            ->where('f.worker = :worker')
            ->andWhere('f.rokZestawieniowy = :year')
            ->andWhere('f.state is NULL or f.state = :w_role')
            ->setParameters([
                'worker' => $worker,
                'w_role' => 'worker',
                'year' => $this->rokZestawieniowy->findOneBy(['status' => 1])
            ])
            ->getQuery()
            ->getResult();
    }

    // Formularze w akceptacji
    public function findFormsInAcceptForWorker($worker)
    {
        return $this->createQueryBuilder('f')
            ->where('f.worker = :worker')
            ->andWhere('f.rokZestawieniowy = :year')
            ->andWhere('f.state = :s_role or f.state = :m_role')
            ->setParameters([
                'worker' => $worker,
                's_role' => 'supervisor',
                'm_role' => 'manager',
                'year' => $this->rokZestawieniowy->findOneBy(['status' => 1])
            ])
            ->getQuery()
            ->getResult();
    }


    // Formularze zakończone
    public function findFormsDoneForWorker($worker)
    {
        return $this->createQueryBuilder('f')
            ->where('f.worker = :worker')
            ->andWhere('f.rokZestawieniowy = :year')
            ->andWhere('f.state = :state')
            ->setParameters([
                'worker' => $worker,
                'state' => 'done',
                'year' => $this->rokZestawieniowy->findOneBy(['status' => 1])
            ])
            ->getQuery()
            ->getResult();
    }


    /*********************************
     *
     * --- Supervisor - Przełożony ---
     *
     ********************************/

    //Formularze do realizacji
    public function findFormsToDoForSupervisor($supervisor)
    {
        return $this->createQueryBuilder('f')
//            ->where('f.worker = :worker')
            ->andWhere('f.rokZestawieniowy = :year')
            ->andWhere('f.state = :s_role')
            ->setParameters([
                's_role' => 'supervisor',
                'year' => $this->rokZestawieniowy->findOneBy(['status' => 1])
            ])
            ->getQuery()
            ->getResult();
    }

    // Formularze w akceptacji
    public function findFormsInAcceptForSupervisor($supervisor)
    {
        return $this->createQueryBuilder('f')
//            ->where('f.worker = :worker')
            ->andWhere('f.rokZestawieniowy = :year')
            ->andWhere('f.state = :m_role')
            ->setParameters([
                'm_role' => 'manager',
                'year' => $this->rokZestawieniowy->findOneBy(['status' => 1])
            ])
            ->getQuery()
            ->getResult();
    }

    // Formularze zakończone
    public function findFormsDoneForSupervisor($supervisor)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.rokZestawieniowy = :year')
            ->andWhere('f.state = :state')
            ->setParameters([
                'state' => 'done',
                'year' => $this->rokZestawieniowy->findOneBy(['status' => 1])
            ])
            ->getQuery()
            ->getResult();
    }


    /****************************
     *
     * --- Manager - Dyrektor ---
     *
     ***************************/

    //Formularze do realizacji
    public function findFormsToDoForManager($manager)
    {
        return $this->createQueryBuilder('f')
//            ->where('f.worker = :worker')
            ->andWhere('f.rokZestawieniowy = :year')
            ->andWhere('f.state = :m_role')
            ->setParameters([
                'm_role' => 'manager',
                'year' => $this->rokZestawieniowy->findOneBy(['status' => 1])
            ])
            ->getQuery()
            ->getResult();
    }

    // Formularze w akceptacji
    public function findFormsInAcceptForManager($manager)
    {
        return $this->createQueryBuilder('f')
//            ->where('f.worker = :worker')
            ->andWhere('f.rokZestawieniowy = :year')
            ->andWhere('f.state = :s_role')
            ->setParameters([
                's_role' => 'supervisor',
                'year' => $this->rokZestawieniowy->findOneBy(['status' => 1])
            ])
            ->getQuery()
            ->getResult();
    }

    // Formularze zakończone
    public function findFormsDoneForManager($manager)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.rokZestawieniowy = :year')
            ->andWhere('f.state = :state')
            ->setParameters([
                'state' => 'done',
                'year' => $this->rokZestawieniowy->findOneBy(['status' => 1])
            ])
            ->getQuery()
            ->getResult();
    }

    public function exportPDF($id)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findArchives($jednostka)
    {
        return $this->createQueryBuilder('f')
            ->leftJoin('f.rokZestawieniowy', 'r')
            ->andWhere('f.jednostka = :j')
            ->andWhere('r.status = :status')
            ->setParameters([
                'status' => 0,
                'j' => $jednostka,
            ])
            ->orderBy('f.rokZestawieniowy', 'DESC')
            ->getQuery()
            ->getResult();
    }
}