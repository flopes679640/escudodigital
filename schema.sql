CREATE DATABASE IF NOT EXISTS escudo_digital
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE escudo_digital;

CREATE TABLE IF NOT EXISTS acessos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome_usuario VARCHAR(120) NOT NULL,
  faixa_etaria VARCHAR(40) DEFAULT 'Não informada',
  data_hora_acesso DATETIME NOT NULL,
  quiz_pontuacao TINYINT DEFAULT NULL,
  quiz_concluido_em DATETIME DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS feedbacks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  acesso_id INT DEFAULT NULL,
  nome_usuario VARCHAR(120) NOT NULL,
  nota TINYINT NOT NULL,
  comentario TEXT,
  data_hora DATETIME NOT NULL,
  CONSTRAINT fk_feedback_acesso
    FOREIGN KEY (acesso_id) REFERENCES acessos(id)
    ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;