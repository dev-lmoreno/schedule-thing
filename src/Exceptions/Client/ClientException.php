<?php

namespace ScheduleThing\Exceptions\Client;

use Exception;

class ClientException extends Exception{
    public function __construct(string $message = "", int $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
