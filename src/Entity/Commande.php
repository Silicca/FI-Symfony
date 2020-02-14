<?php

namespace App\Entity;

use App\Entity\Product;
use App\Entity\Menu;
use App\Entity\StatusEnum;
use App\Entity\IBuyable;

final class Commande
{
    private $id;

    private $status;

    private $price;

    private $commande;

    public function __construct()
    {
        $this->id = \App\ORM\Util\UUID::v4();
        $this->status = StatusEnum::$COMMANDE;
        $this->price = 0;
        $this->commande = array();
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
        $id = $buyable->getId();
        $command = $this->getCommande();
        if(in_array($id, $command))
        {
            $command[$id] += $quantity;
        } else
        {
            $command[$id] = $quantity;
        }
    }

    public function delete(IBuyable $buyable): void
    {
        unset($this->getCommande()[$buyable->getId()]);
    }

}
