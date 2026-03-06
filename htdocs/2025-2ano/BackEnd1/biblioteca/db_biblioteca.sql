-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/02/2026 às 18:22
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_biblioteca`
--
CREATE DATABASE IF NOT EXISTS `db_biblioteca` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_biblioteca`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `codigoaluno` int(4) NOT NULL,
  `nomealuno` varchar(50) NOT NULL,
  `emailaluno` varchar(100) NOT NULL,
  `telefonealuno` bigint(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`codigoaluno`, `nomealuno`, `emailaluno`, `telefonealuno`) VALUES
(1, 'Ana Clara Ribeiro', 'ana.ribeiro@email.com', 11912345678),
(2, 'Bruno Martins', 'bruno.martins@email.com', 21923456789),
(3, 'Carla Souza', 'carla.souza@email.com', 31934567890),
(4, 'Diego Lopes', 'diego.lopes@email.com', 41945678901),
(5, 'Eduarda Lima', 'eduarda.lima@email.com', 51956789012),
(6, 'Felipe Andrade', 'felipe.andrade@email.com', 61967890123),
(7, 'Gabriela Torres', 'gabriela.torres@email.com', 71978901234),
(8, 'Heitor Nunes', 'heitor.nunes@email.com', 81989012345),
(9, 'Isabela Rocha', 'isabela.rocha@email.com', 91990123456),
(10, 'Joao Pedro Silva', 'joao.silva@email.com', 11991234567),
(11, 'Larissa Moura', 'larissa.moura@email.com', 21992345678),
(12, 'Matheus Oliveira', 'matheus.oliveira@email.com', 31993456789),
(13, 'Nicole Ferreira', 'nicole.ferreira@email.com', 41994567890),
(14, 'Pedro Henrique Ramos', 'pedro.ramos@email.com', 51995678901),
(15, 'Rafaela Castro', 'rafaela.castro@email.com', 61996789012);

-- --------------------------------------------------------

--
-- Estrutura para tabela `autor`
--

CREATE TABLE `autor` (
  `codigoautor` int(4) NOT NULL,
  `nomeautor` varchar(50) NOT NULL,
  `nacionalidadeautor` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `autor`
--

INSERT INTO `autor` (`codigoautor`, `nomeautor`, `nacionalidadeautor`) VALUES
(1, 'Machado de Assis', 'Brasileiro'),
(2, 'Aluísio Azevedo', 'Brasileiro'),
(3, 'José de Alencar', 'Brasileiro'),
(4, 'Graciliano Ramos', 'Brasileiro'),
(5, 'Jorge Amado', 'Brasileiro'),
(6, 'Manuel Antônio de Almeida', 'Brasileiro'),
(7, 'Raquel de Queiroz', 'Brasileira'),
(8, 'Clarice Lispector', 'Brasileira'),
(9, 'Erico Verissimo', 'Brasileiro'),
(10, 'Cecília Meireles', 'Brasileira'),
(11, 'Carlos Drummond de Andrade', 'Brasileiro'),
(12, 'Lima Barreto', 'Brasileiro'),
(13, 'Bernardo Guimarães', 'Brasileiro'),
(14, 'João Cabral de Melo Neto', 'Brasileiro'),
(15, 'Monteiro Lobato', 'Brasileiro');

-- --------------------------------------------------------

--
-- Estrutura para tabela `editora`
--

CREATE TABLE `editora` (
  `codigoeditora` int(4) NOT NULL,
  `nomeeditora` varchar(50) NOT NULL,
  `cidadesede` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `editora`
--

INSERT INTO `editora` (`codigoeditora`, `nomeeditora`, `cidadesede`) VALUES
(1, 'Companhia das Letras', 'São Paulo'),
(2, 'Editora Record', 'Rio de Janeiro'),
(3, 'Globo Livros', 'Porto Alegre'),
(4, 'Martins Fontes', 'São Paulo'),
(5, 'Rocco', 'Rio de Janeiro'),
(6, 'Objetiva', 'Rio de Janeiro'),
(7, 'Intrínseca', 'Rio de Janeiro'),
(8, 'Saraiva', 'São Paulo'),
(9, 'Ática', 'São Paulo'),
(10, 'Moderna', 'São Paulo'),
(11, 'Panda Books', 'São Paulo'),
(12, 'WMF Martins Fontes', 'São Paulo'),
(13, 'Nova Fronteira', 'Rio de Janeiro'),
(14, 'L&PM Editores', 'Porto Alegre'),
(15, 'Autêntica Editora', 'Belo Horizonte');

-- --------------------------------------------------------

--
-- Estrutura para tabela `emprestar`
--

CREATE TABLE `emprestar` (
  `fk_Livro_codigolivro` int(4) DEFAULT NULL,
  `fk_Aluno_codigoaluno` int(4) DEFAULT NULL,
  `codigoemprestimo` int(4) NOT NULL,
  `retirada` datetime NOT NULL,
  `devolucao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `emprestar`
--

INSERT INTO `emprestar` (`fk_Livro_codigolivro`, `fk_Aluno_codigoaluno`, `codigoemprestimo`, `retirada`, `devolucao`) VALUES
(4, 2, 1, '2025-09-01 10:00:00', '2025-09-10 15:00:00'),
(9, 11, 2, '2025-09-02 11:30:00', '2025-09-12 16:00:00'),
(10, 8, 3, '2025-09-03 09:15:00', '2025-09-13 14:45:00'),
(7, 15, 4, '2025-09-04 14:00:00', '2025-09-14 18:00:00'),
(6, 3, 5, '2025-09-05 13:30:00', '2025-09-15 12:00:00'),
(12, 13, 6, '2025-09-06 15:00:00', '2025-09-16 17:30:00'),
(5, 1, 7, '2025-09-07 09:00:00', '2025-09-17 13:00:00'),
(1, 5, 8, '2025-09-08 08:45:00', '2025-09-18 10:30:00'),
(15, 3, 9, '2025-09-09 10:15:00', '2025-09-19 11:45:00'),
(3, 9, 10, '2025-09-10 11:00:00', '2025-09-20 16:15:00'),
(11, 10, 11, '2025-09-11 13:45:00', '2025-09-21 17:00:00'),
(2, 4, 12, '2025-09-12 14:30:00', '2025-09-22 18:30:00'),
(8, 6, 13, '2025-09-13 09:30:00', '2025-09-23 14:00:00'),
(13, 7, 14, '2025-09-14 15:00:00', '2025-09-24 16:45:00'),
(14, 12, 15, '2025-09-15 10:45:00', '2025-09-25 12:15:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `livro`
--

CREATE TABLE `livro` (
  `codigolivro` int(4) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `anopublicacao` int(4) NOT NULL,
  `fk_Autor_codigoautor` int(4) DEFAULT NULL,
  `fk_Editora_codigoeditora` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `livro`
--

INSERT INTO `livro` (`codigolivro`, `titulo`, `anopublicacao`, `fk_Autor_codigoautor`, `fk_Editora_codigoeditora`) VALUES
(1, 'Dom Casmurro', 1899, 1, 1),
(2, 'O Cortiço', 1890, 2, 2),
(3, 'Memórias Póstumas de Brás Cubas', 1881, 1, 1),
(4, 'Iracema', 1865, 3, 3),
(5, 'Vidas Secas', 1938, 4, 4),
(6, 'Capitães da Areia', 1937, 5, 5),
(7, 'O Guarani', 1857, 3, 9),
(8, 'Senhora', 1875, 3, 10),
(9, 'O Ateneu', 1888, 6, 8),
(10, 'Sagarana', 1946, 5, 13),
(11, 'Grande Sertão: Veredas', 1956, 4, 14),
(12, 'A Moreninha', 1844, 13, 11),
(13, 'Triste Fim de Policarpo Quaresma', 1915, 12, 6),
(14, 'Quincas Borba', 1891, 1, 7),
(15, 'Lucíola', 1862, 3, 12);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`codigoaluno`),
  ADD UNIQUE KEY `emailaluno` (`emailaluno`),
  ADD UNIQUE KEY `telefonealuno` (`telefonealuno`);

--
-- Índices de tabela `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`codigoautor`);

--
-- Índices de tabela `editora`
--
ALTER TABLE `editora`
  ADD PRIMARY KEY (`codigoeditora`),
  ADD UNIQUE KEY `nomeeditora` (`nomeeditora`);

--
-- Índices de tabela `emprestar`
--
ALTER TABLE `emprestar`
  ADD PRIMARY KEY (`codigoemprestimo`),
  ADD KEY `FK_Emprestar_1` (`fk_Livro_codigolivro`),
  ADD KEY `FK_Emprestar_2` (`fk_Aluno_codigoaluno`);

--
-- Índices de tabela `livro`
--
ALTER TABLE `livro`
  ADD PRIMARY KEY (`codigolivro`),
  ADD KEY `FK_Livro_2` (`fk_Autor_codigoautor`),
  ADD KEY `FK_Livro_3` (`fk_Editora_codigoeditora`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `codigoaluno` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `autor`
--
ALTER TABLE `autor`
  MODIFY `codigoautor` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `editora`
--
ALTER TABLE `editora`
  MODIFY `codigoeditora` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `emprestar`
--
ALTER TABLE `emprestar`
  MODIFY `codigoemprestimo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `livro`
--
ALTER TABLE `livro`
  MODIFY `codigolivro` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `emprestar`
--
ALTER TABLE `emprestar`
  ADD CONSTRAINT `FK_Emprestar_1` FOREIGN KEY (`fk_Livro_codigolivro`) REFERENCES `livro` (`codigolivro`),
  ADD CONSTRAINT `FK_Emprestar_2` FOREIGN KEY (`fk_Aluno_codigoaluno`) REFERENCES `aluno` (`codigoaluno`);

--
-- Restrições para tabelas `livro`
--
ALTER TABLE `livro`
  ADD CONSTRAINT `FK_Livro_2` FOREIGN KEY (`fk_Autor_codigoautor`) REFERENCES `autor` (`codigoautor`),
  ADD CONSTRAINT `FK_Livro_3` FOREIGN KEY (`fk_Editora_codigoeditora`) REFERENCES `editora` (`codigoeditora`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
