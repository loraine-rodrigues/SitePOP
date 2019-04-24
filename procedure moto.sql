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

drop procedure if exists insMotofrete;

DELIMITER $$
CREATE PROCEDURE `insMotofrete` (
IN nome varchar(100),
 IN cel char(11), 
 in tel char(11),
 in email varchar(100),
 in cpf char(11),
 in cnpj char(14),
 in cnh char(11),
 in regiao varchar(11),
 in nasc DATE,
 in habilitado tinyint(4),
 in mei boolean,
 in condumoto char(8),
 in placa char(7),
 in renavam char(11),
 in modelo varchar(45),
 in cor varchar(45),
 in marca varchar(45))

 
BEGIN
START TRANSACTION;

	INSERT INTO tb_fretista (nm_fretista, id_cel, id_tel, nm_email, id_cpf, id_cnpj, id_cnh, nm_regiao, dt_nasc, ic_habilitado, ic_mei, id_condumoto)
    VALUES (nome, cel, tel, email, cpf, cnpj, cnh, regiao, nasc, habilitado, mei, condumoto);
    insert into tb_veiculo (id_placa, id_renavam, nm_modelo, nm_cor, nm_marca, id_fretista) values (placa, renavam, modelo, cor, marca, last_insert_id());

END$$

DELIMITER ;

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
 in regiao varchar(11),
 in nasc DATE,
 in habilitado tinyint(4),
 in mei boolean,
 in condumoto char(8),
 in placa char(7),
 in renavam char(11),
 in modelo varchar(45),
 in cor varchar(45),
 in marca varchar(45))
 
 begin
 update tb_fretista set nm_fretista = nome, id_cel = cel, id_tel = tel, nm_email = email, id_cpf = cpf, id_cnpj = cnpj, id_cnh = cnh,
 nm_regiao = regiao, dt_nasc = nasc, ic_habilitado = habilitado, ic_mei = mei, id_condumoto = condumoto where id_fretista = id;
 
 update tb_veiculo set id_placa = placa, id_renavam = renavam, nm_modelo = modelo, nm_cor = cor, nm_marca = marca where id_fretista = id;
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

drop procedure if exists viewMoto;

delimiter $$
create procedure viewMoto(in id int)

begin
select * from tb_fretista inner join tb_veiculo;

end $$
delimiter ;