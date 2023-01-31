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

    public function execute(string $testAction = ''): void
    {
        $connectionTest = $this->connectionTest->connect();
        $this->logExecution('connection', $connectionTest);

        switch ($testAction) {
            case 'create':
                $createClientTest = $this->clientTest->createClientTest();
                $this->logExecution('createClientTest', $createClientTest);
                break;
            case 'findAll':
                $findAllClientTest = $this->clientTest->findAllClientTest();
                $this->logExecution('findAllClientTest', $findAllClientTest);
                break;
            case 'findOne':
                $findOneClientTest = $this->clientTest->findOneClientTest();
                $this->logExecution('findOneClientTest', $findOneClientTest);
            case 'delete':
                $deleteClientTest = $this->clientTest->deleteClientTest();
                $this->logExecution('deleteClientTest', $deleteClientTest);
            case 'update':
                $updateClientTest = $this->clientTest->updateClientTest();
                $this->logExecution('updateClientTest', $updateClientTest);
        }
    }

    private function logExecution(string $log, array|object|bool $result): string
    {
        return print_r([
            'log' => $log,
            'result' => $result
        ]);
    }
}
