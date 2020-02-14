<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\DoStuff;
use App\Entity\Product;
use App\Entity\CategorieEnum;
use App\Util\Debugger;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController
{

    public function __invoke(Request $request, Container $container)
    {
        $entityManager = new \App\ORM\EntityManager();
        $collectionOfProduct = $entityManager->findAll(Product::class);

        if (0 === count($collectionOfProduct)){
            $this->initializeDB($entityManager);
            $collectionOfProduct= $entityManager->findAll(Product::class);
        }
        
        ob_start();

        foreach($collectionOfProduct as $product){
            echo "Name : $product->name\n";
            echo "Price : $product->price\n";
            echo "Category : $product->cat\n";
            echo "name : $product->name\n\n";
        }
        $content = ob_get_clean();

        // $jsonResponse = new JsonResponse(['Data' => 'stuff']);
        return new Response($content);
    }


    private function initializeDB($entityManager) : void{
        $product1 = new Product();
        $product1->id = 1;
        $product1->name = 'product1';
        $product1->price = 9;
        $product1->cat = CategorieEnum::BURGER;

        $product2 = new Product();
        $product2->id = 2;
        $product2->name = 'product2';
        $product2->price = 12;
        $product2->cat = CategorieEnum::BOISSON;

        $product3 = new Product();
        $product3->id = 3;
        $product3->name = 'product3';
        $product3->price = 5;
        $product3->cat = CategorieEnum::ACCOMPAGNEMENT;

        $product4 = new Product();
        $product4->id = 4;
        $product4->name = 'product4';
        $product4->price = 100;
        $product4->cat = CategorieEnum::SAUCES;

        $product5 = new Product();
        $product5->id = 5;
        $product5->name = 'product5';
        $product5->price = 7;
        $product5->cat = CategorieEnum::DESSERT;
        
        $entityManager->resetDatabase();

        $entityManager->persist($product1);
        $entityManager->persist($product2);
        $entityManager->persist($product3);
        $entityManager->persist($product4);
        $entityManager->persist($product5);

        $entityManager->flush();

    }
}
