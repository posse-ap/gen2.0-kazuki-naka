DROP SCHEMA IF EXISTS webapp;
CREATE SCHEMA webapp;
USE webapp;

CREATE USER 'kazuki'@'mysql' IDENTIFIED BY 'password';

-- 必要なデータは日付・学習時間・言語・コンテンツ
DROP TABLE IF EXISTS learning_schedule;
CREATE TABLE learning_schedule
(
  id int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  learning_date DATE,
  learning_time INT(10),
  learning_language VARCHAR(40),
  lang_id INT(10),
  learning_content VARCHAR(40),
  cont_id INT(10)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO learning_schedule (learning_date,learning_time,learning_language,lang_id,learning_content,cont_id) VALUES
('2022-02-01',3,'HTML',1,'ドットインストール',1),
('2022-02-04',4,'CSS',2,'POSSE課題',3),
('2022-02-07',4,'JavaScript',3,'N予備校',2),
('2022-02-08',5,'PHP',4,'N予備校',2),
('2022-02-13',7,'Laravel',5,'POSSE課題',3),
('2022-02-15',2,'SQL',6,'POSSE課題',3),
('2022-02-20',4,'SHELL',7,'POSSE課題',3),
('2022-02-28',3,'情報システム基礎知識',8,'ドットインストール',1),
('2022-03-02',4,'HTML',1,'POSSE課題',3),
('2022-03-06',5,'SHELL',7,'ドットインストール',1),
('2022-03-12',6,'SQL',6,'N予備校',2),
('2022-03-20',2,'CSS',2,'POSSE課題',3),
('2022-03-28',5,'JavaScript',3,'POSSE課題',3);