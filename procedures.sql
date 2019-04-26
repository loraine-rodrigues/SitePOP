drop procedure if exists insMoto;

DELIMITER $$
CREATE PROCEDURE `insMoto` (
IN nome varchar(100),
 IN cel char(11), 
 in tel char(11),
 in email varchar(100),
 in cpf char(11),
 in cnpj char(14),
 in cnh char(11),
 in genero varchar(9),
 in regiao varchar(11),
 in nasc DATE,
 in habilitado tinyint(4),
 in mei boolean,
 in condumoto char(8),
 in placa char(7),
 in renavam char(11),
 in modelo varchar(45),
 in cor varchar(45),
 in marca varchar(45),
 in senha varchar(255))

 
BEGIN
START TRANSACTION;

	INSERT INTO tb_fretista (nm_fretista, id_cel, id_tel, nm_email, id_cpf, id_cnpj, id_cnh, ic_genero, nm_regiao, dt_nasc, ic_habilitado, ic_mei, id_condumoto, nm_senha)
    VALUES (nome, cel, tel, email, cpf, cnpj, cnh, genero, regiao, nasc, habilitado, mei, condumoto, senha);
    insert into tb_veiculo (id_placa, id_renavam, nm_modelo, nm_cor, nm_marca, id_fretista) values (placa, renavam, modelo, cor, marca, last_insert_id());

END$$
delimiter ;


drop procedure if exists updMoto;

delimiter $$
create procedure updMoto (
in id int(11),
IN nome varchar(100),
 IN cel char(11), 
 in tel char(11),
 in email varchar(100),
 in cpf char(11),
 in cnpj char(14),
 in cnh char(11),
 in genero varchar(9), 
 in regiao varchar(12),
 in nasc DATE,
 in habilitado tinyint(4),
 in mei boolean,
 in condumoto char(8),
 in placa char(7),
 in renavam char(11),
 in modelo varchar(45),
 in cor varchar(45),
 in marca varchar(45),
 in senha varchar(255))
 
 begin
 update tb_fretista set nm_fretista = nome, id_cel = cel, id_tel = tel, nm_email = email, id_cpf = cpf, id_cnpj = cnpj, id_cnh = cnh, ic_genero = genero,
 nm_regiao = regiao, dt_nasc = nasc, ic_habilitado = habilitado, ic_mei = mei, id_condumoto = condumoto, nm_senha = senha where id_fretista = id;
 
 update tb_veiculo set id_placa = placa, id_renavam = renavam, nm_modelo = modelo, nm_cor = cor, nm_marca = marca where id_fretista = id;
 end $$
 
delimiter ;

delimiter $$
create procedure viewMoto(in id int)

begin
select * from tb_fretista inner join tb_veiculo;

end $$
delimiter ;

drop procedure if exists delMoto;

delimiter $$
create procedure delMoto(
in id int(11))

begin
delete from tb_veiculo where id_fretista = id;
delete from tb_fretista where id_fretista = id;
end $$
delimiter ;


DROP procedure IF EXISTS `insCliente`;

DELIMITER $$
CREATE PROCEDURE `insCliente` (IN nome varchar(255), IN nasc date, IN cpf char(11), IN email varchar(100), IN cel varchar(13), IN senha varchar(255))
BEGIN
	INSERT INTO tb_cliente (nm_cliente, dt_nasc, id_cpf, nm_email, id_cel, nm_senha)
		VALUES (nome, nasc, cpf, email, cel, senha);
	
END$$

DELIMITER ;

drop procedure if exists updCliente;

delimiter $$ 
create procedure updCliente (in id int, IN nome varchar(255), IN nasc date, IN cpf char(11), IN email varchar(100), IN cel varchar(13), IN senha varchar(45))
begin
update tb_cliente set nm_cliente = nome, dt_nasc = nasc, id_cpf = cpf, nm_email = email, id_cel = cel, nm_senha = senha where id_cliente = id;
end $$
delimiter ;

delimiter $$
create procedure viewCliente (in id int)
begin
select * from tb_cliente;
end $$
delimiter ;

drop procedure if exists delCliente;

delimiter $$
create procedure delCliente(in id int)
begin
delete from tb_cliente where id_cliente = id;
end $$
delimiter ;

