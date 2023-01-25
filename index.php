<?php

require 'vendor/autoload.php';
require 'src/Test/ClientTest.php';

echo "\n\nInício do sistema\n\n";

$clientTest = new ClientTest();
$createClientTest = $clientTest->createClientTest();

// o clientTest deve retornar 1 caso de tudo certo.
print_r([
    'log'        => 'createClientTest',
    'clientTest' => $createClientTest,
]);
