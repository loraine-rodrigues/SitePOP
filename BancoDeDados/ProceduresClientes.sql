-- PROCEDURES DE CLIENTE

USE `motofrete`;


-- INSERIR CLIENTE 
DROP procedure IF EXISTS `cadastrarCliente`;

DELIMITER $$
CREATE PROCEDURE `cadastrarCliente` (IN nome varchar(255), IN nascimento date, IN cpf char(11), IN email varchar(100), IN celular varchar(11), IN senha varchar(45))
BEGIN
	INSERT INTO tb_login (nm_usuario, nm_login, id_senha, id_tipo_login)
		VALUES (nome, email, md5(senha), '1');
	INSERT INTO tb_cliente (nm_cliente, dt_nascimento, id_cpf, nm_email, cd_celular)
		VALUES (nome, nascimento, cpf, email, celular);

END$$

DELIMITER ;


-- EDITAR MOTOFRETISTA
drop procedure if exists `editarCliente`;

DELIMITER $$
create procedure editarCliente (in id int(11), IN nome varchar(255), IN nascimento date, IN cpf char(11), IN email varchar(100), IN celular varchar(11))

begin
  update tb_login set nm_login = email, nm_usuario = nome;
	update tb_cliente set nm_cliente = nome, dt_nascimento = nascimento, id_cpf = cpf, nm_email = email, cd_celular = celular where id_cliente = id;
end $$
DELIMITER ;


-- BUSCAR CLIENTE
drop procedure if exists `buscarCliente`;

DELIMITER $$
create procedure buscarCliente (in id int(11))

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
drop procedure if exists deletarCliente;

DELIMITER $$
create procedure deletarCliente(in id int)

begin
	delete from tb_login where nm_login = (SELECT nm_email from tb_cliente WHERE id_cliente = id);
  delete from tb_cliente where id_cliente = id;
end $$
DELIMITER ;
