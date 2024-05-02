CREATE TABLE IF NOT EXISTS News (
id_news INT(3) AUTO_INCREMENT,
title VARCHAR(20) NOT NULL,
preview VARCHAR(255) DEFAULT NULL,
description VARCHAR(255) DEFAULT NULL,
id_user VARCHAR(15) NOT NULL,
data_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
data_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
active BOOLEAN DEFAULT TRUE,
active_date_end DATE DEFAULT NULL,
active_date_start DATE DEFAULT NULL,
text_html TEXT DEFAULT NULL,
PRIMARY KEY (id_news)
)
engine = innodb
auto_increment = 1
character set utf8
collate utf8_general_ci;