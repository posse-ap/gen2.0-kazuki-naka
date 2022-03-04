DROP SCHEMA IF EXISTS webapp;
CREATE SCHEMA webapp;
USE webapp;

CREATE USER 'kazuki'@'mysql' IDENTIFIED BY 'password';

-- 必要なデータは日付・学習時間・言語・コンテンツ
DROP TABLE IF EXISTS learning_schedule;
CREATE TABLE learning_schedule
(
  id int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  learning_date DATETIME,
  learning_time INT(10),
  learning_language VARCHAR(40),
  learning_content VARCHAR(40)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO learning_schedule (learning_date,learning_time,learning_language,learning_content) VALUES
('2022-02-01',3,'HTML','ドットインストール'),
('2022-02-04',4,'CSS','POSSE課題'),
('2022-02-07',4,'JavaScript','N予備校'),
('2022-02-08',5,'PHP','N予備校'),
('2022-02-13',7,'Laravel','POSSE課題'),
('2022-02-15',2,'SQL','POSSE課題'),
('2022-02-20',4,'SHELL','POSSE課題'),
('2022-02-28',3,'情報システム基礎知識(その他)','ドットインストール'),
('2022-03-02',4,'HTML','POSSE課題');