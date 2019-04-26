Create database if not exists motofrete;

use motofrete;


CREATE TABLE IF NOT EXISTS `tb_cliente` (
    `id_cliente` INT(11) NOT NULL AUTO_INCREMENT,
    `nm_cliente` VARCHAR(255) NOT NULL,
    `dt_nasc` DATE NOT NULL,
    `id_cpf` CHAR(11) NOT NULL,
    `nm_email` VARCHAR(100) NOT NULL,
     `id_senha` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id_cliente`)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8;



CREATE TABLE IF NOT EXISTS `tb_fretista` (
    `id_fretista` INT(11) NOT NULL AUTO_INCREMENT,
    `nm_fretista` VARCHAR(100) NOT NULL,
    `id_cpf` CHAR(11) DEFAULT NULL,
    `id_cnpj` CHAR(14) DEFAULT NULL,
    `id_cel` CHAR(11) DEFAULT NULL,
    `id_tel` CHAR(11) DEFAULT NULL,
    `id_cnh` CHAR(11) DEFAULT NULL,
    `nm_email` VARCHAR(100) DEFAULT NULL,
    ic_genero set ('Masculino','Feminino','Outros'),
    `nm_regiao` SET('Bertioga', 'Cubatão', 'Guarujá', 'Itanhaém', 'Mongaguá', 'Peruíbe', 'Praia Grande', 'Santos', 'São Vicente') DEFAULT 'Praia Grande',
    `dt_nasc` DATE DEFAULT NULL,
    `ic_habilitado` TINYINT(4) DEFAULT NULL,
    `ic_mei` TINYINT(4) DEFAULT NULL,
    `id_condumoto` CHAR(8) DEFAULT NULL,
    `id_senha` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id_fretista`)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8;


CREATE TABLE IF NOT EXISTS `tb_veiculo` (
    `id_veiculo` INT(11) NOT NULL AUTO_INCREMENT,
    `id_placa` CHAR(7) NOT NULL,
    `id_renavam` CHAR(11) DEFAULT NULL,
    `nm_modelo` VARCHAR(45) DEFAULT NULL,
    `nm_cor` VARCHAR(45) DEFAULT NULL,
    `nm_marca` VARCHAR(45) DEFAULT NULL,
    PRIMARY KEY (`id_veiculo`)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8;

ALTER TABLE `motofrete`.`tb_veiculo` 
ADD COLUMN `id_fretista` INT NULL AFTER `nm_marca`,
ADD UNIQUE INDEX `id_fretista_UNIQUE` (`id_fretista` ASC);

alter table motofrete.tb_veiculo
add CONSTRAINT `fk_veiculo_fretista`
 FOREIGN KEY (`id_fretista`)
 REFERENCES `tb_fretista` (`id_fretista`)
 ON DELETE NO ACTION
 ON UPDATE NO ACTION;