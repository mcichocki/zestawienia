<?php

namespace App\Service;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Security;

class BaseService
{
    private EntityManagerInterface $entityManager;
    private LoggerInterface $logger;
    private Security $security;

    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->logger = $logger;
        $this->security = $security;
    }

    public function save($object)
    {
        $this->entityManager->persist($object);
        $this->entityManager->flush();
    }

    public function remove($object)
    {
        $this->entityManager->remove($object);
        $this->entityManager->flush();
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function getUser()
    {
        return $this->security->getUser();
    }

    public function getRole()
    {
        return $this->getUser()->getRoles()[0];
    }

    public function getRepository($entity)
    {
        return $this->getEntityManager()->getRepository($entity);
    }

    public function delay($time)
    {
        sleep($time);
    }
}