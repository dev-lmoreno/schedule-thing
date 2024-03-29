<?php

namespace ScheduleThing\Database;

use PDO;
use PDOException;
use Exception;
use ScheduleThing\Constants\Http\StatusCodeConstants;
use ScheduleThing\Exceptions\Database\DatabaseException;

class DbThing {
    public string $host;
    public string $database;
    public string $port;
    public string $user;
    public string $password;

    public function __construct() {
        $this->host     = $_ENV['MYSQL_HOST'];
        $this->database = $_ENV['MYSQL_DATABASE'];
        $this->port     = $_ENV['MYSQL_PORT'];
        $this->user     = $_ENV['MYSQL_USER'];
        $this->password = $_ENV['MYSQL_PASSWORD'];
    }

    public function connect(): PDO|bool
    {
        try {
            $conn = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->database", $this->user, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;
        } catch(PDOException $e) {
            throw new DatabaseException("Unable to connect to database", StatusCodeConstants::SERVICE_UNAVAILABLE, $e);
        }
    }

    public function fetchAll(string $query): array
    {
        try {
            $sql = $this->connect()->prepare($query);
            $sql->execute();

            $rows = $sql->fetchAll(PDO::FETCH_ASSOC);

            return [
                'success' => true,
                'data' => $rows
            ];
        } catch (Exception $e) {
            return [
                'log' => 'Error to fetchAll data',
                'success' => false,
                'msg' => $e->getMessage()
            ];
        }
    }

    public function fetchOne(string $query, int $id): array
    {
        try {
            $sql = $this->connect()->prepare($query);
            $sql->execute(['client_id' => $id]);

            $rows = $sql->fetch(PDO::FETCH_ASSOC);

            return [
                'success' => true,
                'data' => $rows
            ];
        } catch (Exception $e) {
            return [
                'log' => 'Error to fetchOne data',
                'success' => false,
                'msg' => $e->getMessage(),
                'data' => $id
            ];
        }
    }

    public function delete(string $query, int $id): array
    {
        try {
            $sql = $this->connect()->prepare($query);
            $sql->execute();

            return [
                'success' => true,
                'data' => $id
            ];
        } catch (Exception $e) {
            return [
                'log' => 'Error to delete client',
                'success' => false,
                'msg' => $e->getMessage(),
                'data' => $id
            ];
        }
    }

    public function update(string $query, int $id): array
    {
        try {
            $sql = $this->connect()->prepare($query);
            $sql->execute();

            return [
                'success' => true,
                'data' => $id
            ];
        } catch (Exception $e) {
            return [
                'log' => 'Error to update client',
                'success' => false,
                'msg' => $e->getMessage(),
                'data' => $id
            ];
        }
    }

    public function insert(string $query, array $values): array
    {
        try {
            $sql = $this->connect()->prepare($query);
            $sql->execute($values);

            return [
                'success' => true,
            ];
        } catch (Exception $e) {
            return [
                'log' => 'Error to insert data',
                'success' => false,
                'msg' => $e->getMessage(),
                'data' => $values
            ];
        }
    }

    /**
     * Id increment is done by 2 by 2
     */
    public function nextId(string $table, string $columnId): int
    {
        $query = sprintf('SELECT MAX(%s) FROM %s', $columnId, $table);
        $sql = $this->connect()->query($query);
        $row = $sql->fetch();

        return $row[0] + 2;
    }
}
