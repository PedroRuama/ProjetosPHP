-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08/04/2025 às 21:17
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ystrategy_bd`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cad_user`
--

CREATE TABLE `cad_user` (
  `id` int(4) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `nome_completo` varchar(50) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `acesso` varchar(20) DEFAULT NULL,
  `acao` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cad_user`
--

INSERT INTO `cad_user` (`id`, `usuario`, `senha`, `nome_completo`, `email`, `acesso`, `acao`) VALUES
(2, 'RUAMA', 'e10adc3949ba59abbe56e057f20f883e', 'Pedro Ruama Nunes dos Santos', 'ruama246@gmail.com', 'ADMIN', 'geral');

--
-- Acionadores `cad_user`
--
DELIMITER $$
CREATE TRIGGER `NovoUser` AFTER INSERT ON `cad_user` FOR EACH ROW BEGIN
    INSERT INTO financas_mes (
        userID,
        ano,
        mes,
        inicial_amount,
        saldoAtual_amount,
        total_recebimentos,
        total_gastos
    ) VALUES (
        NEW.id,
        YEAR(NOW()),
        MONTH(NOW()),
        0.00,
        0.00,
        0.00,
        0.00
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `categoria_id` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `tipo` enum('gasto','recebimento','ambos') NOT NULL,
  `padrao_ys` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `userID`, `name`, `tipo`, `padrao_ys`) VALUES
(3, NULL, 'Alimentação', 'gasto', 1),
(4, NULL, 'Aluguel', 'gasto', 1),
(5, NULL, 'Água/Luz', 'gasto', 1),
(6, NULL, 'Transporte', 'gasto', 1),
(7, NULL, 'Internet', 'gasto', 1),
(8, NULL, 'Investimento', 'gasto', 1),
(9, NULL, 'Fatura', 'gasto', 1),
(10, NULL, 'Academia', 'gasto', 1),
(11, NULL, 'Lazer', 'gasto', 1),
(13, NULL, 'Outros', 'gasto', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `financas_mes`
--

CREATE TABLE `financas_mes` (
  `mes_id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `inicial_amount` decimal(10,2) DEFAULT 0.00,
  `saldoAtual_amount` decimal(10,2) DEFAULT 0.00,
  `total_recebimentos` decimal(10,2) DEFAULT 0.00,
  `total_gastos` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `financas_mes`
--

INSERT INTO `financas_mes` (`mes_id`, `userID`, `ano`, `mes`, `inicial_amount`, `saldoAtual_amount`, `total_recebimentos`, `total_gastos`, `created_at`, `updated_at`) VALUES
(1, 2, 2025, 4, 0.00, 0.00, 0.00, 0.00, '2025-04-05 17:39:00', '2025-04-05 17:39:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `gastos_fixos`
--

CREATE TABLE `gastos_fixos` (
  `gasto_fixo_id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `descriacao` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `imgs_users`
--

CREATE TABLE `imgs_users` (
  `id` int(5) NOT NULL,
  `userID` int(5) NOT NULL,
  `path` varchar(70) NOT NULL,
  `extensao` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `imgs_users`
--

INSERT INTO `imgs_users` (`id`, `userID`, `path`, `extensao`) VALUES
(2, 1, './imgs_users/img_67f07b6d53a97_1.png', 'png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `metas`
--

CREATE TABLE `metas` (
  `meta_id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `meta_amount` decimal(10,2) NOT NULL,
  `atual_amount` decimal(10,2) DEFAULT 0.00,
  `deadline` date DEFAULT NULL,
  `is_achieved` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `transacoes`
--

CREATE TABLE `transacoes` (
  `transacoes_id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `mes_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `data_transacao` date NOT NULL,
  `ehfixo` tinyint(1) DEFAULT 0,
  `ehrecorrente` tinyint(1) DEFAULT 0,
  `ehrecorrente_dias` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cad_user`
--
ALTER TABLE `cad_user`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`),
  ADD UNIQUE KEY `userID` (`userID`,`name`,`tipo`);

--
-- Índices de tabela `financas_mes`
--
ALTER TABLE `financas_mes`
  ADD PRIMARY KEY (`mes_id`),
  ADD UNIQUE KEY `userID` (`userID`,`ano`,`mes`);

--
-- Índices de tabela `gastos_fixos`
--
ALTER TABLE `gastos_fixos`
  ADD PRIMARY KEY (`gasto_fixo_id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Índices de tabela `imgs_users`
--
ALTER TABLE `imgs_users`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `metas`
--
ALTER TABLE `metas`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `userID` (`userID`);

--
-- Índices de tabela `transacoes`
--
ALTER TABLE `transacoes`
  ADD PRIMARY KEY (`transacoes_id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `mes_id` (`mes_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cad_user`
--
ALTER TABLE `cad_user`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `financas_mes`
--
ALTER TABLE `financas_mes`
  MODIFY `mes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `gastos_fixos`
--
ALTER TABLE `gastos_fixos`
  MODIFY `gasto_fixo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `imgs_users`
--
ALTER TABLE `imgs_users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `metas`
--
ALTER TABLE `metas`
  MODIFY `meta_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `transacoes`
--
ALTER TABLE `transacoes`
  MODIFY `transacoes_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `cad_user` (`id`);

--
-- Restrições para tabelas `financas_mes`
--
ALTER TABLE `financas_mes`
  ADD CONSTRAINT `financas_mes_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `cad_user` (`id`);

--
-- Restrições para tabelas `gastos_fixos`
--
ALTER TABLE `gastos_fixos`
  ADD CONSTRAINT `gastos_fixos_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `cad_user` (`id`),
  ADD CONSTRAINT `gastos_fixos_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`categoria_id`);

--
-- Restrições para tabelas `metas`
--
ALTER TABLE `metas`
  ADD CONSTRAINT `metas_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `cad_user` (`id`);

--
-- Restrições para tabelas `transacoes`
--
ALTER TABLE `transacoes`
  ADD CONSTRAINT `transacoes_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `cad_user` (`id`),
  ADD CONSTRAINT `transacoes_ibfk_2` FOREIGN KEY (`mes_id`) REFERENCES `financas_mes` (`mes_id`),
  ADD CONSTRAINT `transacoes_ibfk_3` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`categoria_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
