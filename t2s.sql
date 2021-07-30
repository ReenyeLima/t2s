DROP DATABASE IF EXISTS t2s;
CREATE DATABASE t2s;

USE t2s;

CREATE TABLE conteiner (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  cliente INTEGER NOT NULL,
  conteiner VARCHAR(11) NOT NULL UNIQUE,
  tipo INTEGER NOT NULL,
  status VARCHAR(5) NOT NULL,
  categoria VARCHAR(10) NOT NULL
);

CREATE TABLE movimentacoes (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  id_conteiner INTEGER NOT NULL,
  tipo VARCHAR(14) NOT NULL,
  inicio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  fim TIMESTAMP NULL DEFAULT NULL,
  CONSTRAINT fk_id_conteiner FOREIGN KEY (id_conteiner) REFERENCES conteiner (id)
);