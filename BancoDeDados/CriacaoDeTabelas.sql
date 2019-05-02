Create database if not exists motofrete;

use motofrete;

CREATE TABLE IF NOT EXISTS `motofrete`.`tb_login` (
    `id_login` INT NOT NULL AUTO_INCREMENT,
    `nm_usuario` VARCHAR(45) NOT NULL UNIQUE,
    `id_senha` VARCHAR(32) NOT NULL,
	`id_tipo_login` ENUM ('1', '2', '3') NOT NULL,
    PRIMARY KEY (`id_login`)
)  ENGINE=INNODB DEFAULT CHARACTER SET=UTF8;

CREATE TABLE IF NOT EXISTS `tb_cliente` (
    `id_cliente` INT(11) NOT NULL AUTO_INCREMENT,
    `nm_cliente` VARCHAR(255) NOT NULL,
    `dt_nascimento` DATE NOT NULL,
    `id_cpf` CHAR(11) NOT NULL UNIQUE,
    `nm_email` VARCHAR(100) NOT NULL UNIQUE, 
    `cd_celular` VARCHAR (11) NOT NULL UNIQUE,
    PRIMARY KEY (`id_cliente`) 
)  ENGINE=INNODB DEFAULT CHARSET=UTF8;

CREATE TABLE IF NOT EXISTS `tb_motofretista` (
    `id_motofretista` INT(11) NOT NULL AUTO_INCREMENT,
    `nm_motofretista` VARCHAR(100) NOT NULL,
    `id_cpf` CHAR(11) NOT NULL UNIQUE,
    `id_cnpj` CHAR(14) NOT NULL UNIQUE,
    `id_celular` CHAR(11) NOT NULL UNIQUE, 
    `id_telefone` CHAR(11) NOT NULL UNIQUE,
	`ic_genero` ENUM ('Masculino','Feminino','Outros'),
    `id_cnh` CHAR(11) NOT NULL UNIQUE,
    `nm_email` VARCHAR(100) NOT NULL UNIQUE,
    `nm_regiao` SET('Bertioga', 'Cubatão', 'Guarujá', 'Itanhaém', 'Mongaguá', 'Peruíbe', 'Praia Grande', 'Santos', 'São Vicente') DEFAULT 'Praia Grande',
    `dt_nascimento` DATE NOT NULL,
    `ic_mei` ENUM ('Sim', 'Não') DEFAULT NULL,
	`id_placa` CHAR(7) NOT NULL UNIQUE,
    `id_renavam` CHAR(11) NOT NULL UNIQUE,
    `nm_modelo` VARCHAR(45) NOT NULL,
    `nm_cor` VARCHAR(45) NOT NULL,
    `nm_marca` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`id_motofretista`)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8;


  



 