DROP DATABASE IF EXISTS db;
CREATE DATABASE db CHARSET utf8mb4;
USE db;

CREATE TABLE users (
    id int(11) NOT NULL auto_increment,
    username varchar(100) NOT NULL,
    email varchar(100) NOT NULL,
    user_type ENUM('Admin', 'User'),
    password varchar(100) NOT NULL,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE USER IF NOT EXISTS 'user'@'%';
SET PASSWORD FOR 'user'@'%' = 'password';
GRANT ALL PRIVILEGES ON db.* TO 'user'@'%';