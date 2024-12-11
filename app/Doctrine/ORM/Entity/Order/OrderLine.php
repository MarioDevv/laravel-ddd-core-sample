<?php

namespace App\Doctrine\ORM\Entity\Order;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'order_lines')]
class OrderLine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'integer')]
    private int $quantity;

    #[ORM\Column(type: 'integer')]
    private float $price;

    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'orderLines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $order = null;

    public function __construct(
        string $name,
        int    $quantity,
        float  $price
    )
    {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(?Order $order): void
    {
        $this->order = $order;
    }
}
