<?php

namespace ScheduleThing\Test\ClientTest;

use DateTime;
use ScheduleThing\Controller\Client\ClientController;
use ScheduleThing\Model\Client\ClientModel;
use ScheduleThing\Database\DbThing;
use ScheduleThing\Constants\Clients\ClientsConstants;

class ClientTest {
    private DbThing $db;

    public function __construct() {
        $this->db = new DbThing();
    }

    public function createClientTest(): array
    {
        $clientController = new ClientController();

        $clientModelFirst = new ClientModel(
            $this->db->nextId(ClientsConstants::TABLE_NAME, ClientsConstants::COLUMN_ID),
            'Lucas',
            'Moreno',
            'devlmoreno007@gmail.com',
            '82825535060',
            'lmoreno',
            'teste123',
            new DateTime(),
            new DateTime(),
        );

        $createClientFirst = $clientController->create($clientModelFirst);

        $clientModelSecond = new ClientModel(
            $this->db->nextId(ClientsConstants::TABLE_NAME, ClientsConstants::COLUMN_ID),
            'Lukita',
            'Moreno',
            'lucasacm007@gmail.com',
            '47413606011',
            'lukita',
            'teste123',
            new DateTime(),
            new DateTime(),
        );

        $createClientSecond = $clientController->create($clientModelSecond);

        $return = [
            'createClientFirst' => $createClientFirst,
            'createClientSecond' => $createClientSecond
        ];

        return $return;
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
