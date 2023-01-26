<?php

namespace ScheduleThing\Test\DatabaseTest;

use ScheduleThing\Database\DbThing;

class ConnectionTest {
    public function connect()
    {
        $db = new DbThing();
        $connection = $db->connect();

        if ($connection) {
            return [
                'success' => true,
            ];
        }

        return [
            'success' => false,
        ];
        
    }
}