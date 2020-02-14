<?php

/** 
*   This file contains the class entity for the commands
*/

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Product;
use App\Entity\Menu;
use App\Entity\StatusEnum;
use App\Entity\IBuyable;

/** 
*   Commande class
*/
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

    /**
    * This function add a product or a menu to the command with a specific quantity
    *
    * @param IBuyable $buyable The product or menu added to the command
    * @param int $quantity The quantity of product or menu added to the command
    * @return void
    */
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

    /**
    * This function delete a product or a menu of the command.
    *
    * @param IBuyable $buyable The product or menu deleted of the command
    * @return void
    */
    public function delete(IBuyable $buyable): void
    {
        unset($this->getCommande()[$buyable->getId()]);
    }

}
