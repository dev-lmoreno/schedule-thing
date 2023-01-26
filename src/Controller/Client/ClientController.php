<?php

namespace ScheduleThing\Controller\Client;

use ScheduleThing\Service\Client\ClientService;

// repassar para o service os dados
class ClientController {
    public ClientService $clientService;

    public function __construct() {
        $this->clientService = new clientService();
    }

    public function findOne() {}

    public function findAll()
    {
        $findAll = $this->clientService->findAll();
        return $findAll;
    }

    public function create($request_data)
    {
        $create = $this->clientService->create($request_data);
        return $create;
    }

    public function delete() {}

    public function update() {}

}
