<?php

/** 
*   This file contains the class entity for the menus
*/

declare(strict_types=1);

namespace App\Entity;

use App\Entity\IBuyable;

/** 
*   Menu class
*/
class Menu implements IBuyable
{
    private $id;

    private $menu;

    private $name;

    private $price;

    public function __construct($name, $price)
    {
        $this->id = \App\ORM\Util\UUID::v4();
        $this->products = [];
        $this->name = $name;
        $this->price = $price;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setPrice($price): void
    {
        $this->price = $price;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getMenu() : array
    {
        return $this->menu;
    }

    /**
    * This function add a product to a menu
    *
    * @param IBuyable $buyable The product added to the menu
    * @return void
    */
    public function add(IBuyable $buyable): void
    {
        $id = $buyable->getId();
        array_push($this->menu, $id);
    }

    /**
    * This function delete a product of a menu
    *
    * @param IBuyable $buyable The product deleted of the menu
    * @return void
    */
    public function delete(IBuyable $buyable): void
    {
        unset($this->getMenu()[$buyable->getId()]);
    }
}
