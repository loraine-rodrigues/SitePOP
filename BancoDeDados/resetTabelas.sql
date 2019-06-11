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
CALL cadastrarMotofretista('Giulia Souza', '13992340102', '1325627087', 'motob@email.com', '71132790077', '01561256000130', '39431348587', 'Masculino', 'Cubatão,Guarujá,Peruíbe,Praia Grande,São Vicente', '1982-02-02', 'Sim', 'BBB2222', '43699283560', 'Modelo B', 'Cor B', 'Marca B', '123456', 'avatar2.jpeg');
CALL cadastrarMotofretista('Leandro Silva', '13995065821', '1337304728', 'motoc@email.com', '42861681900', '22032090000135', '18540211902', 'Feminino', 'Praia Grande', '1983-03-03', 'Sim', 'CCC3333', '13092514164', 'Modelo C', 'Cor C', 'Marca C', '123456', 'avatar3.jpeg');
CALL cadastrarMotofretista('Letícia Sampaio', '13992871026', '1328555486', 'motod@email.com', '26953633549', '63639971000104', '27739446832', 'Masculino', 'Guarujá,Praia Grande,Santos,São Vicente', '1984-04-04', 'Sim', 'DDD4444', '43516138069', 'Modelo D', 'Cor D', 'Marca D', '123456', 'avatar4.jpeg');
CALL cadastrarMotofretista('Loraine Rodrigues', '13994677983', '1338944072', 'motoe@email.com', '00292341156', '77355009000140', '24511553828', 'Masculino', 'Santos,Guarujá', '1985-05-05', 'Sim', 'EEE5555', '22729196195', 'Modelo E', 'Cor E', 'Marca E', '123456', 'avatar5.jpeg');

call buscarClientes();