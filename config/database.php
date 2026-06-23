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


CREATE TABLE jogos (
    id_jogo INT AUTO_INCREMENT PRIMARY KEY,
    data_jogo DATE NOT NULL,
    horario TIME NOT NULL,
    equipe_mandante INT NOT NULL,
    equipe_visitante INT NOT NULL,
    local_jogo VARCHAR(150) NOT NULL,
    resultado VARCHAR(20),

    CONSTRAINT fk_jogo_mandante
        FOREIGN KEY (equipe_mandante)
        REFERENCES equipe(id_equipe),

    CONSTRAINT fk_jogo_visitante
        FOREIGN KEY (equipe_visitante)
        REFERENCES equipe(id_equipe)
);

INSERT INTO equipe (nome, estado, pais) VALUES
('IFRS Vôlei', 'RS', 'Brasil'),
('Asavolei', 'RS', 'Brasil'),
('UPF Vôlei', 'RS', 'Brasil');