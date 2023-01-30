<?php

namespace ScheduleThing\Database;

use PDO;
use PDOException;
use Exception;

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
            print_r([
                'log' => 'ERROR',
                'message' => $e->getMessage()
            ]);

            return false;
        }
    }

    public function fetchAll(string $query): array
    {
        $sql = $this->connect()->query($query);
        $rows = $sql->fetchAll();

        return $rows;
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
                'msg' => $e->getMessage()
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
