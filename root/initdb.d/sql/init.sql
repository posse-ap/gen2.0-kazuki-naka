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
  lang_color VARCHAR(40),
  learning_content VARCHAR(40),
  cont_color VARCHAR(40)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO learning_schedule (learning_date,learning_time,learning_language,lang_color,learning_content,cont_color) VALUES
('2022-02-01',3,'HTML','#0042E5','ドットインストール','#0042E5'),
('2022-02-04',4,'CSS','#0070B9','POSSE課題','#00BDDB'),
('2022-02-07',4,'JavaScript','#00BDDB','N予備校','#0070B9'),
('2022-02-08',5,'PHP','#08CDFA','N予備校','#0070B9'),
('2022-02-13',7,'Laravel','#B29DEF','POSSE課題','#00BDDB'),
('2022-02-15',2,'SQL','#6C43E5','POSSE課題','#00BDDB'),
('2022-02-20',4,'SHELL','#4609E8','POSSE課題','#00BDDB'),
('2022-02-28',3,'情報システム基礎知識','#2D00BA','ドットインストール','#0042E5'),
('2022-03-02',4,'HTML','#0042E5','POSSE課題','#00BDDB'),
('2022-03-06',5,'SHELL','#4609E8','ドットインストール','#0042E5'),
('2022-03-14',6,'SQL','#6C43E5','N予備校','#0070B9'),
('2022-03-20',2,'CSS','#0070B9','POSSE課題','#00BDDB'),
('2022-03-28',5,'JavaScript','#00BDDB','POSSE課題','#00BDDB');