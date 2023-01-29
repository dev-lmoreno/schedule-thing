<?php

namespace ScheduleThing\Service\Client;

use DateTime;
use ScheduleThing\Validate\CommomValidate;
use ScheduleThing\Validate\Client\ClientValidate;
use ScheduleThing\Repository\Client\ClientRepository;

class ClientService {
    public ClientRepository $clientRepository;

    public function __construct() {
        $this->clientRepository = new ClientRepository();
    }

    public function create($request_data): array
    {
        if (is_object($request_data)) {
            $request_data = CommomValidate::convertObjectToArray($request_data);
        }

        $isEmptyFields = CommomValidate::isEmptyFields($request_data);

        if (!empty($isEmptyFields)) {
            return [
                'success' => false,
                'msg' => 'Empty Fields',
                'log' => $isEmptyFields
            ];
        }

        $isValidEmail = CommomValidate::isValidEmail($request_data['email']);

        if ($isValidEmail === false) {
            return [
                'success' => false,
                'msg' => 'Invalid Email',
                'log' => $isValidEmail
            ];
        }

        $isValidCpf = ClientValidate::isValidCpf($request_data['cpf']);

        if ($isValidCpf === false) {
            return [
                'success' => false,
                'msg' => 'Invalid CPF',
                'log' => $isValidCpf
            ];
        }

        if (empty($request_data['dateCreated'])) {
            $request_data['dateCreated'] = new DateTime();
        }

        if (empty($request_data['dateUpdated'])) {
            $request_data['dateUpdated'] = new DateTime();
        }

        $request_data['cpf'] = ClientValidate::removeCharactersfromCpf($request_data['cpf']);
        $request_data['dateCreated'] = CommomValidate::getPropertyDate($request_data['dateCreated']);
        $request_data['dateUpdated'] = CommomValidate::getPropertyDate($request_data['dateUpdated']);

        return $this->clientRepository->create($request_data);
    }

    public function findAll()
    {
        $findAll = $this->clientRepository->findAll();
        return $findAll;
    }
}
