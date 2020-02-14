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
        echo 'test';
        $content = ob_get_clean();
        return new Response($content);
    }
}
