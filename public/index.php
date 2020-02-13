<?php

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use App\MicroKernel;
use Symfony\Component\HttpFoundation\Request;

$kernel = new MicroKernel();
$request = Request::createFromGlobals();
$response = $kernel->handleRequest($request);
$response->send();
