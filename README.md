# Sistema de agendamento
### Inicialmente o projeto irá funcionar para agendar horários em cabelereiros
---
### Features atuais
* Cadastro de cliente
* Cadastro de empresa
* Horário de atendimento
* Agendamento
* Notificações

### Features futuras
* Chat
* Anúncios
* Publicações em redes sociais (centralizar na plataforma)

### Stack tecnológico (inicial)
* **PHP (API)**
* **MySQL (DB)**
* **VueJs (Front)**
* **Redis (Cache)**

### Stack tecnológico (futuro)
* NodeJs (futuramente)
* MongoDb (futuramente)
* React (futuramente)

**Observação**
A ideia inicial é desenvolver o projeto com **PHP, MySQL, VueJs e Redis** para fins de estudo. Com o projeto desenvolvido com essa stack, o mesmo será refeito com outra stack também para estudo.
No decorrer do desenvolvimento será listados as bibliotecas utilizas e para que estão sendo utilizadas.


### Regra de negócio
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
© 2023 Moscão Company




