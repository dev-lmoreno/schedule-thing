# Sistema de agendamento
### Inicialmente o projeto irá funcionar para agendar horários em cabelereiros

#### [Link do projeto no Trello](https://trello.com/b/GX7was5G/schedule-thing)
---
#### Índice
1. [Features atuais](#features-atuais)
2. [Features futuras](#features-novas)
3. [Stack tecnológico (inicial)](#stack-tecnologico-inicial)
4. [Stack tecnológico (futuro)](#stack-tecnologico-futuro)
5. [Regra de negócio](#regra-de-negocio)
6. [Clonando o repositório](#clonando-repositorio)
7. [Configurando o projeto](#configurando-projeto)
8. [Rotas disponíveis](#rotas)
---
### <a name="features-atuais">Features atuais</a>
* Cadastro de cliente
* Cadastro de empresa
* Horário de atendimento
* Agendamento
* Notificações

### <a name="features-novas">Features futuras</a>
* Chat
* Anúncios
* Publicações em redes sociais (centralizar na plataforma)

### <a name="stack-tecnologico-inicial">Stack tecnológico (inicial)</a>
* **PHP (API)**
* **MySQL (DB)**
* **VueJs (Front)**
* **Redis (Cache)**

### <a name="stack-tecnologico-futuro">Stack tecnológico (futuro)</a>
* NodeJs (futuramente)
* MongoDb (futuramente)
* React (futuramente)

**Observação**
A ideia inicial é desenvolver o projeto com **PHP, MySQL, VueJs e Redis** para fins de estudo. Com o projeto desenvolvido com essa stack, o mesmo será refeito com outra stack também para estudo.
No decorrer do desenvolvimento será listados as bibliotecas utilizas e para que estão sendo utilizadas.


### <a name="regra-de-negocio">Regra de negócio</a>
1. **Cadastro**
    * **Cliente**: deve informar o nome, sobrenome, email, cpf e endereço (opcional) e avatar (opcional) (informações pessoais) e para realizar o login na plataforma também deverá ser cadastrado um nome de usuário e senha.
    * **Empresa**: deve informar o nome fantasia, cnpj, email, log (opcional) e endereço (informações da empresa) e para realizar o login para parte adminstrativa da plataforma também deverá ser cadastrado um nome de usuário e senha.

2. **Horário de atendimento** 
    * Após a empresa realizar o login ela deverá cadastrar um horário de funcionamento para que o cliente faça seu agendamento.
    * Será necessário escolher os dias da semana e horário em que a empresa irá atender, podendo ser de segunda a domingo e horário de funcionamento podendo escolher qualquer horário do dia/noite (24h).
    * Nessa funcionalidade também terá a opção de adicionar dias não trabalhados, por exemplo em feriados a empresa poderá marcar que o dia não será trabalhado.
    * Também será possível editar esse horário de atendimento quando necessário.

3. **Agendamento**
    * Após o cliente realizar o login na plataforma ele fará uma busca pela empresa em que deseja fazero agendamento.
    * Em seguida será selecionada a empresa será exibido os horários de atendimentos e um calendário exibindo os dias e horários livres para atendimento (de 1h em 1h como a agenda do google por exemplo).
    * Para realizar o agendamento o cliente deve selecionar o dia no calendário e digitar o horário que deseja fazer o agendamento.
    * Assim que o agendamento for realizado a empresa irá receber uma notificação onde será possível aceitar ou recusar.
    * Caso a empresa aceite ou recuse o agendamento o cliente será notificado.
    * Também existirá a opção do cliente cancelar o agendamento, assim que cancelado a empresa será notificada e o dia/horário irão ficar liberados novamente para escolha no calendário.

4. **Notificações**
    * Serão enviadas notificações tanto para empresa quanto para o cliente nas ações de agendamento, cancelamento do agendamento e também para recados que a empresa queira passar para seus consumidores (promoções, mudança de horário de atendimento, etc)

---
### <a name="clonando-repositorio">Clonando o repositório</a>
* Ao clonar o repositório execute o comando `composer install` para instalar as dependencias do projeto.

---
### <a name="configurando-projeto">Configurando o projeto</a>
* to-do: disponibilizar script de criação de tabela e adicionar os valores nas .envs
---
### <a name="rotas">Rotas disponíveis</a>
* Exemplo da chamada para API: `{url}/{prefix}/{resource}`
* Clientes (`/list, /create`)
    * Listagem de todos clientes
        *   `http://127.0.0.1:8001/api/clients/list`
        * Retorno da listagem
            ```
            {
                "success": true,
                "statusCode": 200,
                "msg": "Data from all clients successfully selected",
                "data": [
                    {
                        "client_id": 2,
                        "client_firstName": "Bob",
                        "client_lastName": "Johnson",
                        "client_email": "bobjohnson@example.com",
                        "client_cpf": "98562990043",
                        "client_username": "bobjohnson",
                        "client_password": "482c811da5d5b4bc6d497ffa98491e38",
                        "date_created": "2023-01-30 14:44:21",
                        "date_updated": "2023-01-30 14:44:21"
                    },
                    {
                        "client_id": 4,
                        "client_firstName": "Jane",
                        "client_lastName": "Doe",
                        "client_email": "janedoe@example.com",
                        "client_cpf": "03909997090",
                        "client_username": "janedoe",
                        "client_password": "4cab2a2db6a3c31b01d804def28276e6",
                        "date_created": "2023-01-30 17:29:00",
                        "date_updated": "2023-01-30 17:29:00"
                    },
                    {
                        "client_id": 6,
                        "client_firstName": "Bob",
                        "client_lastName": "Smith",
                        "client_email": "bobsmith@example.com",
                        "client_cpf": "34927331075",
                        "client_username": "bobsmith",
                        "client_password": "34819d7beeabb9260a5c854bc85b3e44",
                        "date_created": "2023-01-30 17:29:15",
                        "date_updated": "2023-01-30 17:29:15"
                    },
                    {
                        "client_id": 8,
                        "client_firstName": "Sarah",
                        "client_lastName": "Williams",
                        "client_email": "sarahwilliams@example.com",
                        "client_cpf": "16301129091",
                        "client_username": "sarahwilliams",
                        "client_password": "e9e0ffdc4fc69fb2047203f45a36cb59",
                        "date_created": "2023-01-30 17:29:30",
                        "date_updated": "2023-01-30 17:29:30"
                    },
                    {
                        "client_id": 10,
                        "client_firstName": "Emma",
                        "client_lastName": "Jones",
                        "client_email": "emmajones@example.com",
                        "client_cpf": "07701956018",
                        "client_username": "emmajones",
                        "client_password": "6302f9dd9ec451f36159d9378774e8fe",
                        "date_created": "2023-01-30 17:29:45",
                        "date_updated": "2023-01-30 17:29:45"
                    },
                    {
                        "client_id": 12,
                        "client_firstName": "Michael",
                        "client_lastName": "Davis",
                        "client_email": "michaeldavis@example.com",
                        "client_cpf": "17578307070",
                        "client_username": "michaeldavis",
                        "client_password": "ad6b7f82c77fca02255af63175b58b57",
                        "date_created": "2023-01-30 17:30:02",
                        "date_updated": "2023-01-30 17:30:02"
                    },
                    "totalRows": 7
                ]
            }
            ```
    * Cadastro de clientes
        *   `http://127.0.0.1:8001/api/clients/create`
            * É preciso passar o seguinte body em formato `application/json`
            * exemplo de body
                ```
                {
                    "firstName": "Tony",
                    "lastName": "Stark",
                    "email": "thebestavenger@avengers.com",
                    "cpf": "61131919076",
                    "username": "ironman",
                    "password": "thebest"
                }
                ```

        * Retorno do cadastro
        ```
        {
            "success": true,
            "statusCode": 200,
            "msg": "Client inserted successfully",
            "data": {
                "firstName": "Tony",
                "lastName": "Stark",
                "email": "thebestavenger@avengers.com",
                "cpf": "61131919076",
                "username": "ironman",
                "password": "thebest",
                "dateCreated": "2023-01-30 18:18:07",
                "dateUpdated": "2023-01-30 18:18:07"
            }
        }
        ```
}

---
© 2023 Moscão Company




