<?php

namespace ScheduleThing\Test\ClientTest;

use DateTime;
use ScheduleThing\Controller\Client\ClientController;
use ScheduleThing\Model\Client\ClientModel;

class ClientTest {
    private ClientController $clientController;

    public function __construct() {
        $this->clientController = new ClientController();
    }

    private function prepareDublesClients(): array
    {
        $clientsDubles = [
            new ClientModel(
                null,
                'Lucas',
                'Moreno',
                'devlmoreno007@gmail.com',
                '82825535060',
                'lmoreno',
                'teste123',
                new DateTime(),
                new DateTime(),
                null
            ),
            new ClientModel(
                null,
                'Lukita',
                'Moreno',
                'lucasacm007@gmail.com',
                '47413606011',
                'lukita',
                'teste123',
                new DateTime(),
                new DateTime(),
                null
            ),
            new ClientModel(
                null,
                'John',
                'Doe',
                'johndoe@example.com',
                '524.749.900-03',
                'johndoe',
                'password123',
                new DateTime(),
                new DateTime(),
                null
            ),
            new ClientModel(
                null,
                'Jane',
                'Smith',
                'janesmith@example.com',
                '38990938015',
                'janesmith',
                'password456',
                new DateTime(),
                new DateTime(),
                null
            ),
            new ClientModel(
                null,
                'Bob',
                'Johnson',
                'bobjohnson@example.com',
                '985.629.900-43',
                'bobjohnson',
                'password789',
                new DateTime(),
                new DateTime(),
                null
            ),
        ];

        return $clientsDubles;
    }

    public function createClientTest(): array
    {
        $dublesClients = self::prepareDublesClients();

        $createDubleClient = [];
        foreach($dublesClients as $dubleClient) {
            $createDubleClient[] = $this->clientController->create($dubleClient);
        }

        return $createDubleClient;
    }

    public function findAllClientTest(): array
    {
        $findAllClient = $this->clientController->findAll();
        return $findAllClient;
    }

    public function findOneClientTest(): array
    {
        $findOneClient = $this->clientController->findOne(3);
        return $findOneClient;
    }

    public function deleteClientTest(): array
    {
        $deleteClient = $this->clientController->delete(2);
        return $deleteClient;
    }

    public function updateClientTest(): array
    {
        $updateValues = [
            'firstName' => 'Lucas update',
            'lastName'  => 'Moreno update'
        ];

        $updateClient = $this->clientController->update(10, $updateValues);
        return $updateClient;
    }
}
