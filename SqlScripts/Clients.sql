CREATE TABLE schedulething.Clients (
	client_id BIGINT auto_increment NOT NULL,
	client_firstName varchar(255) NOT NULL,
	client_lastName varchar(255) NOT NULL,
	client_email varchar(255) NOT NULL,
	client_cpf varchar(255) NOT NULL,
	client_username varchar(255) NOT NULL,
	client_password varchar(255) NOT NULL,
	date_created DATETIME NULL,
	date_updated DATETIME NULL,
	date_deleted DATETIME NULL,
	CONSTRAINT id_cpf_PK PRIMARY KEY (client_id,client_cpf),
	CONSTRAINT username_UN UNIQUE KEY (client_username),
	CONSTRAINT email_UN UNIQUE KEY (client_email)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_0900_ai_ci;