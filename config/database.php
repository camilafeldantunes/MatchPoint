CREATE DATABASE IF NOT EXISTS matchpoint;

CREATE TABLE equipe (
    id_equipe INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    estado VARCHAR(2) NOT NULL
    foto VARCHAR(255)
);

INSERT INTO equipe (nome, estado) VALUES
('IFRS Vôlei', 'RS'),
('Asavolei', 'RS'),
('UPF Vôlei', 'RS');