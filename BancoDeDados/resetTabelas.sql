USE motofrete;

-- RESET DAS TABELAS --
DELETE FROM tb_login WHERE TRUE;
DELETE FROM tb_cliente WHERE TRUE;
DELETE FROM tb_motofretista WHERE TRUE;

-- INSERÇÃO DE ADMIN --
CALL cadastrarAdmin('Administrador', 'admin', 'admin');

-- INSERÇÃO DE CLIENTES --
CALL cadastrarCliente('Cliente A', '1981-01-01', '76346884018', 'clientea@email.com', '11988972570', '123456');
CALL cadastrarCliente('Cliente B', '1982-02-02', '91044702060', 'clienteb@email.com', '12996157867', '123456');
CALL cadastrarCliente('Cliente C', '1983-03-03', '96512794001', 'clientec@email.com', '13992212410', '123456');
CALL cadastrarCliente('Cliente D', '1984-04-04', '51834618053', 'cliented@email.com', '13998341098', '123456');
CALL cadastrarCliente('Cliente E', '1985-05-05', '83007320046', 'clientee@email.com', '11986891880', '123456');

-- INSERÇÃO DE MOTOFRETISTAS --
CALL cadastrarMotofretista('Dryelly Regis', '13981910588', '1335781288', 'motoa@email.com', '91199180033', '06294103000198', '19518522713', 'Feminino', 'Bertioga,Cubatão,Guarujá,Itanhaém,Mongaguá,Peruíbe,Praia Grande,Santos,São Vicente', '1981-01-01', 'Sim', 'AAA1111', '16119283090', 'Modelo A', 'Cor A', 'Marca A', '123456', 'avatar1.jpeg');
CALL cadastrarMotofretista('Giulia Souza', '13992340102', '1325627087', 'motob@email.com', '71132790077', '01561256000130', '39431348587', 'Feminino', 'Cubatão,Guarujá,Peruíbe,Praia Grande,São Vicente', '1982-02-02', 'Sim', 'BBB2222', '43699283560', 'Modelo B', 'Cor B', 'Marca B', '123456', 'avatar2.jpeg');
CALL cadastrarMotofretista('Leandro Silva', '13995065821', '1337304728', 'motoc@email.com', '42861681900', '22032090000135', '18540211902', 'Masculino', 'Praia Grande', '1983-03-03', 'Sim', 'CCC3333', '13092514164', 'Modelo C', 'Cor C', 'Marca C', '123456', 'avatar3.jpeg');
CALL cadastrarMotofretista('Letícia Sampaio', '13992871026', '1328555486', 'motod@email.com', '26953633549', '63639971000104', '27739446832', 'Feminino', 'Guarujá,Praia Grande,Santos,São Vicente', '1984-04-04', 'Sim', 'DDD4444', '43516138069', 'Modelo D', 'Cor D', 'Marca D', '123456', 'avatar4.jpeg');
CALL cadastrarMotofretista('Loraine Rodrigues', '13994677983', '1338944072', 'motoe@email.com', '00292341156', '77355009000140', '24511553828', 'Feminino', 'Santos,Guarujá', '1985-05-05', 'Sim', 'EEE5555', '22729196195', 'Modelo E', 'Cor E', 'Marca E', '123456', 'avatar5.jpeg');

CALL cadastrarMotofretista('Pedro Santos', '13981810588', '1335751288', 'motoh@email.com', '28579668069', '07660377000116', '92016839935', 'Feminino', 'Bertioga,Cubatão,Guarujá,Itanhaém,Mongaguá,Peruíbe,Praia Grande,Santos,São Vicente', '1981-01-01', 'Sim', 'AAA1112', '26657424157', 'Modelo A', 'Cor A', 'Marca A', '123456', 'avatar6.png');
CALL cadastrarMotofretista('Felipe Souza', '13692340102', '1325667087', 'motol@email.com', '23092876016', '63053269000156', '76028110710', 'Masculino', 'Cubatão,Guarujá,Peruíbe,Praia Grande,São Vicente', '1982-02-02', 'Sim', 'BBB2242', '93788420577', 'Modelo B', 'Cor B', 'Marca B', '123456', 'avatar7.jpg');
CALL cadastrarMotofretista('Marcia Silva', '13995085821', '1337304828', 'motor@email.com', '44279896089', '30326748000140', '32705541089', 'Feminino', 'Praia Grande', '1983-03-03', 'Sim', 'CCC4333', '61098843917', 'Modelo C', 'Cor C', 'Marca C', '123456', 'avatar8.jpg');
CALL cadastrarMotofretista('Sandra Sampaio', '13992871326', '1328565486', 'motok@email.com', '56091422022', '47633358000115', '10404534282', 'Masculino', 'Guarujá,Praia Grande,Santos,São Vicente', '1984-04-04', 'Sim', 'DJD4444', '79419418770', 'Modelo D', 'Cor D', 'Marca D', '123456', 'avatar9.jpg');
CALL cadastrarMotofretista('Beatriz Rodrigues', '13974677983', '1338944272', 'moto5@email.com', '80337175055', '91571746000100', '56392361126', 'Masculino', 'Santos,Guarujá', '1985-05-05', 'Sim', 'EFE5655', '43146132681', 'Modelo E', 'Cor E', 'Marca E', '123456', 'avatar10.jpg');
CALL cadastrarMotofretista('Luiza Ribeiro Rodrigues Manoela Pereira Nascimento', '13994677899', '19630753060', 'nome1grande@email.com', '70194825161', '61387183000134', '98968984005', 'Masculino', 'Santos,Guarujá', '1985-05-05', 'Sim', 'ZZK6666', '56639041600', 'Modelo E', 'Cor E', 'Marca E', '123456', 'avatar11.jpg');
CALL cadastrarMotofretista('Fernanda Pereira Nascimento', '13994678999', '1338944299', 'nomegrand@email.com', '02480294013', '46133665000174', '62854118569', 'Masculino', 'Santos,Guarujá', '1985-05-05', 'Sim', 'ZZL6666', '23746402391', 'Modelo E', 'Cor E', 'Marca E', '123456', 'avatar12.jpg');