-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 05-Jun-2015 às 03:54
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cadastro`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1430507674),
('m140524_153638_init_user', 1430507684),
('m140524_153642_init_user_auth', 1430507685);

-- --------------------------------------------------------

--
-- Estrutura da tabela `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profile_user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `profile`
--

INSERT INTO `profile` (`id`, `user_id`, `create_time`, `update_time`, `full_name`) VALUES
(1, 1, '2015-05-02 00:14:44', NULL, 'the one'),
(2, 2, '2015-05-03 01:28:22', NULL, 'Usuario Solicitante'),
(3, 3, '2015-05-03 01:28:57', '2015-05-13 13:01:27', 'Riuler L');

-- --------------------------------------------------------

--
-- Estrutura da tabela `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `can_admin` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `role`
--

INSERT INTO `role` (`id`, `name`, `create_time`, `update_time`, `can_admin`) VALUES
(1, 'Admin', '2015-05-02 00:14:44', NULL, 1),
(2, 'Solicitante', '2015-05-02 00:14:44', NULL, 0),
(3, 'Analista', '2015-05-02 03:00:00', NULL, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_files`
--

CREATE TABLE IF NOT EXISTS `tb_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `solicitation_id` int(6) unsigned zerofill NOT NULL,
  `attachment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `solicitation_id` (`solicitation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_location`
--

CREATE TABLE IF NOT EXISTS `tb_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(100) CHARACTER SET latin1 NOT NULL,
  `fullname` varchar(200) CHARACTER SET latin1 NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `is_active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Extraindo dados da tabela `tb_location`
--

INSERT INTO `tb_location` (`id`, `nickname`, `fullname`, `created`, `updated`, `is_active`) VALUES
(1, 'PA 00', 'PA 00 - Agência Sede GV', '2015-05-01 00:00:00', NULL, 1),
(2, 'PA 02', 'PA 02 - São Félix', '2015-05-01 00:00:00', NULL, 1),
(3, 'PA 03', 'PA 03 - Frei Inocêncio', '2015-05-01 00:00:00', NULL, 1),
(4, 'PA 04', 'PA 04 - Itabirinha', '2015-05-01 00:00:00', NULL, 1),
(5, 'PA 05', 'PA 05 - Jampruca', '2015-05-01 00:00:00', NULL, 1),
(8, 'PA 06', 'PA 06 - Pescador', '2015-05-01 00:00:00', NULL, 1),
(9, 'PA 07', 'PA 07 - Marilac', '2015-05-01 00:00:00', NULL, 1),
(10, 'PA 08', 'PA 08 - Nova Belem', '2015-05-01 00:00:00', NULL, 0),
(11, 'PA 09', 'PA 09 - Mantena', '2015-05-01 00:00:00', NULL, 1),
(12, 'PA 10', 'PA 10 - Fernandes Tourinho', '2015-05-01 00:00:00', NULL, 1),
(13, 'PA 11', 'PA 11 - Santa Efigênia de Minas', '2015-05-01 00:00:00', NULL, 1),
(14, 'PA 13', 'PA 13 - Divinolandia de Minas', '2015-05-01 00:00:00', NULL, 1),
(15, 'PA 14', 'PA 14 - Sardoá', '2015-05-01 00:00:00', NULL, 1),
(16, 'PA 15', 'PA 15 - Divino das Laranjeiras', '2015-05-01 00:00:00', NULL, 1),
(17, 'PA 16', 'PA 16 - Capitão Andrade', '2015-05-01 00:00:00', NULL, 1),
(18, 'PA 17', 'PA 17 - Virginopolis', '2015-05-01 00:00:00', NULL, 1),
(19, 'PA 18', 'PA 18 - Vargem Grande', '2015-05-01 00:00:00', NULL, 1),
(20, 'PA 19', 'PA 19 - Jardim Pérola (GV)', '2015-05-01 00:00:00', NULL, 1),
(21, 'PA 20', 'PA 20 - JK (GV)', '2015-05-01 00:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_solicitation`
--

CREATE TABLE IF NOT EXISTS `tb_solicitation` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `created` date DEFAULT NULL,
  `updated` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  `typeperson_id` int(11) NOT NULL,
  `typesolicitation_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `analyst_id` int(11) DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `note_analyst` text COLLATE utf8_unicode_ci,
  `cpf_cnpj` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `scholarity` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `occupation` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_firm` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_role` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_admission_date` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `spouse_cpf` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `status_id` (`status_id`),
  KEY `location_id` (`location_id`),
  KEY `typesolicitation_id` (`typesolicitation_id`),
  KEY `typeperson_id` (`typeperson_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_status`
--

CREATE TABLE IF NOT EXISTS `tb_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `color` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=100 ;

--
-- Extraindo dados da tabela `tb_status`
--

INSERT INTO `tb_status` (`id`, `name`, `description`, `color`) VALUES
(1, 'Aguardando', 'Solicitação enviada para ser feito cadastro', '#282828'),
(2, 'Em andamento', 'Cadastro sendo realizado por um analista', '#1045A0'),
(3, 'Pendência', 'Alguma pendência foi encontrada, aguardando normalização!', '#A81212'),
(4, 'Corrigido', 'Correção realizada e aguardando novamente a realização do cadastro', '#DB5700'),
(98, 'Cancelado', '', '#777777'),
(99, 'Concluído', 'Cadastro Concluído', '#095B11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_typeperson`
--

CREATE TABLE IF NOT EXISTS `tb_typeperson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `desc` text CHARACTER SET latin1,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=100 ;

--
-- Extraindo dados da tabela `tb_typeperson`
--

INSERT INTO `tb_typeperson` (`id`, `name`, `desc`) VALUES
(1, 'Conjuge', NULL),
(2, 'PF', NULL),
(3, 'PF Conta Salário', NULL),
(4, 'PF Conta Poupança', NULL),
(6, 'Produtor Rural', NULL),
(7, 'Sócio PJ', NULL),
(99, 'PJ', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_typesolicitation`
--

CREATE TABLE IF NOT EXISTS `tb_typesolicitation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `desc` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `tb_typesolicitation`
--

INSERT INTO `tb_typesolicitation` (`id`, `name`, `desc`) VALUES
(1, '1º Cadastro', '...'),
(2, 'Correção', '...'),
(3, 'Renovação', '...'),
(4, 'Regularização de Aba', '...');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `status` smallint(6) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `api_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_time` timestamp NULL DEFAULT NULL,
  `create_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `ban_time` timestamp NULL DEFAULT NULL,
  `ban_reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email` (`email`),
  UNIQUE KEY `user_username` (`username`),
  KEY `user_role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=127 ;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `role_id`, `status`, `email`, `new_email`, `username`, `password`, `auth_key`, `api_key`, `login_ip`, `login_time`, `create_ip`, `create_time`, `update_time`, `ban_time`, `ban_reason`) VALUES
(1, 1, 1, 'neo@neo.com', NULL, 'neo', '$2y$10$WYB666j7MmxuW6b.kFTOde/eGCLijWa6BFSjAAiiRbSAqpC1HCmrC', 'ICBGPyDRdB2N15lI2NbMs4miPQKWn1D6', 'dWzR8YJOGcqar7oQRNj1VsKxx360BRjh', '127.0.0.1', '2015-05-13 13:00:47', NULL, '2015-05-02 00:14:44', NULL, NULL, NULL),
(2, 2, 1, 'teste@teste.com.br', NULL, 'solicitante', '$2y$13$V11Fxf9VPopkUMOJ4./V..9N..1L5nu6mQiSKYVgiTmQYatYhjuIC', NULL, NULL, NULL, NULL, NULL, '2015-05-03 01:28:22', NULL, NULL, NULL),
(3, 3, 1, 'riuler.matos@sicoobcrediriodoce.com.br', NULL, 'riulerl3027_00', '$2y$13$u8/wnXL.Mc3JUMiAZ5xs8.v.k9zo8nuu8lH6JL4iFl26crjoq.RFu', NULL, NULL, '172.19.37.37', '2015-05-26 16:18:32', NULL, '2015-05-03 01:28:57', '2015-05-13 13:01:27', NULL, NULL),
(104, 2, 1, 'evelyn.oliveira@sicoobcrediriodoce.com.br', '', 'evelyna3027_00', '$2y$13$Qd30oF0sot5I9cJagoZG4OP01yZ1eaq1RKoAZFV48Cl/amPzJ0Q2G', 'ICBGPyDRdB2N15lI2NbMs4miPQKWn1D6', 'dWzR8YJOGcqar7oQRNj1VsKxx360BRjh', '127.0.0.1', '2015-02-06 00:23:47', '', '2015-02-06 00:28:57', '2015-02-06 00:29:10', NULL, NULL),
(105, 2, 1, 'maria.oliveira@sicoobcrediriodoce.com.br', '', 'marial3027_16', '$2y$13$Qd30oF0sot5I9cJagoZG4OP01yZ1eaq1RKoAZFV48Cl/amPzJ0Q2G', 'ICBGPyDRdB2N15lI2NbMs4miPQKWn1D6', 'dWzR8YJOGcqar7oQRNj1VsKxx360BRjh', '127.0.0.1', '2015-02-06 00:23:47', '', '2015-02-06 00:28:57', '2015-02-06 00:29:10', NULL, NULL),
(106, 2, 1, 'alessandra.turco@sicoobcrediriodoce.com.br', '', 'alessandraa3027_00', '$2y$13$Qd30oF0sot5I9cJagoZG4OP01yZ1eaq1RKoAZFV48Cl/amPzJ0Q2G', 'ICBGPyDRdB2N15lI2NbMs4miPQKWn1D6', 'dWzR8YJOGcqar7oQRNj1VsKxx360BRjh', '127.0.0.1', '2015-02-06 00:23:47', '', '2015-02-06 00:28:57', '2015-02-06 00:29:10', NULL, NULL),
(107, 2, 1, 'meire.almeida@sicoobcrediriodoce.com.br', '', 'meirem3027_17', '$2y$13$Qd30oF0sot5I9cJagoZG4OP01yZ1eaq1RKoAZFV48Cl/amPzJ0Q2G', 'ICBGPyDRdB2N15lI2NbMs4miPQKWn1D6', 'dWzR8YJOGcqar7oQRNj1VsKxx360BRjh', '127.0.0.1', '2015-02-06 00:23:47', '', '2015-02-06 00:28:57', '2015-02-06 00:29:10', NULL, NULL),
(108, 2, 1, 'wadson.martins@sicoobcrediriodoce.com.br', '', 'wadsonv3027_10', '$2y$13$Qd30oF0sot5I9cJagoZG4OP01yZ1eaq1RKoAZFV48Cl/amPzJ0Q2G', 'ICBGPyDRdB2N15lI2NbMs4miPQKWn1D6', 'dWzR8YJOGcqar7oQRNj1VsKxx360BRjh', '127.0.0.1', '2015-02-06 00:23:47', '', '2015-02-06 00:28:57', '2015-02-06 00:29:10', NULL, NULL),
(109, 2, 1, 'ediane.conrado@sicoobcrediriodoce.com.br', '', 'edianec3027_04', '$2y$13$Qd30oF0sot5I9cJagoZG4OP01yZ1eaq1RKoAZFV48Cl/amPzJ0Q2G', 'ICBGPyDRdB2N15lI2NbMs4miPQKWn1D6', 'dWzR8YJOGcqar7oQRNj1VsKxx360BRjh', '127.0.0.1', '2015-02-06 00:23:47', '', '2015-02-06 00:28:57', '2015-02-06 00:29:10', NULL, NULL),
(110, 2, 1, 'cristianne.assumpcao@sicoobcrediriodoce.com.br', '', 'cristiannem3027_17', '$2y$13$Qd30oF0sot5I9cJagoZG4OP01yZ1eaq1RKoAZFV48Cl/amPzJ0Q2G', 'ICBGPyDRdB2N15lI2NbMs4miPQKWn1D6', 'dWzR8YJOGcqar7oQRNj1VsKxx360BRjh', '127.0.0.1', '2015-02-06 00:23:47', '', '2015-02-06 00:28:57', '2015-02-06 00:29:10', NULL, NULL),
(111, 2, 1, 'raifa.gomes@sicoobcrediriodoce.com.br', '', 'raifab3027_00', '$2y$13$Qd30oF0sot5I9cJagoZG4OP01yZ1eaq1RKoAZFV48Cl/amPzJ0Q2G', 'ICBGPyDRdB2N15lI2NbMs4miPQKWn1D6', 'dWzR8YJOGcqar7oQRNj1VsKxx360BRjh', '127.0.0.1', '2015-02-06 00:23:47', '', '2015-02-06 00:28:57', '2015-02-06 00:29:10', NULL, NULL),
(112, 2, 1, 'paula.roberto@sicoobcrediriodoce.com.br', '', 'paular3027_00', '$2y$13$Qd30oF0sot5I9cJagoZG4OP01yZ1eaq1RKoAZFV48Cl/amPzJ0Q2G', 'ICBGPyDRdB2N15lI2NbMs4miPQKWn1D6', 'dWzR8YJOGcqar7oQRNj1VsKxx360BRjh', '127.0.0.1', '2015-02-06 00:23:47', '', '2015-02-06 00:28:57', '2015-02-06 00:29:10', NULL, NULL),
(113, 2, 1, 'ana.prates@sicoobcrediriodoce.com.br', '', 'anac3027_00', '$2y$13$Qd30oF0sot5I9cJagoZG4OP01yZ1eaq1RKoAZFV48Cl/amPzJ0Q2G', 'ICBGPyDRdB2N15lI2NbMs4miPQKWn1D6', 'dWzR8YJOGcqar7oQRNj1VsKxx360BRjh', '127.0.0.1', '2015-02-06 00:23:47', '', '2015-02-06 00:28:57', '2015-02-06 00:29:10', NULL, NULL),
(114, 2, 1, 'jayne.machado@sicoobcrediriodoce.com.br', '', 'jayned3027_00', '$2y$13$Qd30oF0sot5I9cJagoZG4OP01yZ1eaq1RKoAZFV48Cl/amPzJ0Q2G', 'ICBGPyDRdB2N15lI2NbMs4miPQKWn1D6', 'dWzR8YJOGcqar7oQRNj1VsKxx360BRjh', '127.0.0.1', '2015-02-06 00:23:47', '', '2015-02-06 00:28:57', '2015-02-06 00:29:10', NULL, NULL),
(115, 2, 1, 'luiz.junior@sicoobcrediriodoce.com.br', '', 'luizc3027_00', '$2y$13$Qd30oF0sot5I9cJagoZG4OP01yZ1eaq1RKoAZFV48Cl/amPzJ0Q2G', 'ICBGPyDRdB2N15lI2NbMs4miPQKWn1D6', 'dWzR8YJOGcqar7oQRNj1VsKxx360BRjh', '127.0.0.1', '2015-02-06 00:23:47', '', '2015-02-06 00:28:57', '2015-02-06 00:29:10', NULL, NULL),
(117, 2, 1, 'gustavo.rodrigues@sicoobcrediriodoce.com.br', '', 'gustavom3027_04', '$2y$13$Qd30oF0sot5I9cJagoZG4OP01yZ1eaq1RKoAZFV48Cl/amPzJ0Q2G', 'ICBGPyDRdB2N15lI2NbMs4miPQKWn1D6', 'dWzR8YJOGcqar7oQRNj1VsKxx360BRjh', '127.0.0.1', '2015-02-06 00:23:47', '', '2015-02-06 00:28:57', '2015-02-06 00:29:10', NULL, NULL),
(118, 2, 1, 'antonio.filho@sicoobcrediriodoce.com.br', '', 'antoniog3027_00', '$2y$13$Qd30oF0sot5I9cJagoZG4OP01yZ1eaq1RKoAZFV48Cl/amPzJ0Q2G', 'ICBGPyDRdB2N15lI2NbMs4miPQKWn1D6', 'dWzR8YJOGcqar7oQRNj1VsKxx360BRjh', '127.0.0.1', '2015-02-06 00:23:47', '', '2015-02-06 00:28:57', '2015-02-06 00:29:10', NULL, NULL),
(119, 2, 1, 'raquel.leite@sicoobcrediriodoce.com.br', '', 'raquelg3027_09', '$2y$13$Qd30oF0sot5I9cJagoZG4OP01yZ1eaq1RKoAZFV48Cl/amPzJ0Q2G', 'ICBGPyDRdB2N15lI2NbMs4miPQKWn1D6', 'dWzR8YJOGcqar7oQRNj1VsKxx360BRjh', '127.0.0.1', '2015-02-06 00:23:47', '', '2015-02-06 00:28:57', '2015-02-06 00:29:10', NULL, NULL),
(120, 2, 1, 'cesar.melo@sicoobcrediriodoce.com.br', '', 'cesarm3027_00', '$2y$13$Qd30oF0sot5I9cJagoZG4OP01yZ1eaq1RKoAZFV48Cl/amPzJ0Q2G', 'ICBGPyDRdB2N15lI2NbMs4miPQKWn1D6', 'dWzR8YJOGcqar7oQRNj1VsKxx360BRjh', '127.0.0.1', '2015-02-06 00:23:47', '', '2015-02-06 00:28:57', '2015-02-06 00:29:10', NULL, NULL),
(121, 3, 1, 'caio.cunha@sicoobcrediriodoce.com.br', NULL, 'caioh3027_00', '$2y$13$u8/wnXL.Mc3JUMiAZ5xs8.v.k9zo8nuu8lH6JL4iFl26crjoq.RFu', NULL, NULL, '127.0.0.1', '2015-06-05 06:44:01', NULL, '2015-05-03 01:28:57', '2015-05-03 01:28:57', NULL, NULL),
(122, 3, 1, 'dalton.junior@sicoobcrediriodoce.com.br', NULL, 'daltonj3027_00', '$2y$13$u8/wnXL.Mc3JUMiAZ5xs8.v.k9zo8nuu8lH6JL4iFl26crjoq.RFu', NULL, NULL, '172.19.37.3', '2015-05-27 10:24:00', NULL, '2015-05-25 16:18:02', '2015-05-25 16:18:02', NULL, NULL),
(123, 2, 1, 'francisco.junior@sicoobcrediriodoce.com.br', NULL, 'franciscoa3027_03', '$2y$13$Qd30oF0sot5I9cJagoZG4OP01yZ1eaq1RKoAZFV48Cl/amPzJ0Q2G', 'ICBGPyDRdB2N15lI2NbMs4miPQKWn1D6', 'dWzR8YJOGcqar7oQRNj1VsKxx360BRjh', '127.0.0.1', '2015-02-06 00:23:47', NULL, '2015-02-06 00:23:47', '2015-02-06 00:23:47', NULL, NULL),
(124, 2, 1, 'marcelo.sampaio@sicoobcrediriodoce.com.br', '', 'marcelom3027_10', '$2y$13$Qd30oF0sot5I9cJagoZG4OP01yZ1eaq1RKoAZFV48Cl/amPzJ0Q2G', 'ICBGPyDRdB2N15lI2NbMs4miPQKWn1D6', 'dWzR8YJOGcqar7oQRNj1VsKxx360BRjh', '127.0.0.1', '2015-02-06 00:23:47', NULL, '2015-02-06 00:23:47', '2015-02-06 00:23:47', NULL, NULL),
(125, 3, 1, 'jaciane.campos@sicoobcrediriodoce.com.br', NULL, 'jacianea3027_00', '$2y$13$u8/wnXL.Mc3JUMiAZ5xs8.v.k9zo8nuu8lH6JL4iFl26crjoq.RFu', NULL, NULL, '172.19.37.3', '2015-05-26 12:19:31', NULL, '2015-05-26 11:48:02', '2015-05-26 11:48:02', NULL, NULL),
(126, 2, 1, 'alessandra.silva@sicoobcrediriodoce.com.br', NULL, 'alessandraf3027_00', '$2y$13$Qd30oF0sot5I9cJagoZG4OP01yZ1eaq1RKoAZFV48Cl/amPzJ0Q2G', 'ICBGPyDRdB2N15lI2NbMs4miPQKWn1D6', 'dWzR8YJOGcqar7oQRNj1VsKxx360BRjh', '127.0.0.1', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_auth`
--

CREATE TABLE IF NOT EXISTS `user_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_attributes` text COLLATE utf8_unicode_ci NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_auth_provider_id` (`provider_id`),
  KEY `user_auth_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_key`
--

CREATE TABLE IF NOT EXISTS `user_key` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `consume_time` timestamp NULL DEFAULT NULL,
  `expire_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_key_key` (`key`),
  KEY `user_key_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `tb_files`
--
ALTER TABLE `tb_files`
  ADD CONSTRAINT `fk_solicitation_id` FOREIGN KEY (`solicitation_id`) REFERENCES `tb_solicitation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_solicitation`
--
ALTER TABLE `tb_solicitation`
  ADD CONSTRAINT `fk_tb_location_id` FOREIGN KEY (`location_id`) REFERENCES `tb_location` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_typeperson_id` FOREIGN KEY (`typeperson_id`) REFERENCES `tb_typeperson` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_typesolicitation_id` FOREIGN KEY (`typesolicitation_id`) REFERENCES `tb_typesolicitation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ft_tb_status_id` FOREIGN KEY (`status_id`) REFERENCES `tb_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Limitadores para a tabela `user_auth`
--
ALTER TABLE `user_auth`
  ADD CONSTRAINT `user_auth_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `user_key`
--
ALTER TABLE `user_key`
  ADD CONSTRAINT `user_key_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
