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

    public function create(array|object $request_data): array
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

        return $create;
    }

    public function findAll(): array
    {
        $findAll = $this->clientRepository->findAll();

        $totalRows = count($findAll['data']);
        $findAll['data']['totalRows'] = $totalRows;

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

    public function findOne(int $id): array
    {
        $findOne = $this->clientRepository->findOne($id);

        if ($findOne['success']) {
            if ($findOne['data']) {
                return CommomValidate::formatResponse(
                    true,
                    StatusCodeConstants::OK,
                    'Data from one client successfully selected',
                    $findOne['data']
                );
            }

            return CommomValidate::formatResponse(
                true,
                StatusCodeConstants::OK,
                'Client not found in database',
                $findOne['data']
            );
        }

        return CommomValidate::formatResponse(
            false,
            StatusCodeConstants::INTERNAL_SERVER_ERROR,
            $findOne['msg'],
            $findOne['data']
        );
    }

    public function delete(int $id): array
    {
        $findOne = $this->findOne($id);

        if ($findOne['success'] && $findOne['data']) {
            $dateDeleted = CommomValidate::getPropertyDate(new DateTime());

            $delete = $this->clientRepository->delete($id, $dateDeleted);

            if ($delete['success']) {
                return CommomValidate::formatResponse(
                    true,
                    StatusCodeConstants::OK,
                    'Client successfully deleted',
                    $delete['data']
                );
            }

            return CommomValidate::formatResponse(
                false,
                StatusCodeConstants::INTERNAL_SERVER_ERROR,
                $delete['msg'],
                $delete['data']
            );
        }

        return CommomValidate::formatResponse(
            true,
            StatusCodeConstants::OK,
            'Client not found in database to delete',
            $id
        );
    }

    public function update(int $id, array|object $request_data): array
    {
        $findOne = $this->findOne($id);

        if ($findOne['success'] && $findOne['data']) {
            if (is_object($request_data)) {
                $request_data = CommomValidate::convertObjectToArray($request_data);
            }

            $acceptedColumnsToUpdate = [
                'firstName', 'lastName', 'email', 'cpf', 'password'
            ];

            foreach ($request_data as $column => $value) {
                if (empty($value)) {
                    unset($request_data[$column]);
                    continue;
                }

                if (!in_array($column, $acceptedColumnsToUpdate)) {
                    unset($request_data[$column]);
                    continue;
                }

                if ($column === 'email') {
                    $isValidEmail = CommomValidate::isValidEmail($request_data['email']);

                    if ($isValidEmail === false) {
                        return CommomValidate::formatResponse(
                            false,
                            StatusCodeConstants::INTERNAL_SERVER_ERROR,
                            'Invalid Email to update',
                            $isValidEmail
                        );
                    }
                }

                if ($column === 'cpf') {
                    $isValidCpf = ClientValidate::isValidCpf($request_data['cpf']);

                    if ($isValidCpf === false) {
                        return CommomValidate::formatResponse(
                            false,
                            StatusCodeConstants::INTERNAL_SERVER_ERROR,
                            'Invalid CPF to update',
                            $isValidCpf
                        );
                    }
                }

                if ($column === 'password') {
                    $request_data['password'] = md5($request_data['password']);
                }

                $request_data['client_'.$column] = $request_data[$column];
                unset($request_data[$column]);
            }

            $request_data['date_updated'] = new DateTime();
            $request_data['date_updated'] = CommomValidate::getPropertyDate($request_data['date_updated']);

            $update = $this->clientRepository->update($id, $request_data);

            if ($update['success'] && $update['data']) {
                return CommomValidate::formatResponse(
                    true,
                    StatusCodeConstants::OK,
                    'Client updated successfully',
                    $update['data']
                );
            }

            return CommomValidate::formatResponse(
                true,
                StatusCodeConstants::OK,
                $update['msg'],
                $update['data']
            );
        }

        return CommomValidate::formatResponse(
            false,
            StatusCodeConstants::INTERNAL_SERVER_ERROR,
            'Client not found in database to update',
            $id
        );
    }
}
