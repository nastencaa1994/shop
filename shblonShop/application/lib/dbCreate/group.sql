CREATE TABLE IF NOT EXISTs Group_User(
id_group INT(3) AUTO_INCREMENT,
title VARCHAR(100) NOT NULL,
data_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
data_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id_group))
engine = Innodb
auto_increment = 1
character set = utf8
collate utf8_general_ci;

