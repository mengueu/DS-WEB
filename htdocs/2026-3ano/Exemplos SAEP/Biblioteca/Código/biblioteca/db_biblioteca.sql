-- Banco de Dados: db_biblioteca
CREATE DATABASE IF NOT EXISTS db_biblioteca DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_biblioteca;

CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS alunos (
    id_aluno INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    matricula VARCHAR(20) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS autores (
    id_autor INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    nacionalidade VARCHAR(50) DEFAULT 'Brasileira'
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS editoras (
    id_editora INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cnpj VARCHAR(18) NOT NULL UNIQUE,
    telefone VARCHAR(20)
) ENGINE=InnoDB;

-- INSERÇÕES PADRÃO (Seed)
-- A senha criptografada abaixo é '123456' (Gerada usando password_hash do PHP)
INSERT INTO usuarios (nome, email, senha) VALUES
('Administrador', 'admin@senai.br', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

INSERT INTO alunos (nome, matricula, email) VALUES
('João Silva', '2026001', 'joao.silva@aluno.senai.br'),
('Maria Souza', '2026002', 'maria.souza@aluno.senai.br');

INSERT INTO autores (nome, nacionalidade) VALUES
('Machado de Assis', 'Brasileira'),
('Clarice Lispector', 'Brasileira');

INSERT INTO editoras (nome, cnpj, telefone) VALUES
('Editora Rocco', '12.345.678/0001-90', '(11) 3000-1111'),
('Companhia das Letras', '98.765.432/0001-10', '(11) 3222-4444');
