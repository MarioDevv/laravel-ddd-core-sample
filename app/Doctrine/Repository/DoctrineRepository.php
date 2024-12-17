<?php

namespace App\Doctrine\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;

abstract class DoctrineRepository
{
    public function __construct(private readonly EntityManager $entityManager)
    {
    }

    protected function entityManager(): EntityManager
    {
        return $this->entityManager;
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    protected function persist($entity): void
    {
        $this->entityManager()->persist($entity);
        $this->entityManager()->flush();
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    protected function remove($entity): void
    {
        $this->entityManager()->remove($entity);
        $this->entityManager()->flush();
    }

    protected function repository(string $entityClass): EntityRepository
    {
        return $this->entityManager->getRepository($entityClass);
    }
}
