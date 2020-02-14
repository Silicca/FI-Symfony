<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Commande;
use App\Entity\IBuyable;

class CartService
{
    private $entity_manager;

    public function __construct($entity_manager)
    {
        $this->entity_manager = $entity_manager;
    }

    /**
     * Returns the total price for a given commande.
     */
    public function computePrice(Commande $commande): int
    {
        $sum = 0;
        foreach ($commande as $productId => $quantity) {
            $product = $entityManager->find(IBuyable::class, $id);

            if(is_null($product))
            {
                throw new Exception('id prodit n\' est pas connu');
            } else
            {
                $sum += $product->getPrice() * $quantity;
            }            
        }
        return $sum;
    }

}
