<?php

namespace ScheduleThing\Test\DatabaseTest;

use ScheduleThing\Database\DbThing;

class ConnectionTest {
    public function connection()
    {
        $db = new DbThing();
        $connection = $db->connection();

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