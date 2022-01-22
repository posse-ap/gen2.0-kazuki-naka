DROP SCHEMA IF EXISTS quizy;
CREATE SCHEMA quizy;
USE quizy;

CREATE TABLE big_questions
(
  id INT(10),
  name     VARCHAR(40)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO big_questions (id, name) VALUES (1, "東京");
INSERT INTO big_questions (id, name) VALUES (2, "広島");

CREATE TABLE questions
(
  id int AUTO_INCREMENT NOT NULL PRIMARY KEY ,
  big_question_id INT(10),
  image     VARCHAR(40)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO questions (big_question_id,image) VALUES (1, "takanawa.png");
INSERT INTO questions (big_question_id,image) VALUES (1, "kameido.png");
INSERT INTO questions (big_question_id,image) VALUES (2, "mukainada.png");

CREATE TABLE choices
(
  id int AUTO_INCREMENT NOT NULL PRIMARY KEY ,
  question_id INT(10),
  name     VARCHAR(40),
  valid INT(10)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO choices (question_id,name,valid) VALUES (1,'たかなわ',1);
INSERT INTO choices (question_id,name,valid) VALUES (1,'たかわ',0);
INSERT INTO choices (question_id,name,valid) VALUES (1,'こうわ',0);
INSERT INTO choices (question_id,name,valid) VALUES (2,'かめと',0);
INSERT INTO choices (question_id,name,valid) VALUES (2,'かめど',1);
INSERT INTO choices (question_id,name,valid) VALUES (2,'かめいど',1);
INSERT INTO choices (question_id,name,valid) VALUES (3,'むこうひら',0);
INSERT INTO choices (question_id,name,valid) VALUES (3,'むきひら',0);
INSERT INTO choices (question_id,name,valid) VALUES (3,'むかいなだ',1);

