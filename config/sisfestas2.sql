-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.22-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para sisfestas
CREATE DATABASE IF NOT EXISTS `sisfestas` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `sisfestas`;

-- Copiando estrutura para tabela sisfestas.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `niveis_acesso_id` int(11) DEFAULT NULL,
  `situacoes_usuario_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK2_situser` (`situacoes_usuario_id`) USING BTREE,
  KEY `FK2_nacs` (`niveis_acesso_id`) USING BTREE,
  CONSTRAINT `FK2_SitU` FOREIGN KEY (`situacoes_usuario_id`) REFERENCES `situacoes_usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK2_nAcS` FOREIGN KEY (`niveis_acesso_id`) REFERENCES `niveis_acessos_cli` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela sisfestas.clientes: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT IGNORE INTO `clientes` (`id`, `nome`, `email`, `usuario`, `senha`, `cpf`, `rg`, `telefone`, `cep`, `rua`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `recuperar_senha`, `chave_descadastro`, `foto`, `niveis_acesso_id`, `situacoes_usuario_id`, `created`, `modified`) VALUES
	(1, 'Claudemir da Silva Lopes', 'claudemir.slopes@hotmail.com', 'claudemir', '$2y$10$CaPIIT.zHJiGK3yUO7MbleuvUOZRU16xxshtAHNiQT8mjdAHrL6D.', '284.132.918-60', '275324102', '(19) 98457-8361', '13483-332', 'Rua Guido José Bellon', '358', '', 'Parque Residencial Abílio Pedro', 'Limeira', 'SP', NULL, NULL, 'fotosite.jpg', 1, 1, '2022-02-23 11:15:44', '2022-03-12 08:25:56'),
	(2, 'Eliane Rocha de Freitas Lopes', 'lifreitaslopes@gmail.com', 'lifreitas', '$2y$10$fFVUC7KVoHtDnTrcxjZFGe5y6oyIIDGQ6JDDzByXkznYK4PN6jMSC', '964.301.686-20', '547899541', '(19) 98457-8361', '13482-050', 'Rua Francisco Orlando Stocco', '258', 'fundos', 'Jardim Ouro Verde', 'Limeira', 'SP', NULL, NULL, '1622327057853.png', 2, 1, '2022-02-23 11:19:13', '2022-03-12 08:39:32');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

-- Copiando estrutura para tabela sisfestas.logos
CREATE TABLE IF NOT EXISTS `logos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `foto` varchar(50) DEFAULT NULL,
  `modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sisfestas.logos: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `logos` DISABLE KEYS */;
INSERT IGNORE INTO `logos` (`id`, `foto`, `modified`) VALUES
	(1, 'sf1.png', '2022-03-09 11:36:37'),
	(2, 'sf2.png', '2022-03-09 11:36:46');
/*!40000 ALTER TABLE `logos` ENABLE KEYS */;

-- Copiando estrutura para tabela sisfestas.niveis_acessos
CREATE TABLE IF NOT EXISTS `niveis_acessos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_nivel_acesso` varchar(50) NOT NULL,
  `ordem` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sisfestas.niveis_acessos: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `niveis_acessos` DISABLE KEYS */;
INSERT IGNORE INTO `niveis_acessos` (`id`, `nome_nivel_acesso`, `ordem`, `created`, `modified`) VALUES
	(1, 'Programador', 1, '2022-02-01 16:58:12', '2022-03-09 10:48:03'),
	(2, 'Administrador', 2, '2022-02-01 16:58:27', '2022-02-28 17:06:03'),
	(3, 'Colaborador', 3, '2022-02-01 16:58:36', '2022-02-28 17:06:10'),
	(4, 'Estagiário', 4, '2022-02-19 12:22:50', '2022-03-09 09:40:32');
/*!40000 ALTER TABLE `niveis_acessos` ENABLE KEYS */;

-- Copiando estrutura para tabela sisfestas.niveis_acessos_cli
CREATE TABLE IF NOT EXISTS `niveis_acessos_cli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_nivel_acesso` varchar(50) NOT NULL,
  `ordem` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela sisfestas.niveis_acessos_cli: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `niveis_acessos_cli` DISABLE KEYS */;
INSERT IGNORE INTO `niveis_acessos_cli` (`id`, `nome_nivel_acesso`, `ordem`, `created`, `modified`) VALUES
	(1, 'Cliente', 1, '2022-03-12 08:19:19', NULL),
	(2, 'Visitante', 2, '2022-03-12 08:19:31', NULL);
/*!40000 ALTER TABLE `niveis_acessos_cli` ENABLE KEYS */;

-- Copiando estrutura para tabela sisfestas.niveis_acessos_paginas
CREATE TABLE IF NOT EXISTS `niveis_acessos_paginas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `niveis_acesso_id` int(11) NOT NULL,
  `pagina_id` int(11) NOT NULL,
  `permissao` int(11) NOT NULL,
  `ordem` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK1_nacesso` (`niveis_acesso_id`),
  KEY `FK2_apagina` (`pagina_id`),
  CONSTRAINT `FK2_apagina` FOREIGN KEY (`pagina_id`) REFERENCES `paginas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_niveis_acessos_paginas_niveis_acessos` FOREIGN KEY (`niveis_acesso_id`) REFERENCES `niveis_acessos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sisfestas.niveis_acessos_paginas: ~140 rows (aproximadamente)
/*!40000 ALTER TABLE `niveis_acessos_paginas` DISABLE KEYS */;
INSERT IGNORE INTO `niveis_acessos_paginas` (`id`, `niveis_acesso_id`, `pagina_id`, `permissao`, `ordem`, `created`, `modified`) VALUES
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
	(138, 4, 34, 2, 34, '2022-03-11 17:26:22', NULL);
/*!40000 ALTER TABLE `niveis_acessos_paginas` ENABLE KEYS */;

-- Copiando estrutura para tabela sisfestas.niveis_acessos_paginas_c
CREATE TABLE IF NOT EXISTS `niveis_acessos_paginas_c` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `niveis_acesso_id` int(11) NOT NULL,
  `pagina_id` int(11) NOT NULL,
  `permissao` int(11) NOT NULL,
  `ordem` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK1_nacesso` (`niveis_acesso_id`) USING BTREE,
  KEY `FK2_apagina` (`pagina_id`) USING BTREE,
  CONSTRAINT `FK1_nac` FOREIGN KEY (`niveis_acesso_id`) REFERENCES `niveis_acessos_cli` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK2_pag` FOREIGN KEY (`pagina_id`) REFERENCES `niveis_acessos_paginas_c` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela sisfestas.niveis_acessos_paginas_c: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `niveis_acessos_paginas_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `niveis_acessos_paginas_c` ENABLE KEYS */;

-- Copiando estrutura para tabela sisfestas.paginas
CREATE TABLE IF NOT EXISTS `paginas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `endereco` varchar(120) NOT NULL,
  `nome_pagina` varchar(120) NOT NULL,
  `obs` text DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sisfestas.paginas: ~30 rows (aproximadamente)
/*!40000 ALTER TABLE `paginas` DISABLE KEYS */;
INSERT IGNORE INTO `paginas` (`id`, `endereco`, `nome_pagina`, `obs`, `created`, `modified`) VALUES
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
	(34, 'processa/proc_apagar_clientes', 'Processo de Apagar Cliente', 'Processa a exclusão de cliente', '2022-03-11 17:26:21', NULL);
/*!40000 ALTER TABLE `paginas` ENABLE KEYS */;

-- Copiando estrutura para tabela sisfestas.paginas_c
CREATE TABLE IF NOT EXISTS `paginas_c` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `endereco` varchar(120) NOT NULL,
  `nome_pagina` varchar(120) NOT NULL,
  `obs` text DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela sisfestas.paginas_c: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `paginas_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `paginas_c` ENABLE KEYS */;

-- Copiando estrutura para tabela sisfestas.situacoes_usuarios
CREATE TABLE IF NOT EXISTS `situacoes_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_situacao` varchar(50) NOT NULL,
  `cor_situacao` varchar(20) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sisfestas.situacoes_usuarios: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `situacoes_usuarios` DISABLE KEYS */;
INSERT IGNORE INTO `situacoes_usuarios` (`id`, `nome_situacao`, `cor_situacao`, `created`, `modified`) VALUES
	(1, 'Ativo', 'success', '2017-04-21 00:00:00', NULL),
	(2, 'Inativo', 'danger', '2017-05-24 00:00:00', NULL);
/*!40000 ALTER TABLE `situacoes_usuarios` ENABLE KEYS */;

-- Copiando estrutura para tabela sisfestas.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `modified` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK1_nauser` (`niveis_acesso_id`),
  KEY `FK2_situser` (`situacoes_usuario_id`),
  CONSTRAINT `FK1_nauser` FOREIGN KEY (`niveis_acesso_id`) REFERENCES `niveis_acessos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK2_situser` FOREIGN KEY (`situacoes_usuario_id`) REFERENCES `situacoes_usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sisfestas.usuarios: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT IGNORE INTO `usuarios` (`id`, `nome`, `email`, `usuario`, `senha`, `obs`, `recuperar_senha`, `chave_descadastro`, `foto`, `niveis_acesso_id`, `situacoes_usuario_id`, `created`, `modified`) VALUES
	(1, 'Claudemir da Silva Lopes', 'claudemir.slopes@hotmail.com', 'claudemir', '$2y$10$eiGctERNISJWxpIM7BGtpucbxBgIoC0w4O6K.SGqF0AviYPwcBE9y', 'Claudemir é o desenvolvedor do site e é responsável por toda manutenção e atualização do mesmo.', '2dbd4b6f451138bd20a7228e63e7bba9', NULL, '1622326928532.png', 1, 1, '2017-07-23 00:00:00', '2022-03-11 08:08:37'),
	(2, 'Eliane Rocha de Freitas Lopes', 'lifreitaslopes@gmail.com', 'eliane', '$2y$10$7z2Jgv.VCJ1dBo8dvpTbe.iUPsMQyrO9gX.rMQ6TGA6rFENx3/z3e', NULL, NULL, NULL, '1622327057853.png', 2, 1, '2022-03-01 11:18:38', '2022-03-01 11:35:50'),
	(3, 'Luke Skywalker Lopes', 'luke@sky.com', 'lukesky', '$2y$10$r.aoiHEO3uWRyJa8zZYrpOpixF6CBtG.T3R7jEEsQnF6H/EEkksO6', 'Este usuário é o meu mascote de estimação, ele não tem raça definida, mas é o amor da minha vida e o símbolo da minha empresa.', NULL, NULL, 'img-20210423-wa0011.jpg', 3, 1, '2022-03-10 10:21:48', '2022-03-10 16:32:10');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
