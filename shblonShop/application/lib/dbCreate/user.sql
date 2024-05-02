CREATE TABLE IF NOT EXISTs User(
id_user INT(3) AUTO_INCREMENT,
login VARCHAR(250) NOT NULL,
password VARCHAR(20) NOT NULL,
name VARCHAR(20) DEFAULT NULL,
phone INT(20) DEFAULT NULL,
address INT(3),
group_user INT(3),
data_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
data_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id_user))
engine = innodb
auto_increment = 1
character set utf8
collate utf8_general_ci;
