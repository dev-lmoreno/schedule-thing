<?php

namespace ScheduleThing\Test;

use ScheduleThing\Test\ClientTest\ClientTest;
use ScheduleThing\Test\DatabaseTest\ConnectionTest;

class SystemTest {
    private ClientTest $clientTest;
    private ConnectionTest $connectionTest;

    public function __construct() {
        $this->clientTest = new ClientTest();
        $this->connectionTest = new ConnectionTest();
    }

    public function execute(): void
    {
        $connectionTest = $this->connectionTest->connect();
        $this->logExecution('connection', $connectionTest);

        $createClientTest = $this->clientTest->createClientTest();
        $this->logExecution('createClientTest', $createClientTest);

        $findAllClientTest = $this->clientTest->findAllClientTest();
        $this->logExecution('findAllClientTest', $findAllClientTest);
    }

    private function logExecution(string $log, array|object|bool $result): string
    {
        return print_r([
            'log' => $log,
            'result' => $result
        ]);
    }
}
