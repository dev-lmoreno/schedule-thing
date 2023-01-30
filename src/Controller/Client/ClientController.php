<?php

namespace ScheduleThing\Controller\Client;

use ScheduleThing\Service\Client\ClientService;

class ClientController {
    public ClientService $clientService;

    public function __construct() {
        $this->clientService = new clientService();
    }

    public function findOne() {}

    public function findAll(): array
    {
        $findAll = $this->clientService->findAll();
        return $findAll;
    }

    public function create(array $request_data): array
    {
        $create = $this->clientService->create($request_data);
        return $create;
    }

    public function delete() {}

    public function update() {}

}
