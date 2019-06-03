CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `nm_email` varchar(255) NOT NULL,
  `fk_admin_login` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_admin`),
  UNIQUE KEY `nm_email` (`nm_email`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8