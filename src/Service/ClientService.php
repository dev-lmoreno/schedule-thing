<?php

namespace ScheduleThing\Service;

use ScheduleThing\Validate\CommomValidate;
use ScheduleThing\Repository\ClientRepository;

// tratar a regra de negócio e enviar para o repository
class ClientService {
    public ClientRepository $clientRepository;

    public function __construct() {
        $this->clientRepository = new ClientRepository();
    }

    public function create($request_data): bool
    {
        $validatedFields = CommomValidate::isEmptyFields($request_data);

        if (!empty($validatedFields)) {
            return false;
        }

        $request_data = CommomValidate::convertObjectToArray($request_data);

        $create = $this->clientRepository->create($request_data);

        if ($create) {
            return true;
        }

        return false;
    }
}
