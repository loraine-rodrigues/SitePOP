-- PROCEDURES DE CLIENTE

USE `motofrete`;


-- INSERIR CLIENTE 
DROP procedure IF EXISTS `cadastrarCliente`;

DELIMITER $$
CREATE PROCEDURE `cadastrarCliente` (IN nome varchar(255), IN nascimento date, IN cpf char(11), IN email varchar(100), IN celular varchar(11), IN senha varchar(45))
BEGIN
	INSERT INTO tb_login (nm_usuario, nm_login, id_senha, id_tipo_login, ativo)
		VALUES (nome, email, md5(senha), '1', true);
	INSERT INTO tb_cliente (nm_cliente, dt_nascimento, id_cpf, nm_email, cd_celular, ativo)
		VALUES (nome, nascimento, cpf, email, celular, true);

END$$

DELIMITER ;


-- EDITAR MOTOFRETISTA
drop procedure if exists `editarCliente`;

DELIMITER $$
create procedure editarCliente (in id int(11), IN nome varchar(255), IN nascimento date, IN cpf char(11), IN email varchar(100), IN celular varchar(11))

begin
	update tb_cliente set nm_cliente = nome, dt_nascimento = nascimento, id_cpf = cpf, nm_email = email, cd_celular = celular where nm_email = (SELECT nm_login FROM tb_login WHERE id_login = id);
	update tb_login set nm_login = email, nm_usuario = nome WHERE id_login = id;
end $$
DELIMITER ;

-- EDITAR MOTOFRETISTA
drop procedure if exists `adminEditarCliente`;

DELIMITER $$
create procedure adminEditarCliente (in id int(11), IN nome varchar(255), IN nascimento date, IN cpf char(11), IN email varchar(100), IN celular varchar(11))

begin
	update tb_login set nm_login = email, nm_usuario = nome WHERE nm_login = (SELECT nm_email from tb_cliente WHERE id_cliente = id);
	update tb_cliente set nm_cliente = nome, dt_nascimento = nascimento, id_cpf = cpf, nm_email = email, cd_celular = celular where id_cliente = id;
end $$
DELIMITER ;


-- BUSCAR CLIENTE
drop procedure if exists `buscarCliente`;

DELIMITER $$
create procedure buscarCliente (in id int(11))

begin
	select * from tb_cliente where nm_email = (SELECT nm_login FROM tb_login WHERE id_login = id);
end $$
DELIMITER ;

-- BUSCAR CLIENTE
drop procedure if exists `adminBuscarCliente`;

DELIMITER $$
create procedure adminBuscarCliente (in id int(11))

begin
	select * from tb_cliente where id_cliente = id;
end $$
DELIMITER ;

-- BUSCAR TODOS CLIENTES
drop procedure if exists `buscarClientes`;

DELIMITER $$
create procedure buscarClientes ()

begin
	select * from tb_cliente;
end $$
DELIMITER ;

-- DELETAR CLIENTE
drop procedure if exists desativarCliente;

DELIMITER $$
create procedure desativarCliente(in id int)

begin
	UPDATE tb_login SET ativo = false where nm_login = (SELECT nm_email from tb_cliente WHERE id_cliente = id);
  UPDATE tb_cliente SET ativo = false where id_cliente = id;
end $$
DELIMITER ;