CREATE DATABASE `projectecode`;

CREATE TABLE `pessoa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `dataNascimento` date NOT NULL,
  `cpf` varchar(45) NOT NULL,
  `rg` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sexo` tinyint(1) NOT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `telefone` varchar(45) NOT NULL,
  `celular` varchar(45) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `complemento` varchar(100) NOT NULL,
  `cep` varchar(45) NOT NULL,
  `numero` int(11) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `dataCriacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

INSERT INTO pessoa (nome,dataNascimento,cpf,rg,email,sexo,senha,telefone,celular,endereco,bairro,complemento,cep,numero,cidade,estado,status,dataCriacao) VALUES
	 ('Sofia Aguera','2012-12-18','1111111','1332232','sofiaguera@gmail.com',2,'$2y$10$OW9sS9/nTpJuHWaDZod3ZukZD9KZ2GStqWT8WU5WzgtozdUBBfrky','999999999','4444','Avenida Brasil','Zona VII','seila','',3333,'Umuarama','PR',1,'2021-07-19 23:27:12'),
	 ('Marcia Aguera','1978-06-22','11111','3333','marcia@gmail.com',1,'$2y$10$gbkn9.gSCiZnof7CnvtlQeFjRFdKLTc8E5v43KOUJd7xJpyY4FOdK','(44) 3639-2222','(44) 999999999','Rua Treze de Maio','Jardim Colibri','nao','87506340',1829,'Umuarama','PR',1,'2021-07-19 23:27:12');

INSERT INTO administrador (nome,email,senha) VALUES
	 ('Carolina Aguera','carolaguerabr@gmail.com','$2y$10$1/q4GhPaKg9rBuS5jg3gu.RlnDG285jeKhzJIgD1etr8yM83SNvNK'),
	 ('Marcia Aguera','marcia@gmail.com','$2y$10$diJvturw6i6LVtR5DDSPRONLJI5J0gAknhDCb9XRRGGAz4psPfpFW');