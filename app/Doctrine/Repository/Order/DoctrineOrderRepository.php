<?php

namespace App\Doctrine\Repository\Order;

use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

use ddd\core\Order\Domain\Contracts\OrderRepository;
use ddd\core\Order\Domain\Order;

class DoctrineOrderRepository implements OrderRepository
{

    private EntityRepository $serviceRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->serviceRepository = $entityManager->getRepository(Order::class);
    }

    public function nextOrderIdentity(): int
    {
        return $this->getNextIdFromDatabase('orders');
    }

    public function nextOrderLineIdentity(): int
    {
        return $this->getNextIdFromDatabase('order_lines');
    }

    public function findById(int $id): ?Order
    {
        // TODO: Implement findById() method.
    }

    public function persist(Order $order): void
    {
        // TODO: Implement persist() method.
    }


    private function getNextIdFromDatabase(string $tableName): int
    {
        $connection = $this->entityManager->getConnection();
        $sql = 'SHOW TABLE STATUS LIKE :tableName';

        $result = $connection->executeQuery($sql, [
            'tableName' => $tableName
        ])->fetchAssociative();

        if ($result === false || !isset($result['Auto_increment'])) {
            throw new \RuntimeException("Unable to retrieve the next ID for table: {$tableName}");
        }

        return (int) $result['Auto_increment'];
    }


}
