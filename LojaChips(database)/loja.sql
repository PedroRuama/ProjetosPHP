-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/10/2023 às 01:25
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
-- Banco de dados: `loja`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `produto` varchar(50) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  `data` date NOT NULL,
  `valor` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `codigo`, `produto`, `descricao`, `data`, `valor`) VALUES
(1, 99843, 'Doritos', 'https://promocao-bota-na-conta-de-elma.2b.uy/?c=bY9zAjBdKMwrhghO#sku=62001', '2023-08-15', 8),
(2, 34574, 'Fandangos Presunto', 'https://promocao-bota-na-conta-de-elma.2b.uy/?c=bY9zAjBdKMwrhghO#sku=61995', '2023-08-19', 4),
(3, 90430, 'Torcida Churrasco', 'https://promocao-bota-na-conta-de-elma.2b.uy/?c=bY9zAjBdKMwrhghO#sku=61956', '2023-08-30', 4),
(4, 10932, 'Cheetos Requeijão', 'https://promocao-bota-na-conta-de-elma.2b.uy/?c=bY9zAjBdKMwrhghO#sku=80916', '2023-09-05', 7),
(5, 11294, 'Ruffles Original', 'https://promocao-bota-na-conta-de-elma.2b.uy/?c=bY9zAjBdKMwrhghO#sku=81053', '2023-09-12', 8),
(6, 97856, 'Lays Clássica', 'https://promocao-bota-na-conta-de-elma.2b.uy/?c=bY9zAjBdKMwrhghO#sku=80985', '2023-10-18', 9),
(7, 89876, 'Stiksy', 'https://promocao-bota-na-conta-de-elma.2b.uy/?c=bY9zAjBdKMwrhghO#sku=81067', '2023-10-18', 6),
(8, 87642, 'Ovinhos', 'https://promocao-bota-na-conta-de-elma.2b.uy/?c=bY9zAjBdKMwrhghO#sku=80943', '2023-10-18', 3),
(9, 22232, 'Cheetos Parmesão', 'https://promocao-bota-na-conta-de-elma.2b.uy/?c=bY9zAjBdKMwrhghO#sku=80910', '2023-10-12', 5),
(10, 55363, 'Lays Creme Cebola', 'https://promocao-bota-na-conta-de-elma.2b.uy/?c=bY9zAjBdKMwrhghO#sku=80983', '2023-10-18', 9),
(11, 65432, 'Torcida Cebola', 'https://promocao-bota-na-conta-de-elma.2b.uy/?c=bY9zAjBdKMwrhghO#sku=61955', '2023-10-18', 4),
(12, 12642, 'Ruffles Churrasco', 'https://promocao-bota-na-conta-de-elma.2b.uy/?c=bY9zAjBdKMwrhghO#sku=81049', '2023-10-18', 9),
(13, 99234, 'Cheetos Bola Queijo', 'https://promocao-bota-na-conta-de-elma.2b.uy/?c=bY9zAjBdKMwrhghO#sku=88433', '2023-10-18', 9),
(14, 33333, 'Fandangos Queijo', 'https://promocao-bota-na-conta-de-elma.2b.uy/?c=bY9zAjBdKMwrhghO#sku=61997', '2023-10-18', 4),
(15, 76773, 'Lays Frango', 'https://promocao-bota-na-conta-de-elma.2b.uy/?c=bY9zAjBdKMwrhghO#sku=61964 ', '2023-10-18', 12);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
