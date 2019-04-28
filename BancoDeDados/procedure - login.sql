CREATE DEFINER=`root`@`localhost` PROCEDURE `login`(
in senha varchar(32),
in email varchar(100))
begin
SELECT * from tb_login join tb_cliente where id_senha = senha and nm_email= email;
SELECT * from tb_login join tb_motofretista where id_senha = senha and nm_email= email;

end