<?php

require_once 'vendor/autoload.php';

use ScheduleThing\API\Http\Router;
use ScheduleThing\Test\SystemTest;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$acceptedTestAction = ['create', 'findAll'];

$testMode   = $argv[1] ? 'test' : '';
$testAction = $argv[2];

if ($testMode === 'test') {
    if (in_array($testAction, $acceptedTestAction)) {
        $systemTest = (new SystemTest())->execute($testAction);
        die();
    }
}

define('URL', $_ENV['BASE_URL']);

$router = new Router(URL);
if (!$router->isApiRequest()) {
    die();
}

$router->run();
