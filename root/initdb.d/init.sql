DROP SCHEMA IF EXISTS quizy;
CREATE SCHEMA quizy;
USE quizy;

CREATE TABLE big_questions
(
  id INT(10),
  name     VARCHAR(40)
);

INSERT INTO big_questions (id, name) VALUES (1, "東京の難読地名クイズ");
INSERT INTO big_questions (id, name) VALUES (2, "広島の難読地名クイズ");