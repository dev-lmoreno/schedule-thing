<?php

namespace ScheduleThing\Test\ClientTest;

use DateTime;
use ScheduleThing\Controller\Client\ClientController;
use ScheduleThing\Model\Client\ClientModel;

class ClientTest {
    public function createClientTest()
    {
        $clientModel = new ClientModel(
            1,
            'Lucas',
            'Moreno',
            'devlmoreno007@gmail.com',
            '39860026858',
            'lmoreno',
            'teste123',
            new DateTime(),
            new DateTime(),
        );

        $clientController = new ClientController();
        $createClient = $clientController->create($clientModel);

        if ($createClient) {
            return true;
        }

        return false;
    }

    public function findAllClientTest()
    {
        $clientController = new ClientController();
        $findAllClient = $clientController->findAll();

        if ($findAllClient) {
            return $findAllClient;
        }

        return [];
    }
}
