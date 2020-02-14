<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\DoStuff;
use App\Util\Debugger;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomepageController
{
    public function __invoke(Request $request, Container $container)
    {
        switch ($request->getMethod()) {
            case "GET":
                return $this->index($request, $container);
                break;
            default:
                throw new Exception("verb non supporté");
        }
    }

    /**
     * GET HomepageController
     */
    public function index(Request $request, Container $container)
    {
        $menuService = $container->get("menu-service");
        $menuList = $menuService->getMenus();

        $productService = $container->get("product-service");
        $productList = $productService->getProducts();

        echo '<h2>PRODUCTS</h2><p>';
        foreach ($productList as $product) {
            echo "${$product->getName()} ${$product->getPrice()}\n";
        }
        echo '</p>';

        echo '<h2>MENUS</h2><p>';
        foreach ($menuList as $menu) {
            echo "${$menu->getName()} ${$menu->getPrice()}\n";
        }
        echo '</p>';

        $content = ob_get_clean();
        return new Response($content);
    }
}
