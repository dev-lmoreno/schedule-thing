<?php

require_once 'vendor/autoload.php';

use ScheduleThing\API\Http\Router;
use ScheduleThing\Test\SystemTest;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$testMode = $argv[0] ?? false;
if ($testMode) {
    $systemTest = (new SystemTest())->execute();
    die();
}

define('URL', $_ENV['BASE_URL']);

$router = new Router(URL);
if (!$router->isApiRequest()) {
    die();
}

$router->run();
