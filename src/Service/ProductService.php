<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Product;

class ProductService
{
    private $entity_manager;

    public function __construct($entity_manager)
    {
        $this->entity_manager = $entity_manager;
    }

    /**
     * Returns existing products.
     */
    public function getProducts(): array
    {
        return $this->entity_manager->findAll(Product::class);
    }

}
