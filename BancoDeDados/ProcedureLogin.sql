-- PROCEDURE LOGIN --

USE `motofrete`;

DROP procedure IF EXISTS `verificaLogin`;

DELIMITER $$

CREATE PROCEDURE `verificaLogin` (IN email varchar(45), IN senha varchar(32))
BEGIN
	SELECT id_login, nm_usuario, nm_login, id_tipo_login from tb_login where nm_login = email and id_senha = md5(senha);
END$$

DELIMITER ;

DROP procedure IF EXISTS `cadastrarAdmin`;

DELIMITER $$

CREATE PROCEDURE `cadastrarAdmin` (IN nome VARCHAR(100), IN usuario varchar(45), IN senha varchar(32))
BEGIN
	INSERT INTO tb_login (nm_usuario, nm_login, id_senha, id_tipo_login)
	VALUES (nome, usuario, md5(senha), '3');
END$$

DELIMITER ;