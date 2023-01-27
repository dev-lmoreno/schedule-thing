<?php

namespace ScheduleThing\Model\Client;

use DateTime;

class ClientModel {
    public int $id;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $cpf;
    public string $username;
    public string $password;
    public DateTime $dateCreated;
    public DateTime $dateUpdated;

    public function __construct(
        int $id,
        string $firstName,
        string $lastName,
        string $email,
        string $cpf,
        string $username,
        string $password,
        DateTime $dateCreated,
        DateTime $dateUpdated
    ) {
        $this->id            = $id;
        $this->firstName     = $firstName;
        $this->lastName      = $lastName;
        $this->email         = $email;
        $this->cpf           = $cpf;
        $this->username      = $username;
        $this->password      = $password;
        $this->dateCreated   = $dateCreated;
        $this->dateUpdated   = $dateUpdated;
    }
}
