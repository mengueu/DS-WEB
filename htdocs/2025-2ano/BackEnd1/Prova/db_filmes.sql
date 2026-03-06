-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql100.hyperphp.com
-- Tempo de geração: 03/02/2026 às 12:44
-- Versão do servidor: 11.4.9-MariaDB
-- Versão do PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_filmes`
--
CREATE DATABASE IF NOT EXISTS `db_filmes` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_filmes`;
-- --------------------------------------------------------

--
-- Estrutura para tabela `filmes`
--

CREATE TABLE `filmes` (
  `idFilme` int(6) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `ano_lancamento` int(11) NOT NULL,
  `genero` varchar(40) NOT NULL,
  `sinopse` varchar(200) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `filmes`
--

INSERT INTO `filmes` (`idFilme`, `titulo`, `ano_lancamento`, `genero`, `sinopse`, `data_criacao`) VALUES
(1, 'O Senhor dos Anéis: A Sociedade do Anel', 2001, 'acao', 'Um hobbit inicia jornada para destruir anel poderoso.', '2025-12-04 12:04:20'),
(2, 'Matrix', 1999, 'Ficção Científica/Ação', 'Hacker descobre realidade simulada e luta contra máquinas.', '2025-12-04 12:15:01'),
(4, 'Vingadores: Ultimato', 2019, 'Ação/Ficção Científica', 'Heróis unem forças para derrotar Thanos e salvar universo.', '2025-12-04 12:15:01'),
(5, 'Cidade de Deus', 2002, 'Drama/Crime', 'Jovens crescem em meio à violência nas favelas do Rio.', '2025-12-04 12:15:01'),
(6, 'Jurassic Park', 1993, 'Ficção Científica/Aventura', 'Dinossauros clonados escapam e ameaçam visitantes do parque.', '2025-12-04 12:15:01'),
(7, 'Star Wars: Uma Nova Esperança', 1977, 'Ficção Científica/Aventura', 'Luke inicia jornada para derrotar Império Galáctico.', '2025-12-04 12:15:01'),
(8, 'Forrest Gump', 1994, 'Drama/Romance', 'Homem simples vive grandes momentos da história americana.', '2025-12-04 12:15:01'),
(9, 'Gladiador', 2000, 'Ação/Drama', 'General romano busca vingança contra imperador corrupto.', '2025-12-04 12:15:01'),
(10, 'O Poderoso Chefão', 1972, 'acao', 'Família mafiosa enfrenta desafios para manter poder.', '2025-12-04 12:15:01'),
(13, 'Pulp Fiction', 1994, 'Crime/Drama', 'Histórias interligadas de crime e redenção em Los Angeles.', '2025-12-04 14:59:34'),
(14, 'O Silêncio dos Inocentes', 1991, 'Suspense/Terror', 'Agente do FBI busca serial killer com ajuda de Hannibal Lecter.', '2025-12-04 14:59:34'),
(15, 'Clube da Luta', 1999, 'Drama/Ação', 'Homem cria clube secreto de lutas para escapar da rotina.', '2025-12-04 14:59:34'),
(16, 'A Origem', 2010, 'Ficção Científica/Ação', 'Ladrão invade sonhos para plantar ideias na mente das pessoas.', '2025-12-04 14:59:34'),
(17, 'Interestelar', 2014, 'Ficção Científica/Drama', 'Astronautas viajam por buraco negro para salvar humanidade.', '2025-12-04 14:59:34'),
(18, 'O Rei Leão', 1994, 'Animação/Drama', 'Leãozinho enfrenta desafios para se tornar rei da savana.', '2025-12-04 14:59:34'),
(19, 'Os Incríveis', 2004, 'Animação/Ação', 'Família de super-heróis luta contra vilão tecnológico.', '2025-12-04 14:59:34'),
(20, 'Pantera Negra', 2018, 'Ação/Ficção Científica', 'Rei de Wakanda protege nação e enfrenta inimigos poderosos.', '2025-12-04 14:59:34'),
(21, 'Coringa', 2019, 'Drama/Crime', 'Comediante fracassado mergulha na loucura e violência.', '2025-12-04 14:59:34'),
(22, 'O Resgate do Soldado Ryan', 1998, 'Guerra/Drama', 'Soldados buscam salvar combatente durante Segunda Guerra.', '2025-12-04 14:59:34'),
(23, 'Harry Potter e a Pedra Filosofal', 2001, 'Fantasia/Aventura', 'Garoto descobre ser bruxo e inicia jornada em Hogwarts.', '2025-12-04 14:59:34'),
(24, 'Os Caça-Fantasmas', 1984, 'Comédia/Fantasia', 'Grupo enfrenta fantasmas em Nova York com armas especiais.', '2025-12-04 14:59:34'),
(25, 'De Volta para o Futuro', 1985, 'Ficção Científica/Comédia', 'Adolescente viaja no tempo com cientista excêntrico.', '2025-12-04 14:59:34'),
(26, 'O Exorcista', 1973, 'Terror/Suspense', 'Padres tentam salvar garota possuída por entidade demoníaca.', '2025-12-04 14:59:34'),
(27, 'O Grande Lebowski', 1998, 'Comédia/Crime', 'Homem comum se envolve em confusão após troca de identidade.', '2025-12-04 14:59:34');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `filmes`
--
ALTER TABLE `filmes`
  ADD PRIMARY KEY (`idFilme`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `filmes`
--
ALTER TABLE `filmes`
  MODIFY `idFilme` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
