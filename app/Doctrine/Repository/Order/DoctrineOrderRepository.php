<?php

namespace App\Doctrine\Repository\Order;

use App\Doctrine\Repository\DoctrineRepository;

use ddd\core\Order\Domain\Contracts\OrderRepository;
use ddd\core\Order\Domain\Order;
use ddd\core\Order\Domain\OrderLine;

class DoctrineOrderRepository extends DoctrineRepository implements OrderRepository
{

    public function nextOrderIdentity(): int
    {
        $lastOrder = $this->repository(Order::class)->findOneBy([], ['id' => 'DESC']);
        return $lastOrder ? $lastOrder->id() + 1 : 1;
    }

    public function nextOrderLineIdentity(): int
    {
        $lastOrderLine = $this->repository(OrderLine::class)->findOneBy([], ['id' => 'DESC']);
        return $lastOrderLine ? $lastOrderLine->id() + 1 : 1;
    }

    public function findById(int $id): ?Order
    {
        return $this->repository(Order::class)->find($id);
    }

    public function save(Order $order): void
    {
        $this->persist($order);
    }
}
