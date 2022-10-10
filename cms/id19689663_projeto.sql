-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 10-Out-2022 às 17:32
-- Versão do servidor: 10.5.16-MariaDB
-- versão do PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `id19689663_projeto`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `rotas`
--

CREATE TABLE `rotas` (
  `origin_city` varchar(100) NOT NULL,
  `destiny_city` varchar(100) NOT NULL,
  `distance` varchar(145) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `rotas`
--

INSERT INTO `rotas` (`origin_city`, `destiny_city`, `distance`, `id`) VALUES
('Portão', 'Canoas', '30', 11),
('Portão', 'Rio de Janeiro - NH', '1890', 12),
('São paulo', 'Rio de Janeiro - NH', '540', 13),
('Portão', 'Novo Hamburgo', '14', 14),
('Portão', 'São Leopoldo', '10', 15);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(145) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`name`, `email`, `password`, `id`) VALUES
('Usuário teste', 'aula@gmail.com', '123456', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculos`
--

CREATE TABLE `veiculos` (
  `fuel` varchar(100) NOT NULL,
  `distance` varchar(145) NOT NULL,
  `fuel_price` varchar(145) NOT NULL,
  `vehicle_model` varchar(145) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_type` varchar(100) NOT NULL,
  `vehicle_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `veiculos`
--

INSERT INTO `veiculos` (`fuel`, `distance`, `fuel_price`, `vehicle_model`, `id`, `vehicle_type`, `vehicle_name`) VALUES
('fuel_comun', '14', '4.60', 'Suv', 5, 'car', 'Fiat Idea'),
('fuel_comun', '11', '4.30', 'GOL', 7, 'car', 'Gol'),
('fuel_diesel', '9.3', '4.45', 'Hilux Chassi 2.8 Turbo 4×4; Hilux Chassi 2.8 Turbo 4×4', 8, 'car', 'Hilux'),
('fuel_diesel', '15', '4.55', 'Uno', 9, 'car', 'Uno Mile');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `rotas`
--
ALTER TABLE `rotas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `veiculos`
--
ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `rotas`
--
ALTER TABLE `rotas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `veiculos`
--
ALTER TABLE `veiculos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
