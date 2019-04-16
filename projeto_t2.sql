-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 12-Mar-2019 às 14:00
-- Versão do servidor: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projeto_t2`
--
CREATE DATABASE IF NOT EXISTS `projeto_t2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `projeto_t2`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ficheiros`
--

DROP TABLE IF EXISTS `ficheiros`;
CREATE TABLE IF NOT EXISTS `ficheiros` (
  `id_ficheiros` int(11) NOT NULL,
  `id_login_fk` int(11) NOT NULL,
  `diretoria` varchar(512) NOT NULL,
  `nome_do_ficheiro` varchar(512) NOT NULL,
  `data_upload` datetime NOT NULL,
  `tamanho_ficheiro` bigint(20) NOT NULL,
  `data_eliminado` datetime NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ficheiros`
--

INSERT INTO `ficheiros` (`id_ficheiros`, `id_login_fk`, `diretoria`, `nome_do_ficheiro`, `data_upload`, `tamanho_ficheiro`, `data_eliminado`, `eliminado`) VALUES
(1, 38, '/alunos/ficheiros/38/', 'Chrysanthemum.jpg', '2019-02-26 11:50:49', 879394, '2019-02-27 12:55:02', 1),
(2, 38, '/alunos/ficheiros/38/', 'Desert.jpg', '2019-02-26 11:50:54', 845941, '2019-02-27 12:33:34', 1),
(3, 38, '/alunos/ficheiros/38/', 'Jellyfish.jpg', '2019-02-26 11:50:59', 775702, '2019-02-27 12:54:14', 1),
(4, 40, '/alunos/ficheiros/40/', 'Koala.jpg', '2019-02-27 12:37:20', 780831, '2019-02-27 12:38:12', 1),
(5, 40, '/alunos/ficheiros/40/', 'Penguins.jpg', '2019-02-27 12:37:27', 777835, '2019-02-27 12:39:39', 1),
(6, 40, '/alunos/ficheiros/40/', 'Hydrangeas.jpg', '2019-02-27 12:37:32', 595284, '2019-02-27 14:38:23', 1),
(7, 38, '/alunos/ficheiros/38/', 'Jellyfish.jpg', '2019-02-27 12:55:24', 775702, '2019-02-27 13:15:44', 1),
(8, 38, '/alunos/ficheiros/38/', 'Koala.jpg', '2019-02-27 12:55:56', 780831, '2019-02-27 12:56:48', 1),
(9, 38, '/alunos/ficheiros/38/', 'Penguins.jpg', '2019-02-27 12:56:02', 777835, '2019-02-27 13:16:22', 1),
(10, 38, '/alunos/ficheiros/38/', 'Lighthouse.jpg', '2019-02-27 12:56:16', 561276, '2019-02-27 12:56:33', 1),
(11, 38, '/alunos/ficheiros/38/', 'Chrysanthemum.jpg', '2019-02-27 14:35:19', 879394, '2019-02-27 14:35:37', 1),
(12, 38, '/alunos/ficheiros/38/', 'Chrysanthemum.jpg', '2019-02-27 14:35:37', 879394, '2019-03-11 11:07:41', 1),
(13, 38, '/alunos/ficheiros/38/', 'Desert.jpg', '2019-03-11 11:07:46', 845941, '2019-03-12 12:20:38', 1),
(14, 38, '/alunos/ficheiros/38/', 'Lighthouse.jpg', '2019-03-11 11:08:04', 561276, '2019-03-12 12:20:39', 1),
(15, 38, '/alunos/ficheiros/38/', 'Chrysanthemum.jpg', '2019-03-12 12:20:44', 879394, '2019-03-12 12:48:12', 1),
(16, 38, '/alunos/ficheiros/38/', 'Jellyfish.jpg', '2019-03-12 12:20:55', 775702, '2019-03-12 12:48:16', 1),
(17, 38, '/alunos/ficheiros/38/', 'Koala.jpg', '2019-03-12 12:47:57', 780831, '2019-03-12 12:48:18', 1),
(18, 38, '/alunos/ficheiros/38/', 'Desert.jpg', '2019-03-12 12:48:24', 845941, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `lock_descriptions`
--

DROP TABLE IF EXISTS `lock_descriptions`;
CREATE TABLE IF NOT EXISTS `lock_descriptions` (
  `id_lock_description` int(11) NOT NULL,
  `descriptions` varchar(256) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `lock_descriptions`
--

INSERT INTO `lock_descriptions` (`id_lock_description`, `descriptions`) VALUES
(1, 'ativo'),
(2, 'esgotou tentativas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `idrecords` int(11) NOT NULL,
  `datein` datetime DEFAULT NULL,
  `dateout` datetime DEFAULT NULL,
  `users_idlogin` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `logs`
--

INSERT INTO `logs` (`idrecords`, `datein`, `dateout`, `users_idlogin`) VALUES
(2, '2018-10-11 11:40:30', NULL, 2),
(3, '2018-10-11 12:35:23', NULL, 2),
(4, '2018-10-11 12:40:19', NULL, 2),
(5, '2018-10-11 12:43:56', NULL, 2),
(6, '2018-10-11 12:52:35', NULL, 2),
(7, '2018-10-11 12:56:05', NULL, 2),
(8, '2018-10-11 12:56:31', NULL, 2),
(9, '2018-10-11 13:10:47', NULL, 2),
(10, '2018-10-15 10:00:35', NULL, 1),
(11, '2018-10-15 10:00:56', NULL, 2),
(12, '2018-10-15 10:01:14', NULL, 1),
(13, '2018-10-15 10:07:50', NULL, 1),
(14, '2018-10-15 10:40:34', NULL, 1),
(15, '2018-10-15 12:14:37', NULL, 1),
(16, '2018-10-15 12:27:22', NULL, 1),
(17, '2018-10-16 12:15:17', NULL, 2),
(18, '2018-10-16 12:15:28', NULL, 1),
(19, '2018-10-16 12:19:56', NULL, 1),
(20, '2018-10-16 12:22:02', NULL, 1),
(21, '2018-10-16 12:23:40', NULL, 1),
(22, '2018-10-16 12:24:07', NULL, 1),
(23, '2018-10-16 12:53:13', NULL, 1),
(24, '2018-10-16 12:53:38', NULL, 1),
(25, '2018-10-16 12:54:00', NULL, 1),
(26, '2018-10-16 12:54:43', NULL, 1),
(27, '2018-10-16 12:56:13', NULL, 1),
(28, '2018-10-29 08:46:15', NULL, 2),
(29, '2018-10-29 08:47:32', NULL, 2),
(30, '2018-10-29 08:48:02', NULL, 2),
(31, '2018-10-29 10:40:12', NULL, 2),
(32, '2018-10-29 10:40:38', NULL, 1),
(33, '2018-10-30 11:09:14', NULL, 2),
(34, '2018-10-30 11:54:55', NULL, 2),
(35, '2018-10-30 11:56:26', '2018-10-30 12:57:00', 2),
(36, '2018-10-31 11:48:31', NULL, 2),
(37, '2018-11-12 08:45:25', '2018-11-12 11:58:11', 2),
(38, '2018-11-12 11:58:23', NULL, 2),
(39, '2018-11-13 10:46:14', NULL, 2),
(40, '2018-11-14 11:52:51', NULL, 2),
(41, '2018-11-19 08:54:17', NULL, 2),
(42, '2018-11-20 10:52:37', NULL, 2),
(43, '2018-11-21 11:49:43', '2018-11-21 12:09:01', 2),
(44, '2018-11-21 12:09:16', NULL, 2),
(45, '2018-11-22 09:27:28', NULL, 2),
(46, '2018-11-26 08:53:09', NULL, 2),
(47, '2018-11-27 10:42:16', NULL, 2),
(48, '2018-11-28 11:39:58', NULL, 2),
(49, '2018-12-06 10:12:55', NULL, 2),
(50, '2019-01-14 08:50:21', NULL, 2),
(51, '2019-01-14 12:01:06', NULL, 2),
(52, '2019-01-15 10:46:46', NULL, 2),
(53, '2019-01-16 11:45:29', NULL, 2),
(54, '2019-01-17 09:37:45', NULL, 2),
(55, '2019-01-17 13:10:49', NULL, 2),
(56, '2019-01-21 09:30:08', NULL, 2),
(57, '2019-01-22 10:48:59', NULL, 2),
(58, '2019-01-22 12:39:13', NULL, 2),
(59, '2019-01-23 12:55:14', NULL, 2),
(60, '2019-01-24 09:29:59', NULL, 2),
(61, '2019-01-28 09:03:24', NULL, 2),
(62, '2019-01-29 10:47:33', NULL, 2),
(63, '2019-01-29 11:19:42', NULL, 2),
(64, '2019-01-29 11:44:52', NULL, 2),
(65, '2019-01-30 11:46:13', NULL, 2),
(66, '2019-01-30 12:34:43', NULL, 2),
(67, '2019-02-11 09:18:33', NULL, 2),
(68, '2019-02-12 10:42:20', '2019-02-12 11:14:37', 1),
(69, '2019-02-12 11:14:44', '2019-02-12 11:15:25', 2),
(70, '2019-02-12 11:15:41', NULL, 35),
(71, '2019-02-12 11:16:10', '2019-02-12 11:38:29', 37),
(72, '2019-02-12 11:38:37', '2019-02-12 11:38:46', 2),
(73, '2019-02-12 11:44:53', '2019-02-12 12:03:44', 1),
(74, '2019-02-12 12:03:51', NULL, 37),
(75, '2019-02-13 11:49:24', '2019-02-13 12:17:18', 2),
(76, '2019-02-13 12:17:24', NULL, 37),
(77, '2019-02-14 09:46:05', NULL, 2),
(78, '2019-02-18 09:44:26', '2019-02-18 09:57:47', 1),
(79, '2019-02-18 09:58:41', NULL, 35),
(80, '2019-02-18 10:05:35', '2019-02-18 10:06:00', 1),
(81, '2019-02-18 10:06:07', NULL, 35),
(82, '2019-02-18 10:44:28', NULL, 35),
(83, '2019-02-18 10:45:01', NULL, 35),
(84, '2019-02-18 11:13:16', '2019-02-18 11:44:30', 1),
(85, '2019-02-18 11:44:38', '2019-02-18 11:47:38', 1),
(86, '2019-02-18 11:47:42', NULL, 38),
(87, '2019-02-18 11:52:43', '2019-02-18 11:54:18', 1),
(88, '2019-02-18 11:54:23', NULL, 39),
(89, '2019-02-19 10:52:29', NULL, 38),
(90, '2019-02-20 11:52:31', NULL, 38),
(91, '2019-02-20 14:35:47', NULL, 38),
(92, '2019-02-21 09:51:27', NULL, 38),
(93, '2019-02-22 12:09:05', NULL, 39),
(94, '2019-02-24 10:03:41', NULL, 38),
(95, '2019-02-24 10:20:31', NULL, 38),
(96, '2019-02-24 10:47:46', NULL, 38),
(97, '2019-02-24 13:43:47', NULL, 38),
(98, '2019-02-25 09:54:22', NULL, 38),
(99, '2019-02-25 09:55:48', '2019-02-25 10:06:54', 1),
(100, '2019-02-25 10:07:05', NULL, 38),
(101, '2019-02-25 10:07:29', '2019-02-25 10:45:13', 1),
(102, '2019-02-25 10:46:04', NULL, 38),
(103, '2019-02-25 12:00:39', NULL, 38),
(104, '2019-02-25 12:28:29', NULL, 1),
(105, '2019-02-26 10:51:19', '2019-02-26 11:50:38', 1),
(106, '2019-02-26 11:50:42', NULL, 38),
(107, '2019-02-26 11:51:07', '2019-02-26 11:51:15', 1),
(108, '2019-02-26 11:51:24', '2019-02-26 13:00:13', 1),
(109, '2019-02-26 13:00:19', '2019-02-26 13:03:35', 1),
(110, '2019-02-27 11:40:30', NULL, 1),
(111, '2019-02-27 12:26:45', '2019-02-27 12:35:22', 1),
(112, '2019-02-27 12:35:26', NULL, 40),
(113, '2019-02-27 12:37:50', '2019-02-27 12:55:06', 1),
(114, '2019-02-27 12:55:19', NULL, 38),
(115, '2019-02-27 12:56:27', NULL, 1),
(116, '2019-02-27 12:57:17', NULL, 1),
(117, '2019-02-27 13:10:58', NULL, 1),
(118, '2019-02-27 14:35:13', NULL, 38),
(119, '2019-02-27 14:36:01', NULL, 1),
(120, '2019-03-11 08:46:08', '2019-03-11 11:07:08', 1),
(121, '2019-03-11 11:07:16', NULL, 38),
(122, '2019-03-12 10:52:38', '2019-03-12 12:19:57', 1),
(123, '2019-03-12 12:20:02', NULL, 38),
(124, '2019-03-12 12:53:56', '2019-03-12 12:54:16', 1),
(125, '2019-03-12 12:59:00', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id_permissions` int(11) NOT NULL,
  `descriptions` varchar(256) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `permissions`
--

INSERT INTO `permissions` (`id_permissions`, `descriptions`) VALUES
(1, 'administrador'),
(2, 'aluno');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idlogin` int(11) NOT NULL,
  `user` varchar(45) DEFAULT NULL,
  `fotografia` varchar(256) NOT NULL,
  `password` varchar(256) DEFAULT NULL,
  `attempts` varchar(45) DEFAULT NULL,
  `permissions_id_permissions` int(11) NOT NULL,
  `lock_descriptions_id_lock_description` int(11) NOT NULL,
  `cota_maxima` bigint(20) NOT NULL,
  `cota_utilizada` int(11) NOT NULL,
  `eliminado` int(11) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `data_eliminacao` datetime NOT NULL,
  `nome_do_aluno` varchar(512) NOT NULL,
  `numero_proceso_aluno` varchar(256) NOT NULL,
  `email` varchar(512) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`idlogin`, `user`, `fotografia`, `password`, `attempts`, `permissions_id_permissions`, `lock_descriptions_id_lock_description`, `cota_maxima`, `cota_utilizada`, `eliminado`, `data_criacao`, `data_eliminacao`, `nome_do_aluno`, `numero_proceso_aluno`, `email`) VALUES
(1, 'admin', '1.jpg', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '3', 1, 1, 1000000000, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(2, 'empresa', '2.jpg', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '3', 1, 1, 1000000000, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(29, 'ee', '29.jpg', '*210C5F8F1B7EDBA4E3E7179D877BD05083A5750A', '3', 2, 1, 500000000, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(30, 'tttt', '30.jpg', '*7B844B41A3799185EBF33B603FA8C632E65CA3EF', '3', 1, 1, 500000000, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(32, 'mario', '32.jpg', '*652552781BA557B50DDDA5C3633D49FBC5A50081', '3', 1, 1, 500000000, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(33, '12345', '33.jpg', '*5FB0389A1B2E4AC3A2EA98936939FD94FF19D715', '5', 1, 1, 500000000, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '111113s', '11113', 't111113@gmail.com'),
(34, 'ttt', '34.jpg', '*A0C1B1AEC5E4FC2670F87F7F6A46ACF06DC15605', '3', 1, 1, 500000000, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(35, 't1234', '35.jpg', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '3', 2, 1, 500000000, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ''),
(36, 'carlosabc', '36.jpg', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '5', 1, 1, 2000000000, 0, 0, '2019-01-17 13:03:06', '0000-00-00 00:00:00', 'Carlos', '123456', 'abc@gads.com'),
(37, 'teste123', '37.jpg', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '3', 1, 1, 1500000000, 0, 0, '2019-01-21 09:34:01', '0000-00-00 00:00:00', 'teste123 user', '123', '123@gmail.bc'),
(38, '2', '38.jpg', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '3', 2, 1, 500000000, 845941, 0, '2019-02-18 11:14:02', '0000-00-00 00:00:00', 'gh', '123', '1223@gmail.com'),
(39, '3', '39.jpg', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '3', 2, 1, 1000000000, 0, 0, '2019-02-18 11:53:11', '0000-00-00 00:00:00', '3', '3', '3@3'),
(40, '4', '40.jpg', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '3', 2, 1, 3000000000, 0, 0, '2019-02-25 10:40:09', '0000-00-00 00:00:00', '4', '4', '424@4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ficheiros`
--
ALTER TABLE `ficheiros`
  ADD PRIMARY KEY (`id_ficheiros`);

--
-- Indexes for table `lock_descriptions`
--
ALTER TABLE `lock_descriptions`
  ADD PRIMARY KEY (`id_lock_description`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`idrecords`),
  ADD KEY `fk_logs_users1_idx` (`users_idlogin`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id_permissions`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idlogin`),
  ADD KEY `fk_users_permissions_idx` (`permissions_id_permissions`),
  ADD KEY `fk_users_lock_descriptions1_idx` (`lock_descriptions_id_lock_description`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ficheiros`
--
ALTER TABLE `ficheiros`
  MODIFY `id_ficheiros` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `lock_descriptions`
--
ALTER TABLE `lock_descriptions`
  MODIFY `id_lock_description` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `idrecords` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=126;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id_permissions` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idlogin` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `fk_logs_users1` FOREIGN KEY (`users_idlogin`) REFERENCES `users` (`idlogin`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_lock_descriptions1` FOREIGN KEY (`lock_descriptions_id_lock_description`) REFERENCES `lock_descriptions` (`id_lock_description`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_permissions` FOREIGN KEY (`permissions_id_permissions`) REFERENCES `permissions` (`id_permissions`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
