-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 25/03/2026 às 11:29
-- Versão do servidor: 8.0.45-0ubuntu0.22.04.1
-- Versão do PHP: 8.1.2-1ubuntu2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mini_ecommerce`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_general_ci,
  `preco` decimal(10,2) DEFAULT NULL,
  `categoria` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estoque` int DEFAULT NULL,
  `imagem` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('ativo','inativo') COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `preco`, `categoria`, `estoque`, `imagem`, `status`) VALUES
(17, 'Newporter Player', 'Natural', '2969.32', 'Acústico', 19, 'newporterplayer.png', 'ativo'),
(18, 'PRS SE Angelus', 'Gloss Black', '4842.31', 'Acústico', 13, 'prsseangelus.png', 'ativo'),
(19, 'Gretsch Jim Dandy', 'Deep Cherry Burst', '2119.32', 'Acústico', 27, 'gretschjimdandy.png', 'ativo'),
(20, 'Fender Squier Strato', '2-Color Sunburst', '1351.50', 'Elétrico', 54, 'fendersquier.png', 'ativo'),
(21, 'Jackson Rhoads', 'Gloss Black', '8494.32', 'Elétrico', 32, 'jacksonrhoads.png', 'ativo'),
(22, 'Esp Ltd Kirk', 'Black', '4513.93', 'Elétrico', 23, 'espltdkirk.png', 'ativo'),
(23, 'Standart Telecaster', 'Olympic White', '5097.16', 'Elétrico', 21, 'standarttelecaster.png', 'ativo'),
(24, 'Epiphone SG', 'Ebony', '5003.81', 'Elétrico', 18, 'epiphonesg.png', 'ativo'),
(25, 'Gibson Les Paul', 'Alpine White', '6967.16', 'Elétrico', 15, 'gibsonlespaul.png', 'ativo'),
(26, 'Jackson Sign', 'Snow White', '5097.16', 'Elétrico', 21, 'jacksonsignadria.png', 'ativo');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
