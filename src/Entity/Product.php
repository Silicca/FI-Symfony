<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\CategorieEnum;

class Product
{
    private $id;
    private $name;
    private $price;
    private $cat;

    public function __construct($)
    {
        $this->id = \App\ORM\Util\UUID::v4();
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

    /**
     * CategorieEnum
     */
    public function setCat(string $cat)
    {
        $this->cat = $cat;
    }

    /**
     * CategorieEnum
     */
    public function getCat(): string
    {
        return $this->cat;
    }

}
