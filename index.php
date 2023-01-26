<?php

use ScheduleThing\Test\SystemTest;

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

echo "Início do sistema";

$systemTest = (new SystemTest())->execute();
