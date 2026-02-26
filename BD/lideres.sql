-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Fev-2026 às 11:42
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lideres`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `inscritos`
--

CREATE TABLE `inscritos` (
  `id` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `igreja` varchar(100) DEFAULT NULL,
  `regiao` varchar(100) DEFAULT NULL,
  `distrito` varchar(100) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `especialidade` varchar(100) DEFAULT NULL,
  `idade` int(11) DEFAULT NULL,
  `sexo` varchar(20) DEFAULT NULL,
  `estado_civil` varchar(50) DEFAULT NULL,
  `estado_clube` varchar(50) DEFAULT NULL,
  `data_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `inscritos`
--

INSERT INTO `inscritos` (`id`, `foto`, `nome`, `igreja`, `regiao`, `distrito`, `categoria`, `especialidade`, `idade`, `sexo`, `estado_civil`, `estado_clube`, `data_registro`) VALUES
(2, '1771861569_airton.jpg', 'Airton Ngola', 'Nazaré', 'Centro de Viana', 'Nazaré', 'Junior', 'Aventureiro', 32, 'Masculino', 'Casado', 'Activo', '2026-02-23 15:46:09'),
(3, '1771927112_tics.jpg', 'Ventura', 'Cafarnaum', 'Sul de Viana', 'Cafarnaum', 'Senior', 'Embaixador', 18, 'Feminino', 'Solteiro', 'Passivo', '2026-02-24 09:58:32'),
(4, '1771938732_tic.jpg', 'test Sul', 'Mar', 'Belas Norte', 'Cafarnaum', 'Junior', 'Aventureiro', 24, 'Masculino', 'Divorciado', 'Activo', '2026-02-24 13:12:12'),
(6, '1771940296_são silvestre.PNG', 'Louter Anto', 'Vila', 'Cabinda', 'Belize', 'Senior', 'Jovens Adulto', 36, 'Masculino', 'Casado', 'Passivo', '2026-02-24 13:38:16'),
(7, '1771942813_JA-logo.jpg', 'Antonio', 'Emanuel', 'Talatona Norte', 'Galileia', 'Junior', 'Desbravador', 23, 'Masculino', 'Solteiro', 'Activo', '2026-02-24 14:20:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','editor','leitor') NOT NULL DEFAULT 'leitor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `data_registro`, `role`) VALUES
(1, 'Administrador', 'admin@exemplo.com', 'e10adc3949ba59abbe56e057f20f883e', '2025-10-21 14:07:59', 'leitor'),
(2, 'Airton Ngola', 'n.gola@hotmail.com', '$2y$10$WynUflAA5DZZGiM2gESZge2mL5qgENZX1g9jeM7mMf7MfLoZa1NrO', '2025-10-21 14:50:11', 'admin'),
(6, 'lider', 'lider@hotmail.com', '$2y$10$DXxupBa4LCxEO2YY0zKxde9wPsRH7y0vBbziksB/67q27tL.2kSgm', '2026-02-23 13:51:05', 'admin');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `inscritos`
--
ALTER TABLE `inscritos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `inscritos`
--
ALTER TABLE `inscritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
