<?php

namespace App\Doctrine\ORM\Entity\Order;

use ddd\core\Order\Domain\OrderStatus;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'orders')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'integer')]
    private int $clientId;

    #[ORM\Column(type: 'string', enumType: OrderStatus::class)]
    private OrderStatus $status;

    #[ORM\OneToMany(targetEntity: OrderLine::class, mappedBy: 'order', cascade: ['persist', 'remove'])]
    private Collection $orderLines;

    public function __construct(
        int         $id,
        int         $clientId,
        OrderStatus $status,
        array       $orderLines = []
    )
    {
        $this->id = $id;
        $this->clientId = $clientId;
        $this->status = $status;
        $this->orderLines = new ArrayCollection($orderLines);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function getStatus(): OrderStatus
    {
        return $this->status;
    }

    public function getOrderLines(): Collection
    {
        return $this->orderLines;
    }

    public function addOrderLine(OrderLine $orderLine): void
    {
        if (!$this->orderLines->contains($orderLine)) {
            $this->orderLines->add($orderLine);
            $orderLine->setOrder($this);
        }
    }

    public function removeOrderLine(OrderLine $orderLine): void
    {
        if ($this->orderLines->removeElement($orderLine)) {
            $orderLine->setOrder(null);
        }
    }
}
