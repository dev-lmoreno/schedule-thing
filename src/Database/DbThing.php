<?php

namespace ScheduleThing\Database;

use PDO;
use PDOException;

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

    public function connection(): bool
    {
        try {
            $conn = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->database", $this->user, $this->password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return true;
        } catch(PDOException $e) {
            print_r([
                'log' => 'ERROR',
                'message' => $e->getMessage()
            ]);

            return false;
        }
    }
}
