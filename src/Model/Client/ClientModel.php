<?php

namespace ScheduleThing\Model\Client;

// controle dos campos do banco de dados por entidade
class ClientModel {
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $cpf;
    public string $username;
    public string $password;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $cpf,
        string $username,
        string $password
    ) {
        $this->firstName = $firstName;
        $this->lastName  = $lastName;
        $this->email     = $email;
        $this->cpf       = $cpf;
        $this->username  = $username;
        $this->password  = $password;
    }
}
