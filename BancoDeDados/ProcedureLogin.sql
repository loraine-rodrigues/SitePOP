-- PROCEDURE LOGIN --

USE `motofrete`;

DROP procedure IF EXISTS `verificaLogin`;

DELIMITER $$

CREATE PROCEDURE `verificaLogin` (IN email varchar(45), IN senha varchar(32))
BEGIN
	SELECT id_login, nm_usuario, nm_login, id_tipo_login from tb_login where nm_login = email and id_senha = md5(senha) and ativo = true;
END$$

DELIMITER ;

DROP procedure IF EXISTS `mudarSenha`;

DELIMITER $$

CREATE PROCEDURE `mudarSenha` (IN email varchar(45), IN senhaAntiga varchar(32), IN senhaNova varchar(32))
BEGIN
    UPDATE tb_login SET id_senha = md5(senhaNova) WHERE nm_login = email AND id_senha = md5(senhaAntiga);
END$$

DELIMITER ;

DROP procedure IF EXISTS `gerarSenhaTemporaria`;

DELIMITER $$

CREATE PROCEDURE `gerarSenhaTemporaria` (IN usuario varchar(45), IN chaveTemp VARCHAR(45), IN expiracao DATETIME)
BEGIN
    INSERT INTO tb_senhatemporaria (email, chaveTemporaria, dataExpiracao)
    	VALUES (
				(SELECT nm_login FROM tb_login WHERE nm_login = usuario),
				chaveTemp,
    	        expiracao
	);
END$$

DELIMITER ;

DROP procedure IF EXISTS `resetarSenha`;

DELIMITER $$

CREATE PROCEDURE `resetarSenha` (IN usuario varchar(45), IN novaSenha VARCHAR(45))
BEGIN
	UPDATE tb_login SET id_senha = md5(novaSenha) WHERE nm_login = usuario;
END$$

DELIMITER ;

DROP procedure IF EXISTS `validarChave`;

DELIMITER $$

CREATE PROCEDURE `validarChave` (IN usuario varchar(45), IN chaveTemp VARCHAR(45))
BEGIN
	SELECT * FROM tb_senhatemporaria WHERE email = usuario AND chaveTemporaria = chaveTemp;
END$$

DELIMITER ;

DROP procedure IF EXISTS `cadastrarAdmin`;

DELIMITER $$

CREATE PROCEDURE `cadastrarAdmin` (IN nome VARCHAR(100), IN usuario varchar(45), IN senha varchar(32))
BEGIN
	INSERT INTO tb_login (nm_usuario, nm_login, id_senha, id_tipo_login, ativo)
	VALUES (nome, usuario, md5(senha), '3', true);
END$$

DELIMITER ;

DROP procedure IF EXISTS `buscarAdmin`;

DELIMITER $$

CREATE PROCEDURE `buscarAdmin` (IN usuario VARCHAR(45))
BEGIN
	SELECT id_login, nm_login, nm_usuario FROM tb_login WHERE nm_login = usuario;
END$$

DELIMITER ;


call buscarClientes();
select * from tb_login;

call adminBuscarCliente(7);
call buscarCliente(7);

select * from tb_login;

SELECT nm_login FROM tb_login WHERE id_login = 7