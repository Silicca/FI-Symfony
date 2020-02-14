<?php

namespace App\Entity;

use App\Entity\Product;
use App\Entity\Menu;
use App\Entity\StatusEnum;
use App\Entity\IBuyable;

final class Commande
{
    private int $id;

    private int $status;

    private int $price;

    private $commande;

    public function __construct()
    {
        $this->id = \App\ORM\Util\UUID::v4();
        $this->status = new StatusEnum()::$COMMANDE;
        $this->price = 0;
        $this->commande = array('' => , );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getCommande(): array
    {
        return $this->commande;
    }

    public function add(IBuyable $buyable, int $quantity): void
    {
        $this->commande.add($buyable => $quantity);
    }

    public function delete(IBuyable $buyable): void
    {
        $this->commande.delete($buyable);
    }

    public function totalPrice(): int
    {
        int $sum = 0;
        foreach ($commande as $product => $quantity) {
            $sum += $product.getPrice() * $quantity;
        }
        return $sum;
    }
}
