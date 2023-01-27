<?php

namespace ScheduleThing\Service\Client;

use ScheduleThing\Validate\CommomValidate;
use ScheduleThing\Validate\Client\ClientValidate;
use ScheduleThing\Repository\Client\ClientRepository;

// tratar a regra de negócio e enviar para o repository
class ClientService {
    public ClientRepository $clientRepository;

    public function __construct() {
        $this->clientRepository = new ClientRepository();
    }

    public function create($request_data): bool
    {
        $request_data = CommomValidate::convertObjectToArray($request_data);

        $isEmptyFields = CommomValidate::isEmptyFields($request_data);

        if (!empty($isEmptyFields)) {
            return false;
        }

        $isValidEmail = CommomValidate::isValidEmail($request_data['email']);

        if ($isValidEmail === false) {
            return false;
        }

        $isValidCpf = ClientValidate::isValidCpf($request_data['cpf']);

        if ($isValidCpf === false) {
            return false;
        }

        // to-do: validar data

        $create = $this->clientRepository->create($request_data);

        if ($create) {
            return true;
        }

        return false;
    }

    public function findAll()
    {
        $findAll = $this->clientRepository->findAll();
        return $findAll;
    }
}
