<?php

namespace ScheduleThing\Service\Client;

use DateTime;
use ScheduleThing\Constants\Http\StatusCodeConstants;
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
            return CommomValidate::formatResponse(
                false,
                StatusCodeConstants::INTERNAL_SERVER_ERROR,
                'Empty Fields',
                $isEmptyFields
            );
        }

        $isValidEmail = CommomValidate::isValidEmail($request_data['email']);

        if ($isValidEmail === false) {
            return CommomValidate::formatResponse(
                false,
                StatusCodeConstants::INTERNAL_SERVER_ERROR,
                'Invalid Email',
                $isValidEmail
            );
        }

        $isValidCpf = ClientValidate::isValidCpf($request_data['cpf']);

        if ($isValidCpf === false) {
            return CommomValidate::formatResponse(
                false,
                StatusCodeConstants::INTERNAL_SERVER_ERROR,
                'Invalid CPF',
                $isValidCpf
            );
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

        $create = $this->clientRepository->create($request_data);

        if ($create['success']) {
            return CommomValidate::formatResponse(
                true,
                StatusCodeConstants::OK,
                'Client inserted successfully',
                $request_data
            );
        }

        return CommomValidate::formatResponse(
            false,
            StatusCodeConstants::INTERNAL_SERVER_ERROR,
            $create['msg'],
            $request_data
        );
    }

    public function findAll(): array
    {
        $findAll = $this->clientRepository->findAll();

        if ($findAll['success']) {
            return CommomValidate::formatResponse(
                true,
                StatusCodeConstants::OK,
                'Data from all clients successfully selected',
                $findAll['data']
            );
        }

        return CommomValidate::formatResponse(
            false,
            StatusCodeConstants::INTERNAL_SERVER_ERROR,
            $findAll['msg'],
            $findAll['data']
        );
    }
}
