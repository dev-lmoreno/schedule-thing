<?php

namespace ScheduleThing\Controller\Client;

use ScheduleThing\Service\Client\ClientService;

class ClientController {
    public ClientService $clientService;

    public function __construct() {
        $this->clientService = new clientService();
    }

    public function findOne(int $id): array
    {
        $findOne = $this->clientService->findOne($id);
        return $findOne;
    }

    public function findAll(): array
    {
        $findAll = $this->clientService->findAll();
        return $findAll;
    }

    public function create(array|object $request_data): array
    {
        $create = $this->clientService->create($request_data);
        return $create;
    }

    public function delete(int $id): array
    {
        $delete = $this->clientService->delete($id);
        return $delete;
    }

    public function update(int $id, array|object $request_data): array
    {
        $update = $this->clientService->update($id, $request_data);
        return $update;
    }

}
