<?php

namespace ScheduleThing\Repository;

// queries com o banco, aqui já recebemos o valor tratado, com todas validações já feitas
class ClientRepository {
    // to-do: adicionar validação de array $request_data
    public function create($request_data): bool
    {
        // por hora transformando o objeto em array, remover esse trecho futuramente
        // aqui deve receber $request_data como array.
        $request_data = json_decode(json_encode($request_data), true);

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