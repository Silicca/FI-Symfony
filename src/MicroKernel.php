<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Routing\RouteCollection;

use App\Entity\Product;
use App\Entity\CategorieEnum;

final class MicroKernel
{
    private $routes;
    private $containerBuilder;

    public function __construct()
    {
        $this->routes = new RouteCollection();
        $this->containerBuilder = new ContainerBuilder();

        $this->initRoutes();
        $this->initServices();
        $this->initDB();
    }

    private function initRoutes(): void
    {
        $this->routes->add('test', new Route('/test', ['_controller' => 'App\Controller\MyController']));
        // Add your Routes here. documentation here https://symfony.com/doc/4.2/components/routing.html

        $this->routes->add('homepage', new Route('/', ['_controller' => 'App\Controller\HomepageController']));
        //$this->routes->add('route_name', new Route('/', ['_controller' => 'App\Controller\MyController']));        
    }

    private function initServices(): void
    {
        // Add your Services here. documentation here https://symfony.com/doc/4.2/components/dependency_injection.html
        $this->containerBuilder->register('debug', 'App\Util\Debugger');
        $this->containerBuilder->register('entity.manager', 'App\ORM\EntityManager');

        $this->containerBuilder->setParameter('cart-service.entity.manager', new Reference('entity.manager'));
        $this->containerBuilder
            ->register('cart-service', 'App\Service\CartService')
            ->addArgument('%cart-service.entity.manager%');

        $this->containerBuilder->setParameter('menu-service.entity.manager', new Reference('entity.manager'));
        $this->containerBuilder
            ->register('menu-service', 'App\Service\MenuService')
            ->addArgument('%menu-service.entity.manager%');

        $this->containerBuilder->setParameter('product-service.entity.manager', new Reference('entity.manager'));
        $this->containerBuilder
            ->register('product-service', 'App\Service\ProductService')
            ->addArgument('%product-service.entity.manager%');
    }

    private function initDB(): void
    {
        $entityManager = $this->containerBuilder->get('entity.manager');

        $product1 = new Product();
        $product1->setId(1);
        $product1->setName('product1');
        $product1->setPrice(9);
        $product1->setCat(CategorieEnum::BURGER);

        $product2 = new Product();
        $product2->setId(2);
        $product2->setName('product2');
        $product2->setPrice(12);
        $product2->setCat(CategorieEnum::BOISSON);

        $product3 = new Product();
        $product3->setId(3);
        $product3->setName('product3');
        $product3->setPrice(5);
        $product3->setCat(CategorieEnum::ACCOMPAGNEMENT);

        $product4 = new Product();
        $product4->setId(4);
        $product4->setName('product4');
        $product4->setPrice(100);
        $product4->setCat(CategorieEnum::SAUCES);

        $product5 = new Product();
        $product5->setId(5);
        $product5->setName('product5');
        $product5->setPrice(7);
        $product5->setCat(CategorieEnum::DESSERT);
        
        $entityManager->resetDatabase();

        $entityManager->persist($product1);
        $entityManager->persist($product2);
        $entityManager->persist($product3);
        $entityManager->persist($product4);
        $entityManager->persist($product5);

        $entityManager->flush();
    }

    private function resolveController(Request $request)
    {
        $context = new RequestContext('/');
        $matcher = new UrlMatcher($this->routes, $context);

        $parameters = $matcher->match($request->getPathInfo());

        if (!isset($parameters['_controller'])) {
            return false;
        }

        return $parameters;
    }

    public function handleRequest(Request $request): Response
    {
        // load controller
        if (false === $arguments = $this->resolveController($request)) {
            throw new \RuntimeException(sprintf('Unable to find the controller for path "%s". The route is wrongly configured.', $request->getPathInfo()));
        }

        $controllerClass = $arguments['_controller'];

        unset($arguments['_route'], $arguments['_controller']);
        array_unshift($arguments, $request, $this->containerBuilder);

        $controller = new $controllerClass();

        if (!is_callable($controller)) {
            throw new \InvalidArgumentException(sprintf('The controller for URI "%s" is not callable.', $request->getPathInfo()));
        }

        return $controller(...$arguments);
    }
}
