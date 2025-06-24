-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/06/2025 às 18:45
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
-- Banco de dados: `petshop`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `especies`
--

CREATE TABLE `especies` (
  `id` int(11) NOT NULL,
  `especie` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `especies`
--

INSERT INTO `especies` (`id`, `especie`) VALUES
(1, 'Shih Tzu'),
(2, 'Labrador'),
(3, 'Vira-Lata'),
(14, 'Cachorro'),
(25, 'Poodle'),
(26, 'Golden Retriever'),
(28, 'Buldogue'),
(29, 'Gato'),
(31, 'Chihuahua');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pet`
--

CREATE TABLE `pet` (
  `id_pet` int(11) NOT NULL,
  `nome_pet` varchar(45) NOT NULL,
  `nasc_pet` date NOT NULL,
  `especie_pet` varchar(45) NOT NULL,
  `genero_pet` varchar(11) NOT NULL,
  `prontuario_pet` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pet`
--

INSERT INTO `pet` (`id_pet`, `nome_pet`, `nasc_pet`, `especie_pet`, `genero_pet`, `prontuario_pet`) VALUES
(4, 'Bola', '2022-03-18', '1', 'Macho', 'Nâo está com as vacinas em dia. Não é castrado.'),
(6, 'Darci', '2005-03-18', '26', 'Macho', 'Vacinado contra a gripe aviaria. Castrado.'),
(7, 'Maria Luiza', '2023-01-20', '14', 'Fêmea', 'Não fez nenhuma vacina. Não é castrada.'),
(10, 'Cookie', '2025-04-19', '31', 'Fêmea', 'Com todas as vacinas em dia. ');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `nascimento` date NOT NULL,
  `email` varchar(45) NOT NULL,
  `tipo` int(11) NOT NULL,
  `senha` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `nascimento`, `email`, `tipo`, `senha`) VALUES
(1, 'Jonas', '0000-00-00', 'jonas@gmail.com', 1, '1234'),
(2, 'Silvio', '0000-00-00', 'silvio@gmail.com', 1, '1234'),
(3, 'Juliana', '2003-01-01', 'juliana@gmail.com', 2, '12345678');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `especies`
--
ALTER TABLE `especies`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`id_pet`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `especies`
--
ALTER TABLE `especies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `pet`
--
ALTER TABLE `pet`
  MODIFY `id_pet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
