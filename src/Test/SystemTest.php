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

    public function execute(string $testAction = 'all'): void
    {
        switch ($testAction) {
            case 'database':
                $this->runDatabaseTest();
                break;
            case 'create':
                $this->runCreateClientTest();
                break;
            case 'findAll':
                $this->runFindAllClientTest();
                break;
            case 'findOne':
                $this->runFindOneClientTest();
                break;
            case 'delete':
                $this->runDeleteClientTest();
                break;
            case 'update':
                $this->runUpdateClientTest();
                break;
            case 'all':
                $this->executeAllTests();
                break;
            default:
                $this->executeAllTests();
                break;
        }
    }

    public function executeAllTests(): void
    {
        $this->runDatabaseTest();
        $this->runCreateClientTest();
        $this->runFindAllClientTest();
        $this->runFindOneClientTest();
        $this->runDeleteClientTest();
        $this->runUpdateClientTest();
    }

    private function runDatabaseTest(): void
    {
        $connectionTest = $this->connectionTest->connect();
        $this->logExecution('Starting connection test', $connectionTest);
    }

    private function runCreateClientTest(): void
    {
        $createClientTest = $this->clientTest->createClientTest();
        $this->logExecution('Starting create client test', $createClientTest);
    }

    private function runFindAllClientTest(): void
    {
        $findAllClientTest = $this->clientTest->findAllClientTest();
        $this->logExecution('Starting find all client test', $findAllClientTest);
    }

    private function runFindOneClientTest(): void
    {
        $findOneClientTest = $this->clientTest->findOneClientTest();
        $this->logExecution('Starting find one client test', $findOneClientTest);
    }

    private function runDeleteClientTest(): void
    {
        $deleteClientTest = $this->clientTest->deleteClientTest();
        $this->logExecution('Starting delete client test', $deleteClientTest);
    }

    private function runUpdateClientTest(): void
    {
        $updateClientTest = $this->clientTest->updateClientTest();
        $this->logExecution('Starting update client test', $updateClientTest);
    }

    private function logExecution(string $log, array|object|bool $result): string
    {
        return print_r([
            'log' => $log,
            'result' => $result
        ]);
    }
}
