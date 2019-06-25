-- PROCEDURES DE MOTOFRETISTA

USE `motofrete`;

-- INSERIR MOTOFRETISTA 
drop procedure if exists cadastrarMotofretista;

DELIMITER $$
CREATE PROCEDURE `cadastrarMotofretista` (
    IN nome varchar(100),
    IN celular char(11),
    IN telefone char(11),
    IN email varchar(100),
    IN cpf char(11),
    IN cnpj char(14),
    IN cnh char(11),
    IN genero enum ('Masculino','Feminino','Outros'),
    in regiao set ('Bertioga', 'Cubatão', 'Guarujá', 'Itanhaém', 'Mongaguá', 'Peruíbe', 'Praia Grande', 'Santos', 'São Vicente'),
    IN nascimento DATE,
    IN placa char(7),
    IN renavam char(11),
    IN modelo varchar(45),
    IN cor varchar(45),
    IN marca varchar(45),
    IN senha varchar(45),
    IN foto varchar(100),
    IN mei varchar(100))

BEGIN
    INSERT INTO tb_login (nm_usuario, nm_login, id_senha, id_tipo_login, ativo)
    VALUES (nome, email, md5(senha), '2', true);
    INSERT INTO tb_motofretista (nm_motofretista, id_celular, id_telefone, nm_email, id_cpf, id_cnpj, id_cnh, ic_genero, nm_regiao, dt_nascimento, id_placa, id_renavam, nm_modelo, nm_cor, nm_marca, urlFoto, urlMei, ativo)
    VALUES (nome, celular, telefone, email, cpf, cnpj, cnh, genero, regiao, nascimento, placa, renavam, modelo, cor, marca, foto, mei, true);
END$$
DELIMITER ;


-- EDITAR MOTOFRETISTA
drop procedure if exists editarMotofretista;

DELIMITER $$
create procedure `editarMotofretista` (
    IN id int (11),
    IN nome varchar(100),
    IN celular char(11),
    IN telefone char(11),
    IN email varchar(100),
    IN cpf char(11),
    IN cnpj char(14),
    IN cnh char(11),
    IN genero varchar(9),
    in regiao set ('Bertioga', 'Cubatão', 'Guarujá', 'Itanhaém', 'Mongaguá', 'Peruíbe', 'Praia Grande', 'Santos', 'São Vicente'),
    IN nascimento DATE,
    IN placa char(7),
    IN renavam char(11),
    IN modelo varchar(45),
    IN cor varchar(45),
    IN marca varchar(45)
)

BEGIN
    UPDATE tb_login SET nm_login = email, nm_usuario = nome WHERE id_login = id;
    UPDATE tb_motofretista SET nm_motofretista = nome,
                               id_celular = celular,
                               id_telefone = telefone,
                               nm_email = email,
                               id_cpf = cpf,
                               id_cnpj = cnpj,
                               id_cnh = cnh,
                               ic_genero = genero,
                               nm_regiao = regiao,
                               dt_nascimento = nascimento,
                               id_placa = placa,
                               id_renavam = renavam,
                               nm_modelo = modelo,
                               nm_cor = cor,
                               nm_marca = marca
    WHERE nm_email = (SELECT nm_login FROM tb_login WHERE id_login = id);
END $$
DELIMITER ;

-- ADMIN EDITAR MOTOFRETISTA
drop procedure if exists adminEditarMotofretista;

DELIMITER $$
create procedure `adminEditarMotofretista` (
    IN id int (11),
    IN nome varchar(100),
    IN celular char(11),
    IN telefone char(11),
    IN email varchar(100),
    IN cpf char(11),
    IN cnpj char(14),
    IN cnh char(11),
    IN genero varchar(9),
    in regiao set ('Bertioga', 'Cubatão', 'Guarujá', 'Itanhaém', 'Mongaguá', 'Peruíbe', 'Praia Grande', 'Santos', 'São Vicente'),
    IN nascimento DATE,
    IN placa char(7),
    IN renavam char(11),
    IN modelo varchar(45),
    IN cor varchar(45),
    IN marca varchar(45)
)

BEGIN
    UPDATE tb_login SET nm_login = email, nm_usuario = nome WHERE nm_login = (SELECT nm_email FROM tb_motofretista WHERE id_motofretista = id);
    UPDATE tb_motofretista SET nm_motofretista = nome,
                               id_celular = celular,
                               id_telefone = telefone,
                               nm_email = email,
                               id_cpf = cpf,
                               id_cnpj = cnpj,
                               id_cnh = cnh,
                               ic_genero = genero,
                               nm_regiao = regiao,
                               dt_nascimento = nascimento,
                               id_placa = placa,
                               id_renavam = renavam,
                               nm_modelo = modelo,
                               nm_cor = cor,
                               nm_marca = marca
    WHERE id_motofretista = id;
END $$
DELIMITER ;


-- EDITAR FOTO
drop procedure if exists mudarFoto;

DELIMITER $$
create procedure `mudarFoto` (IN email varchar(100), IN foto varchar(100))
BEGIN
    SELECT urlFoto FROM tb_motofretista WHERE nm_email = email;
    UPDATE tb_motofretista SET urlFoto = foto where nm_email = email;
END $$
DELIMITER ;

-- BUSCAR MOTOFRETISTA
drop procedure if exists buscarMotofretista;

DELIMITER $$
create procedure `buscarMotofretista` (in id int (11))
begin

    select * from tb_motofretista where id_motofretista = id;

end $$
DELIMITER ;

-- BUSCAR MOTOFRETISTA PELO NOME DE USUÁRIO
drop procedure if exists buscarMotofretistaPorUsuario;

DELIMITER $$
create procedure `buscarMotofretistaPorUsuario` (IN usuario VARCHAR (100))
begin

    select * from tb_motofretista where nm_email = usuario;

end $$
DELIMITER ;

-- BUSCAR TODOS MOTOFRETISTAS
drop procedure if exists buscarMotofretistas;

DELIMITER $$
create procedure `buscarMotofretistas` ()
begin

    select * from tb_motofretista;

end $$
DELIMITER ;


-- DELETAR MOTOFRETISTA
drop procedure if exists desativarMotofretista;

DELIMITER $$
create procedure `desativarMotofretista` (in id int(11))
begin
    UPDATE tb_login SET ativo = false where nm_login = (SELECT nm_email from tb_motofretista WHERE id_motofretista = id);
    UPDATE tb_motofretista SET ativo = false where id_motofretista = id;

end $$
DELIMITER ;