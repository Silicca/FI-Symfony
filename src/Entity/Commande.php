<?php

namespace App\Entity;

use App\Entity\Product;
use App\Entity\Menu;
use App\Entity\Status;

final class Commande
{
    private $id;

    private $status;

    private $price;

    private $commande;

    public function __construct()
    {
        $this->id = \App\ORM\Util\UUID::v4();
        $this->status = new Status().$COMMANDE;
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

    public function add(Product $product): void
    {
        $this->commande.add($product => $product.getQuantity());
    }

    public function add(Menu $menu): void
    {
        $this->commande.add($menu => $menu.getQuantity());
    }

    public function delete(Product $product): void
    {
        $this->commande.delete($product);
    }

    public function delete(Menu $menu): void
    {
        $this->commande.delete($menu);
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
