USE `motofrete`;
DROP procedure IF EXISTS `cadastrarCliente`;

DELIMITER $$
USE `motofrete`$$
CREATE PROCEDURE `cadastrarCliente` (IN nome varchar(255), IN nascimento date, IN cpf char(11), IN email varchar(100), IN celular varchar(13), IN senha varchar(45))
BEGIN
	INSERT INTO tb_cliente (nm_cliente, dt_nasc, id_cpf, nm_email, cd_celular)
		VALUES (nome, nascimento, cpf, email, celular);
	INSERT INTO tb_login (nm_usuario, id_senha, id_tipo_login)
		VALUES (email, md5(senha), '1');
END$$

DELIMITER ;
