<?php

require_once 'vendor/autoload.php';

use ScheduleThing\API\Http\Router;
use ScheduleThing\Test\SystemTest;
use ScheduleThing\API\Routes\Client\ClientRoutes;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

//echo "Início do sistema";

// TESTE DO SISTEMA
$testMode = $argv[0] ?? false;
if ($testMode) {
    $systemTest = (new SystemTest())->execute();
}

// DEFINE A CONSTANTE DA URL
define('URL', $_ENV['BASE_URL']);

// INICIA O ROUTER
$router = new Router(URL);
if (!$router->isApiRequest()) {
    die();
}

$router->run();
