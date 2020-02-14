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

class MenuController
{

    private function initializeDB(){
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
        

    }


    public function __invoke(Request $request, Container $container)
    {
        /** @var Debugger $debugger */
        $debugger = $container->get('debug');
        //$debugger->dump($request);

        $entityManager = $container->get('entity.manager');
        $entityManager->resetDatabase();

        ob_start();
        $brushTeeth = new DoStuff();
        $brushTeeth->setStuffToDo('Do not forget to brush your teeth');
        echo 'create an object instance.<br/>';

        echo 'persist it (meaning the manager knows the object, but it\'s not stored yet).<br/>';
        $entityManager->persist($brushTeeth);

        $id = $brushTeeth->getId();

        $toCompare = $entityManager->find(DoStuff::class, $id);
        echo 'get the persisted object but not stored yet and compares it to the previous one.<br/>';
        echo 'does it match?.<br/>';

        echo $toCompare === $brushTeeth ? 'yes.<br/>' : 'no.<br/>';

        echo 'store the object this time.<br/>';
        $entityManager->flush();

        // start again.
        echo 'delete the variables and instances.<br/>';
        unset($brushTeeth, $entityManager, $toCompare);

        $entityManager = new \App\ORM\EntityManager();
        $brushTeeth = $entityManager->find(DoStuff::class, $id);

        echo 'get brushTeeth object from the db, with it\'s id.<br/><pre>';
        var_dump($brushTeeth);
        echo '</pre>';

        $collectionOfStuffToDo = $entityManager->findAll(DoStuff::class);
        echo 'get the full collection<br/><pre>';
        var_dump($collectionOfStuffToDo);
        echo '</pre>';

        // remove from memory but not from the db
        echo 'remove object from collection, but not the db yet.<br/>';
        $entityManager->remove($brushTeeth);

        // remove from db
        echo 'updates the db.<br/>';
        $entityManager->flush();

        // start again.
        echo 'delete the variables and instances again.<br/>';
        unset($brushTeeth, $entityManager, $toCompare);

        $entityManager = new \App\ORM\EntityManager();
        $collectionOfStuffToDo = $entityManager->findAll(DoStuff::class);
        echo 'collection should be empty now.<br/>';
        echo 0 === count($collectionOfStuffToDo) ? 'yes.<br/>' : 'no.<br/>';
        $content = ob_get_clean();

        // $jsonResponse = new JsonResponse(['Data' => 'stuff']);
        return new Response($content);
    }
}
