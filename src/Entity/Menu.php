<?php

declare(strict_types=1);

namespace App\Entity;

class DoStuff
{
    private $id;
    private $products;
    private $name;
    private $price;

    public function __construct()
    {
        $this->id = \App\ORM\Util\UUID::v4();
        $this->products = [];
    }

    public function addProduct($product): int
    {
        return array_push($this->products, $product);
    }

    public function deleteProduct($product): void
    {
        $key = array_search($product, $this->products);
        unset($this->products[$key]);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function setPrice($price): void
    {
        $this->price = $price;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setProducts($products): void
    {
        $this->products = $products;
    }
}
