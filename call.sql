SELECT * FROM motofrete.tb_fretista;

select * from tb_veiculo;

call insMotofrete ('jose',null, null, null, null, null, '203939330', 'Santos', '2000-10-01',true, true, '192929', 'eee0000', '11111111111', 'gg','rosa','marca'); 

call updMoto (13, 'jose','12312312312', null, null, null, null, '203939330', 'Santos', '2000-10-01',true, true, '192929', 'eee0000', '11111111111', 'gg','rosa','honda');

call delMoto (12);

call viewMoto (13);

