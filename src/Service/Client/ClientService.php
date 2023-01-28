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

    public function create($request_data): array
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

        if ($request_data['dateCreated']) {
            $request_data['dateCreated'] = CommomValidate::getPropertyDate($request_data['dateCreated']);
        }

        if ($request_data['dateUpdated']) {
            $request_data['dateUpdated'] = CommomValidate::getPropertyDate($request_data['dateUpdated']);
        }

        return $this->clientRepository->create($request_data);
    }

    public function findAll()
    {
        $findAll = $this->clientRepository->findAll();
        return $findAll;
    }
}
