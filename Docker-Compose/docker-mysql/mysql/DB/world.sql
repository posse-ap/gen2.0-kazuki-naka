MySQL dump 10.13  Distrib 5.1.51, for pc-linux-gnu (i686)

Host: 127.0.0.1    Database: world
------------------------------------------------------
Server version       5.1.51-debug-log

/*以下Databaseの内容が記載される*/
CREATE DATABASE sample01;
USE sample01;
DROP TABLE IF EXISTS big_questions;
 
CREATE TABLE big_questions (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name TEXT NOT NULL
)DEFAULT CHARACTER SET=utf8;
INSERT INTO big_questions (name) VALUES ("東京"),("広島");