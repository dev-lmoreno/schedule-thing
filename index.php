<?php

use ScheduleThing\Test\ClientTest\ClientTest;
use ScheduleThing\Test\DatabaseTest\ConnectionTest;

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

echo "\n\nInício do sistema\n\n";

// Início Teste conexão com o banco
$connectionTest = (new ConnectionTest())->connection();

print_r([
    'log'        => 'connection',
    'initConnectionTest' => $connectionTest,
]);
// Fim Teste conexão com o banco

// Início Teste cadastro cliente
$clientTest = new ClientTest();
$createClientTest = $clientTest->createClientTest();

print_r([
    'log'        => 'createClientTest',
    'clientTest' => $createClientTest,
]);
// Fim Teste cadastro cliente
