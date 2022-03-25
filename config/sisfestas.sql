-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Mar-2022 às 21:44
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sisfestas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) NOT NULL,
  `email` varchar(220) NOT NULL,
  `usuario` varchar(220) NOT NULL,
  `senha` varchar(220) NOT NULL,
  `cpf` varchar(50) NOT NULL,
  `rg` varchar(50) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `cep` varchar(12) NOT NULL,
  `rua` varchar(200) NOT NULL,
  `numero` varchar(6) DEFAULT NULL,
  `complemento` varchar(150) DEFAULT NULL,
  `bairro` varchar(150) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `recuperar_senha` varchar(220) DEFAULT NULL,
  `chave_descadastro` varchar(220) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `obs` tinytext DEFAULT NULL,
  `situacao` int(11) DEFAULT 1,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `email`, `usuario`, `senha`, `cpf`, `rg`, `telefone`, `cep`, `rua`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `recuperar_senha`, `chave_descadastro`, `foto`, `obs`, `situacao`, `created`, `modified`) VALUES
(1, 'Claudemir da Silva Lopes', 'claudemir.slopes@hotmail.com', 'claudemir', '$2y$10$CaPIIT.zHJiGK3yUO7MbleuvUOZRU16xxshtAHNiQT8mjdAHrL6D.', '284.132.918-60', '275324102', '(19) 98457-8361', '13483-332', 'Rua Guido José Bellon', '358', '', 'Parque Residencial Abílio Pedro', 'Limeira', 'SP', NULL, NULL, 'fotosite.jpg', NULL, 1, '2022-02-23 11:15:44', '2022-03-12 08:25:56'),
(2, 'Eliane Rocha de Freitas Lopes', 'lifreitaslopes@gmail.com', 'lifreitas', '$2y$10$fFVUC7KVoHtDnTrcxjZFGe5y6oyIIDGQ6JDDzByXkznYK4PN6jMSC', '964.301.686-20', '547899541', '(19) 98457-8361', '13482-050', 'Rua Francisco Orlando Stocco', '258', 'fundos', 'Jardim Ouro Verde', 'Limeira', 'SP', NULL, NULL, '1622327057853.png', NULL, 1, '2022-02-23 11:19:13', '2022-03-12 08:39:32'),
(3, 'Luke Skywalker Lopes', 'luke@luke.com', 'lukesky', '$2y$10$a93XTvtsKJROKaTLm4Q3.uPcQ.1GULrhWx6SuxoXolVgBgf/J86pm', '284.132.918-60', '25874587', '(19) 98457-8361', '13483-332', 'Rua Guido José Bellon', '358', '', 'Parque Residencial Abílio Pedro', 'Limeira', 'SP', NULL, NULL, NULL, 'Usuário apenas para testes no sistema de cadastro', 0, '2022-03-25 17:05:00', NULL),
(4, 'Rogério Moura', 'rogerio.moura@hotmail.com', 'rogerio.moura', '$2y$10$cmzVaqR1oD0kLnUYyPVwzOrE4loASel3nv2/cpF21BvTWG1BR45Na', '425.073.670-91', '4587789965', '(13) 98457-8361', '13487-185', 'Rua Rúbens Quadros', '255', '', 'Jardim Anhangüera', 'Limeira', 'SP', NULL, NULL, 'img-20210423-wa0011.jpg', '', 1, '2022-03-25 17:10:07', NULL),
(5, 'Lilian Doida Moura', 'lilianadoida@hotquente.com', 'lilianadoida', '$2y$10$e28NQAgTK6wC3CSnDGWZEuI2iU50v66XbdSvosvBpk526EzL1wr2G', '844.174.350-90', '278545877', '(15) 45897-8999', '13483-333', 'Rua Edeméia Brandão de Oliveira', '258', '', 'Parque Residencial Abílio Pedro', 'Limeira', 'SP', NULL, NULL, NULL, '', 1, '2022-03-25 17:33:31', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `logos`
--

CREATE TABLE `logos` (
  `id` int(11) NOT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `logos`
--

INSERT INTO `logos` (`id`, `foto`, `modified`) VALUES
(1, 'sf1.png', '2022-03-09 11:36:37'),
(2, 'sf2.png', '2022-03-09 11:36:46');

-- --------------------------------------------------------

--
-- Estrutura da tabela `niveis_acessos`
--

CREATE TABLE `niveis_acessos` (
  `id` int(11) NOT NULL,
  `nome_nivel_acesso` varchar(50) NOT NULL,
  `ordem` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `niveis_acessos`
--

INSERT INTO `niveis_acessos` (`id`, `nome_nivel_acesso`, `ordem`, `created`, `modified`) VALUES
(1, 'Programador', 1, '2022-02-01 16:58:12', '2022-03-09 10:48:03'),
(2, 'Administrador', 2, '2022-02-01 16:58:27', '2022-02-28 17:06:03'),
(3, 'Colaborador', 3, '2022-02-01 16:58:36', '2022-02-28 17:06:10'),
(4, 'Estagiário', 4, '2022-02-19 12:22:50', '2022-03-09 09:40:32');

-- --------------------------------------------------------

--
-- Estrutura da tabela `niveis_acessos_paginas`
--

CREATE TABLE `niveis_acessos_paginas` (
  `id` int(11) NOT NULL,
  `niveis_acesso_id` int(11) NOT NULL,
  `pagina_id` int(11) NOT NULL,
  `permissao` int(11) NOT NULL,
  `ordem` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `niveis_acessos_paginas`
--

INSERT INTO `niveis_acessos_paginas` (`id`, `niveis_acesso_id`, `pagina_id`, `permissao`, `ordem`, `created`, `modified`) VALUES
(1, 1, 1, 1, 1, '2022-03-08 10:41:55', NULL),
(2, 1, 2, 1, 2, '2022-03-08 10:57:49', NULL),
(3, 1, 3, 1, 3, '2022-03-08 10:59:23', NULL),
(4, 2, 3, 2, 1, '2022-03-08 10:59:24', '2022-03-09 09:30:33'),
(5, 3, 3, 2, 1, '2022-03-08 10:59:24', NULL),
(6, 4, 3, 2, 1, '2022-03-08 10:59:24', NULL),
(7, 1, 4, 1, 4, '2022-03-08 11:14:12', NULL),
(8, 2, 4, 2, 2, '2022-03-08 11:14:12', NULL),
(9, 3, 4, 2, 2, '2022-03-08 11:14:12', NULL),
(10, 4, 4, 2, 2, '2022-03-08 11:14:12', NULL),
(11, 2, 1, 2, 3, '2022-03-08 11:14:16', NULL),
(12, 2, 2, 2, 4, '2022-03-08 11:14:16', NULL),
(13, 3, 1, 2, 3, '2022-03-08 11:14:16', NULL),
(14, 3, 2, 2, 4, '2022-03-08 11:14:16', NULL),
(15, 4, 1, 2, 3, '2022-03-08 11:14:16', NULL),
(16, 4, 2, 2, 4, '2022-03-08 11:14:16', NULL),
(17, 1, 5, 1, 5, '2022-03-08 11:22:43', NULL),
(18, 2, 5, 2, 5, '2022-03-08 11:22:43', NULL),
(19, 3, 5, 2, 5, '2022-03-08 11:22:43', NULL),
(20, 4, 5, 2, 5, '2022-03-08 11:22:43', NULL),
(21, 1, 6, 1, 6, '2022-03-09 08:02:51', NULL),
(22, 2, 6, 2, 6, '2022-03-09 08:02:51', NULL),
(23, 3, 6, 2, 6, '2022-03-09 08:02:51', NULL),
(24, 4, 6, 2, 6, '2022-03-09 08:02:51', NULL),
(25, 1, 7, 1, 7, '2022-03-09 08:03:58', NULL),
(26, 2, 7, 2, 7, '2022-03-09 08:03:58', NULL),
(27, 3, 7, 2, 7, '2022-03-09 08:03:58', NULL),
(28, 4, 7, 2, 7, '2022-03-09 08:03:59', NULL),
(29, 1, 8, 1, 8, '2022-03-09 08:44:31', NULL),
(30, 2, 8, 2, 8, '2022-03-09 08:44:31', NULL),
(31, 3, 8, 2, 8, '2022-03-09 08:44:31', NULL),
(32, 4, 8, 2, 8, '2022-03-09 08:44:31', NULL),
(33, 1, 9, 1, 9, '2022-03-09 08:45:19', NULL),
(34, 2, 9, 2, 9, '2022-03-09 08:45:19', NULL),
(35, 3, 9, 2, 9, '2022-03-09 08:45:19', NULL),
(36, 4, 9, 2, 9, '2022-03-09 08:45:19', NULL),
(37, 1, 10, 1, 10, '2022-03-09 08:46:23', NULL),
(38, 2, 10, 2, 10, '2022-03-09 08:46:23', NULL),
(39, 3, 10, 2, 10, '2022-03-09 08:46:23', NULL),
(40, 4, 10, 2, 10, '2022-03-09 08:46:23', NULL),
(41, 1, 11, 1, 11, '2022-03-09 08:47:17', NULL),
(42, 2, 11, 2, 11, '2022-03-09 08:47:17', NULL),
(43, 3, 11, 2, 11, '2022-03-09 08:47:17', NULL),
(44, 4, 11, 2, 11, '2022-03-09 08:47:17', NULL),
(45, 1, 12, 1, 12, '2022-03-09 08:49:54', NULL),
(46, 2, 12, 2, 12, '2022-03-09 08:49:54', NULL),
(47, 3, 12, 2, 12, '2022-03-09 08:49:54', NULL),
(48, 4, 12, 2, 12, '2022-03-09 08:49:54', NULL),
(49, 1, 13, 1, 13, '2022-03-09 09:20:20', NULL),
(50, 2, 13, 2, 13, '2022-03-09 09:20:20', NULL),
(51, 3, 13, 2, 13, '2022-03-09 09:20:20', NULL),
(52, 4, 13, 2, 13, '2022-03-09 09:20:20', NULL),
(53, 1, 14, 1, 14, '2022-03-09 09:30:07', NULL),
(54, 2, 14, 2, 14, '2022-03-09 09:30:07', NULL),
(55, 3, 14, 2, 14, '2022-03-09 09:30:07', NULL),
(56, 4, 14, 2, 14, '2022-03-09 09:30:07', NULL),
(57, 1, 15, 1, 15, '2022-03-09 11:24:06', NULL),
(58, 2, 15, 2, 15, '2022-03-09 11:24:07', NULL),
(59, 3, 15, 2, 15, '2022-03-09 11:24:07', NULL),
(60, 4, 15, 2, 15, '2022-03-09 11:24:07', NULL),
(61, 1, 16, 1, 16, '2022-03-09 11:31:42', NULL),
(62, 2, 16, 2, 16, '2022-03-09 11:31:42', NULL),
(63, 3, 16, 2, 16, '2022-03-09 11:31:42', NULL),
(64, 4, 16, 2, 16, '2022-03-09 11:31:42', NULL),
(65, 1, 17, 1, 17, '2022-03-09 11:35:21', NULL),
(66, 2, 17, 2, 17, '2022-03-09 11:35:22', NULL),
(67, 3, 17, 2, 17, '2022-03-09 11:35:22', NULL),
(68, 4, 17, 2, 17, '2022-03-09 11:35:22', NULL),
(69, 1, 18, 1, 18, '2022-03-09 11:47:50', NULL),
(70, 2, 18, 2, 18, '2022-03-09 11:47:51', NULL),
(71, 3, 18, 2, 18, '2022-03-09 11:47:51', NULL),
(72, 4, 18, 2, 18, '2022-03-09 11:47:51', NULL),
(73, 1, 19, 1, 19, '2022-03-09 11:49:27', NULL),
(74, 2, 19, 2, 19, '2022-03-09 11:49:27', NULL),
(75, 3, 19, 2, 19, '2022-03-09 11:49:27', NULL),
(76, 4, 19, 2, 19, '2022-03-09 11:49:28', NULL),
(77, 1, 20, 1, 20, '2022-03-09 15:49:50', NULL),
(78, 2, 20, 2, 20, '2022-03-09 15:49:50', NULL),
(79, 3, 20, 2, 20, '2022-03-09 15:49:50', NULL),
(80, 4, 20, 2, 20, '2022-03-09 15:49:50', NULL),
(81, 1, 21, 1, 21, '2022-03-09 15:50:29', NULL),
(82, 2, 21, 2, 21, '2022-03-09 15:50:29', NULL),
(83, 3, 21, 2, 21, '2022-03-09 15:50:29', NULL),
(84, 4, 21, 2, 21, '2022-03-09 15:50:29', NULL),
(85, 1, 22, 1, 22, '2022-03-09 16:02:04', NULL),
(86, 2, 22, 2, 22, '2022-03-09 16:02:04', NULL),
(87, 3, 22, 2, 22, '2022-03-09 16:02:04', NULL),
(88, 4, 22, 2, 22, '2022-03-09 16:02:04', NULL),
(89, 1, 23, 1, 23, '2022-03-10 08:30:02', NULL),
(90, 2, 23, 2, 23, '2022-03-10 08:30:02', NULL),
(91, 3, 23, 2, 23, '2022-03-10 08:30:03', NULL),
(92, 4, 23, 2, 23, '2022-03-10 08:30:03', NULL),
(93, 1, 24, 1, 24, '2022-03-10 09:58:01', NULL),
(94, 2, 24, 2, 24, '2022-03-10 09:58:01', NULL),
(95, 3, 24, 2, 24, '2022-03-10 09:58:01', NULL),
(96, 4, 24, 2, 24, '2022-03-10 09:58:01', NULL),
(97, 1, 25, 1, 25, '2022-03-10 10:00:23', NULL),
(98, 2, 25, 2, 25, '2022-03-10 10:00:23', NULL),
(99, 3, 25, 2, 25, '2022-03-10 10:00:23', NULL),
(100, 4, 25, 2, 25, '2022-03-10 10:00:23', NULL),
(101, 1, 26, 1, 26, '2022-03-10 10:01:51', NULL),
(102, 2, 26, 2, 26, '2022-03-10 10:01:51', NULL),
(103, 3, 26, 2, 26, '2022-03-10 10:01:51', NULL),
(104, 4, 26, 2, 26, '2022-03-10 10:01:52', NULL),
(105, 1, 27, 1, 27, '2022-03-10 10:03:54', NULL),
(106, 2, 27, 2, 27, '2022-03-10 10:03:54', NULL),
(107, 3, 27, 2, 27, '2022-03-10 10:03:54', NULL),
(108, 4, 27, 2, 27, '2022-03-10 10:03:54', NULL),
(109, 1, 28, 1, 28, '2022-03-10 10:16:07', NULL),
(110, 2, 28, 2, 28, '2022-03-10 10:16:07', NULL),
(111, 3, 28, 2, 28, '2022-03-10 10:16:07', NULL),
(112, 4, 28, 2, 28, '2022-03-10 10:16:07', NULL),
(113, 1, 29, 1, 29, '2022-03-10 10:34:58', NULL),
(114, 2, 29, 2, 29, '2022-03-10 10:34:58', NULL),
(115, 3, 29, 2, 29, '2022-03-10 10:34:58', NULL),
(116, 4, 29, 2, 29, '2022-03-10 10:34:58', NULL),
(117, 1, 30, 1, 30, '2022-03-10 15:36:55', NULL),
(118, 2, 30, 2, 30, '2022-03-10 15:36:55', NULL),
(119, 3, 30, 2, 30, '2022-03-10 15:36:55', NULL),
(120, 4, 30, 2, 30, '2022-03-10 15:36:55', NULL),
(121, 1, 31, 1, 31, '2022-03-10 15:39:01', NULL),
(122, 2, 31, 2, 31, '2022-03-10 15:39:01', NULL),
(123, 3, 31, 2, 31, '2022-03-10 15:39:01', NULL),
(124, 4, 31, 2, 31, '2022-03-10 15:39:01', NULL),
(125, 1, 32, 1, 32, '2022-03-11 16:31:46', NULL),
(126, 2, 32, 2, 32, '2022-03-11 16:31:46', NULL),
(127, 3, 32, 2, 32, '2022-03-11 16:31:46', NULL),
(128, 4, 32, 2, 32, '2022-03-11 16:31:46', NULL),
(129, 1, 33, 1, 33, '2022-03-11 17:25:45', NULL),
(130, 2, 33, 2, 33, '2022-03-11 17:25:45', NULL),
(131, 3, 33, 2, 33, '2022-03-11 17:25:45', NULL),
(132, 4, 33, 2, 33, '2022-03-11 17:25:45', NULL),
(135, 1, 34, 1, 34, '2022-03-11 17:26:21', NULL),
(136, 2, 34, 2, 34, '2022-03-11 17:26:22', NULL),
(137, 3, 34, 2, 34, '2022-03-11 17:26:22', NULL),
(138, 4, 34, 2, 34, '2022-03-11 17:26:22', NULL),
(141, 1, 35, 1, 35, '2022-03-25 14:38:58', NULL),
(142, 2, 35, 2, 35, '2022-03-25 14:38:58', NULL),
(143, 3, 35, 2, 35, '2022-03-25 14:38:58', NULL),
(144, 4, 35, 2, 35, '2022-03-25 14:38:58', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `paginas`
--

CREATE TABLE `paginas` (
  `id` int(11) NOT NULL,
  `endereco` varchar(120) NOT NULL,
  `nome_pagina` varchar(120) NOT NULL,
  `obs` text DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `paginas`
--

INSERT INTO `paginas` (`id`, `endereco`, `nome_pagina`, `obs`, `created`, `modified`) VALUES
(1, 'listar/list_pagina', 'Listar Página', 'Listar páginas do Sistema', '2022-03-08 10:41:15', '2022-03-09 08:59:57'),
(2, 'processa/proc_cad_pagina', 'Processo de Cadastro de Página', 'Processo de cadastro de página', '2022-03-08 10:57:36', '2022-03-09 07:54:44'),
(3, 'processa/proc_apagar_pagina', 'Processo de Apagar Página', 'Processo de exclusão de página', '2022-03-08 10:59:23', '2022-03-09 07:37:13'),
(4, 'processa/proc_sincronizar_pagina', 'Processo de Sincronia de Página', 'Processo de sincronia de páginas', '2022-03-08 11:14:12', '2022-03-09 07:34:47'),
(5, 'processa/proc_edit_pagina', 'Processo de Edição de Página', 'Processo de edição de página', '2022-03-08 11:22:43', '2022-03-09 07:34:43'),
(6, 'visualizar/configuracoes', 'Visualizar Configurações', 'Visualizar as configurações', '2022-03-09 08:02:51', NULL),
(7, 'listar/list_niv_acessos', 'Listar Níveis de Acessos', 'Listar níveis de acessos ao sistema', '2022-03-09 08:03:58', '2022-03-09 08:58:49'),
(8, 'processa/proc_cad_niv_acessos', 'Processo de Cadastro de Nível', 'Processo de cadastro de nível de acesso', '2022-03-09 08:44:31', '2022-03-09 09:42:23'),
(9, 'editar/edit_niv_acessos', 'Editar Nível de Acesso', 'Edição de nível de acesso', '2022-03-09 08:45:19', NULL),
(10, 'processa/proc_edit_niv_acessos', 'Processo de Edição de Nível de Acesso', 'Processo de edição de Nível de Acesso', '2022-03-09 08:46:23', NULL),
(11, 'processa/proc_apagar_niv_acessos', 'Processo de Apagar Nível de ACesso', 'Processo de exclusão de nível de acesso', '2022-03-09 08:47:17', NULL),
(12, 'listar/list_permissao', 'Listar Permissão', 'Listar permissão de acesso', '2022-03-09 08:49:54', NULL),
(13, 'processa/proc_ordem_niv_acessos', 'Processa a Ordem de Nível', 'Processa a ordem de nível de acesso', '2022-03-09 09:20:19', NULL),
(14, 'processa/proc_liberar_permissao', 'Processo de Liberar Permissão', 'Processo de liberar permissão a usuário', '2022-03-09 09:30:07', NULL),
(15, 'visualizar/ver_logos', 'Visualizar Logos', 'Visualizar os logos do sistema', '2022-03-09 11:24:06', NULL),
(16, 'processa/proc_edit_logos1', 'Processo de Editar Logos', 'Processo de edição de logo do sistema', '2022-03-09 11:31:42', NULL),
(17, 'processa/proc_edit_logos2', 'Processo de Editar Logo', 'Processo de edição de logo do sistema', '2022-03-09 11:35:21', NULL),
(18, 'visualizar/home_relatorio', 'Visualizar Relatórios na Home', 'Visualização de relatórios rápidos na home', '2022-03-09 11:47:50', NULL),
(19, 'visualizar/home', 'Visualizar a Home Page', 'Visualizar a home do sistema', '2022-03-09 11:49:27', NULL),
(20, 'editar/edit_perfil', 'Editar Perfil', 'Editar perfil de usuário', '2022-03-09 15:49:50', NULL),
(21, 'processa/proc_edit_perfil', 'Processo de Edição de Perfil', 'Processo de edição de perfil', '2022-03-09 15:50:29', NULL),
(22, 'editar/edit_senha', 'Editar Senha', 'Editar a senha do usuário', '2022-03-09 16:02:03', NULL),
(23, 'processa/proc_edit_foto', 'Processo de Edição de Foto', 'Processa a edição da foto', '2022-03-10 08:30:02', NULL),
(24, 'listar/list_usuarios', 'Listar Usuários', 'Listar usuários cadastrados no sitema', '2022-03-10 09:58:01', NULL),
(25, 'cadastrar/cad_usuarios', 'Cadastrar Usuários', 'Cadastrar usuários no sistema', '2022-03-10 10:00:23', NULL),
(26, 'editar/edit_usuarios', 'Editar Usuários', 'Editar usuários no sistema', '2022-03-10 10:01:51', NULL),
(27, 'processa/proc_apagar_usuarios', 'Processo de Apagar Usuários', 'Processa a exclusão de usuários', '2022-03-10 10:03:54', NULL),
(28, 'processa/proc_cad_usuarios', 'Processo de Cadastrar Usuários', 'Processo de cadastrar usuários no sistema', '2022-03-10 10:16:07', NULL),
(29, 'processa/proc_edit_usuarios', 'Processo de Editar Usuário', 'Processo de edição de usuário', '2022-03-10 10:34:58', '2022-03-10 15:20:45'),
(30, 'editar/edit_foto2', 'Editar Foto Usuário', 'Editar somente a foto do usuário', '2022-03-10 15:36:55', NULL),
(31, 'processa/proc_edit_foto2', 'Proceso de Edição de Foto Usuário', 'Processa a edição de foto do usuário', '2022-03-10 15:39:01', NULL),
(32, 'listar/list_clientes', 'Listar Clientes', 'Listar clientes do sistema', '2022-03-11 16:31:46', NULL),
(33, 'editar/edit_clientes', 'Editar Clientes', 'Editar clientes no sistema', '2022-03-11 17:25:45', NULL),
(34, 'processa/proc_apagar_clientes', 'Processo de Apagar Cliente', 'Processa a exclusão de cliente', '2022-03-11 17:26:21', NULL),
(35, 'processa/proc_cad_clientes', 'Processo de Cadastrar Clientes', 'Processo de cadastro de clientes no sistema', '2022-03-25 14:38:58', '2022-03-25 16:03:21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `situacoes_usuarios`
--

CREATE TABLE `situacoes_usuarios` (
  `id` int(11) NOT NULL,
  `nome_situacao` varchar(50) NOT NULL,
  `cor_situacao` varchar(20) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `situacoes_usuarios`
--

INSERT INTO `situacoes_usuarios` (`id`, `nome_situacao`, `cor_situacao`, `created`, `modified`) VALUES
(1, 'Ativo', 'success', '2017-04-21 00:00:00', NULL),
(2, 'Inativo', 'danger', '2017-05-24 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) NOT NULL,
  `email` varchar(220) NOT NULL,
  `usuario` varchar(220) NOT NULL,
  `senha` varchar(220) NOT NULL,
  `obs` text DEFAULT NULL,
  `recuperar_senha` varchar(220) DEFAULT NULL,
  `chave_descadastro` varchar(220) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `niveis_acesso_id` int(11) DEFAULT NULL,
  `situacoes_usuario_id` int(1) DEFAULT 1,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `usuario`, `senha`, `obs`, `recuperar_senha`, `chave_descadastro`, `foto`, `niveis_acesso_id`, `situacoes_usuario_id`, `created`, `modified`) VALUES
(1, 'Claudemir da Silva Lopes', 'claudemir.slopes@hotmail.com', 'claudemir', '$2y$10$eiGctERNISJWxpIM7BGtpucbxBgIoC0w4O6K.SGqF0AviYPwcBE9y', 'Claudemir é o desenvolvedor do site e é responsável por toda manutenção e atualização do mesmo.', '2dbd4b6f451138bd20a7228e63e7bba9', NULL, '1622326928532.png', 1, 1, '2017-07-23 00:00:00', '2022-03-11 08:08:37'),
(2, 'Eliane Rocha de Freitas Lopes', 'lifreitaslopes@gmail.com', 'eliane', '$2y$10$7z2Jgv.VCJ1dBo8dvpTbe.iUPsMQyrO9gX.rMQ6TGA6rFENx3/z3e', NULL, NULL, NULL, '1622327057853.png', 2, 1, '2022-03-01 11:18:38', '2022-03-01 11:35:50'),
(3, 'Luke Skywalker Lopes', 'luke@sky.com', 'lukesky', '$2y$10$r.aoiHEO3uWRyJa8zZYrpOpixF6CBtG.T3R7jEEsQnF6H/EEkksO6', 'Este usuário é o meu mascote de estimação, ele não tem raça definida, mas é o amor da minha vida e o símbolo da minha empresa.', NULL, NULL, 'img-20210423-wa0011.jpg', 3, 1, '2022-03-10 10:21:48', '2022-03-25 16:04:00');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Índices para tabela `logos`
--
ALTER TABLE `logos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `niveis_acessos`
--
ALTER TABLE `niveis_acessos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `niveis_acessos_paginas`
--
ALTER TABLE `niveis_acessos_paginas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK1_nacesso` (`niveis_acesso_id`),
  ADD KEY `FK2_apagina` (`pagina_id`);

--
-- Índices para tabela `paginas`
--
ALTER TABLE `paginas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `situacoes_usuarios`
--
ALTER TABLE `situacoes_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK1_nauser` (`niveis_acesso_id`),
  ADD KEY `FK2_situser` (`situacoes_usuario_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `logos`
--
ALTER TABLE `logos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `niveis_acessos`
--
ALTER TABLE `niveis_acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `niveis_acessos_paginas`
--
ALTER TABLE `niveis_acessos_paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT de tabela `paginas`
--
ALTER TABLE `paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `situacoes_usuarios`
--
ALTER TABLE `situacoes_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `niveis_acessos_paginas`
--
ALTER TABLE `niveis_acessos_paginas`
  ADD CONSTRAINT `FK2_apagina` FOREIGN KEY (`pagina_id`) REFERENCES `paginas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_niveis_acessos_paginas_niveis_acessos` FOREIGN KEY (`niveis_acesso_id`) REFERENCES `niveis_acessos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK1_nauser` FOREIGN KEY (`niveis_acesso_id`) REFERENCES `niveis_acessos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK2_situser` FOREIGN KEY (`situacoes_usuario_id`) REFERENCES `situacoes_usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
