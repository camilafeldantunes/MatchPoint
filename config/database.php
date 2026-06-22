CREATE DATABASE IF NOT EXISTS matchpoint;

CREATE TABLE equipe (
    id_equipe INT AUTO_INCREMENT PRIMARY KEY,
    nome      VARCHAR(100) NOT NULL,
    estado    VARCHAR(2),
    cidade    VARCHAR(100),
    foto      VARCHAR(255)
);

CREATE TABLE jogador (
    id_jogador INT AUTO_INCREMENT PRIMARY KEY,
    nome       VARCHAR(100) NOT NULL,
    posicao    VARCHAR(50)  NOT NULL,
    numero     INT          NOT NULL,
    id_equipe  INT,
    foto       VARCHAR(255),
    FOREIGN KEY (id_equipe) REFERENCES equipe(id_equipe)
);

INSERT INTO equipe (nome, estado, pais) VALUES
('IFRS Vôlei', 'RS', 'Brasil'),
('Asavolei', 'RS', 'Brasil'),
('UPF Vôlei', 'RS', 'Brasil');