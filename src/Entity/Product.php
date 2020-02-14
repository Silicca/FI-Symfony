<?php

/** 
*   This file contains the class entity for the products
*/

declare(strict_types=1);

namespace App\Entity;

use App\Entity\CategorieEnum;

/** 
*   Product class
*/
class Product
{
    private $id;

    private $name;

    private $price;

    private $cat;

    public function __construct($name, $price, $cat)
    {
        $this->id = \App\ORM\Util\UUID::v4();
        $this->name = $name;
        $this->cat = $cat;
        $this->price = $price;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setCat(string $cat)
    {
        $this->cat = $cat;
    }

    public function getCat(): string
    {
        return $this->cat;
    }

}
