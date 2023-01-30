<?php

namespace ScheduleThing\Repository\Client;

use ScheduleThing\Database\DbThing;
use ScheduleThing\Constants\Clients\ClientsConstants;

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

        return $this->db->insert($query, $values);
    }

    public function findAll()
    {
        $query = sprintf("SELECT * FROM %s", ClientsConstants::TABLE_NAME);
        return $this->db->fetchAll($query);
    }
}
