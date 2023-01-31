<?php

namespace ScheduleThing\Repository\Client;

use ScheduleThing\Database\DbThing;
use ScheduleThing\Constants\Clients\ClientsConstants;
use ScheduleThing\Constants\Http\StatusCodeConstants;
use ScheduleThing\Validate\CommomValidate;

class ClientRepository {
    public DbThing $db;

    public function __construct() {
        $this->db = new DbThing();
    }

    public function create(array $request_data): array
    {
        $values = [
            'id'          => $request_data['id']  ?: $this->db->nextId(ClientsConstants::TABLE_NAME, ClientsConstants::COLUMN_ID),
            'firstName'   => $request_data['firstName'],
            'lastName'    => $request_data['lastName'],
            'email'       => $request_data['email'],
            'cpf'         => $request_data['cpf'],
            'username'    => $request_data['username'],
            'password'    => $request_data['password'],
            'dateCreated' => $request_data['dateCreated'],
            'dateUpdated' => $request_data['dateUpdated'],
        ];

        $query = sprintf("
            INSERT INTO %s
                (%s, client_firstName, client_lastName, client_email, client_cpf , client_username, client_password, date_created, date_updated)
            VALUES
                (:id, :firstName, :lastName, :email, :cpf , :username, md5(:password), :dateCreated, :dateUpdated)
        ", ClientsConstants::TABLE_NAME, ClientsConstants::COLUMN_ID);

        $create = $this->db->insert($query, $values);

        if ($create['success']) {
            return CommomValidate::formatResponse(
                true,
                StatusCodeConstants::OK,
                'Client inserted successfully',
                $values
            );
        }

        return CommomValidate::formatResponse(
            false,
            StatusCodeConstants::INTERNAL_SERVER_ERROR,
            $create['msg'],
            $values
        );
    }

    public function findAll(): array
    {
        $query = sprintf("SELECT * FROM %s", ClientsConstants::TABLE_NAME);
        return $this->db->fetchAll($query);
    }

    public function findOne(string $field, int|string $value): array
    {
        $where = '';
        switch (gettype($value)) {
            case 'integer':
                $where = "{$field} = :{$field}";
                break;
            case 'string':
                $where = "{$field} LIKE :{$field}";
                $value = "%$value%";
                break;
            default:
                $where = '';
                break;
        }

        $query = sprintf("
            SELECT
                %s
            FROM
                %s
            WHERE
                %s
            LIMIT 1
            ", $field, ClientsConstants::TABLE_NAME, $where);

        return $this->db->fetchOne($query, $field, $value);
    }
}
