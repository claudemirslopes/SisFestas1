-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Mar-2022 às 21:07
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
(1, 'Programador', 1, '2022-02-01 16:58:12', '2022-03-01 10:35:18'),
(2, 'Administrador', 2, '2022-02-01 16:58:27', '2022-02-28 17:06:03'),
(3, 'Colaborador', 3, '2022-02-01 16:58:36', '2022-02-28 17:06:10'),
(4, 'Estagiário', 4, '2022-02-19 12:22:50', '2022-02-28 17:07:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `niveis_acessos_paginas`
--

CREATE TABLE `niveis_acessos_paginas` (
  `id` int(11) NOT NULL,
  `niveis_acesso_id` int(11) NOT NULL,
  `pagina_id` int(11) NOT NULL,
  `permissao` int(11) NOT NULL,
  `menu` int(11) NOT NULL DEFAULT 2,
  `ordem` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `niveis_acessos_paginas`
--

INSERT INTO `niveis_acessos_paginas` (`id`, `niveis_acesso_id`, `pagina_id`, `permissao`, `menu`, `ordem`, `created`, `modified`) VALUES
(1, 1, 1, 1, 2, 1, '2022-02-18 22:13:08', '2022-02-19 12:28:18'),
(2, 1, 2, 1, 2, 2, '2022-02-18 22:13:24', '2022-02-19 12:28:18'),
(3, 1, 3, 1, 2, 3, '2022-02-18 22:13:40', '2022-02-19 10:03:44'),
(4, 1, 4, 1, 2, 4, '2022-02-19 09:48:27', '2022-02-19 10:03:47'),
(5, 1, 5, 1, 2, 5, '2022-02-19 09:48:41', '2022-02-19 10:03:50'),
(6, 1, 6, 1, 2, 6, '2022-02-19 09:52:43', '2022-02-19 10:03:52'),
(7, 1, 7, 1, 2, 7, '2022-02-19 09:52:54', '2022-02-19 10:03:55'),
(8, 1, 8, 1, 2, 8, '2022-02-19 09:53:03', '2022-02-19 10:03:59'),
(9, 1, 9, 1, 2, 9, '2022-02-19 09:53:16', '2022-02-19 10:04:01'),
(10, 1, 10, 1, 2, 10, '2022-02-19 10:00:37', '2022-02-19 10:04:04'),
(11, 1, 11, 1, 2, 11, '2022-02-19 10:00:48', '2022-02-19 10:04:07'),
(12, 1, 12, 1, 2, 12, '2022-02-19 10:00:58', '2022-02-19 10:04:11'),
(13, 1, 13, 1, 2, 13, '2022-02-19 10:01:21', '2022-02-19 10:04:14'),
(14, 1, 14, 1, 2, 14, '2022-02-19 10:01:38', '2022-02-19 10:04:16'),
(15, 1, 15, 1, 2, 15, '2022-02-19 11:21:06', NULL),
(16, 1, 16, 1, 2, 16, '2022-02-19 11:23:33', NULL),
(17, 1, 17, 1, 2, 17, '2022-02-19 11:27:35', NULL),
(18, 1, 18, 1, 2, 18, '2022-02-19 11:38:43', NULL),
(19, 1, 19, 1, 2, 19, '2022-02-19 11:59:02', NULL),
(20, 1, 20, 1, 2, 20, '2022-02-19 12:27:21', NULL),
(21, 1, 21, 1, 2, 21, '2022-02-19 12:27:30', NULL),
(22, 1, 22, 1, 2, 22, '2022-02-19 12:27:40', NULL),
(23, 1, 23, 1, 2, 23, '2022-02-19 12:30:26', NULL),
(24, 1, 24, 1, 2, 24, '2022-02-19 12:46:37', NULL),
(25, 1, 25, 1, 2, 25, '2022-02-19 12:51:15', NULL),
(26, 2, 25, 1, 2, 1, '2022-02-19 12:51:15', '2022-02-21 08:08:08'),
(27, 3, 25, 1, 2, 1, '2022-02-19 12:51:15', '2022-02-21 08:15:25'),
(28, 4, 25, 2, 2, 1, '2022-02-19 12:51:15', NULL),
(29, 2, 1, 1, 2, 2, '2022-02-19 12:53:02', '2022-02-21 08:08:14'),
(30, 2, 2, 1, 2, 3, '2022-02-19 12:53:02', '2022-02-21 08:08:18'),
(31, 2, 3, 1, 2, 4, '2022-02-19 12:53:03', '2022-02-21 08:08:23'),
(32, 2, 4, 2, 2, 5, '2022-02-19 12:53:03', NULL),
(33, 2, 5, 1, 2, 6, '2022-02-19 12:53:03', '2022-02-21 08:48:46'),
(34, 2, 6, 2, 2, 7, '2022-02-19 12:53:03', NULL),
(35, 2, 7, 2, 2, 8, '2022-02-19 12:53:03', NULL),
(36, 2, 8, 2, 2, 9, '2022-02-19 12:53:03', NULL),
(37, 2, 9, 2, 2, 10, '2022-02-19 12:53:03', NULL),
(38, 2, 10, 2, 2, 11, '2022-02-19 12:53:03', NULL),
(39, 2, 11, 2, 2, 12, '2022-02-19 12:53:03', NULL),
(40, 2, 12, 2, 2, 13, '2022-02-19 12:53:03', NULL),
(41, 2, 13, 1, 2, 14, '2022-02-19 12:53:03', '2022-02-21 08:49:00'),
(42, 2, 14, 2, 2, 15, '2022-02-19 12:53:03', NULL),
(43, 2, 15, 1, 2, 16, '2022-02-19 12:53:03', '2022-02-21 08:09:02'),
(44, 2, 16, 1, 2, 17, '2022-02-19 12:53:03', '2022-02-21 08:09:09'),
(45, 2, 17, 1, 2, 18, '2022-02-19 12:53:03', '2022-02-21 08:09:16'),
(46, 2, 18, 2, 2, 19, '2022-02-19 12:53:03', NULL),
(47, 2, 19, 2, 2, 20, '2022-02-19 12:53:03', NULL),
(48, 2, 20, 2, 2, 21, '2022-02-19 12:53:03', NULL),
(49, 2, 21, 2, 2, 22, '2022-02-19 12:53:03', NULL),
(50, 2, 22, 2, 2, 23, '2022-02-19 12:53:03', NULL),
(51, 2, 23, 1, 2, 24, '2022-02-19 12:53:03', '2022-02-21 08:49:10'),
(52, 2, 24, 2, 2, 25, '2022-02-19 12:53:04', NULL),
(53, 3, 1, 1, 2, 2, '2022-02-19 12:53:04', '2022-02-21 08:15:33'),
(54, 3, 2, 1, 2, 3, '2022-02-19 12:53:04', '2022-02-21 08:15:36'),
(55, 3, 3, 2, 2, 4, '2022-02-19 12:53:04', NULL),
(56, 3, 4, 2, 2, 5, '2022-02-19 12:53:04', NULL),
(57, 3, 5, 2, 2, 6, '2022-02-19 12:53:04', NULL),
(58, 3, 6, 2, 2, 7, '2022-02-19 12:53:04', NULL),
(59, 3, 7, 2, 2, 8, '2022-02-19 12:53:04', NULL),
(60, 3, 8, 2, 2, 9, '2022-02-19 12:53:04', NULL),
(61, 3, 9, 2, 2, 10, '2022-02-19 12:53:04', NULL),
(62, 3, 10, 2, 2, 11, '2022-02-19 12:53:04', NULL),
(63, 3, 11, 2, 2, 12, '2022-02-19 12:53:04', NULL),
(64, 3, 12, 2, 2, 13, '2022-02-19 12:53:04', NULL),
(65, 3, 13, 2, 2, 14, '2022-02-19 12:53:04', NULL),
(66, 3, 14, 2, 2, 15, '2022-02-19 12:53:04', NULL),
(67, 3, 15, 1, 2, 16, '2022-02-19 12:53:04', '2022-02-21 08:16:04'),
(68, 3, 16, 1, 2, 17, '2022-02-19 12:53:04', '2022-02-21 08:16:08'),
(69, 3, 17, 1, 2, 18, '2022-02-19 12:53:04', '2022-02-21 08:16:13'),
(70, 3, 18, 2, 2, 19, '2022-02-19 12:53:04', NULL),
(71, 3, 19, 2, 2, 20, '2022-02-19 12:53:04', NULL),
(72, 3, 20, 2, 2, 21, '2022-02-19 12:53:04', NULL),
(73, 3, 21, 2, 2, 22, '2022-02-19 12:53:04', NULL),
(74, 3, 22, 2, 2, 23, '2022-02-19 12:53:04', NULL),
(75, 3, 23, 2, 2, 24, '2022-02-19 12:53:04', NULL),
(76, 3, 24, 2, 2, 25, '2022-02-19 12:53:04', NULL),
(77, 4, 1, 1, 2, 2, '2022-02-19 12:53:05', '2022-02-21 08:20:51'),
(78, 4, 2, 1, 2, 3, '2022-02-19 12:53:05', '2022-02-21 08:20:54'),
(79, 4, 3, 2, 2, 4, '2022-02-19 12:53:05', NULL),
(80, 4, 4, 2, 2, 5, '2022-02-19 12:53:05', NULL),
(81, 4, 5, 2, 2, 6, '2022-02-19 12:53:05', NULL),
(82, 4, 6, 2, 2, 7, '2022-02-19 12:53:05', NULL),
(83, 4, 7, 2, 2, 8, '2022-02-19 12:53:05', NULL),
(84, 4, 8, 2, 2, 9, '2022-02-19 12:53:05', NULL),
(85, 4, 9, 2, 2, 10, '2022-02-19 12:53:05', NULL),
(86, 4, 10, 2, 2, 11, '2022-02-19 12:53:05', NULL),
(87, 4, 11, 2, 2, 12, '2022-02-19 12:53:05', NULL),
(88, 4, 12, 2, 2, 13, '2022-02-19 12:53:05', NULL),
(89, 4, 13, 2, 2, 14, '2022-02-19 12:53:05', NULL),
(90, 4, 14, 2, 2, 15, '2022-02-19 12:53:05', NULL),
(91, 4, 15, 1, 2, 16, '2022-02-19 12:53:05', '2022-02-21 08:21:11'),
(92, 4, 16, 1, 2, 17, '2022-02-19 12:53:05', '2022-02-21 08:21:17'),
(93, 4, 17, 1, 2, 18, '2022-02-19 12:53:05', '2022-02-21 08:21:21'),
(94, 4, 18, 2, 2, 19, '2022-02-19 12:53:05', NULL),
(95, 4, 19, 2, 2, 20, '2022-02-19 12:53:05', NULL),
(96, 4, 20, 2, 2, 21, '2022-02-19 12:53:05', NULL),
(97, 4, 21, 2, 2, 22, '2022-02-19 12:53:05', NULL),
(98, 4, 22, 2, 2, 23, '2022-02-19 12:53:05', NULL),
(99, 4, 23, 2, 2, 24, '2022-02-19 12:53:05', NULL),
(100, 4, 24, 2, 2, 25, '2022-02-19 12:53:06', NULL),
(101, 1, 26, 1, 2, 26, '2022-02-19 13:07:52', NULL),
(102, 2, 26, 2, 2, 26, '2022-02-19 13:07:52', NULL),
(103, 3, 26, 2, 2, 26, '2022-02-19 13:07:52', NULL),
(104, 4, 26, 2, 2, 26, '2022-02-19 13:07:52', NULL),
(105, 1, 27, 1, 2, 27, '2022-02-19 13:22:28', NULL),
(106, 2, 27, 2, 2, 27, '2022-02-19 13:22:28', NULL),
(107, 3, 27, 2, 2, 27, '2022-02-19 13:22:28', NULL),
(108, 4, 27, 2, 2, 27, '2022-02-19 13:22:28', NULL),
(109, 1, 28, 1, 2, 28, '2022-02-19 16:11:08', NULL),
(110, 2, 28, 1, 2, 28, '2022-02-19 16:11:08', '2022-02-21 08:10:02'),
(111, 3, 28, 1, 2, 28, '2022-02-19 16:11:08', '2022-02-21 09:15:00'),
(112, 4, 28, 2, 2, 28, '2022-02-19 16:11:08', NULL),
(113, 1, 29, 1, 2, 29, '2022-02-19 16:12:33', NULL),
(114, 2, 29, 1, 2, 29, '2022-02-19 16:12:33', '2022-02-21 08:10:10'),
(115, 3, 29, 1, 2, 29, '2022-02-19 16:12:33', '2022-02-21 09:15:05'),
(116, 4, 29, 2, 2, 29, '2022-02-19 16:12:33', NULL),
(117, 1, 30, 1, 2, 30, '2022-02-19 16:14:30', NULL),
(118, 2, 30, 1, 2, 30, '2022-02-19 16:14:30', '2022-02-21 08:10:19'),
(119, 3, 30, 1, 2, 30, '2022-02-19 16:14:30', '2022-02-21 08:17:24'),
(120, 4, 30, 2, 2, 30, '2022-02-19 16:14:30', NULL),
(121, 1, 31, 1, 2, 31, '2022-02-19 16:16:36', NULL),
(122, 2, 31, 1, 2, 31, '2022-02-19 16:16:36', '2022-02-21 08:41:27'),
(123, 3, 31, 1, 2, 31, '2022-02-19 16:16:36', '2022-02-21 09:15:36'),
(124, 4, 31, 2, 2, 31, '2022-02-19 16:16:36', NULL),
(125, 1, 32, 1, 2, 32, '2022-02-19 16:26:14', NULL),
(126, 2, 32, 1, 2, 32, '2022-02-19 16:26:14', '2022-02-21 08:10:30'),
(127, 3, 32, 1, 2, 32, '2022-02-19 16:26:14', '2022-02-21 09:15:23'),
(128, 4, 32, 2, 2, 32, '2022-02-19 16:26:14', NULL),
(129, 1, 33, 1, 2, 33, '2022-02-19 16:37:25', NULL),
(130, 2, 33, 1, 2, 33, '2022-02-19 16:37:25', '2022-02-21 08:10:35'),
(131, 3, 33, 1, 2, 33, '2022-02-19 16:37:25', '2022-02-21 09:15:27'),
(132, 4, 33, 2, 2, 33, '2022-02-19 16:37:25', NULL),
(133, 1, 34, 1, 2, 34, '2022-02-19 16:44:21', NULL),
(134, 2, 34, 1, 2, 34, '2022-02-19 16:44:21', '2022-02-21 08:10:40'),
(135, 3, 34, 1, 2, 34, '2022-02-19 16:44:21', '2022-02-21 08:17:38'),
(136, 4, 34, 1, 2, 34, '2022-02-19 16:44:21', '2022-02-21 08:21:59'),
(137, 1, 35, 1, 2, 35, '2022-02-19 16:45:31', NULL),
(138, 2, 35, 1, 2, 35, '2022-02-19 16:45:31', '2022-02-21 08:10:48'),
(139, 3, 35, 1, 2, 35, '2022-02-19 16:45:31', '2022-02-21 08:17:46'),
(140, 4, 35, 1, 2, 35, '2022-02-19 16:45:31', '2022-02-21 08:22:03'),
(141, 1, 36, 1, 2, 36, '2022-02-19 16:59:12', NULL),
(142, 2, 36, 1, 2, 36, '2022-02-19 16:59:12', '2022-02-21 08:10:56'),
(143, 3, 36, 1, 2, 36, '2022-02-19 16:59:12', '2022-02-21 08:17:51'),
(144, 4, 36, 1, 2, 36, '2022-02-19 16:59:13', '2022-02-21 08:22:10'),
(145, 1, 37, 1, 2, 37, '2022-02-19 16:59:47', NULL),
(146, 2, 37, 1, 2, 37, '2022-02-19 16:59:47', '2022-02-21 08:11:01'),
(147, 3, 37, 1, 2, 37, '2022-02-19 16:59:47', '2022-02-21 08:17:55'),
(148, 4, 37, 1, 2, 37, '2022-02-19 16:59:47', '2022-02-21 08:22:14'),
(149, 1, 38, 1, 2, 38, '2022-02-19 17:00:28', NULL),
(150, 2, 38, 1, 2, 38, '2022-02-19 17:00:28', '2022-02-21 08:11:10'),
(151, 3, 38, 1, 2, 38, '2022-02-19 17:00:28', '2022-02-21 08:18:01'),
(152, 4, 38, 1, 2, 38, '2022-02-19 17:00:28', '2022-02-21 08:22:18'),
(153, 1, 39, 1, 2, 39, '2022-02-19 17:01:08', NULL),
(154, 2, 39, 1, 2, 39, '2022-02-19 17:01:08', '2022-02-21 08:11:13'),
(155, 3, 39, 1, 2, 39, '2022-02-19 17:01:08', '2022-02-21 08:18:09'),
(156, 4, 39, 1, 2, 39, '2022-02-19 17:01:08', '2022-02-21 08:22:22'),
(157, 1, 40, 1, 2, 40, '2022-02-19 17:01:57', NULL),
(158, 2, 40, 1, 2, 40, '2022-02-19 17:01:57', '2022-02-21 08:11:19'),
(159, 3, 40, 1, 2, 40, '2022-02-19 17:01:57', '2022-02-21 08:18:13'),
(160, 4, 40, 1, 2, 40, '2022-02-19 17:01:57', '2022-02-21 08:22:25'),
(161, 1, 41, 1, 2, 41, '2022-02-19 17:02:31', NULL),
(162, 2, 41, 1, 2, 41, '2022-02-19 17:02:31', '2022-02-21 08:11:23'),
(163, 3, 41, 1, 2, 41, '2022-02-19 17:02:31', '2022-02-21 08:18:19'),
(164, 4, 41, 1, 2, 41, '2022-02-19 17:02:31', '2022-02-21 08:22:34'),
(165, 1, 42, 1, 2, 42, '2022-02-19 17:03:12', NULL),
(166, 2, 42, 1, 2, 42, '2022-02-19 17:03:12', '2022-02-21 08:11:32'),
(167, 3, 42, 1, 2, 42, '2022-02-19 17:03:12', '2022-02-21 08:18:24'),
(168, 4, 42, 1, 2, 42, '2022-02-19 17:03:12', '2022-02-21 08:22:38'),
(169, 1, 43, 1, 2, 43, '2022-02-19 17:03:42', NULL),
(170, 2, 43, 1, 2, 43, '2022-02-19 17:03:42', '2022-02-21 08:11:36'),
(171, 3, 43, 1, 2, 43, '2022-02-19 17:03:42', '2022-02-21 08:18:29'),
(172, 4, 43, 1, 2, 43, '2022-02-19 17:03:42', '2022-02-21 08:22:44'),
(173, 1, 44, 1, 2, 44, '2022-02-19 17:11:42', NULL),
(174, 2, 44, 2, 2, 44, '2022-02-19 17:11:42', '2022-02-21 08:11:48'),
(175, 3, 44, 2, 2, 44, '2022-02-19 17:11:42', NULL),
(176, 4, 44, 2, 2, 44, '2022-02-19 17:11:42', NULL),
(177, 1, 45, 1, 2, 45, '2022-02-19 17:12:26', NULL),
(178, 2, 45, 1, 2, 45, '2022-02-19 17:12:26', '2022-02-21 08:11:57'),
(179, 3, 45, 2, 2, 45, '2022-02-19 17:12:26', NULL),
(180, 4, 45, 2, 2, 45, '2022-02-19 17:12:26', NULL),
(181, 1, 46, 1, 2, 46, '2022-02-19 17:19:09', NULL),
(182, 2, 46, 2, 2, 46, '2022-02-19 17:19:09', NULL),
(183, 3, 46, 2, 2, 46, '2022-02-19 17:19:09', NULL),
(184, 4, 46, 2, 2, 46, '2022-02-19 17:19:09', NULL),
(185, 1, 47, 1, 2, 47, '2022-02-19 17:42:27', NULL),
(186, 2, 47, 1, 2, 47, '2022-02-19 17:42:27', '2022-02-21 08:12:04'),
(187, 3, 47, 2, 2, 47, '2022-02-19 17:42:27', NULL),
(188, 4, 47, 2, 2, 47, '2022-02-19 17:42:27', NULL),
(189, 1, 48, 1, 2, 48, '2022-02-19 20:19:42', NULL),
(190, 2, 48, 2, 2, 48, '2022-02-19 20:19:42', NULL),
(191, 3, 48, 2, 2, 48, '2022-02-19 20:19:42', NULL),
(192, 4, 48, 2, 2, 48, '2022-02-19 20:19:42', NULL),
(193, 1, 49, 1, 2, 49, '2022-02-19 20:20:37', NULL),
(194, 2, 49, 1, 2, 49, '2022-02-19 20:20:37', '2022-02-21 08:12:13'),
(195, 3, 49, 2, 2, 49, '2022-02-19 20:20:37', NULL),
(196, 4, 49, 2, 2, 49, '2022-02-19 20:20:37', NULL),
(197, 1, 50, 1, 2, 50, '2022-02-19 20:24:54', NULL),
(198, 2, 50, 2, 2, 50, '2022-02-19 20:24:54', NULL),
(199, 3, 50, 2, 2, 50, '2022-02-19 20:24:54', NULL),
(200, 4, 50, 2, 2, 50, '2022-02-19 20:24:54', NULL),
(201, 1, 51, 1, 2, 51, '2022-02-19 21:09:49', NULL),
(202, 2, 51, 1, 2, 51, '2022-02-19 21:09:49', '2022-02-21 08:12:21'),
(203, 3, 51, 2, 2, 51, '2022-02-19 21:09:49', NULL),
(204, 4, 51, 2, 2, 51, '2022-02-19 21:09:49', NULL),
(205, 1, 52, 1, 2, 52, '2022-02-20 10:19:31', NULL),
(206, 2, 52, 2, 2, 52, '2022-02-20 10:19:31', NULL),
(207, 3, 52, 2, 2, 52, '2022-02-20 10:19:31', NULL),
(208, 4, 52, 2, 2, 52, '2022-02-20 10:19:31', NULL),
(209, 1, 53, 1, 2, 53, '2022-02-20 10:27:17', NULL),
(210, 2, 53, 1, 2, 53, '2022-02-20 10:27:17', '2022-02-21 08:12:41'),
(211, 3, 53, 2, 2, 53, '2022-02-20 10:27:17', NULL),
(212, 4, 53, 2, 2, 53, '2022-02-20 10:27:17', NULL),
(213, 1, 54, 1, 2, 54, '2022-02-20 10:29:10', NULL),
(214, 2, 54, 2, 2, 54, '2022-02-20 10:29:11', NULL),
(215, 3, 54, 2, 2, 54, '2022-02-20 10:29:11', NULL),
(216, 4, 54, 2, 2, 54, '2022-02-20 10:29:11', NULL),
(217, 1, 55, 1, 2, 55, '2022-02-20 10:32:39', NULL),
(218, 2, 55, 2, 2, 55, '2022-02-20 10:32:39', NULL),
(219, 3, 55, 2, 2, 55, '2022-02-20 10:32:39', NULL),
(220, 4, 55, 2, 2, 55, '2022-02-20 10:32:39', NULL),
(221, 1, 56, 1, 2, 56, '2022-02-20 10:59:50', NULL),
(222, 2, 56, 1, 2, 56, '2022-02-20 10:59:50', '2022-02-21 08:12:51'),
(223, 3, 56, 2, 2, 56, '2022-02-20 10:59:50', NULL),
(224, 4, 56, 2, 2, 56, '2022-02-20 10:59:50', NULL),
(225, 1, 57, 1, 2, 57, '2022-02-20 12:00:32', NULL),
(226, 2, 57, 2, 2, 57, '2022-02-20 12:00:32', NULL),
(227, 3, 57, 2, 2, 57, '2022-02-20 12:00:32', NULL),
(228, 4, 57, 2, 2, 57, '2022-02-20 12:00:32', NULL),
(229, 1, 58, 1, 2, 58, '2022-02-20 12:02:12', NULL),
(230, 2, 58, 1, 2, 58, '2022-02-20 12:02:12', '2022-02-21 08:13:00'),
(231, 3, 58, 2, 2, 58, '2022-02-20 12:02:12', NULL),
(232, 4, 58, 2, 2, 58, '2022-02-20 12:02:12', NULL),
(233, 1, 59, 1, 2, 59, '2022-02-20 12:10:31', NULL),
(234, 2, 59, 2, 2, 59, '2022-02-20 12:10:31', NULL),
(235, 3, 59, 2, 2, 59, '2022-02-20 12:10:31', NULL),
(236, 4, 59, 2, 2, 59, '2022-02-20 12:10:31', NULL),
(237, 1, 60, 1, 2, 60, '2022-02-20 12:35:56', NULL),
(238, 2, 60, 1, 2, 60, '2022-02-20 12:35:56', '2022-02-21 08:13:19'),
(239, 3, 60, 2, 2, 60, '2022-02-20 12:35:56', NULL),
(240, 4, 60, 2, 2, 60, '2022-02-20 12:35:56', NULL),
(241, 1, 61, 1, 2, 61, '2022-02-20 12:38:57', NULL),
(242, 2, 61, 1, 2, 61, '2022-02-20 12:38:57', '2022-02-21 08:13:28'),
(243, 3, 61, 2, 2, 61, '2022-02-20 12:38:57', NULL),
(244, 4, 61, 2, 2, 61, '2022-02-20 12:38:57', NULL),
(245, 1, 62, 1, 2, 62, '2022-02-20 15:30:17', NULL),
(246, 2, 62, 1, 2, 62, '2022-02-20 15:30:17', '2022-02-21 08:13:34'),
(247, 3, 62, 2, 2, 62, '2022-02-20 15:30:17', NULL),
(248, 4, 62, 2, 2, 62, '2022-02-20 15:30:17', NULL),
(249, 1, 63, 1, 2, 63, '2022-02-20 15:30:57', NULL),
(250, 2, 63, 2, 2, 63, '2022-02-20 15:30:57', NULL),
(251, 3, 63, 2, 2, 63, '2022-02-20 15:30:58', NULL),
(252, 4, 63, 2, 2, 63, '2022-02-20 15:30:58', NULL),
(253, 1, 64, 1, 2, 64, '2022-02-20 15:31:40', NULL),
(254, 2, 64, 2, 2, 64, '2022-02-20 15:31:40', NULL),
(255, 3, 64, 2, 2, 64, '2022-02-20 15:31:40', NULL),
(256, 4, 64, 2, 2, 64, '2022-02-20 15:31:40', NULL),
(257, 1, 65, 1, 2, 65, '2022-02-20 15:32:13', NULL),
(258, 2, 65, 1, 2, 65, '2022-02-20 15:32:13', '2022-02-21 08:13:44'),
(259, 3, 65, 2, 2, 65, '2022-02-20 15:32:13', NULL),
(260, 4, 65, 2, 2, 65, '2022-02-20 15:32:13', NULL),
(261, 1, 66, 1, 2, 66, '2022-02-20 15:32:49', NULL),
(262, 2, 66, 2, 2, 66, '2022-02-20 15:32:49', NULL),
(263, 3, 66, 2, 2, 66, '2022-02-20 15:32:49', NULL),
(264, 4, 66, 2, 2, 66, '2022-02-20 15:32:49', NULL),
(265, 1, 67, 1, 2, 67, '2022-02-20 16:06:01', NULL),
(266, 2, 67, 2, 2, 67, '2022-02-20 16:06:01', NULL),
(267, 3, 67, 2, 2, 67, '2022-02-20 16:06:01', NULL),
(268, 4, 67, 2, 2, 67, '2022-02-20 16:06:02', NULL),
(269, 1, 68, 1, 2, 68, '2022-02-20 16:06:41', NULL),
(270, 2, 68, 1, 2, 68, '2022-02-20 16:06:41', '2022-02-21 08:13:59'),
(271, 3, 68, 2, 2, 68, '2022-02-20 16:06:41', NULL),
(272, 4, 68, 2, 2, 68, '2022-02-20 16:06:41', NULL),
(273, 1, 69, 1, 2, 69, '2022-02-20 16:11:10', NULL),
(274, 2, 69, 2, 2, 69, '2022-02-20 16:11:10', NULL),
(275, 3, 69, 2, 2, 69, '2022-02-20 16:11:10', NULL),
(276, 4, 69, 2, 2, 69, '2022-02-20 16:11:10', NULL),
(277, 1, 70, 1, 2, 70, '2022-02-20 16:11:38', NULL),
(278, 2, 70, 1, 2, 70, '2022-02-20 16:11:38', '2022-02-21 08:14:06'),
(279, 3, 70, 2, 2, 70, '2022-02-20 16:11:38', NULL),
(280, 4, 70, 2, 2, 70, '2022-02-20 16:11:38', NULL),
(281, 1, 71, 1, 2, 71, '2022-02-20 16:43:15', NULL),
(282, 2, 71, 1, 2, 71, '2022-02-20 16:43:16', '2022-02-21 08:14:24'),
(283, 3, 71, 2, 2, 71, '2022-02-20 16:43:16', NULL),
(284, 4, 71, 2, 2, 71, '2022-02-20 16:43:16', NULL),
(285, 1, 72, 1, 2, 72, '2022-02-20 16:44:00', NULL),
(286, 2, 72, 1, 2, 72, '2022-02-20 16:44:00', '2022-02-21 08:14:17'),
(287, 3, 72, 2, 2, 72, '2022-02-20 16:44:00', NULL),
(288, 4, 72, 2, 2, 72, '2022-02-20 16:44:00', NULL),
(289, 1, 73, 1, 2, 73, '2022-02-20 16:44:36', NULL),
(290, 2, 73, 1, 2, 73, '2022-02-20 16:44:36', '2022-02-21 08:14:29'),
(291, 3, 73, 2, 2, 73, '2022-02-20 16:44:36', NULL),
(292, 4, 73, 2, 2, 73, '2022-02-20 16:44:36', NULL),
(293, 1, 74, 1, 2, 74, '2022-02-20 16:50:08', NULL),
(294, 2, 74, 1, 2, 74, '2022-02-20 16:50:08', '2022-02-21 08:14:34'),
(295, 3, 74, 2, 2, 74, '2022-02-20 16:50:08', NULL),
(296, 4, 74, 2, 2, 74, '2022-02-20 16:50:08', NULL),
(297, 1, 75, 1, 2, 75, '2022-02-20 16:50:44', NULL),
(298, 2, 75, 1, 2, 75, '2022-02-20 16:50:44', '2022-02-21 08:14:40'),
(299, 3, 75, 2, 2, 75, '2022-02-20 16:50:44', NULL),
(300, 4, 75, 2, 2, 75, '2022-02-20 16:50:44', NULL),
(301, 1, 76, 1, 2, 76, '2022-02-20 17:04:15', NULL),
(302, 2, 76, 1, 2, 76, '2022-02-20 17:04:15', '2022-02-21 08:14:44'),
(303, 3, 76, 2, 2, 76, '2022-02-20 17:04:15', NULL),
(304, 4, 76, 2, 2, 76, '2022-02-20 17:04:15', NULL),
(305, 1, 77, 1, 2, 77, '2022-02-20 17:04:50', NULL),
(306, 2, 77, 1, 2, 77, '2022-02-20 17:04:51', '2022-02-21 08:14:48'),
(307, 3, 77, 1, 2, 77, '2022-02-20 17:04:51', '2022-02-21 08:19:50'),
(308, 4, 77, 2, 2, 77, '2022-02-20 17:04:51', NULL),
(309, 1, 78, 1, 2, 78, '2022-02-20 17:05:28', NULL),
(310, 2, 78, 1, 2, 78, '2022-02-20 17:05:28', '2022-02-21 08:14:52'),
(311, 3, 78, 1, 2, 78, '2022-02-20 17:05:28', '2022-02-21 08:19:35'),
(312, 4, 78, 2, 2, 78, '2022-02-20 17:05:28', NULL),
(313, 1, 79, 1, 2, 79, '2022-02-20 17:06:15', NULL),
(314, 2, 79, 1, 2, 79, '2022-02-20 17:06:15', '2022-02-21 08:14:57'),
(315, 3, 79, 1, 2, 79, '2022-02-20 17:06:15', '2022-02-21 08:19:40'),
(316, 4, 79, 2, 2, 79, '2022-02-20 17:06:15', NULL),
(317, 1, 80, 1, 2, 80, '2022-02-20 17:06:56', NULL),
(318, 2, 80, 1, 2, 80, '2022-02-20 17:06:56', '2022-02-21 08:15:00'),
(319, 3, 80, 1, 2, 80, '2022-02-20 17:06:56', '2022-02-21 08:19:45'),
(320, 4, 80, 2, 2, 80, '2022-02-20 17:06:56', NULL);

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
(1, 'visualizar/home', 'Home', 'Página Incial', '2022-02-18 22:10:52', '2022-03-01 10:16:26'),
(2, 'visualizar/home_relatorio', 'Relatórios', 'Página de Relatórios', '2022-02-18 22:11:56', NULL),
(3, 'visualizar/configuracoes', 'Configurações', 'Página de configurações', '2022-02-18 22:12:42', NULL),
(4, 'listar/list_pagina', 'Listar Páginas', 'Lista as páginas do sistema', '2022-02-19 09:46:42', '2022-02-19 09:47:02'),
(5, 'listar/list_niv_acessos', 'Listar Níveis de caessos', 'Lista níveis de acessos', '2022-02-19 09:48:04', NULL),
(6, 'cadastrar/cad_pagina', 'Cadastro de Página', 'Cadatra novas páginas', '2022-02-19 09:50:06', NULL),
(7, 'processa/proc_sincronizar_pagina', 'Processar Cadatro de Páginas', 'Processo de cadastro de nova página', '2022-02-19 09:50:51', NULL),
(8, 'editar/edit_pagina', 'Editar Página', 'Edição de página', '2022-02-19 09:51:23', NULL),
(9, 'visualizar/ver_pagina', 'Visualizar Página', 'Visualização de páginas', '2022-02-19 09:51:56', NULL),
(10, 'cadastrar/cad_niv_acessos', 'Cadastrar Nível de Acesso', 'Cadastra mais níveis de acessos', '2022-02-19 09:56:12', '2022-02-19 09:57:32'),
(11, 'listar/list_permissao', 'Listar Nível de Permissão', 'Lista os níveis de permissão', '2022-02-19 09:57:19', NULL),
(12, 'editar/edit_niv_acessos', 'Editar Nível de Acesso', 'Edita o nível de acesso', '2022-02-19 09:58:20', NULL),
(13, 'visualizar/ver_niv_acessos', 'Ver Nível de Acesso', 'Visualiza o nível de acesso', '2022-02-19 09:59:04', NULL),
(14, 'processa/proc_apagar_niv_acessos', 'Processar Esclusão de Nível', 'Processo de exclusão de nível de acesso', '2022-02-19 10:00:00', NULL),
(15, 'visualizar/perfil', 'Meu Perfil', 'Página do perfil de usuário', '2022-02-19 11:20:48', NULL),
(16, 'editar/edit_perfil', 'Editar Perfil', 'Editar perfil do usuário', '2022-02-19 11:23:06', NULL),
(17, 'editar/edit_senha', 'Editar Senha', 'Editar a senha do usuário', '2022-02-19 11:27:19', NULL),
(18, 'processa/proc_cad_niv_acessos', 'Processo de Cadastro de Nível', 'Processo de cadastro de nível', '2022-02-19 11:37:53', '2022-02-19 11:58:43'),
(19, 'processa/proc_edit_niv_acessos', 'Processo de Edição de Nível', 'Processo de edição de nível de acesso', '2022-02-19 11:58:33', NULL),
(20, 'processa/proc_liberar_menu', 'Pocesso de Libera Menu', 'Processo de liberar menu', '2022-02-19 12:25:30', NULL),
(21, 'processa/proc_liberar_permissao', 'Processo de Libera Permissão', 'Processo de liberar permissão', '2022-02-19 12:26:13', NULL),
(22, 'processa/proc_ordem_menu', 'Processo de Ordem Menu', 'Processo de ordem de menu', '2022-02-19 12:27:01', NULL),
(23, 'processa/proc_ordem_niv_acessos', 'Processo de Ordem Nível', 'Processo de ordem de nível de acesso', '2022-02-19 12:30:12', NULL),
(24, 'processa/proc_cad_pagina', 'Processo de Cadastro de Página', 'Processo de cadastro de página', '2022-02-19 12:46:24', NULL),
(25, 'listar/list_usuarios', 'Listar usuários do sistema', 'Listar usuários do sistema', '2022-02-19 12:51:15', '2022-02-19 13:09:13'),
(26, 'processa/proc_edit_pagina', 'Processo de Edição de Página', 'Processo de edição de página', '2022-02-19 13:07:52', '2022-02-19 13:21:33'),
(27, 'processa/proc_apagar_pagina', 'Processo de Apagar Página', 'Processo de exclusão de página', '2022-02-19 13:22:27', NULL),
(28, 'cadastrar/cad_usuarios', 'Cadastrar Usuário', 'Cadastrar usuários no sistema', '2022-02-19 16:11:08', NULL),
(29, 'editar/edit_usuarios', 'Editar Usuário', 'Editar usuário no sistema', '2022-02-19 16:12:32', NULL),
(30, 'visualizar/ver_usuarios', 'Ver Usuário', 'Visualizar usuários no sistema', '2022-02-19 16:14:29', NULL),
(31, 'processa/proc_apagar_usuarios', 'Processo de Apagar Usuário', 'Processo de exclusão de uuário', '2022-02-19 16:16:36', NULL),
(32, 'processa/proc_cad_usuarios', 'Processo de Cadastro de Usuários', 'Processo de cadastro de usuários', '2022-02-19 16:26:14', '2022-02-19 16:32:23'),
(33, 'processa/proc_edit_usuarios', 'Processo de Edição de Usuário', 'Processa a edição de usuários', '2022-02-19 16:37:25', NULL),
(34, 'processa/proc_edit_perfil', 'Processo de Edição de Perfil', 'Processo de edição de perfil', '2022-02-19 16:44:21', NULL),
(35, 'processa/proc_edit_senha', 'Processo de Edição de Senha', 'Processo de edição de senha', '2022-02-19 16:45:31', NULL),
(36, 'listar/list_homepage', 'Listar Home Page', 'Listar Home Page do Site', '2022-02-19 16:59:12', NULL),
(37, 'listar/list_sobrenos', 'Listar Sobre Nós', 'Listar página sobre nós', '2022-02-19 16:59:47', NULL),
(38, 'listar/list_servicos', 'Listar Serviços', 'Listar página de serviços', '2022-02-19 17:00:27', NULL),
(39, 'listar/list_contatos', 'Listar Contatos', 'Listar contatos do site', '2022-02-19 17:01:08', NULL),
(40, 'listar/list_redessociais', 'Listar Redes Sociais', 'Listar redes sociais do site', '2022-02-19 17:01:57', NULL),
(41, 'listar/list_slides', 'Listar Slides', 'Listar slides do site', '2022-02-19 17:02:31', NULL),
(42, 'listar/list_categorias', 'Listar Categorias do Blog', 'Listar categorias do blog', '2022-02-19 17:03:12', NULL),
(43, 'listar/list_blogs', 'Listar Blogs', 'Listar blogs do site', '2022-02-19 17:03:42', NULL),
(44, 'cadastrar/cad_homepage', 'Cadastrar Home Page', 'Cadastrar home page do site', '2022-02-19 17:11:42', NULL),
(45, 'editar/edit_homepage', 'Editar Home Page', 'Editar home page do site', '2022-02-19 17:12:26', NULL),
(46, 'processa/proc_cad_homepage', 'Processo de Cadastro Home Page', 'Processo de cadastro da home page do site', '2022-02-19 17:19:09', NULL),
(47, 'processa/proc_edit_homepage', 'Processo de Edição da Home Page', 'Processo de edição da home page do site', '2022-02-19 17:42:27', NULL),
(48, 'cadastrar/cad_sobrenos', 'Cadastrar Sobre Nós', 'Cadastrar página do sobre nós do site', '2022-02-19 20:19:42', NULL),
(49, 'editar/edit_sobrenos', 'Editar Sobre Nós', 'Editar sobre nós do site', '2022-02-19 20:20:37', NULL),
(50, 'processa/proc_cad_sobrenos', 'Processo de Cadastro Sobre Nós', 'Processo de cadastro de sobre nós do site', '2022-02-19 20:24:54', NULL),
(51, 'processa/proc_edit_sobrenos', 'Processo de Edição Sobre Nós', 'Processo de edição de sobre nós do site', '2022-02-19 21:09:49', NULL),
(52, 'cadastrar/cad_servicos', 'Cadastrar Serviços', 'Cadastro de serviços no site', '2022-02-20 10:19:31', NULL),
(53, 'editar/edit_servicos', 'Editar Serviços', 'Editar serviços do site', '2022-02-20 10:27:17', NULL),
(54, 'processa/proc_apagar_servicos', 'Processo de Apagar Serviços', 'Processo de exclusão de serviços do site', '2022-02-20 10:29:10', NULL),
(55, 'processa/proc_cad_servicos', 'Processo de Cadastro de Serviços', 'Processo de cadastro de serviços do site', '2022-02-20 10:32:39', NULL),
(56, 'processa/proc_edit_servicos', 'Processo de Editar Serviços', 'Processo de editar serviços do site', '2022-02-20 10:59:50', NULL),
(57, 'cadastrar/cad_contatos', 'Cadatrar Contato', 'Cadastrar contatos no sistema', '2022-02-20 12:00:32', NULL),
(58, 'editar/edit_contato', 'Editar Contatos', 'Editar contato no site', '2022-02-20 12:02:12', NULL),
(59, 'processa/proc_cad_contatos', 'Processo de Cadastro de Contatos', 'Processo de cadastro de contatos no site', '2022-02-20 12:10:31', NULL),
(60, 'editar/edit_contatos', 'Editar Contato', 'Editar contatos no site', '2022-02-20 12:35:55', NULL),
(61, 'processa/proc_edit_contatos', 'Processo de Editar Contato', 'Processo de editar contato no site', '2022-02-20 12:38:57', NULL),
(62, 'editar/edit_redessociais', 'Editar Redes Sociais', 'Editar redes sociais do site', '2022-02-20 15:30:17', NULL),
(63, 'cadastrar/cad_redessociais', 'Cadastrar Redes Sociais', 'Cadastrar redes sociais do site', '2022-02-20 15:30:57', NULL),
(64, 'processa/proc_apagar_redessociais', 'Processo de Apagar Redes Sociais', 'Processo de apagar redes sociais do site', '2022-02-20 15:31:40', NULL),
(65, 'processa/proc_edit_redessociais', 'Processo de Editar Redes Sociais', 'Processo de editar redes sociais do site', '2022-02-20 15:32:13', NULL),
(66, 'processa/proc_cad_redessociais', 'Processo de Cadastrar Redes Sociais', 'Processo de cadastrar redes sociais do site', '2022-02-20 15:32:49', NULL),
(67, 'cadastrar/cad_slides', 'Cadastrar Slides', 'Cadastrar slides no site', '2022-02-20 16:06:01', NULL),
(68, 'editar/edit_slides', 'Editar Slides', 'Editar slides do site', '2022-02-20 16:06:41', NULL),
(69, 'processa/proc_cad_slides', 'Processo de Cadastrar Slide', 'Processo de cadastrar slide do site', '2022-02-20 16:11:10', NULL),
(70, 'processa/proc_edit_slides', 'Processo de Editar Slide', 'Processo de editar slide do site', '2022-02-20 16:11:38', NULL),
(71, 'cadastrar/cad_categorias', 'Cadastrar Categorias', 'Cadastrar categorias do blog do site', '2022-02-20 16:43:15', NULL),
(72, 'editar/edit_categorias', 'Editar Categorias', 'Editar categorias do blog do site', '2022-02-20 16:44:00', NULL),
(73, 'processa/proc_apagar_categorias', 'Processo de Apagar Categoria', 'Processo de exclusão de categoria do blog do site', '2022-02-20 16:44:36', NULL),
(74, 'processa/proc_cad_categorias', 'Processo de Cadastrar Categoria', 'Processo de cadastrar categoria do blog do site', '2022-02-20 16:50:08', NULL),
(75, 'processa/proc_edit_categorias', 'Processo de Editar Categoria', 'Processo de editar categoria do blog do site', '2022-02-20 16:50:44', NULL),
(76, 'processa/proc_apagar_blogs', 'Processo de Apagar Blog', 'Processo de apagar blog do site', '2022-02-20 17:04:15', '2022-02-20 19:48:16'),
(77, 'processa/proc_edit_blogs', 'Processo de Editar Blog', 'Processo de editar blog do site', '2022-02-20 17:04:50', '2022-02-20 19:48:35'),
(78, 'processa/proc_cad_blogs', 'Processo de cadastrar Blog', 'Processo de cadastrar blog do site', '2022-02-20 17:05:27', '2022-02-20 19:48:57'),
(79, 'cadastrar/cad_blogs', 'Cadastrar Blog', 'Cadastrar blog do site', '2022-02-20 17:06:15', NULL),
(80, 'editar/edit_blogs', 'Editar Blog', 'Editar blog do site', '2022-02-20 17:06:56', NULL);

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
(1, 'Claudemir Lopes', 'claudemir.slopes@hotmail.com', 'claudemir', '$2y$10$Cl8tDjZRWVi/vDQuhseOMOJQCWFOWXNO6L7HVBxqTSQ2DOg5zaT22', 'Claudemir é o desenvolvedor do site e é responsável por toda manutenção e atualização do mesmo.', '2dbd4b6f451138bd20a7228e63e7bba9', NULL, '1622326928532.png', 1, 1, '2017-07-23 00:00:00', '2022-03-01 16:33:14'),
(2, 'Eliane Rocha de Freitas Lopes', 'lifreitaslopes@gmail.com', 'eliane', '$2y$10$7z2Jgv.VCJ1dBo8dvpTbe.iUPsMQyrO9gX.rMQ6TGA6rFENx3/z3e', NULL, NULL, NULL, '1622327057853.png', 2, 1, '2022-03-01 11:18:38', '2022-03-01 11:35:50');

--
-- Índices para tabelas despejadas
--

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
-- AUTO_INCREMENT de tabela `niveis_acessos`
--
ALTER TABLE `niveis_acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `niveis_acessos_paginas`
--
ALTER TABLE `niveis_acessos_paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;

--
-- AUTO_INCREMENT de tabela `paginas`
--
ALTER TABLE `paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de tabela `situacoes_usuarios`
--
ALTER TABLE `situacoes_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `niveis_acessos_paginas`
--
ALTER TABLE `niveis_acessos_paginas`
  ADD CONSTRAINT `FK1_nacesso` FOREIGN KEY (`niveis_acesso_id`) REFERENCES `niveis_acessos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK2_apagina` FOREIGN KEY (`pagina_id`) REFERENCES `paginas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
