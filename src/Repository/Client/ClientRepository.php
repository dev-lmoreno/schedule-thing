<?php

namespace ScheduleThing\Repository\Client;

// queries com o banco, aqui já recebemos o valor tratado, com todas validações já feitas
class ClientRepository {
    public function create(array $request_data): bool
    {
        $firstName = $request_data['firstName'];
        $lastName =  $request_data['lastName'];
        $email =     $request_data['email'];
        $cpf =       $request_data['cpf'];
        $username =  $request_data['username'];
        $password =  $request_data['password'];

        $insert = "
            INSERT INTO Clients (firstName, lastName, email, cpf , username, password)
            VALUES (`$firstName`, `$lastName`, `$email`, `$cpf` , `$username`, `$password`)
        ";

        // simulando insert no banco com sucesso
        if ($insert) {
            return true;
        }

        return false;
    }
}
