-- PROCEDURE LOGIN --

USE `motofrete`;

DROP procedure IF EXISTS `verificaLogin`;

DELIMITER $$

USE `motofrete`$$
CREATE PROCEDURE `verificaLogin` (IN email varchar(45), IN senha varchar(32))
BEGIN
	SELECT id_login, nm_usuario, id_tipo_login from tb_login where nm_usuario = email and id_senha = md5(senha);
END$$

DELIMITER ;
