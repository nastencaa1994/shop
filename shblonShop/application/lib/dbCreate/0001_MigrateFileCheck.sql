CREATE TABLE IF NOT EXISTs MigrateFileCheck(
    file VARCHAR(255) NOT NULL,
    data_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)
    engine = innodb
    auto_increment = 1
    character set utf8
    collate utf8_general_ci;