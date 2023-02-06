<?php

namespace ScheduleThing\Test\DatabaseTest;

use ScheduleThing\Constants\Http\StatusCodeConstants;
use ScheduleThing\Database\DbThing;
use ScheduleThing\Exceptions\Database\DatabaseException;
use ScheduleThing\Validate\CommomValidate;

class ConnectionTest {
    public function connect()
    {
        try {
            $db = (new DbThing())->connect();

            return CommomValidate::formatResponse(
                true,
                StatusCodeConstants::OK,
                'Database connection successfully',
                $db
            );
        } catch (DatabaseException $e) {
            return CommomValidate::formatResponse(
                false,
                $e->getCode(),
                $e->getMessage(),
                false
            );
        }
    }
}
