CREATE DATABASE foro_vincenzo;

USE foro_vincenzo;

CREATE TABLE tema(
  id INT NOT NULL AUTO_INCREMENT,
  titulo VARCHAR(30),
  tema VARCHAR(100),
  autor VARCHAR(30),
  fecha DATE NOT NULL DEFAULT CURRENT_DATE(),
  hora TIME NOT NULL DEFAULT CURRENT_TIME(),
  PRIMARY KEY (id)
);

CREATE TABLE respuesta(
  id INT NOT NULL AUTO_INCREMENT,
  id_tema INT NOT NULL,
  respuesta VARCHAR(100) NOT NULL,
  autor VARCHAR(30) NOT NULL DEFAULT 'Anonimo',
  fecha DATE NOT NULL DEFAULT CURRENT_DATE(),
  PRIMARY KEY (id),
  FOREIGN KEY (id_tema) REFERENCES tema(id)
  ON UPDATE CASCADE ON DELETE CASCADE
);