<?php

use ScheduleThing\Controller\ClientController;
use ScheduleThing\Model\ClientModel;

class ClientTest {
    public function createClientTest()
    {
        $clientModel = new ClientModel(
            'Lucas',
            'Moreno',
            'devlmoreno007@gmail.com',
            '39860026858',
            'lmoreno',
            'teste123'
        );

        $clientController = new ClientController();
        $clientController->create($clientModel);

        if ($clientController) {
            return true;
        }

        return false;
    }
}
