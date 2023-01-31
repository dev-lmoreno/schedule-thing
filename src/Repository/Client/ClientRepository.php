<?php

namespace ScheduleThing\Repository\Client;

use DateTime;
use ScheduleThing\Database\DbThing;
use ScheduleThing\Constants\Clients\ClientsConstants;
use ScheduleThing\Constants\Http\StatusCodeConstants;
use ScheduleThing\Validate\CommomValidate;

class ClientRepository {
    const WHERE_CLIENT_ID   = "client_id = :client_id";
    const WHERE_NOT_DELETED = "date_deleted IS NULL";

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
        $query = sprintf("SELECT * FROM %s WHERE %s",
            ClientsConstants::TABLE_NAME, self::WHERE_NOT_DELETED);
        return $this->db->fetchAll($query);
    }

    public function findOne(int $id): array
    {
        $query = sprintf("
            SELECT
                *
            FROM
                %s
            WHERE
                %s
                AND %s
            LIMIT 1
            ", ClientsConstants::TABLE_NAME, self::WHERE_CLIENT_ID, self::WHERE_NOT_DELETED);

        return $this->db->fetchOne($query, $id);
    }

    public function delete(int $id, string $dateDeleted): array
    {
        $query = sprintf("UPDATE %s SET date_deleted = '%s' WHERE client_id = %s LIMIT 1",
            ClientsConstants::TABLE_NAME, $dateDeleted, $id
        );

        return $this->db->delete($query, $id);
    }
}
