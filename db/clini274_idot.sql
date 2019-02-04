-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 03-Fev-2019 às 07:32
-- Versão do servidor: 5.6.41-84.1
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clini274_idot`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `login` varchar(45) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `last_login` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `admin`
--

INSERT INTO `admin` (`admin_id`, `login`, `senha`, `email`, `last_login`) VALUES
(12, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '2019-01-29 14:43:56'),
(14, 'conrado', '81dc9bdb52d04dc20036dbd8313ed055', '', '2019-01-21 11:14:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamento`
--

CREATE TABLE `agendamento` (
  `agenda_id` int(11) NOT NULL,
  `data` date NOT NULL,
  `vagas` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `modulo_id` int(11) NOT NULL,
  `encontro_id` int(11) DEFAULT NULL,
  `sala_id` int(11) NOT NULL,
  `status` enum('aberto','fechado') NOT NULL DEFAULT 'aberto'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `agendamento`
--

INSERT INTO `agendamento` (`agenda_id`, `data`, `vagas`, `professor_id`, `curso_id`, `modulo_id`, `encontro_id`, `sala_id`, `status`) VALUES
(1, '2019-01-31', 2, 8, 22, 6, 1, 1, 'aberto'),
(5, '2019-01-30', 3, 8, 23, 7, 0, 1, 'aberto'),
(6, '2019-01-31', 4, 8, 24, 13, 2, 1, 'aberto'),
(8, '2019-01-29', 3, 10, 24, 10, 1, 1, 'aberto'),
(9, '2019-01-31', 4, 10, 24, 10, 1, 1, 'aberto'),
(10, '2019-01-31', 4, 10, 24, 10, 1, 1, 'aberto'),
(11, '2019-01-31', 4, 10, 24, 10, 1, 1, 'aberto');

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `alunos_id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `matricula` varchar(45) DEFAULT NULL,
  `login` varchar(45) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `data_cadastro` varchar(45) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `turma` varchar(45) DEFAULT NULL,
  `historico_turma` text,
  `last_login` varchar(45) NOT NULL,
  `cep` varchar(12) DEFAULT NULL,
  `complemento` varchar(45) DEFAULT NULL,
  `bairro` text,
  `telefone` varchar(45) DEFAULT NULL,
  `celular` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`alunos_id`, `nome`, `email`, `matricula`, `login`, `senha`, `data_cadastro`, `endereco`, `turma`, `historico_turma`, `last_login`, `cep`, `complemento`, `bairro`, `telefone`, `celular`) VALUES
(7, 'Robson', 'robson_eduardo@yahoo.com.br', '1', 'robson', '81dc9bdb52d04dc20036dbd8313ed055', '2019-01-21', 'rua pio XI', '1', '1', '2019-01-29 11:00:57', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_cursos`
--

CREATE TABLE `aluno_cursos` (
  `aluno_cursos_id` int(11) NOT NULL,
  `aluno_id` int(11) DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `modulo_id` int(11) DEFAULT NULL COMMENT '\n',
  `submodulo_id` int(11) DEFAULT NULL,
  `turma` varchar(45) DEFAULT NULL,
  `historico` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno_cursos`
--

INSERT INTO `aluno_cursos` (`aluno_cursos_id`, `aluno_id`, `curso_id`, `modulo_id`, `submodulo_id`, `turma`, `historico`) VALUES
(4, 7, 23, 7, 0, '1', '1'),
(5, 8, 24, 1, 1, '3', '2'),
(6, 9, 24, 10, 1, '1', '2'),
(7, 10, 24, 10, 1, '16', '2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aulas`
--

CREATE TABLE `aulas` (
  `aulas_id` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aulas`
--

INSERT INTO `aulas` (`aulas_id`, `titulo`, `status`) VALUES
(1, 'Como fazer um Select', 'ativo'),
(2, 'Oque são hooks', 'ativo'),
(3, 'MÓDULO I - Introdução a Osteopatia', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aula_modulos`
--

CREATE TABLE `aula_modulos` (
  `aula_modulos_id` int(11) NOT NULL,
  `aula_id` int(11) DEFAULT NULL,
  `modulo_id` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aula_modulos`
--

INSERT INTO `aula_modulos` (`aula_modulos_id`, `aula_id`, `modulo_id`) VALUES
(2, 1, '2'),
(3, 2, '3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `avisos`
--

CREATE TABLE `avisos` (
  `avisos_id` int(11) NOT NULL,
  `tipo` enum('admin','professor','aluno') DEFAULT NULL,
  `mensagem` text,
  `visualizado` enum('sim','nao') DEFAULT 'nao',
  `data` date DEFAULT NULL,
  `id` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `avisos`
--

INSERT INTO `avisos` (`avisos_id`, `tipo`, `mensagem`, `visualizado`, `data`, `id`) VALUES
(2, 'professor', 'Agendamento de nova aula', 'nao', '2019-01-20', '7'),
(3, 'professor', 'Agendamento de nova aula', 'nao', '2019-01-20', '7'),
(4, 'professor', 'Agendamento de nova aula', 'nao', '2019-01-20', '7'),
(5, 'professor', 'Agendamento de nova aula', 'nao', '2019-01-20', '7'),
(6, 'professor', 'Agendamento de nova aula', 'nao', '2019-01-21', '8'),
(7, 'professor', 'Agendamento de nova aula', 'nao', '2019-01-21', '8'),
(8, 'aluno', 'Há uma nova aula agendada para você no dia 31/01/2019', 'nao', '2019-01-27', '8'),
(9, 'professor', 'Há uma nova aula agendada para você no dia 31/01/2019', 'nao', '2019-01-27', '8'),
(10, 'aluno', 'Há uma nova aula agendada para você no dia 28/01/2019', 'nao', '2019-01-27', '7'),
(11, 'professor', 'Há uma nova aula agendada para você no dia 28/01/2019', 'nao', '2019-01-27', '8'),
(12, 'aluno', 'Há uma nova aula agendada para você no dia 30/01/2019', 'nao', '2019-01-27', '8'),
(13, 'professor', 'Há uma nova aula agendada para você no dia 30/01/2019', 'nao', '2019-01-27', '9'),
(14, 'aluno', 'Há uma nova aula agendada para você no dia 30/01/2019', 'nao', '2019-01-27', '8'),
(15, 'professor', 'Há uma nova aula agendada para você no dia 30/01/2019', 'nao', '2019-01-27', '10'),
(16, 'aluno', 'Há uma nova aula agendada para você no dia 30/01/2019', 'nao', '2019-01-27', '7'),
(17, 'professor', 'Há uma nova aula agendada para você no dia 30/01/2019', 'nao', '2019-01-27', '8'),
(18, 'aluno', 'Há uma nova aula agendada para você no dia 31/01/2019', 'nao', '2019-01-28', '8'),
(19, 'professor', 'Há uma nova aula agendada para você no dia 31/01/2019', 'nao', '2019-01-28', '8'),
(20, 'aluno', 'Há uma nova aula agendada para você no dia 29/01/2019', 'nao', '2019-01-28', '7'),
(21, 'professor', 'Há uma nova aula agendada para você no dia 29/01/2019', 'nao', '2019-01-28', '11'),
(22, 'aluno', 'Há uma nova aula agendada para você no dia 29/01/2019', 'nao', '2019-01-28', '8'),
(23, 'aluno', 'Há uma nova aula agendada para você no dia 29/01/2019', 'nao', '2019-01-28', '9'),
(24, 'aluno', 'Há uma nova aula agendada para você no dia 29/01/2019', 'nao', '2019-01-28', '10'),
(25, 'professor', 'Há uma nova aula agendada para você no dia 29/01/2019', 'nao', '2019-01-28', '10'),
(26, 'aluno', 'Há uma aula agendada para o dia // caso queira assistir, por favor confirme sua presença', 'nao', '2019-01-28', '8'),
(27, 'aluno', 'Há uma aula agendada para o dia // caso queira assistir, por favor confirme sua presença', 'nao', '2019-01-28', '9'),
(28, 'aluno', 'Há uma aula agendada para o dia // caso queira assistir, por favor confirme sua presença', 'nao', '2019-01-28', '10'),
(29, 'professor', 'Há uma aula agendada para o dia // caso queira assistir, por favor confirme sua presença', 'nao', '2019-01-28', '10'),
(30, 'aluno', 'Há uma aula agendada para o dia // caso queira assistir, por favor confirme sua presença', 'nao', '2019-01-28', '8'),
(31, 'aluno', 'Há uma aula agendada para o dia // caso queira assistir, por favor confirme sua presença', 'nao', '2019-01-28', '9'),
(32, 'aluno', 'Há uma aula agendada para o dia // caso queira assistir, por favor confirme sua presença', 'nao', '2019-01-28', '10'),
(33, 'professor', 'Há uma aula agendada para o dia // caso queira assistir, por favor confirme sua presença', 'nao', '2019-01-28', '10'),
(34, 'aluno', 'Há uma aula agendada para o dia 31/01/2019 caso queira assistir, por favor confirme sua presença', 'nao', '2019-01-28', '8'),
(35, 'aluno', 'Há uma aula agendada para o dia 31/01/2019 caso queira assistir, por favor confirme sua presença', 'nao', '2019-01-28', '9'),
(36, 'aluno', 'Há uma aula agendada para o dia 31/01/2019 caso queira assistir, por favor confirme sua presença', 'nao', '2019-01-28', '10'),
(37, 'professor', 'Há uma aula agendada para o dia 31/01/2019 caso queira assistir, por favor confirme sua presença', 'nao', '2019-01-28', '10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE `cursos` (
  `cursos_id` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `descricao` text,
  `nivel` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cursos`
--

INSERT INTO `cursos` (`cursos_id`, `titulo`, `status`, `descricao`, `nivel`) VALUES
(23, 'Sistemas musculoesquelético e neural', 'ativo', '<p><strong style=\"box-sizing: border-box; color: #3f3e3e; font-family: open_sansregular;\">O CURSO:</strong><span style=\"color: #3f3e3e; font-family: open_sansregular;\">&nbsp;compreende 16 encontros te&oacute;rico-pr&aacute;ticos, entre eles est&aacute;gios supervisionados para que os alunos possam estudar juntos com nossos professores e monitores de est&aacute;gio, sendo realizados aos finais de semana.</span></p>', 1),
(24, 'Sistema tônico-postural e vias de comunicação Sistemas visceral e vascular', 'ativo', '<p><strong style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">O CURSO: &nbsp;Compreende 20 m&oacute;dulos que s&atilde;o realizados em 10 encontros te&oacute;rico-pr&aacute;ticos.&nbsp;</strong></p>', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `departamentos`
--

CREATE TABLE `departamentos` (
  `departamento_id` int(11) NOT NULL,
  `titulo` varchar(150) CHARACTER SET latin1 NOT NULL,
  `email_responsavel` varchar(255) DEFAULT NULL,
  `status` enum('ativo','inativo') CHARACTER SET latin1 NOT NULL DEFAULT 'ativo',
  `empresa_id` int(11) NOT NULL,
  `tipo_trabalho` enum('banco_horas','horas_extras','ambas') NOT NULL DEFAULT 'ambas',
  `limite_bh` int(11) NOT NULL DEFAULT '60',
  `contar_pausa` tinyint(1) NOT NULL DEFAULT '1',
  `contar_falta` tinyint(1) NOT NULL DEFAULT '1',
  `debitar_saldo_horas` tinyint(1) NOT NULL DEFAULT '1',
  `exibir_horas` tinyint(1) NOT NULL DEFAULT '1',
  `ssid` varchar(100) NOT NULL,
  `bcc` tinyint(1) NOT NULL DEFAULT '1',
  `inicio_fechamento` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `departamentos`
--

INSERT INTO `departamentos` (`departamento_id`, `titulo`, `email_responsavel`, `status`, `empresa_id`, `tipo_trabalho`, `limite_bh`, `contar_pausa`, `contar_falta`, `debitar_saldo_horas`, `exibir_horas`, `ssid`, `bcc`, `inicio_fechamento`) VALUES
(2, 'Desenvolvimento', 'kauan@wvtodoz.com.br', 'ativo', 1, 'ambas', 2, 1, 1, 1, 1, '', 1, '0'),
(3, 'Design', 'de.akao@gmail.com', 'ativo', 1, 'banco_horas', 2, 1, 1, 1, 1, '', 1, '0'),
(4, 'Marketing', NULL, 'ativo', 1, 'horas_extras', 2, 1, 1, 1, 1, '', 1, ''),
(5, 'Atendimento', NULL, 'ativo', 1, 'horas_extras', 2, 1, 1, 1, 1, '', 1, ''),
(6, 'Administrativo', NULL, 'ativo', 1, 'ambas', 2, 1, 1, 1, 1, '', 1, '0'),
(7, 'Departamento Único', NULL, 'ativo', 2, 'horas_extras', 2, 1, 1, 1, 1, '', 1, ''),
(8, 'Departamento Único', NULL, 'ativo', 3, 'horas_extras', 2, 1, 1, 1, 1, '', 1, ''),
(9, 'Departamento Único', NULL, 'ativo', 4, 'horas_extras', 2, 1, 1, 1, 1, '', 1, ''),
(10, 'Departamento Único', NULL, 'ativo', 5, 'horas_extras', 2, 1, 1, 1, 1, '', 1, ''),
(11, 'Departamento Único', NULL, 'ativo', 6, 'horas_extras', 2, 1, 1, 1, 1, '', 1, ''),
(13, 'Departamento Único', NULL, 'ativo', 8, 'horas_extras', 2, 1, 1, 1, 1, '', 1, ''),
(14, 'Engenharia', NULL, 'ativo', 7, 'horas_extras', 2, 1, 1, 1, 1, '', 1, ''),
(15, 'Serviços', NULL, 'ativo', 7, 'horas_extras', 2, 1, 1, 1, 1, '', 1, ''),
(16, 'Comercial', NULL, 'ativo', 7, 'horas_extras', 2, 1, 1, 1, 1, '', 1, ''),
(17, 'Departamento Único', NULL, 'ativo', 9, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(18, 'Departamento Único', NULL, 'ativo', 10, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(19, 'Departamento Único', NULL, 'ativo', 11, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(20, 'Departamento Único', NULL, 'ativo', 12, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(21, 'Departamento Único', NULL, 'ativo', 13, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(22, 'Departamento Único', NULL, 'ativo', 14, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(23, 'Departamento Único', NULL, 'ativo', 15, '', 2, 1, 1, 1, 1, '', 1, ''),
(24, 'ADM', NULL, 'ativo', 15, '', 0, 1, 1, 1, 1, '', 1, ''),
(25, 'ENFERMGEM', NULL, 'ativo', 15, '', 0, 1, 1, 1, 1, '', 1, ''),
(27, 'PORTARIA', NULL, 'ativo', 15, '', 0, 1, 1, 1, 1, '', 1, ''),
(28, 'LIMPEZA', NULL, 'ativo', 15, '', 0, 1, 1, 1, 1, '', 1, ''),
(29, 'COPA', NULL, 'ativo', 15, '', 0, 1, 1, 1, 1, '', 1, ''),
(30, 'FARMÁRCIA', NULL, 'ativo', 15, '', 0, 1, 1, 1, 1, '', 1, ''),
(31, 'Departamento Único', NULL, 'ativo', 16, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(32, 'Vendas', '', 'ativo', 1, 'banco_horas', 2, 1, 1, 1, 1, '', 1, ''),
(33, 'Departamento Único', NULL, 'ativo', 17, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(34, 'Departamento Único', NULL, 'ativo', 18, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(35, 'Departamento Único', NULL, 'ativo', 19, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(36, 'Departamento Único', NULL, 'ativo', 20, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(37, 'Departamento Único', NULL, 'ativo', 21, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(38, 'Departamento Único', NULL, 'ativo', 22, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(40, 'COZINHA', NULL, 'ativo', 23, 'banco_horas', 1, 1, 1, 1, 1, '', 1, ''),
(41, 'SALAO', NULL, 'ativo', 23, 'banco_horas', 1, 1, 1, 1, 1, '', 1, ''),
(42, 'Departamento Único', NULL, 'ativo', 24, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(43, 'Vendas', NULL, 'ativo', 25, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(44, 'RH', NULL, 'ativo', 14, 'banco_horas', 1, 1, 1, 1, 1, '', 1, ''),
(45, 'Departamento Único', NULL, 'ativo', 26, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(46, 'Departamento Único', NULL, 'ativo', 27, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(47, 'Departamento Único', NULL, 'ativo', 28, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(48, 'Departamento Único', NULL, 'ativo', 29, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(49, 'Departamento Único', NULL, 'ativo', 30, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(50, 'Departamento Único', NULL, 'ativo', 31, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(51, 'Operacional', NULL, 'ativo', 30, 'banco_horas', 2, 1, 1, 1, 1, '', 1, ''),
(52, 'Departamento Único', '', 'ativo', 32, 'ambas', 2, 1, 1, 1, 0, '', 1, ''),
(53, 'Operacional', NULL, 'ativo', 32, 'banco_horas', 2, 1, 1, 1, 1, '', 1, ''),
(54, 'Departamento Único', NULL, 'ativo', 33, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(55, 'Operacional', NULL, 'ativo', 33, 'banco_horas', 2, 1, 1, 1, 1, '', 1, ''),
(56, 'Desenvolvimento', NULL, 'ativo', 34, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(57, 'Design', NULL, 'ativo', 34, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(58, 'Marketing', NULL, 'ativo', 34, 'horas_extras', 2, 1, 1, 1, 1, '', 1, ''),
(59, 'Atendimento', NULL, 'ativo', 34, 'horas_extras', 2, 1, 1, 1, 1, '', 1, ''),
(60, 'Administrativo', NULL, 'ativo', 34, 'horas_extras', 2, 1, 1, 1, 1, '', 1, ''),
(61, 'Vendas', NULL, 'ativo', 34, 'banco_horas', 2, 1, 1, 1, 1, '', 1, ''),
(62, 'Desenvolvimento', NULL, 'ativo', 35, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(63, 'Design', NULL, 'ativo', 35, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(64, 'Marketing', NULL, 'ativo', 35, 'horas_extras', 2, 1, 1, 1, 1, '', 1, ''),
(65, 'Atendimento', NULL, 'ativo', 35, 'horas_extras', 2, 1, 1, 1, 1, '', 1, ''),
(66, 'Administrativo', NULL, 'ativo', 35, 'horas_extras', 2, 1, 1, 1, 1, '', 1, ''),
(67, 'Vendas', NULL, 'ativo', 35, 'banco_horas', 2, 1, 1, 1, 1, '', 1, ''),
(68, 'Departamento Único', NULL, 'ativo', 37, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(69, 'Departamento Único', NULL, 'ativo', 38, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(70, 'Portaria', NULL, 'ativo', 37, 'horas_extras', 0, 1, 1, 1, 1, '', 1, ''),
(71, 'Zeladoria', NULL, 'ativo', 37, 'ambas', 0, 1, 1, 1, 1, '', 1, ''),
(72, 'Departamento Único', NULL, 'ativo', 39, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(73, 'Departamento Único', NULL, 'ativo', 40, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(93, 'Departamento Único', NULL, 'ativo', 45, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(97, 'DIRETORIA', NULL, 'ativo', 46, '', 2, 1, 1, 1, 1, '', 1, ''),
(98, 'Fazendas do Grupo Dalcin - Campo', NULL, 'ativo', 46, 'horas_extras', 0, 1, 1, 1, 1, '', 1, ''),
(99, 'Escritorio da Fazenda', NULL, 'ativo', 46, 'horas_extras', 0, 1, 1, 1, 1, '', 1, ''),
(100, 'Fazendas - Sede', NULL, 'ativo', 46, 'banco_horas', 0, 1, 1, 1, 1, '', 1, ''),
(105, 'Laboratorio - Processamento de analises', NULL, 'ativo', 47, 'banco_horas', 0, 1, 1, 1, 1, '', 1, ''),
(106, 'Laboratorio - Administrativo', NULL, 'ativo', 47, 'banco_horas', 0, 1, 1, 1, 1, '', 1, ''),
(107, 'GERENCIA', NULL, 'ativo', 47, '', 0, 1, 1, 1, 1, '', 1, ''),
(108, 'DIRETORIA', NULL, 'ativo', 47, 'banco_horas', 0, 1, 1, 1, 1, '', 1, ''),
(109, 'Suporte', NULL, 'ativo', 40, 'banco_horas', 0, 1, 1, 1, 1, '', 1, ''),
(110, 'Departamento Único', NULL, 'ativo', 48, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(111, 'Departamento Único', NULL, 'ativo', 49, 'ambas', 2, 1, 1, 1, 1, '', 1, ''),
(112, 'Adm', '', 'ativo', 50, 'horas_extras', 1, 1, 1, 1, 1, '', 1, ''),
(113, 'VENDAS', '', 'ativo', 51, 'banco_horas', 12, 1, 1, 1, 1, '', 1, ''),
(114, 'CAIXA', '', 'ativo', 51, 'banco_horas', 12, 0, 1, 1, 1, '', 1, ''),
(115, 'MOTORISTA E AJUDANTES', '', 'ativo', 51, 'banco_horas', 12, 1, 1, 1, 1, '', 1, ''),
(116, 'Departamento Único', NULL, 'ativo', 52, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(118, 'Departamento Único', NULL, 'ativo', 53, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(119, 'Departamento Único', NULL, 'ativo', 54, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(120, 'Departamento Único', NULL, 'ativo', 55, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(121, 'Departamento Único', NULL, 'ativo', 56, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(122, 'Departamento Único', NULL, 'ativo', 57, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(123, 'Departamento Único', 'rh@advocaciashimada.com.br', 'ativo', 58, 'banco_horas', 180, 1, 1, 1, 1, '', 1, ''),
(124, 'Departamento Único', NULL, 'ativo', 59, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(128, 'Departamento Único', NULL, 'ativo', 63, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(129, 'Departamento Único', NULL, 'ativo', 64, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(130, 'Departamento Único', NULL, 'ativo', 65, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(131, 'Departamento Único', NULL, 'ativo', 66, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(132, 'Departamento Único', NULL, 'ativo', 67, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(133, 'Departamento Único', NULL, 'ativo', 68, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(134, 'Departamento Único', NULL, 'ativo', 69, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(135, 'Departamento Único', NULL, 'ativo', 70, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(136, 'Departamento Único', NULL, 'ativo', 71, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(137, 'Departamento Único', NULL, 'ativo', 72, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(138, 'Departamento Externo', 'irossi@envisionpm.com.br', 'ativo', 73, '', 60, 1, 1, 1, 1, '', 1, ''),
(139, 'Departamento Único', 'arnaldo@revisautovistorias.com.br', 'ativo', 74, 'horas_extras', 60, 1, 1, 1, 1, '', 1, ''),
(140, 'Departamento Interno', '', 'ativo', 73, 'banco_horas', 60, 0, 1, 1, 1, '', 1, ''),
(141, 'Departamento Único', 'raphaelwd@hotmail.com', 'ativo', 75, 'ambas', 6, 1, 1, 1, 1, '', 1, ''),
(142, 'Departamento Único', NULL, 'ativo', 76, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(143, 'Integral/ Escritório', 'irossi@envisionpm.com.br', 'ativo', 73, 'banco_horas', 100, 1, 1, 1, 1, '', 1, ''),
(144, 'Departamento Único', NULL, 'ativo', 77, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(145, 'Departamento Único', NULL, 'ativo', 78, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(146, 'ADMINISTRATIVO', 'aparelhoauditivos.brasilia@gmail.com', 'ativo', 79, 'banco_horas', 6, 1, 1, 1, 1, '', 1, ''),
(147, 'manutenção', '', 'ativo', 1, 'horas_extras', 0, 1, 1, 1, 0, '', 1, ''),
(148, 'limpeza', '', 'ativo', 1, 'banco_horas', 0, 0, 1, 1, 0, 'WVFacileme 5GHz', 0, ''),
(149, 'RECEPÇÃO', 'aparelhoauditivos.brasilia@gmail.com', 'ativo', 79, 'banco_horas', 6, 1, 1, 1, 0, '', 1, ''),
(150, 'FONOAUDIOLOGOS', 'aparelhoauditivos.brasilia@gmail.com', 'ativo', 79, 'banco_horas', 6, 1, 1, 1, 0, '', 1, ''),
(151, 'MARKETING', 'aparelhoauditivos.brasilia@gmail.com', 'ativo', 79, 'banco_horas', 6, 1, 1, 1, 0, '', 1, ''),
(152, 'LABORATORIO', 'aparelhoauditivos.brasilia@gmail.com', 'ativo', 79, 'banco_horas', 6, 1, 1, 1, 0, '', 1, ''),
(153, 'ESTOQUE', 'aparelhoauditivos.brasilia@gmail.com', 'ativo', 79, 'banco_horas', 6, 1, 1, 1, 0, '', 1, ''),
(154, 'COPA', 'aparelhoauditivos.brasilia@gmail.com', 'ativo', 79, 'banco_horas', 6, 1, 1, 1, 0, '', 1, ''),
(155, 'RELAÇÕES PUBLICAS', 'aparelhoauditivos.brasilia@gmail.com', 'ativo', 79, 'banco_horas', 6, 1, 1, 1, 0, '', 1, ''),
(156, 'Departamento Único', NULL, 'ativo', 80, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(157, 'Departamento Único', 'anastacia.silva@gympass.com', 'ativo', 81, 'banco_horas', 0, 1, 1, 1, 1, '', 1, ''),
(158, 'ADMINISTRATIVO', 'aparelhoauditivos.brasilia@gmail.com', 'ativo', 82, 'banco_horas', 6, 1, 1, 1, 1, '', 1, ''),
(159, 'RECEPÇÃO', 'aparelhoauditivos.brasilia@gmail.com', 'ativo', 82, 'banco_horas', 6, 1, 1, 1, 0, '', 1, ''),
(160, 'FONOAUDIOLOGOS', 'aparelhoauditivos.brasilia@gmail.com', 'ativo', 82, 'banco_horas', 6, 1, 1, 1, 0, '', 1, ''),
(161, 'MARKETING', 'aparelhoauditivos.brasilia@gmail.com', 'ativo', 82, 'banco_horas', 6, 1, 1, 1, 0, '', 1, ''),
(162, 'LABORATORIO', 'aparelhoauditivos.brasilia@gmail.com', 'ativo', 82, 'banco_horas', 6, 1, 1, 1, 0, '', 1, ''),
(163, 'ESTOQUE', 'aparelhoauditivos.brasilia@gmail.com', 'ativo', 82, 'banco_horas', 6, 1, 1, 1, 0, '', 1, ''),
(164, 'COPA', 'aparelhoauditivos.brasilia@gmail.com', 'ativo', 82, 'banco_horas', 6, 1, 1, 1, 0, '', 1, ''),
(165, 'RELAÇÕES PUBLICAS', 'aparelhoauditivos.brasilia@gmail.com', 'ativo', 82, 'banco_horas', 6, 1, 1, 1, 0, '', 1, ''),
(166, 'Departamento Único', '', 'ativo', 83, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(167, 'DEPARTAMENTO ADM', 'rh@akousis.com.br', 'ativo', 84, '', 60, 1, 1, 1, 1, '', 1, ''),
(168, 'Departamento Único', '', 'ativo', 85, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(169, 'Departamento Único', NULL, 'ativo', 86, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(170, 'SHOPPING ABC', 'elza@giulianaflores.com.br', 'ativo', 83, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(171, 'SHOPPING ANALIA FRANCO', 'elza@giulianaflores.com.br', 'ativo', 83, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(172, 'SHOPPING ARICANDUVA', 'elza@giulianaflores.com.br', 'ativo', 83, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(173, 'SHOPPING CENTER 3', 'elza@giulianaflores.com.br', 'ativo', 83, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(174, 'SHOPPING VILA OLIMPIA', '', 'ativo', 83, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(175, 'SHOPPING CIDADE SP', '', 'ativo', 83, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(176, 'SHOPPING CENTER NORTE', '', 'ativo', 83, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(177, 'SHOPPING GRAND PLAZA', 'elza@giulianaflores.com.br', 'ativo', 83, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(178, 'SHOPPING IBIRAPUERA', 'elza@giulianaflores.com.br', 'ativo', 83, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(179, 'SHOPPING GRANJA VIANNA', 'elza@giulianaflores.com.br', 'ativo', 83, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(180, 'SHOPPING MOOCA', '', 'ativo', 83, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(181, 'SHOPPING SCS', 'elza@giulianaflores.com.br', 'ativo', 83, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(182, 'SHOPPING PATIO PAULISTA', 'elza@giulianaflores.com.br', 'ativo', 83, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(183, 'SHOPPING SANTA CRUZ', 'elza@giulianaflores.com.br', 'ativo', 83, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(184, 'SHOPPING TAMBORÉ', 'elza@giulianaflores.com.br', 'ativo', 83, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(185, 'SHOPPING TIETE', 'elza@giulianaflores.com.br', 'ativo', 83, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(186, 'SHOPPING TUCURUVI', 'elza@giulianaflores.com.br', 'ativo', 83, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(188, 'Departamento  ADM', 'rh@akousis.com.br', 'ativo', 87, '', 60, 1, 1, 1, 1, '', 1, ''),
(189, 'Departamento  JARDINS', 'rh@akousis.com.br', 'ativo', 88, '', 60, 1, 1, 1, 1, '', 1, ''),
(190, 'Departamento  ADM', 'rh@akousis.com.br', 'ativo', 89, '', 60, 1, 1, 1, 1, '', 1, ''),
(191, 'Departamento  ADM', 'rh@akousis.com.br', 'ativo', 90, '', 60, 1, 1, 1, 1, '', 1, ''),
(192, 'Departamento  Lapa', 'rh@akousis.com.br', 'ativo', 91, '', 60, 1, 1, 1, 1, '', 1, ''),
(193, 'Departamento  TATUAPÉ', 'rh@akousis.com.br', 'ativo', 92, '', 60, 1, 1, 1, 1, '', 1, ''),
(194, 'Departamento  ADM', 'rh@akousis.com.br', 'ativo', 93, '', 60, 1, 1, 1, 1, '', 1, ''),
(195, 'Departamento  GUARULHOS', 'rh@akousis.com.br', 'ativo', 94, '', 60, 1, 1, 1, 1, '', 1, ''),
(196, 'Departamento  SANTANA', 'rh@akousis.com.br', 'ativo', 95, '', 60, 1, 1, 1, 1, '', 1, ''),
(197, 'Departamento  Moema', 'rh@akousis.com.br', 'ativo', 96, '', 60, 1, 1, 1, 1, '', 1, ''),
(198, 'Departamento  ADM', 'rh@akousis.com.br', 'ativo', 97, '', 60, 1, 1, 1, 1, '', 1, ''),
(199, 'Departamento  Morumbi', 'rh@akousis.com.br', 'ativo', 98, '', 60, 1, 1, 1, 1, '', 1, ''),
(200, 'Departamento  HIGIENÓPOLIS', 'rh@akousis.com.br', 'ativo', 99, '', 60, 1, 1, 1, 1, '', 1, ''),
(201, 'Departamento  VILA MARIANA', 'rh@akousis.com.br', 'ativo', 100, '', 60, 1, 1, 1, 1, '', 1, ''),
(213, 'Departamento Padrão', 'junior@edumaxdobrasil.com.br', 'ativo', 101, 'banco_horas', 60, 1, 1, 1, 1, '', 1, ''),
(214, 'Administrativo', 'junior@edumaxdobrasil.com.br', 'ativo', 102, 'banco_horas', 60, 1, 1, 1, 1, '', 1, ''),
(215, 'Produção', 'junior@edumaxdobrasil.com.br', 'ativo', 102, 'banco_horas', 60, 1, 1, 1, 0, '', 1, ''),
(216, 'SHOPPING ABC', '', 'ativo', 85, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(217, 'SHOPPING ANALIA FRANCO', '', 'ativo', 85, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(218, 'SHOPPING ARICANDUVA', '', 'ativo', 85, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(219, 'SHOPPING CENTER 3', '', 'ativo', 85, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(220, 'SHOPPING GRAND PLAZA', '', 'ativo', 85, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(221, 'SHOPPING CENTER NORTE', '', 'ativo', 85, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(222, 'SHOPPING CIDADE SP', '', 'ativo', 85, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(223, 'SHOPPING GRANJA VIANNA', '', 'ativo', 85, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(224, 'SHOPPING IBIRAPUERA', '', 'ativo', 85, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(225, 'SHOPPING MOOCA', '', 'ativo', 85, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(226, 'SHOPPING PATIO PAULISTA', '', 'ativo', 85, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(227, 'SHOPPING SANTA CRUZ', '', 'ativo', 85, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(228, 'SHOPPING TAMBORÉ', '', 'ativo', 85, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(229, 'SHOPPING SCS', '', 'ativo', 85, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(230, 'SHOPPING TIETE', '', 'ativo', 85, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(231, 'SHOPPING TUCURUVI', '', 'ativo', 85, 'ambas', 0, 0, 1, 1, 0, '', 1, ''),
(232, 'DEPARTAMENTO JARDINS', 'rh@akousis.com.br', 'ativo', 103, '', 60, 1, 1, 1, 1, '', 1, ''),
(233, 'DEPARTAMENTO STO AMARO', 'rh@akousis.com.br', 'ativo', 104, '', 60, 1, 1, 1, 1, '', 1, ''),
(234, 'Recepção', 'yara.brito@gympass.com', 'ativo', 81, 'banco_horas', 1, 1, 1, 1, 0, '', 1, ''),
(235, 'DEPARTAMENTO STO AMARO', 'rh@akousis.com.br', 'ativo', 105, '', 60, 1, 1, 1, 1, '', 1, ''),
(236, 'Departamento Único', NULL, 'ativo', 106, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(237, 'Escritório', 'andre@construtorariobranco.com.br', 'ativo', 107, 'horas_extras', 60, 1, 1, 1, 1, '', 1, ''),
(238, 'Contabil', '', 'ativo', 108, 'banco_horas', 60, 1, 1, 1, 1, '', 1, ''),
(239, 'Fiscal', '', 'ativo', 108, 'banco_horas', 0, 0, 1, 1, 0, '', 1, ''),
(240, 'Pessoal', '', 'ativo', 108, 'banco_horas', 0, 0, 1, 1, 0, '', 1, ''),
(241, 'Legalização', '', 'ativo', 108, 'banco_horas', 0, 0, 1, 1, 0, '', 1, ''),
(242, 'Externo', '', 'ativo', 108, 'banco_horas', 0, 0, 1, 1, 0, '', 1, ''),
(243, 'Cozinha', '', 'ativo', 108, 'banco_horas', 0, 0, 1, 1, 0, '', 1, ''),
(244, 'Limpeza', '', 'ativo', 108, 'banco_horas', 0, 0, 1, 1, 0, '', 1, ''),
(246, 'Administrativo', '', 'ativo', 108, 'banco_horas', 0, 0, 1, 1, 0, '', 1, ''),
(247, 'Recepção', '', 'ativo', 108, 'banco_horas', 0, 0, 1, 1, 0, '', 1, ''),
(248, 'Contabil', '', '', 109, 'banco_horas', 60, 1, 1, 1, 1, '', 1, ''),
(249, 'Fiscal', '', 'ativo', 109, 'banco_horas', 0, 0, 1, 1, 0, '', 1, ''),
(250, 'Pessoal', '', 'ativo', 109, 'banco_horas', 0, 0, 1, 1, 0, '', 1, ''),
(251, 'Legalização', '', 'ativo', 109, 'banco_horas', 0, 0, 1, 1, 0, '', 1, ''),
(252, 'Externo', '', 'ativo', 109, 'banco_horas', 0, 0, 1, 1, 0, '', 1, ''),
(253, 'Cozinha', '', 'ativo', 109, 'banco_horas', 0, 0, 1, 1, 0, '', 1, ''),
(254, 'Limpeza', '', 'ativo', 109, 'banco_horas', 0, 0, 1, 1, 0, '', 1, ''),
(255, 'Administrativo', '', 'ativo', 109, 'banco_horas', 0, 0, 1, 1, 0, '', 1, ''),
(256, 'Recepção', '', 'ativo', 109, 'banco_horas', 0, 0, 1, 1, 0, '', 1, ''),
(257, 'Departamento Único', NULL, 'ativo', 111, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(258, 'Trabalhista', 'daniel.santos@confirp.com', 'ativo', 111, 'horas_extras', 0, 0, 1, 1, 0, '', 1, ''),
(259, 'Small Bussiness', 'daniel.santos@confirp.com', 'ativo', 111, 'horas_extras', 0, 0, 1, 1, 0, '', 1, ''),
(260, 'Departamento Único', NULL, 'ativo', 112, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(261, 'Departamento Único', NULL, 'ativo', 113, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(262, 'Departamento Único', NULL, 'ativo', 114, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(263, 'Departamento Único', NULL, 'ativo', 115, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(264, 'Desenvolvimento', 'denis@wvtodoz.com.br', 'ativo', 115, 'banco_horas', 2, 1, 1, 1, 1, '', 1, ''),
(266, 'Departamento Único', NULL, 'ativo', 116, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(267, 'Departamento Único', NULL, 'ativo', 117, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(268, 'Departamento Único', NULL, 'ativo', 118, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(269, 'Departamento Único', NULL, 'ativo', 119, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(270, 'Departamento Único', NULL, 'ativo', 120, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(271, 'Departamento Único', NULL, 'ativo', 121, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(272, 'Departamento Único', NULL, 'ativo', 122, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(273, 'Departamento Único', NULL, 'ativo', 123, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(274, 'Departamento Único', NULL, 'ativo', 124, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(275, 'Departamento Único', NULL, 'ativo', 125, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(276, 'Departamento Único', NULL, 'ativo', 126, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(277, 'Departamento Único', NULL, 'ativo', 127, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(278, 'Departamento Único', NULL, 'ativo', 128, 'ambas', 60, 1, 1, 1, 1, '', 1, ''),
(279, 'Departamento café', NULL, 'ativo', 1, 'banco_horas', 0, 0, 1, 1, 0, '', 1, ''),
(281, 'Departamento Único', NULL, 'ativo', 129, 'ambas', 60, 1, 1, 1, 1, '', 1, NULL),
(282, 'Departamento Único', NULL, 'ativo', 130, 'ambas', 60, 1, 1, 1, 1, '', 1, NULL),
(283, 'Departamento Único', NULL, 'ativo', 131, 'ambas', 60, 1, 1, 1, 1, '', 1, NULL),
(284, 'Departamento Único', NULL, 'ativo', 132, 'ambas', 60, 1, 1, 1, 1, '', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresas`
--

CREATE TABLE `empresas` (
  `empresa_id` int(11) NOT NULL,
  `nome` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `tipo_cadastro` enum('pf','pj') NOT NULL DEFAULT 'pj',
  `cnpj_cpf` varchar(22) CHARACTER SET latin1 DEFAULT NULL,
  `telefone` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('ativo','inativo') CHARACTER SET latin1 DEFAULT NULL,
  `codigo` varchar(45) CHARACTER SET latin1 NOT NULL,
  `faceListId` varchar(150) CHARACTER SET latin1 NOT NULL,
  `plano_id` int(11) DEFAULT NULL,
  `apiToken` varchar(255) DEFAULT NULL,
  `logo` varchar(150) DEFAULT NULL,
  `msg_welcome` varchar(150) NOT NULL,
  `data_expiracao` date NOT NULL,
  `cep` varchar(9) NOT NULL,
  `logradouro` varchar(150) NOT NULL,
  `numero` varchar(5) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` char(2) NOT NULL,
  `complemento` varchar(100) NOT NULL,
  `valor_funcionario` float DEFAULT NULL,
  `url_api` varchar(255) NOT NULL DEFAULT 'https://app.letswork.com.br/api/',
  `nome_fantasia` varchar(150) NOT NULL,
  `is_filial` tinyint(1) NOT NULL DEFAULT '0',
  `excluido` tinyint(1) DEFAULT '0',
  `indicacao_id` int(11) DEFAULT NULL,
  `auto_acoes` tinyint(1) NOT NULL DEFAULT '0',
  `cobrar_inativos` tinyint(1) NOT NULL DEFAULT '1',
  `contrato` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `empresas`
--

INSERT INTO `empresas` (`empresa_id`, `nome`, `tipo_cadastro`, `cnpj_cpf`, `telefone`, `data_criacao`, `status`, `codigo`, `faceListId`, `plano_id`, `apiToken`, `logo`, `msg_welcome`, `data_expiracao`, `cep`, `logradouro`, `numero`, `bairro`, `cidade`, `estado`, `complemento`, `valor_funcionario`, `url_api`, `nome_fantasia`, `is_filial`, `excluido`, `indicacao_id`, `auto_acoes`, `cobrar_inativos`, `contrato`) VALUES
(1, 'WV_Todoz Agencia Interativa Ltda', 'pj', '08.806.769/0001-03', '(11) 5531-1779', '2018-12-05 17:11:45', 'ativo', '123123', '1', 1, '33398d9ffd75415bb5dbbab79d335e37', '', 'Bem Vindo à wv todos!', '0000-00-00', '04703-004', 'Av. Morumbi', '8435', 'Brooklin', 'São Paulo', 'SP', 'sala 104', NULL, 'https://app.letswork.com.br/api/', 'WV_Todoz', 0, 0, NULL, 0, 0, 1),
(2, 'WV_Todoz', 'pj', '31.231.231/3123-12', '(12) 31231-2312', '2017-01-24 00:30:36', 'ativo', '000001', '2', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à WV_Todoz', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 1, NULL, 0, 0, 0),
(3, 'Facíleme', 'pj', '12.312.313/1231-23', '(11) 12121-1212', '2017-02-15 19:46:46', 'ativo', '259911', '3', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Facíleme', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 1, NULL, 0, 0, 0),
(4, 'Fragmaq Indústria de Maquinas Ltda', 'pj', '44.031.631/0001-43', '(11) 99839-8821', '2017-02-21 20:54:53', 'ativo', '381126', '4', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Fragmaq Indústria de Maquinas Ltda', '2017-05-06', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 1, NULL, 0, 0, 0),
(5, 'Fragmaq Indústria de Maquinas Ltda', 'pj', '44.031.631/0001-43', '(11) 99839-8821', '2017-02-21 20:58:35', 'ativo', '479718', '5', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Fragmaq Indústria de Maquinas Ltda', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 1, NULL, 0, 0, 0),
(6, 'Ana Paula Sayuri Ribeiro', 'pj', '07.336.627/0001-67', '(11) 98236-6412', '2017-02-22 22:05:46', 'inativo', '138066', '6', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Ana Paula Sayuri Ribeiro', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(7, 'MTX Engenharia LTDA - ME', 'pj', '17.223.665/0001-67', '(19) 4109-0111', '2017-03-03 16:54:12', 'inativo', '671394', '7', 1, '5d54533df8554e50bee819feee4e6c19', '', 'Bem vindo à MTX Engenharia -ME', '2017-04-09', '13478-560', 'Rua Paraná', '453', 'Vila Nossa Senhora de Fátima', 'Americana', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'MTX Engenharia & Serviços', 0, 0, NULL, 0, 0, 0),
(8, 'Facileme', 'pj', '12.312.312/3123-12', '(12) 31312-3123', '2017-03-09 18:47:38', 'ativo', '752396', '8', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Facileme', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 1, NULL, 0, 0, 0),
(9, 'Bate ponto', 'pj', '04.039.689/0001-19', '(84) 41410-640', '2017-03-20 12:48:44', 'ativo', '640702', '9', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Bate ponto', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 1, NULL, 0, 0, 0),
(10, 'orthox odontologia especializada ltda', 'pj', '15.497.146/0001-61', '(21) 98888-3498', '2017-03-24 15:59:40', 'inativo', '474791', '10', 1, 'b2e8e922e62d4665b24b26e47da09f0d', '', 'Bem vindo à orthox odontologia especializada ltda', '0000-00-00', '24020-084', 'Rua da Conceição', '144', 'Centro', 'Niterói', 'RJ', 'sobreloja', NULL, 'https://app.letswork.com.br/api/', 'Ortho X', 0, 0, NULL, 0, 0, 0),
(11, 'Formatcom consultoria e informática', 'pj', '26.691.875/0001-70', '(87) 99939-9448', '2017-03-31 12:16:14', 'inativo', '956366', '11', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Formatcom consultoria e informática', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(12, 'Marcelo Roncada Transportes ME', 'pj', '22.781.251/0001-93', '(16) 33428-933', '2017-04-03 17:28:02', 'inativo', '577202', '12', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Marcelo Roncada Transportes ME', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(13, 'WILLIAM BARBOSA XAVIER ME', 'pj', '20.136.940/0001-10', '(19) 38466-534', '2017-04-03 21:25:06', 'inativo', '386726', '13', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à WILLIAM BARBOSA XAVIER ME', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(14, 'Ivalis', 'pj', '18.175.677/0001-26', '(11) 2376-6259', '2017-04-03 23:20:30', 'ativo', '997382', '14', 1, '33398d9ffd75415bb5dbbab79d335e37', '', 'Bem vindo à Ivalis', '0000-00-00', '09531-190', 'Alameda Terracota', '135', 'Cerâmica', 'São Caetano do Sul', 'SP', 'cj 1417', NULL, 'https://app.letswork.com.br/api/', 'Ivalis', 0, 0, NULL, 0, 0, 0),
(15, 'SP Day Hospital Ass. Médica Ltda.', 'pj', '10.339.268/0001-06', '(11) 3831-7777', '2017-04-06 00:07:57', 'ativo', '636480', '15', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à SP Day Hospital Ass. Médica Ltda.', '0000-00-00', '05089-001', 'Rua Guaipá', '509', 'Vila Leopoldina', 'São Paulo', 'SP', '', 5.5, 'https://app.letswork.com.br/api/', 'SP Day Hospital', 0, 0, NULL, 0, 0, 0),
(16, 'GERMANIA MOEMA', 'pj', '19.762.711/0001-21', '(11) 50515-024', '2017-04-18 20:39:09', 'inativo', '948240', '16', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à GERMANIA MOEMA', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(17, 'Lojas Barracão', 'pj', '04.851.609/0001-25', '(11) 32218-488', '2017-05-31 20:21:28', 'inativo', '245774', '17', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Lojas Barracão', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(18, 'ITELNET SOLUCOES LTDA – ME', 'pj', '10.507.946/0001-00', '(11) 58232-863', '2017-06-06 22:24:48', 'inativo', '816075', '18', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à ITELNET SOLUCOES LTDA – ME', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(19, 'Centro Brasileiro de Estudos em Ecologia de E', 'pj', '07.905.127/0001-07', '(32) 98702-2006', '2017-06-14 23:32:47', 'inativo', '225668', '19', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Centro Brasileiro de Estudos em Ecologia de Estradas', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(20, 'Tupi Transportes Urbanos Piratininga Ltda.', 'pj', '61.380.101/0001-20', '(11) 5671-7177', '2017-06-30 18:10:02', 'inativo', '934195', '20', 1, '364b148f5f57477b89985740b21ba99d', '', 'Bem vindo à Tupi Transportes Urbanos', '0000-00-00', '04361-000', 'R. Jorge Duprat Figueiredo', '148', 'Vila Paulista', 'São Paulo', 'SP', '', 7, 'https://app.letswork.com.br/api/', 'Tupi Transportes Urbanos', 0, 0, NULL, 0, 0, 0),
(21, 'Atelie dos Doces', 'pj', '25.371.656/0001-41', '(62) 03624-1322', '2017-07-03 02:41:11', 'inativo', '909975', '21', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Atelie dos Doces', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(22, 'Atelie dos Doces', 'pj', '25.371.656/0001-41', '(62) 98458-7897', '2017-07-03 16:18:38', 'inativo', '266846', '22', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Atelie dos Doces', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(23, 'Samosa e Company Interesting Food Ltda', 'pj', '19.560.456/0001-34', '(11) 94536-7617', '2017-07-04 23:41:15', 'inativo', '152938', '23', 1, '0395fc6e84684e1781ae6ad2db3605a3', '', 'Bem vindo à Samosa & Company Interesting Food Ltda', '0000-00-00', '01420-007', 'Alameda Jaú', '1639', 'Jardim Paulista', 'São Paulo', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'Samosa Jardins', 0, 0, NULL, 0, 0, 0),
(24, 'soul custom confecçoes e acessorios ldta', 'pj', '26.390.187/0001-80', '(11) 94729-2157', '2017-07-10 15:10:47', 'inativo', '987170', '24', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à soul custom confecçoes e acessorios ldta', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(25, 'Iphykiss Comercio e Serviços Ltda - ME', 'pj', '05.400.964/0001-40', '(11) 41782-143', '2017-07-17 18:49:05', 'inativo', '493505', '7', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Iphykiss Comercio e Serviços Ltda - ME', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(26, 'Rafael e Manuela Limpeza ME', 'pj', '00.821.645/0001-95', '(87) 38484-708', '2017-07-23 18:28:57', 'inativo', '951638', '7', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Rafael e Manuela Limpeza ME', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(27, 'Baú Serviços e Corretora de Seguros', 'pj', '23.456.383/0001-02', '(11) 38926-960', '2017-08-02 16:31:03', 'inativo', '948801', '7', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Baú Serviços e Corretora de Seguros', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(28, 'fswfsdfdsf', 'pj', '21.212.121/2122-12', '(22) 12121-2121', '2017-08-04 01:29:40', 'ativo', '471809', '7', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à fswfsdfdsf', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 1, NULL, 0, 0, 0),
(29, 'João Alves Pereira me', 'pj', '21.492.555/0001-78', '(64) 98146-8313', '2017-08-05 15:46:26', 'inativo', '500373', '7', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à João Alves Pereira me', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(30, 'MANUPORT ASSESSORIA ADUANEIRA E LOGISTICA LTD', 'pj', '13.089.240/0001-56', '(11) 2198-9859', '2017-08-23 20:57:52', 'ativo', '402764', '30', 1, '33398d9ffd75415bb5dbbab79d335e37', '', 'Bem vindo à MANUPORT ASSESSORIA ADUANEIRA E LOGISTICA LTDA', '0000-00-00', '11010-091', 'Rua Frei Gaspar', '22', 'Centro', 'Santos', 'SP', '10 ANDAR CONJ 101', NULL, 'https://app.letswork.com.br/api/', 'MANUPORT ASSESSORIA - SANTOS', 1, 0, NULL, 0, 0, 0),
(31, 'Samuel Francisco EPP', 'pj', '22.233.679/0001-00', '(11) 99374-4712', '2017-08-29 14:19:56', 'inativo', '818885', '7', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Samuel Francisco EPP', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(32, 'MANUPORT ASSESSORIA ADUANEIRA E LOGISTICA LTD', 'pj', '13.089.240/0002-37', '(11) 2198-9859', '2017-09-01 13:29:05', 'ativo', '490546', '32', 1, '33398d9ffd75415bb5dbbab79d335e37', '', '', '0000-00-00', '13049-253', 'Avenida Antonio Artioli', '570', 'Swiss Park', 'Campinas', 'SP', 'SALA 108 ED SANTIS', NULL, 'https://app.letswork.com.br/api/', 'MANUPORT ASSESSORIA - CAMPINAS', 1, 0, NULL, 0, 0, 0),
(33, 'MANUPORT LOGISTICS DO BRASIL LTDA', 'pj', '07.696.753/0001-22', '(11) 2198-9859', '2017-09-01 13:30:04', 'ativo', '792615', '33', 1, '33398d9ffd75415bb5dbbab79d335e37', '', '', '0000-00-00', '04729-080', 'Rua Luiz Seráphico Júnior', '511', 'Jardim Caravelas', 'São Paulo', 'SP', '18 ANDAR', NULL, 'https://app.letswork.com.br/api/', 'MANUPORT - SP', 0, 0, NULL, 0, 0, 0),
(34, 'Facíleme Ingresso', 'pj', '52.845.158/0001-66', '(11) 5531-1779', '2017-09-01 14:38:14', 'ativo', '708479', '1', 1, '33398d9ffd75415bb5dbbab79d335e37', '', '', '0000-00-00', '04703-004', 'Avenida Morumbi', '8435', 'Santo Amaro', 'São Paulo', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'Facíleme Ingresso', 1, 0, NULL, 0, 0, 0),
(35, 'Let´s Work', 'pj', '19.902.167/0001-76', '(11) 5531-1779', '2017-09-01 14:39:20', 'ativo', '671080', '1', 1, '33398d9ffd75415bb5dbbab79d335e37', '', '', '0000-00-00', '04703-004', 'Avenida Morumbi', '8435', 'Santo Amaro', 'São Paulo', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'let´s work', 1, 0, NULL, 0, 0, 0),
(37, 'Spazio Rio Fraser', 'pj', '12.726.783/0001-74', '(17) 41412-646', '2017-09-06 21:45:12', 'inativo', '746382', '37', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Spazio Rio Fraser', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(38, 'Leandro dos Anjos Pereira', 'pj', '26.693.809/0001-30', '(11) 95705-0107', '2017-09-08 23:07:22', 'inativo', '242851', '38', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Leandro dos Anjos Pereira', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(39, 'HORTYFRIOS', 'pj', '04.338.937/0001-22', '(89) 34225-044', '2017-09-25 16:41:19', 'inativo', '911132', '39', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à HORTYFRIOS', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(40, 'DMCARD', 'pj', '05.355.090/0001-57', '(12) 21360-120', '2017-09-25 23:34:18', 'inativo', '270560', '40', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à DMCARD', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(41, 'EDIANE DE MIRANDA CASTRO DALCIN', 'pj', '78.317.320/120', '(66) 99988-5873', '2017-10-24 21:35:56', 'inativo', '533960', '41', 1, 'b2e8e922e62d4665b24b26e47da09f0d', '', 'Bem vindo à EDIANE DE MIRANDA CASTRO DALCIN', '0000-00-00', '78690-000', 'FAZENDA MONTE ALEGRE - LOTE 11 A 37KM DA SEDE, S/N', 'S/N', 'ZONA RURAL', 'Nova Xavantina', 'MT', '', NULL, 'https://app.letswork.com.br/api/', 'Ediane de Miranda Castro Dalcin', 0, 0, NULL, 0, 0, 0),
(45, 'Leandro dos Anjos Pereira', 'pj', '26.693.809/0001-30', '(11) 95705-0107', '2017-10-29 18:19:45', 'inativo', '294490', '45', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Leandro dos Anjos Pereira', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(46, 'Endrigo Dalcin', 'pj', '55.026.796/168', '(66) 99988-5872', '2017-11-01 00:11:39', 'inativo', '935184', '46', 1, 'b2e8e922e62d4665b24b26e47da09f0d', '', '', '0000-00-00', '78690-000', 'Fazenda Monique', 'S/N', 'ZONA RURAL', 'Nova Xavantina', 'MT', '', NULL, 'https://app.letswork.com.br/api/', 'Endrigo Dalcin', 1, 0, NULL, 0, 0, 0),
(47, 'Dalcin Laboratório de Analises Agropecuárias', 'pj', '03.122.191/0002-33', '(66) 3529-1625', '2017-11-01 01:49:29', 'inativo', '658251', '47', 1, 'b2e8e922e62d4665b24b26e47da09f0d', '', '', '0000-00-00', '78643-000', 'Av, Noberto Schwantes', '173D', 'Setor Industrial', 'Querência', 'MT', '', NULL, 'https://app.letswork.com.br/api/', 'Dalcin Laboratorio  de Analises de solos e folhas', 1, 0, NULL, 0, 0, 0),
(48, 'Bruno', 'pf', '023.491.700-80', '(53) 98100-5478', '2017-11-24 11:32:08', 'inativo', '435497', '48', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Bruno', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(49, 'Jonei Nogueira de Oliveira', 'pf', '729.135.251-72', '(66) 99643-9683', '2017-11-28 15:03:24', 'inativo', '161513', '49', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Jonei Nogueira de Oliveira', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(50, 'CREDZ Administrado de Cartões Ltda', 'pj', '12.109.247/0001-20', '(11) 30962-008', '2018-01-23 18:25:31', 'ativo', '553316', '50', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à CREDZ Administrado de Cartões Ltda', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(51, 'PELLEGRINO MATERIAIS PARA CONSTRUÇÃO LTDA', 'pj', '20.525.231/0001-26', '(11) 98426-7476', '2018-02-02 12:51:32', 'ativo', '496577', '51', 1, '33398d9ffd75415bb5dbbab79d335e37', '', 'Bem vindo à Depósito Promoção', '0000-00-00', '05665-040', 'Rua Itapeim', '1313/', 'Paraisópolis', 'São Paulo', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'Depósito Promoção', 0, 0, NULL, 0, 0, 0),
(52, 'Puro Afeto Banho e Tosa', 'pj', '07.591.719/0001-93', '(31)', '2018-02-16 09:48:01', 'inativo', '183072', '52', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Puro Afeto Banho e Tosa', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(53, 'Fundação Ezute', 'pj', '01.710.917/0001-42', '(11) 3040-7300', '2018-03-14 18:52:57', 'inativo', '722539', '53', 1, 'b2e8e922e62d4665b24b26e47da09f0d', '', 'Bem vindo à Fundação Ezute', '0000-00-00', '04552-904', 'Rua do Rocio', '313', 'Vila Olímpia', 'São Paulo', 'SP', '11º and', NULL, 'https://app.letswork.com.br/api/', 'Fundação Ezute', 0, 0, NULL, 0, 0, 0),
(54, 'Unidas Seguros', 'pj', '18.757.923/0001-58', '(81) 34232-323', '2018-03-18 12:07:49', 'inativo', '480914', '54', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Unidas Seguros', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(55, 'Jadlog Ibitinga - PA JACUTINGA 01', 'pj', '28.290.010/0002-09', '(16) 33413-180', '2018-03-20 14:39:35', 'inativo', '569296', '55', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Jadlog Ibitinga - PA JACUTINGA 01', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(56, 'Transportadora Cyrillo & Campoy', 'pj', '28.290.010/0002-09', '(16) 98107-5088', '2018-03-21 12:18:49', 'inativo', '195979', '55', 1, 'b2e8e922e62d4665b24b26e47da09f0d', '', '', '0000-00-00', '37590-000', 'Rua Jose Joaquim Araujo', '23', 'Jd Colina 2', 'Jacutinga', 'MG', '', NULL, 'https://app.letswork.com.br/api/', 'Jadlog Ibitinga - PA JACUTINGA 01', 1, 0, NULL, 0, 0, 0),
(57, 'M2R Serviços', 'pj', '17.595.161/0001-78', '(21) 35131-701', '2018-03-22 15:19:26', 'inativo', '281552', '57', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à M2R Serviços', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(58, 'Sheila Shimada Sociedade Individual de Advoca', 'pj', '25.053.097/0001-21', '(11) 2729-2221', '2018-03-23 18:55:22', 'ativo', '243148', '58', 1, '33398d9ffd75415bb5dbbab79d335e37', '', 'Bem vindo à Sheila Shimada Sociedade Individual de Advocacia Eireli', '0000-00-00', '04578-000', 'Avenida das Nações Unidas', '12399', 'Brooklin Paulista', 'São Paulo', 'SP', 'cj 32b', NULL, 'https://app.letswork.com.br/api/', 'Shimada Advocacia', 0, 0, NULL, 0, 0, 0),
(59, 'Startup SP', 'pj', '32.131.231/3123-13', '(11) 12232-1312', '2018-04-03 18:28:34', 'ativo', '435629', '59', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Startup SP', '0000-00-00', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 1, NULL, 0, 0, 0),
(63, 'Denis', 'pf', '', '(12) 31231-2312', '2018-04-08 00:36:05', 'ativo', '776886', '63', 2, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Denis', '2018-04-10', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 1, NULL, 0, 0, 0),
(64, 'Denis Akao', 'pf', '', '(13) 12313-1231', '2018-04-08 00:37:29', 'ativo', '357146', '64', 2, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Denis Akao', '2018-04-10', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 1, NULL, 0, 0, 0),
(65, 'Pronet telecom', 'pj', '14.407.498/0001-89', '(82) 98770-9274', '2018-04-15 11:20:19', 'inativo', '886339', '65', 2, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Pronet telecom', '2018-04-18', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(66, 'Ricardo Martins', 'pf', '257.286.978-01', '(11) 99971-5238', '2018-04-17 14:34:14', 'ativo', '557590', '66', 2, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Ricardo Martins', '2018-04-20', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(67, 'REGINALDO ANTONIO RIBEIRO DA COSTA', 'pj', '08.339.363/0001-68', '(15) 3249-2825', '2018-04-17 20:15:17', 'inativo', '206223', '67', 1, 'b2e8e922e62d4665b24b26e47da09f0d', '', 'Bem vindo à Solo Vivo Orgânicos', '2018-04-20', '18150-000', 'Rua São Roque', '15', 'Votorantim', 'Ibiúna', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'Solo Vivo Orgânicos', 0, 0, NULL, 0, 0, 0),
(68, 'PINI PISOS E REVESTIMENTOS INDUSTRIAIS LTDA', 'pj', '67.087.965/0001-34', '(11) 3672-4098', '2018-04-26 18:04:54', 'ativo', '612905', '68', 1, '33398d9ffd75415bb5dbbab79d335e37', '', 'Bem vindo à Pinipisos', '2018-04-29', '01250-050', 'Rua Zequinha de Abreu', '240', 'Pacaembu', 'São Paulo', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'Pini Pisos', 0, 0, NULL, 0, 0, 0),
(69, 'MÓDULO CONSULTORIA EM RECURSOS HUMANOS LTDA -', 'pj', '13.439.456/0001-02', '(11) 5687-2890', '2018-04-26 18:21:24', 'ativo', '828063', '69', 1, '33398d9ffd75415bb5dbbab79d335e37', '', 'Bem vindo à MÓDULO CONSULTORIA EM RECURSOS HUMANOS LTDA - EPP', '2018-04-29', '04743-010', 'Rua Manuel Borba', '163', 'Santo Amaro', 'São Paulo', 'SP', '3º and cj 32', NULL, 'https://app.letswork.com.br/api/', 'Módulo RH', 0, 0, NULL, 0, 0, 0),
(70, 'JT Testolin Comércio de Materiais de Construç', 'pj', '12.444.264/0001-13', '(11) 2308-7082', '2018-05-03 17:19:25', 'inativo', '697073', '70', 1, '33398d9ffd75415bb5dbbab79d335e37', '', 'Bem vindo à JT Testolin Comércio de Materiais de Construção e Serviços Ltda', '2018-05-06', '03030-040', 'Rua Teresa Francisca Martin', '90', 'Canindé', 'São Paulo', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'JT TESTOLIN', 0, 0, NULL, 0, 0, 0),
(71, 'Elesbão Ferreira', 'pf', '', '(11) 95922-5641', '2018-05-08 23:50:17', 'inativo', '857817', '71', 2, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Elesbão Ferreira', '2018-05-11', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(72, 'Ricardo Cardoso Machado', 'pj', '17.210.158/0001-99', '(84) 99820-8510', '2018-05-14 19:35:16', 'ativo', '123135', '72', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Rede de Óticas F5', '2018-06-17', '59865-000', 'Umarizal', '90', 'Centro', 'Umarizal', 'RN', '', NULL, 'https://app.letswork.com.br/api/', 'Rede de Óticas F5', 0, 0, NULL, 0, 0, 0),
(73, 'ENVISION PM GERENCIAMENTO E CONSULTORIA LTDA', 'pj', '05.731.509/0001-28', '(11) 3814-3339', '2018-05-24 17:43:25', 'ativo', '422122', '73', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à ENVISION PM GERENCIAMENTO E CONSULTORIA LTDA', '2018-05-27', '05409-000', 'Rua Capote Valente', '207', 'Pinheiros', 'São Paulo', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'ENVISION PM', 0, 0, NULL, 0, 0, 0),
(74, 'REVISAUTO VISTORIAS', 'pj', '04.006.604/0001-04', '(19) 3253-1410', '2018-05-30 18:48:30', 'ativo', '318484', '74', 1, '33398d9ffd75415bb5dbbab79d335e37', '', 'Bem vindo à REVISAUTO VISTORIAS', '2018-07-02', '0', '0', '0', '0', 'Campinas', 'SP', '0', NULL, 'https://app.letswork.com.br/api/', 'REVISAUTO VISTORIAS', 0, 0, NULL, 0, 0, 0),
(75, 'Mandacaru Informatica LTDA', 'pj', '10.785.790/0001-11', '(44) 99143-2725', '2018-06-05 15:07:08', 'inativo', '419307', '75', 1, 'b2e8e922e62d4665b24b26e47da09f0d', '', 'Bem vindo à Mandacaru Informatica LTDA', '2018-06-08', '87080-612', 'Avenida Mandacaru', '1723', 'Vila Vardelina', 'Maringá', 'PR', 'loja', NULL, 'https://app.letswork.com.br/api/', 'Mandacaru Informatica', 0, 0, NULL, 0, 0, 0),
(76, 'Playpiso Pisos Esportivos Ltda', 'pj', '57.396.418/0001-87', '(11) 41338-800', '2018-06-06 12:50:37', 'inativo', '185713', '76', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Playpiso Pisos Esportivos Ltda', '2018-06-09', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(77, 'Empresa', 'pj', '00.000.000/0000-00', '(00) 00000-0000', '2018-07-11 13:14:13', 'ativo', '478563', '77', 2, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Empresa', '2018-07-14', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 1, NULL, 0, 0, 0),
(78, 'xxx', 'pj', '00.000.000/0000-00', '(00) 00000-0000', '2018-07-11 13:45:17', 'ativo', '227257', '78', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à xxx', '2018-07-14', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 1, NULL, 0, 0, 0),
(79, 'SEMEED COMERCIO DE APARELHOS AUDITIVOS LTDA –', 'pj', '09.106.651/0001-35', '(61) 98218-7171', '2018-07-19 19:07:41', 'ativo', '243716', '79', 1, '33398d9ffd75415bb5dbbab79d335e37', '', 'Bem vindo à Para Ouvir', '2018-07-22', '70390-108', 'Quadra SEPS 710/910', '710/9', 'Asa Sul', 'Brasília', 'DF', 'CONJ D LOJA 42 44 46 TERREO', NULL, 'https://app.letswork.com.br/api/', 'Para Ouvir', 0, 0, NULL, 0, 0, 0),
(80, 'rrrrrrrr', 'pj', '44.444.444/444', '(44) 44444-4444', '2018-07-24 12:54:27', 'ativo', '117903', '80', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à rrrrrrrr', '2018-07-27', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 1, NULL, 0, 0, 0),
(81, 'GPBR Participações LTDA', 'pj', '15.664.649/0001-84', '(11) 94871-0005', '2018-07-24 15:16:23', 'inativo', '730317', '81', 1, '33398d9ffd75415bb5dbbab79d335e37', '', 'Bem vindo à GPBR Participações LTDA', '2018-07-27', '01451-914', 'Avenida Brigadeiro Faria Lima', '1306', 'Jardim Paulistano', 'São Paulo', 'SP', '1º and', NULL, 'https://app.letswork.com.br/api/', 'Gympass', 0, 0, NULL, 0, 0, 0),
(82, 'SEMEED COMERCIO DE APARELHOS AUDITIVOS LTDA –', 'pj', '09.106.651/0001-35', '(61) 98218-7171', '2018-07-24 18:20:19', 'inativo', '236451', '79', 1, 'b2e8e922e62d4665b24b26e47da09f0d', '', '', '0000-00-00', '72115-700', 'Área Especial Setor C Norte', 'SALA', 'Taguatinga Norte (Taguatinga)', 'Brasília', 'DF', 'ALA D 1 ANDAR (Hospital Anchieta - Taguatinga Norte', NULL, 'https://app.letswork.com.br/api/', 'Para Ouvir', 1, 1, NULL, 0, 0, 0),
(83, 'GIULIANA COMÉRCIO DE FLORES E ARRANJOS LTDA', 'pj', '67.389.718/0001-92', '(11) 3383-1723', '2018-07-27 13:50:03', 'ativo', '844425', '83', 1, '33398d9ffd75415bb5dbbab79d335e37', '', 'Bem vindo à GIULIANA COMÉRCIO DE FLORES E ARRANJOS LTDA', '2018-07-30', '09531-110', 'Rua Monte Alegre', '127', 'Santo Antônio', 'São Caetano do Sul', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'Giuliana Flores', 0, 0, NULL, 0, 0, 0),
(84, 'BF COMÉRCIO DE PRODUTOS PESSOAIS EIRELLI ME', 'pj', '09.229.486/0001-09', '(11) 99432-5297', '2018-07-27 14:21:51', 'ativo', '845816', '84', 1, '33398d9ffd75415bb5dbbab79d335e37', '', 'Bem vindo à BF COMÉRCIO DE PRODUTOS PESSOAIS EIRELLI ME', '2018-07-30', '01425-011', 'Rua Caconde', '219', 'Jardim Paulista', 'São Paulo', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'BF ADM', 0, 0, NULL, 0, 0, 1),
(85, '67389718000435', 'pj', '67.389.718/0004-35', '(11) 3383-1731', '2018-08-01 17:08:10', 'ativo', '636896', '83', 1, '33398d9ffd75415bb5dbbab79d335e37', '', '', '0000-00-00', '09510-021', 'Rua Rio Grande do Sul', '720', 'Santo Antônio', 'São Caetano do Sul', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'GIULIANA FLORES FILIAL 04 ABC', 1, 0, NULL, 0, 0, 0),
(86, 'GIULIANA COMERCIO DE FLORES E ARRANJOS LTDA', 'pj', '67.389.718/0003-54', '(11) 3383-1726', '2018-08-01 17:12:15', 'ativo', '545971', '83', 1, '33398d9ffd75415bb5dbbab79d335e37', '', '', '0000-00-00', '09531-190', 'Alameda Terracota', '545', 'Cerâmica', 'São Caetano do Sul', 'SP', 'PSC 19', NULL, 'https://app.letswork.com.br/api/', 'GIULIANA FLORES CERÂMICA', 1, 0, NULL, 0, 0, 0),
(87, 'BF COMÉRCIO DE PRODUTOS PESSOAIS EIRELI', 'pj', '09.229.486/0001-09', '(11) 3051-4284', '2018-08-02 20:39:15', 'inativo', '632757', '84', 1, 'b2e8e922e62d4665b24b26e47da09f0d', '', '', '0000-00-00', '01425-011', 'Rua Caconde', '29', 'Jardim Paulista', 'São Paulo', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'Akousis SANTOS', 1, 1, NULL, 0, 0, 0),
(88, 'BF COMÉRCIO DE PRODUTOS PESSOAIS EIRELI', 'pj', '09.229.486/0001-09', '(11) 3051-4284', '2018-08-03 20:41:53', 'ativo', '834907', '84', 1, '33398d9ffd75415bb5dbbab79d335e37', '', '', '0000-00-00', '01425-011', 'Rua Caconde', '219', 'Jardim Paulista', 'São Paulo', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'BF JARDINS', 1, 0, NULL, 0, 0, 0),
(89, 'BF COMERCIO DE PRODUTOS PESSOAIS EIRELI', 'pf', '10743885/0001-08', '(11) 3051-4284', '2018-08-04 12:47:02', 'inativo', '155411', '84', 1, 'b2e8e922e62d4665b24b26e47da09f0d', '', '', '0000-00-00', '04717-001', 'Rua Alexandre Dumas', '1629', 'Chácara Santo Antônio (Zona Sul)', 'São Paulo', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'Akousis STO AMARO', 1, 1, NULL, 0, 0, 0),
(90, 'BF COMERCIO DE PRODUTOS PESSOAIS EIRELI', 'pj', '09.229.486/0002-90', '(11) 2325-0946', '2018-08-04 13:44:40', 'inativo', '301059', '84', 1, 'b2e8e922e62d4665b24b26e47da09f0d', '', '', '0000-00-00', '03318-000', 'Rua Serra de Bragança', '1629', 'Vila Gomes Cardim', 'São Paulo', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'QUELI', 1, 1, NULL, 0, 0, 0),
(91, 'BF COMERCIO DE PRODUTOS PESSOAIS EIRELI', 'pj', '09.229.486/0003-70', '(11) 3021-1130', '2018-08-04 13:49:01', 'ativo', '516607', '84', 1, '33398d9ffd75415bb5dbbab79d335e37', '', '', '0000-00-00', '05061-100', 'Rua Cerro Corá', '550', 'Vila Romana', 'São Paulo', 'SP', '6A', NULL, 'https://app.letswork.com.br/api/', 'BF LAPA', 1, 0, NULL, 0, 0, 0),
(92, 'BF COMERCIO DE PRODUTOS PESSOAIS EIRELI', 'pj', '09.229.486/0002-90', '(11) 2225-0946', '2018-08-04 13:51:30', 'ativo', '106601', '84', 1, '33398d9ffd75415bb5dbbab79d335e37', '', '', '0000-00-00', '03318-000', 'Rua Serra de Bragança', '1629', 'Vila Gomes Cardim', 'São Paulo', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'BF TATUAPE', 1, 0, NULL, 0, 0, 0),
(93, 'BF COMERCIO DE PRODUTOS PESSOAIS EIRELI', 'pj', '09.229.486/0004-51', '(11) 4193-3965', '2018-08-04 13:58:43', 'ativo', '828215', '84', 1, '33398d9ffd75415bb5dbbab79d335e37', '', '', '0000-00-00', '06453-004', 'Praça das Violetas', '12', 'Alphaville Comercial', 'São Paulo', 'SP', 'SALA 01', NULL, 'https://app.letswork.com.br/api/', 'BF ALPHAVILLE', 1, 0, NULL, 0, 0, 0),
(94, 'BF COMERCIO DE PRODUTOS PESSOAIS EIRELI', 'pj', '09.229.486/0005-33', '(11) 2229-5637', '2018-08-04 14:00:37', 'ativo', '600651', '84', 1, '33398d9ffd75415bb5dbbab79d335e37', '', '', '0000-00-00', '07114-000', 'Avenida Doutor Renato de Andrade Maia', '748', 'Parque Renato Maia', 'São Paulo', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'BF GUARULHOS', 1, 0, NULL, 0, 0, 0),
(95, 'BF COMERCIO DE PRODUTOS PESSOAIS EIRELI', 'pj', '09.229.486/0006-13', '(11) 2281-6465', '2018-08-04 14:06:15', 'ativo', '836822', '84', 1, '33398d9ffd75415bb5dbbab79d335e37', '', '', '0000-00-00', '02018-012', 'Rua Conselheiro Moreira de Barros', '840', 'Santana', 'São Paulo', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'BF SANTANA', 1, 0, NULL, 0, 0, 0),
(96, 'BF COMERCIO DE PRODUTOS PESSOAIS EIRELI', 'pj', '09.229.486/0007-02', '(11) 2364-1050', '2018-08-04 14:09:35', 'ativo', '234469', '84', 1, '33398d9ffd75415bb5dbbab79d335e37', '', '', '0000-00-00', '04080-011', 'Avenida Jurucê', '307', 'Indianópolis', 'São Paulo', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'BF MOEMA', 1, 0, NULL, 0, 0, 0),
(97, 'AKOUSIS APARELHOS AUDITIVOS EIRELI', 'pj', '10.473.885/0001-08', '(11) 3078-1768', '2018-08-04 14:14:07', 'inativo', '632959', '84', 1, 'b2e8e922e62d4665b24b26e47da09f0d', '', '', '0000-00-00', '04717-001', 'Rua Alexandre Dumas', '675', 'Chácara Santo Antônio (Zona Sul)', 'São Paulo', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'AKOUSIS MATRIZ', 1, 1, NULL, 0, 0, 0),
(98, 'AKOUSIS APARELHOS AUDITIVOS EIRELI', 'pj', '10.473.885/0002-80', '(11) 3721-7301', '2018-08-04 14:16:55', 'ativo', '679427', '84', 1, '33398d9ffd75415bb5dbbab79d335e37', '', '', '0000-00-00', '05615-000', 'Rua José Jannarelli', '421', 'Vila Progredior', 'São Paulo', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'AKOUSIS MORUMBI', 1, 0, NULL, 0, 0, 0),
(99, 'AKOUSIS APARELHOS AUDITIVOS EIRELI', 'pj', '10.473.885/0003-61', '(11) 3129-7577', '2018-08-04 14:19:15', 'ativo', '703765', '84', 1, '33398d9ffd75415bb5dbbab79d335e37', '', '', '0000-00-00', '01239-040', 'Rua Mato Grosso', '306', 'Higienópolis', 'São Paulo', 'SP', 'LJ13', NULL, 'https://app.letswork.com.br/api/', 'AKOUSIS HIGIENÓPOLIS', 1, 0, NULL, 0, 0, 0),
(100, 'AKOUSIS APARELHOS AUDITIVOS EIRELI', 'pj', '10.473.885/0004-42', '(11) 5071-5049', '2018-08-04 14:20:52', 'ativo', '213082', '84', 1, '33398d9ffd75415bb5dbbab79d335e37', '', '', '0000-00-00', '04043-150', 'Rua Luís Góis', '1404', 'Mirandópolis', 'São Paulo', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'AKOUSIS VILA MARIANA', 1, 0, NULL, 0, 0, 0),
(101, 'EDX COMPANY', 'pj', '08.110.617/0001-71', '(11) 4613-6699', '2018-08-06 17:35:36', 'ativo', '631170', '101', 1, '33398d9ffd75415bb5dbbab79d335e37', '', 'Bem vindo à EDX COMPANY', '2018-09-09', '06716-020', 'Rua Soluções do Lar', '105', 'Jardim do Rio Cotia', 'Cotia', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'EDX COMPANY', 0, 0, NULL, 0, 0, 0),
(102, 'LUI COSMÉTICOS EIRELI - ME', 'pj', '13.116.324/0001-31', '(11) 4613-6699', '2018-08-06 18:49:30', 'ativo', '599593', '101', 1, '33398d9ffd75415bb5dbbab79d335e37', '', '', '0000-00-00', '06714-250', 'Rua Pascoal Rizzo', '73', 'Parque Alexandre', 'Cotia', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'LUI COSMETICO', 1, 0, NULL, 0, 0, 0),
(103, 'BF COMÉRCIO DE PRODUTOS PESSOAIS EIRELI', 'pj', '09.229.486/0001-09', '(11) 3051-4284', '2018-08-07 21:24:05', 'ativo', '848957', '84', 1, '33398d9ffd75415bb5dbbab79d335e37', '', '', '0000-00-00', '01425-011', 'Rua Caconde', '219', 'Jardim Paulista', 'São Paulo', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'AKOUSIS JARDINS', 1, 1, NULL, 0, 0, 0),
(104, 'AKOUSIS APARELHOS AUDITIVOS LTDA', 'pj', '10.743.885/0001-08', '(11) 3078-1768', '2018-08-07 21:36:02', 'ativo', '385093', '84', 1, '33398d9ffd75415bb5dbbab79d335e37', '', '', '0000-00-00', '04717-001', 'Rua Alexandre Dumas', '675', 'Chácara Santo Antônio (Zona Sul)', 'São Paulo', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'Akousis STO AMARO', 1, 0, NULL, 0, 0, 0),
(105, 'teste10', 'pj', '22.222.222/2222-22', '(33) 33333-3333', '2018-08-08 17:36:11', 'inativo', '284394', '84', 1, 'b2e8e922e62d4665b24b26e47da09f0d', '', '', '0000-00-00', '05879-470', 'Rua das Perobeiras', '2', 'Chácara Santa Maria', 'São Paulo', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'teste10', 1, 1, NULL, 0, 0, 0),
(106, 'CONSTRUTORA RIO BRANCO', 'pj', '08.335.760/0001-61', '(11) 40290-050', '2018-08-16 16:15:08', 'ativo', '583418', '106', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à CONSTRUTORA RIO BRANCO', '2018-08-19', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 1, NULL, 0, 0, 0),
(107, 'CONSTRUTORA RIO BRANCO LTDA', 'pj', '08.335.760/0001-61', '(11) 4029-0050', '2018-08-16 17:13:49', 'ativo', '715698', '107', 1, '33398d9ffd75415bb5dbbab79d335e37', '', 'Bem vindo à CONSTRUTORA RIO BRANCO LTDA', '2018-08-19', '13320-270', 'Rua Rio Branco', '835', 'Centro', 'Salto', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'Construtora Rio Branco', 0, 0, NULL, 0, 0, 0),
(108, 'CONTRI CONTABILIDADE', 'pj', '01.337.132/0001-76', '(11) 2694-9283', '2018-08-20 19:20:17', 'ativo', '355962', '108', 1, '33398d9ffd75415bb5dbbab79d335e37', '', 'Bem vindo à CONTRI CONTABILIDADE', '2018-08-23', '03138-040', 'Rua Pires Pimentel', '310', 'Parque da Vila Prudente', 'São Paulo', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'Contri', 0, 0, NULL, 0, 0, 0),
(109, 'CONTRI S&A SERVIÇOS ADMINIST LTDA ME', 'pj', '07.839.674/0001-23', '(11) 2694-9283', '2018-08-24 14:40:23', 'ativo', '958032', '108', 1, '33398d9ffd75415bb5dbbab79d335e37', '', '', '0000-00-00', '03138-040', 'Rua Pires Pimentel', '310', 'Parque da Vila Prudente', 'São Paulo', 'SP', '', NULL, 'https://app.letswork.com.br/api/', 'CONTRI S&A', 1, 0, NULL, 0, 0, 0),
(110, 'CONFIRP CONSULTORIA CONTABIL LTDA', 'pj', '56.812.993/0001-50', '(11) 5555-5555', '2018-08-31 20:47:04', 'ativo', '', '', 1, NULL, '', '', '0000-00-00', '58985-970', 'Rua Silvino Mangueira 130', '96', 'Centro', 'Santana de Mangueira', 'PB', '', NULL, 'https://app.letswork.com.br/api/', 'Confirp', 0, 1, NULL, 0, 0, 0),
(111, 'CONFIRP CONSULTORIA CONTABIL LTDA', 'pj', '56.812.993/0001-50', '(11) 05078-3045', '2018-08-31 20:55:53', 'ativo', '944305', '111', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à CONFIRP CONSULTORIA CONTABIL LTDA', '2018-09-03', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(112, 'Teste', 'pj', '12.313.213/1312-3', '(11) 23123-123', '2018-09-14 15:21:26', 'ativo', '377435', '112', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à Teste', '2018-09-17', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(113, 'WV_Todoz', 'pj', '12.312.312/3131-23', '(12) 31231-2321', '2018-09-14 15:30:31', 'ativo', '434604', '113', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à WV_Todoz', '2018-09-17', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(114, 'WV_Todoz', 'pj', '12.312.312/3131-23', '(12) 31231-2321', '2018-09-14 15:31:04', 'ativo', '274254', '114', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à WV_Todoz', '2018-09-17', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(115, 'WV_Todoz', 'pj', '12.312.312/3131-23', '(12) 31231-2321', '2018-09-14 15:31:08', 'ativo', '731095', '115', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à WV_Todoz', '2018-09-17', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(116, 'teste teste', 'pf', '555.555.555-55', '(11) 11111-1111', '2018-10-17 12:51:22', 'ativo', '274270', '116', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à teste teste', '2018-10-20', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 1),
(117, 'teste1', 'pj', '11.111.111/1111-11', '(11) 11111-1111', '2018-10-17 16:40:41', 'ativo', '828525', '117', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à teste1', '2018-10-20', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(118, 'kauan2', 'pj', '22.222.222/2222-22', '(22) 22222-2222', '2018-10-17 16:43:56', 'ativo', '555081', '118', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à kauan2', '2018-10-20', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(119, 'ssssssssss', 'pj', '22.222.222/2222-22', '(22) 22222-2222', '2018-10-17 16:50:00', 'ativo', '344643', '119', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à ssssssssss', '2018-10-20', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(120, 'ttt', 'pf', '444.444.444-44', '(44) 44444-4444', '2018-10-17 16:51:49', 'ativo', '765559', '120', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à ttt', '2018-10-20', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 1),
(121, 'fun', 'pj', '22.222.222/2222-2', '(22) 22222-2222', '2018-10-17 16:56:15', 'ativo', '276588', '121', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à fun', '2018-10-20', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(122, 'asassa', 'pj', '11.111.111/1111-11', '(11) 11111-1111', '2018-10-17 16:59:47', 'ativo', '140385', '122', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à asassa', '2018-10-20', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 1),
(123, 'sdfsdf', 'pj', '22.222.222/2222', '(22) 22222-2222', '2018-10-17 17:20:24', 'ativo', '541771', '123', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à sdfsdf', '2018-10-20', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(124, 'teste50', 'pf', '222.222.222-22', '(22) 22222-2222', '2018-10-17 20:09:49', 'ativo', '283297', '124', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à teste50', '2018-10-20', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(125, 'fafa', 'pj', '33.333.333/3333-33', '(33) 33333-3333', '2018-10-17 20:33:45', 'ativo', '971679', '125', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à fafa', '2018-10-20', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, 10, 0, 0, 0),
(126, 'bbbb', 'pj', '55.555.555/5555-55', '(55) 55555-5555', '2018-10-17 20:37:37', 'ativo', '500874', '126', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à bbbb', '2018-10-20', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, 0, 0, 0, 1),
(127, 'naoF', 'pj', '33.333.333/3333-33', '(33) 33333-3333', '2018-10-18 13:51:25', 'ativo', '420261', '127', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à naoF', '2018-10-21', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 0, 0),
(128, 'simF', 'pj', '22.222.222/2222-22', '(22) 22222-2222', '2018-10-18 13:54:50', 'ativo', '878296', '128', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à simF', '2018-10-21', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, 0, 0, 0, 1),
(129, 'teste3', 'pj', '22.222.222/2222-22', '(22) 22222-2222', '2018-12-05 12:55:51', 'ativo', '134514', '129', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à teste3', '2018-12-09', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 1, 0),
(130, 'yyy', 'pj', '66.666.666/6666-6', '(33) 33333-3333', '2018-12-07 12:11:27', 'ativo', '925901', '130', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à yyy', '2018-12-10', '', '', '', '', '', '', '', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 1, 0),
(131, '55m', 'pj', '55.555.555/5555-55', '(55) 55555-5555', '2018-12-07 12:18:56', 'ativo', '749208', '131', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à 55m', '2018-12-10', '05879-470', 'Rua das Perobeiras', '0', 'Chácara Santa Maria', 'São Paulo', 'SP', 'l', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 1, 0),
(132, 'xxxxxxxxxxx', 'pj', '22.222.222/2222-22', '(22) 22222-2222', '2018-12-07 13:37:17', 'ativo', '731159', '132', 1, '33398d9ffd75415bb5dbbab79d335e37', NULL, 'Bem vindo à xxxxxxxxxxx', '2018-12-10', '41205-000', 'Rua Direta de Tancredo Neves', '25', 'Tancredo Neves', 'Salvador', 'BA', 'q', NULL, 'https://app.letswork.com.br/api/', '', 0, 0, NULL, 0, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `encontros`
--

CREATE TABLE `encontros` (
  `encontros_id` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `modulo_id` int(11) DEFAULT NULL,
  `descricao` text,
  `status` enum('ativo','inativo') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `encontros`
--

INSERT INTO `encontros` (`encontros_id`, `titulo`, `modulo_id`, `descricao`, `status`) VALUES
(1, 'Encontro 1', 36, '<p>Encontro 1</p>', 'ativo'),
(2, '• ENCONTRO I', 43, '<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Introdu&ccedil;&atilde;o a posturologia</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Sistema t&ocirc;nico-postural</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Avalia&ccedil;&atilde;o postural</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Captor podal</p>\r\n<p><span style=\"color: #3f3e3e; font-family: open_sansregular;\">Oficina de confec&ccedil;&atilde;o de palmilhas&nbsp;</span></p>', 'ativo'),
(3, '• ENCONTRO II', 43, '<div style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Captor ocular</div>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Aparelho manducat&oacute;rio</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Obst&aacute;culos: cicatrizes, microgalvanismos</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Correla&ccedil;&otilde;es cl&iacute;nicas</p>', 'ativo'),
(4, '• ENCONTRO II', 47, '<div style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Captor ocular</div>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Aparelho manducat&oacute;rio</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Obst&aacute;culos: cicatrizes, microgalvanismos</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Correla&ccedil;&otilde;es cl&iacute;nicas</p>', 'ativo'),
(5, '• ENCONTRO II', 49, '<div style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Captor ocular</div>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Aparelho manducat&oacute;rio</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Obst&aacute;culos: cicatrizes, microgalvanismos</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Correla&ccedil;&otilde;es cl&iacute;nicas</p>', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulos`
--

CREATE TABLE `modulos` (
  `modulos_id` int(11) NOT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `curso_id` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `submodulo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `modulos`
--

INSERT INTO `modulos` (`modulos_id`, `titulo`, `curso_id`, `descricao`, `status`, `submodulo`) VALUES
(10, 'ENCONTRO I', 24, '<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Introdu&ccedil;&atilde;o a posturologia</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Sistema t&ocirc;nico-postural</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Avalia&ccedil;&atilde;o postural</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Captor podal<br /><span style=\"color: #3f3e3e; font-family: open_sansregular;\">Oficina de confec&ccedil;&atilde;o de palmilhas&nbsp;</span></p>', 'ativo', 1),
(11, 'ENCONTRO II', 24, '<div style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Captor ocular</div>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Aparelho manducat&oacute;rio</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Obst&aacute;culos: cicatrizes, microgalvanismos</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Correla&ccedil;&otilde;es cl&iacute;nicas</p>', 'ativo', 1),
(12, 'ENCONTRO III', 24, '<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Introdu&ccedil;&atilde;o ao sistema nervoso (vias de comunica&ccedil;&atilde;o)</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Teste informacional</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Plexo lombar</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Plexo lombossacral-cocc&iacute;geo</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Plexo braquial</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Plexo cervical</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">Nervos&nbsp;cranianos</p>', 'ativo', 1),
(13, 'ENCONTRO I', 24, '<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">- Introdu&ccedil;&atilde;o</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">- Diagn&oacute;stico Osteop&aacute;tico Visceral</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">- Perit&ocirc;nio e v&aacute;lvulas Gastrointestinais.</p>', 'ativo', 2),
(14, 'ENCONTRO II', 24, '<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">- Es&ocirc;fago</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">- Est&ocirc;mago</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">- Duodeno</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-family: open_sansregular; vertical-align: baseline; color: #3f3e3e;\">- Ba&ccedil;o e p&acirc;ncreas</p>', 'ativo', 2),
(15, 'Módulo I', 23, '<p>M&oacute;dulo I</p>', 'ativo', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulo_cursos`
--

CREATE TABLE `modulo_cursos` (
  `modulo_cursos_id` int(11) NOT NULL,
  `modulo_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `modulo_cursos`
--

INSERT INTO `modulo_cursos` (`modulo_cursos_id`, `modulo_id`, `curso_id`) VALUES
(8, 2, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `nivel`
--

CREATE TABLE `nivel` (
  `id_nivel` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `nivel`
--

INSERT INTO `nivel` (`id_nivel`, `empresa_id`, `descricao`) VALUES
(0, 0, 'Funcionário'),
(1, 0, 'Administrador Geral'),
(10, 1, 'vendas'),
(11, 1, 'limpeza2'),
(12, 79, 'RECEPÇÃO'),
(13, 79, 'FONOAUDIOLOGOS'),
(14, 79, 'MARKETING'),
(15, 79, 'LABORATORIO'),
(16, 79, 'ESTOQUE'),
(17, 79, 'COPA'),
(18, 79, 'RELAÇÕES PUBLICAS'),
(19, 83, 'SHOPPING ABC'),
(20, 83, 'SHOPPING ANALIA FRANCO'),
(21, 83, 'SHOPPING ARICANDUVA'),
(22, 83, 'SHOPPING CENTER 3'),
(23, 83, 'SHOPPING ABC'),
(24, 83, 'SHOPPING ABC'),
(25, 83, 'SHOPPING ABC'),
(26, 83, 'SHOPPING GRAND PLAZA'),
(27, 83, 'SHOPPING IBIRAPUERA'),
(28, 83, 'SHOPPING GRANJA VIANNA'),
(29, 83, 'SHOPPING MOOCA'),
(30, 84, 'DEPARTAMENTO JARDINS'),
(31, 83, 'SHOPPING SCS'),
(32, 83, 'SHOPPING PATIO PAULISTA'),
(33, 83, 'SHOPPING SANTA CRUZ'),
(34, 83, 'SHOPPING TAMBORÉ'),
(35, 83, 'SHOPPING TIETE'),
(36, 83, 'SHOPPING TUCURUVI'),
(37, 84, 'Departamento Jardins'),
(38, 84, 'DEPARTAMENTO TATUAPE'),
(39, 84, 'DEPARTAMENTO LAPA'),
(40, 84, 'DEPARTAMENTO GUARULHOS'),
(41, 84, 'DEPARTAMENTO SANTANA'),
(42, 84, 'DEPARTAMENTO ALPHAVILLE'),
(43, 84, 'DEPARTAMENTO MOEMA'),
(44, 84, 'DEPARTAMENTO JARDINS'),
(45, 84, 'DEPARTAMENTO SANTO AMARO'),
(46, 84, 'DEPARTAMENTO MORUMBI'),
(47, 84, 'DEPARTAMENTO HIGIENOPOLIS'),
(48, 84, 'DEPARTAMENTO VILA MARIANA'),
(49, 102, 'Produção'),
(50, 85, 'SHOPPING ABC'),
(51, 85, 'SHOPPING ANALIA FRANCO'),
(52, 85, 'SHOPPING ARICANDUVA'),
(53, 85, 'SHOPPING CENTER 3'),
(54, 85, 'SHOPPING CENTER 3'),
(55, 85, 'SHOPPING CENTER NORTE'),
(56, 85, 'SHOPPING CIDADE SP'),
(57, 85, 'SHOPPING GRANJA VIANNA'),
(58, 85, 'SHOPPING IBIRAPUERA'),
(59, 85, 'SHOPPING MOOCA'),
(60, 85, 'SHOPPING PATIO PAULISTA'),
(61, 85, 'SHOPPING SANTA CRUZ'),
(62, 85, 'SHOPPING ABC'),
(63, 85, 'SHOPPING SCS'),
(64, 85, 'SHOPPING TIETE'),
(65, 85, 'SHOPPING TUCURUVI'),
(66, 81, 'Departamento Pessoal'),
(67, 81, 'Recepção'),
(68, 108, 'Fiscal'),
(69, 108, 'Pessoal'),
(70, 108, 'Legalização'),
(71, 108, 'Externo'),
(72, 108, 'Cozinha'),
(73, 108, 'Limpeza'),
(74, 108, 'Recepção'),
(75, 108, 'Administrativo'),
(76, 108, 'Recepção'),
(77, 111, 'Trabalhista'),
(78, 111, 'Small Bussiness'),
(79, 115, 'DEV'),
(80, 1, 'a'),
(81, 1, 'Departamento café'),
(82, 1, 'Tecnologia'),
(83, 1, 'sadfasdf');

-- --------------------------------------------------------

--
-- Estrutura da tabela `nivel_departamento`
--

CREATE TABLE `nivel_departamento` (
  `id_nivel_departamento` int(11) NOT NULL,
  `id_nivel` int(12) NOT NULL,
  `departamento_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `nivel_departamento`
--

INSERT INTO `nivel_departamento` (`id_nivel_departamento`, `id_nivel`, `departamento_id`) VALUES
(1, 6, 2),
(4, 12, 149),
(5, 13, 150),
(6, 14, 151),
(7, 15, 152),
(8, 16, 153),
(9, 17, 154),
(10, 18, 155),
(11, 19, 170),
(12, 20, 171),
(13, 21, 172),
(14, 22, 173),
(15, 23, 174),
(16, 24, 175),
(17, 25, 176),
(18, 26, 177),
(19, 27, 178),
(20, 28, 179),
(21, 29, 180),
(22, 31, 181),
(23, 32, 182),
(24, 33, 183),
(25, 34, 184),
(26, 35, 185),
(27, 36, 186),
(28, 37, 187),
(29, 38, 202),
(30, 39, 203),
(31, 40, 204),
(32, 41, 205),
(33, 42, 206),
(34, 43, 207),
(35, 44, 208),
(36, 45, 209),
(37, 46, 210),
(38, 47, 211),
(39, 48, 212),
(40, 49, 215),
(41, 50, 216),
(42, 51, 217),
(43, 52, 218),
(44, 53, 219),
(45, 54, 220),
(46, 55, 221),
(47, 56, 222),
(48, 57, 223),
(49, 58, 224),
(50, 59, 225),
(51, 60, 226),
(52, 61, 227),
(53, 62, 228),
(54, 63, 229),
(55, 64, 230),
(56, 65, 231),
(57, 66, 157),
(58, 67, 234),
(59, 68, 237),
(60, 68, 239),
(61, 69, 240),
(62, 70, 241),
(63, 71, 242),
(64, 73, 244),
(65, 74, 245),
(66, 75, 246),
(67, 76, 247),
(68, 72, 243),
(69, 77, 258),
(70, 78, 257),
(71, 78, 258),
(72, 78, 259),
(73, 79, 263),
(74, 79, 264),
(76, 81, 279),
(106, 83, 2),
(107, 83, 3),
(108, 83, 4),
(109, 83, 32),
(120, 11, 148),
(127, 9, 147),
(128, 9, 148),
(129, 9, 279),
(152, 80, 6),
(161, 10, 147),
(162, 10, 148),
(177, 82, 2),
(178, 82, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `nivel_permissoes`
--

CREATE TABLE `nivel_permissoes` (
  `id_nivel_permissao` int(11) NOT NULL,
  `id_nivel` int(11) NOT NULL,
  `config` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `planos`
--

CREATE TABLE `planos` (
  `plano_id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `usuarios` int(4) DEFAULT NULL,
  `mensal` float DEFAULT NULL,
  `descricao` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='utf8_general_ci';

--
-- Extraindo dados da tabela `planos`
--

INSERT INTO `planos` (`plano_id`, `nome`, `usuarios`, `mensal`, `descricao`) VALUES
(1, 'Pro', NULL, NULL, '<li>Funcionários ilimitados</li>                             <li>Reconhecimento Facial <span class=\"text-success fa fa-check-circle\"></span></li>                             <li>Geolocalização <span class=\"text-success fa fa-check-circle\"></span></li>                             <li>Tempo Real <span class=\"text-success fa fa-check-circle\"></span></li>                             <li>Cadastro de Turnos <span class=\"text-success fa fa-check-circle\"></span></li>                             <li>Cadastro de Departamentos <span class=\"text-success fa fa-check-circle\"></span></li>                             <li>Cadastro de Ações <span class=\"text-success fa fa-check-circle\"></span></li>                             <li>Cadastro de Notificações <span class=\"text-success fa fa-check-circle\"></span></li>                             <li>Relatório de Funcionários <span class=\"text-success fa fa-check-circle\"></span></li>'),
(2, 'House', 3, 10, '<li>Até <strong>2</strong> Funcionários</li>                             <li>Reconhecimento Facial <span class=\"text-success fa fa-check-circle\"></span></li>                             <li>Geolocalização <span class=\"text-success fa fa-check-circle\"></span></li>                             <li>Tempo Real <span class=\"text-success fa fa-check-circle\"></span></li>                             <li>Relatório de Funcionários <span class=\"text-success fa fa-check-circle\"></span></li>');

-- --------------------------------------------------------

--
-- Estrutura da tabela `presenca`
--

CREATE TABLE `presenca` (
  `presenca_id` int(11) NOT NULL,
  `aluno_id` int(11) DEFAULT NULL,
  `agenda_id` varchar(45) DEFAULT NULL,
  `presente` enum('sim','nao') DEFAULT NULL,
  `tipo` enum('normal','reposicao','revisao','confirmar') DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `presenca`
--

INSERT INTO `presenca` (`presenca_id`, `aluno_id`, `agenda_id`, `presente`, `tipo`) VALUES
(1, 8, '1', NULL, 'normal'),
(2, 7, '2', 'sim', 'normal'),
(3, 8, '3', NULL, 'normal'),
(4, 8, '4', 'nao', 'normal'),
(5, 7, '5', NULL, 'normal'),
(6, 8, '6', NULL, 'normal'),
(7, 7, '7', NULL, 'normal'),
(8, 8, '8', 'sim', 'normal'),
(9, 9, '8', 'sim', 'normal'),
(10, 10, '8', 'nao', 'normal'),
(11, 8, '9', NULL, 'confirmar'),
(13, 10, '9', NULL, 'confirmar'),
(14, 8, '10', NULL, 'confirmar'),
(16, 10, '10', NULL, 'confirmar'),
(17, 8, '11', NULL, 'confirmar'),
(18, 9, '11', NULL, 'confirmar'),
(19, 10, '11', NULL, 'confirmar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `id_professor` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `texto` text COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `login` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `senha` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('ativo','inativo') COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`id_professor`, `email`, `nome`, `texto`, `foto`, `ativo`, `login`, `senha`, `status`, `last_login`) VALUES
(8, 'ricardo@idotsp.com.br', 'Ricardo', '<p><span style=\"color: #333333; font-family: Roboto, \'Helvetica Neue\', Arial, sans-serif; font-weight: bold; text-align: right; background-color: rgba(203, 203, 210, 0.15);\">Mini-Curr&iacute;culo</span><span style=\"background-color: rgba(203, 203, 210, 0.15); color: #333333; font-family: Roboto, \'Helvetica Neue\', Arial, sans-serif; font-weight: bold; text-align: right;\">Mini-Curr&iacute;culo</span><span style=\"background-color: rgba(203, 203, 210, 0.15); color: #333333; font-family: Roboto, \'Helvetica Neue\', Arial, sans-serif; font-weight: bold; text-align: right;\">Mini-Curr&iacute;culo</span><span style=\"background-color: rgba(203, 203, 210, 0.15); color: #333333; font-family: Roboto, \'Helvetica Neue\', Arial, sans-serif; font-weight: bold; text-align: right;\">Mini-Curr&iacute;culo</span><span style=\"background-color: rgba(203, 203, 210, 0.15); color: #333333; font-family: Roboto, \'Helvetica Neue\', Arial, sans-serif; font-weight: bold; text-align: right;\">Mini-Curr&iacute;culo</span><span style=\"background-color: rgba(203, 203, 210, 0.15); color: #333333; font-family: Roboto, \'Helvetica Neue\', Arial, sans-serif; font-weight: bold; text-align: right;\">Mini-Curr&iacute;culo</span><span style=\"background-color: rgba(203, 203, 210, 0.15); color: #333333; font-family: Roboto, \'Helvetica Neue\', Arial, sans-serif; font-weight: bold; text-align: right;\">Mini-Curr&iacute;culo</span><span style=\"background-color: rgba(203, 203, 210, 0.15); color: #333333; font-family: Roboto, \'Helvetica Neue\', Arial, sans-serif; font-weight: bold; text-align: right;\">Mini-Curr&iacute;culo</span><span style=\"background-color: rgba(203, 203, 210, 0.15); color: #333333; font-family: Roboto, \'Helvetica Neue\', Arial, sans-serif; font-weight: bold; text-align: right;\">Mini-Curr&iacute;culo</span><span style=\"background-color: rgba(203, 203, 210, 0.15); color: #333333; font-family: Roboto, \'Helvetica Neue\', Arial, sans-serif; font-weight: bold; text-align: right;\">Mini-Curr&iacute;culo</span><span style=\"background-color: rgba(203, 203, 210, 0.15); color: #333333; font-family: Roboto, \'Helvetica Neue\', Arial, sans-serif; font-weight: bold; text-align: right;\">Mini-Curr&iacute;culo</span><span style=\"background-color: rgba(203, 203, 210, 0.15); color: #333333; font-family: Roboto, \'Helvetica Neue\', Arial, sans-serif; font-weight: bold; text-align: right;\">Mini-Curr&iacute;culo</span><span style=\"background-color: rgba(203, 203, 210, 0.15); color: #333333; font-family: Roboto, \'Helvetica Neue\', Arial, sans-serif; font-weight: bold; text-align: right;\">Mini-Curr&iacute;culo</span><span style=\"background-color: rgba(203, 203, 210, 0.15); color: #333333; font-family: Roboto, \'Helvetica Neue\', Arial, sans-serif; font-weight: bold; text-align: right;\">Mini-Curr&iacute;culo</span><span style=\"background-color: rgba(203, 203, 210, 0.15); color: #333333; font-family: Roboto, \'Helvetica Neue\', Arial, sans-serif; font-weight: bold; text-align: right;\">Mini-Curr&iacute;culo</span><span style=\"background-color: rgba(203, 203, 210, 0.15); color: #333333; font-family: Roboto, \'Helvetica Neue\', Arial, sans-serif; font-weight: bold; text-align: right;\">Mini-Curr&iacute;culo</span><span style=\"background-color: rgba(203, 203, 210, 0.15); color: #333333; font-family: Roboto, \'Helvetica Neue\', Arial, sans-serif; font-weight: bold; text-align: right;\">Mini-Curr&iacute;culo</span></p>', NULL, 1, 'ricardo', '81dc9bdb52d04dc20036dbd8313ed055', 'ativo', '2019-01-29 14:41:18'),
(10, 'flavio@uol.com.br', 'flavio', '<p>adadadasdsa</p>', NULL, 1, 'flavio', '81dc9bdb52d04dc20036dbd8313ed055', 'ativo', '2019-01-28 05:14:48'),
(11, 'cesar@uol.com.br', 'cesar', '<p>qeqeqeqwe</p>', NULL, 1, 'cesar', '65cc2c8205a05d7379fa3a6386f710e1', 'ativo', '2019-01-28 14:49:38');

-- --------------------------------------------------------

--
-- Estrutura da tabela `salas`
--

CREATE TABLE `salas` (
  `salas_id` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `salas`
--

INSERT INTO `salas` (`salas_id`, `titulo`, `status`) VALUES
(1, 'Sala 1', 'ativo'),
(2, 'Sala 2', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sessions`
--

INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('27fba0bb051853e247e510e180e1364d60e3a6b3', '60.191.38.77', 1548701948, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534383730313934383b),
('cc02cea72accf8d7d8743a63e6beaccee4d3d064', '60.191.38.77', 1548702354, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534383730323335343b),
('851b246d94576262e01c23913c487b4fe5acfe65', '60.191.38.77', 1548703866, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534383730333836363b),
('3dc5144531ad004e606ddc270424711767b718db', '60.191.38.77', 1548704196, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534383730343139363b),
('ca4d2088e9808b1225337dc7b9f429763b067916', '177.197.96.240', 1548709202, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534383730393033303b61646d696e7c4f3a383a22737464436c617373223a353a7b733a383a2261646d696e5f6964223b733a323a223132223b733a353a226c6f67696e223b733a353a2261646d696e223b733a353a22656d61696c223b733a303a22223b733a31303a226c6173745f6c6f67696e223b733a31393a22323031392d30312d32382031343a34343a3539223b733a343a227469706f223b733a353a2261646d696e223b7d),
('54ea5276f83bfb2ec8ff87c689e1e004dbdc3626', '189.62.74.65', 1548717632, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534383731373537373b),
('b476f33119b1b9beccb27bc8814eb18aa6e7886c', '179.100.35.164', 1548717658, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534383731373635383b),
('facb2dec918106ce86e8be718c6feb02d08a597a', '209.17.97.114', 1548765898, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534383736353839373b),
('230f9ecc77d70ee1a1537c883547f700ee2cc545', '177.197.96.240', 1548782047, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534383738323034373b61646d696e7c4f3a383a22737464436c617373223a31363a7b733a393a22616c756e6f735f6964223b733a313a2237223b733a343a226e6f6d65223b733a363a22526f62736f6e223b733a353a22656d61696c223b733a32373a22726f62736f6e5f6564756172646f407961686f6f2e636f6d2e6272223b733a393a226d6174726963756c61223b733a313a2231223b733a353a226c6f67696e223b733a363a22726f62736f6e223b733a31333a22646174615f636164617374726f223b733a31303a22323031392d30312d3231223b733a383a22656e64657265636f223b733a31303a227275612070696f205849223b733a353a227475726d61223b733a313a2231223b733a31353a22686973746f7269636f5f7475726d61223b733a313a2231223b733a31303a226c6173745f6c6f67696e223b733a31393a22323031392d30312d32372031373a31353a3439223b733a333a22636570223b733a303a22223b733a31313a22636f6d706c656d656e746f223b733a303a22223b733a363a2262616972726f223b733a303a22223b733a383a2274656c65666f6e65223b733a303a22223b733a373a2263656c756c6172223b733a303a22223b733a343a227469706f223b733a353a22616c756e6f223b7d),
('9b4db8f44f49064ca1b5981d9c98a51060e724f4', '209.17.96.234', 1548792240, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534383739323234303b),
('f6cb6b713e3c9a6be721243124e889aa6d8f4525', '177.197.96.240', 1548794641, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534383739343633323b61646d696e7c4f3a383a22737464436c617373223a353a7b733a383a2261646d696e5f6964223b733a323a223132223b733a353a226c6f67696e223b733a353a2261646d696e223b733a353a22656d61696c223b733a303a22223b733a31303a226c6173745f6c6f67696e223b733a31393a22323031392d30312d32392031343a33323a3537223b733a343a227469706f223b733a353a2261646d696e223b7d),
('3b8864b5f347e0de0f77315690f7d600fc930760', '209.17.96.34', 1548811380, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534383831313338303b),
('f788e0c1f84ea35b377c71b4111e766feea066db', '209.17.96.50', 1548856885, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534383835363838343b),
('6a64e608200597c682cbf26741cedafadd5f1cbf', '60.191.38.77', 1548921540, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534383932313534303b),
('0a17275f1d6b034681ad7fa8874df1a9ad21d10a', '60.191.38.77', 1548924007, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534383932343030373b),
('048c23c6f8676fb4cdca8833fab85233541a933c', '60.191.38.77', 1548925709, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534383932353730393b),
('26850bb5a80ced941d1b9fd90a934de1d1b9c45c', '60.191.38.77', 1548927155, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534383932373135353b),
('d05b34dc794ade97639883cec18f5e35b26a42ff', '209.17.97.10', 1548962765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534383936323736353b),
('d432800024d32f41877d037ec4eccb10f71d8025', '171.67.70.43', 1548980558, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534383938303535383b),
('e71cd6ea0dbf5a2c7ba90f0c6c6fe3b4584222c2', '171.67.70.45', 1548981885, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534383938313838353b),
('467710afe7e935b358e565a5eea59638b459c007', '171.67.70.37', 1549002687, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393030323638373b),
('cb432ea8b0259d64d2e4b65d446f80698666647b', '34.212.187.121', 1549024381, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393032343338313b),
('1c12b9869bb7b124bf95e23a1a9db41ae101e7dd', '171.67.70.43', 1549028320, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393032383332303b),
('127cab7ce8100d32f25e163f0bdbe16fd423427d', '209.17.97.106', 1549050271, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393035303237313b),
('e675718adfd1e071e10f4467d001605fa98211f1', '64.246.161.42', 1549080870, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393038303836393b),
('a9a1ca46a40aef9dd9618a829adca0878d3c0d27', '209.17.96.26', 1549089869, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393038393836393b),
('c6db4e76dd947b6a21f17e5143a14436de9c4347', '171.67.70.42', 1549098970, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393039383937303b),
('dea49fd7b83077db748b6b1fd8772666952c5fad', '209.17.97.2', 1549116624, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393131363632343b);

-- --------------------------------------------------------

--
-- Estrutura da tabela `submodulo`
--

CREATE TABLE `submodulo` (
  `submodulos_id` int(11) NOT NULL,
  `titulo` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `submodulo`
--

INSERT INTO `submodulo` (`submodulos_id`, `titulo`) VALUES
(1, 'SISTEMA TÔNICO-POSTURAL E VIAS DE COMUNICAÇÃO'),
(2, 'SISTEMAS VISCERAL E VASCULAR');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `IDUser` int(11) NOT NULL,
  `login` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `senha` text COLLATE latin1_general_ci NOT NULL,
  `nome` varchar(300) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(300) COLLATE latin1_general_ci DEFAULT NULL,
  `dataCadastro` date DEFAULT '0000-00-00',
  `nivel` int(2) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `aceitou_termo` tinyint(4) NOT NULL DEFAULT '0',
  `rg` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `observacao` text COLLATE latin1_general_ci,
  `IDPais` int(11) NOT NULL DEFAULT '15',
  `updatePass` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `index2` (`login`);

--
-- Indexes for table `agendamento`
--
ALTER TABLE `agendamento`
  ADD PRIMARY KEY (`agenda_id`);

--
-- Indexes for table `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`alunos_id`);

--
-- Indexes for table `aluno_cursos`
--
ALTER TABLE `aluno_cursos`
  ADD PRIMARY KEY (`aluno_cursos_id`);

--
-- Indexes for table `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`aulas_id`);

--
-- Indexes for table `aula_modulos`
--
ALTER TABLE `aula_modulos`
  ADD PRIMARY KEY (`aula_modulos_id`);

--
-- Indexes for table `avisos`
--
ALTER TABLE `avisos`
  ADD PRIMARY KEY (`avisos_id`);

--
-- Indexes for table `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`cursos_id`);

--
-- Indexes for table `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`departamento_id`),
  ADD KEY `empresa_id` (`empresa_id`),
  ADD KEY `contar_pausa` (`contar_pausa`);

--
-- Indexes for table `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`empresa_id`),
  ADD KEY `index2` (`codigo`),
  ADD KEY `index3` (`status`),
  ADD KEY `index4` (`data_criacao`),
  ADD KEY `fk_empresas_planos1_idx` (`plano_id`);

--
-- Indexes for table `encontros`
--
ALTER TABLE `encontros`
  ADD PRIMARY KEY (`encontros_id`);

--
-- Indexes for table `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`modulos_id`,`curso_id`);

--
-- Indexes for table `modulo_cursos`
--
ALTER TABLE `modulo_cursos`
  ADD PRIMARY KEY (`modulo_cursos_id`);

--
-- Indexes for table `nivel`
--
ALTER TABLE `nivel`
  ADD PRIMARY KEY (`id_nivel`);

--
-- Indexes for table `nivel_departamento`
--
ALTER TABLE `nivel_departamento`
  ADD PRIMARY KEY (`id_nivel_departamento`);

--
-- Indexes for table `nivel_permissoes`
--
ALTER TABLE `nivel_permissoes`
  ADD PRIMARY KEY (`id_nivel_permissao`),
  ADD KEY `id_nivel` (`id_nivel`);

--
-- Indexes for table `planos`
--
ALTER TABLE `planos`
  ADD PRIMARY KEY (`plano_id`);

--
-- Indexes for table `presenca`
--
ALTER TABLE `presenca`
  ADD PRIMARY KEY (`presenca_id`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id_professor`);

--
-- Indexes for table `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`salas_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `submodulo`
--
ALTER TABLE `submodulo`
  ADD PRIMARY KEY (`submodulos_id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IDUser`),
  ADD UNIQUE KEY `indexLogin` (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `agendamento`
--
ALTER TABLE `agendamento`
  MODIFY `agenda_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `alunos`
--
ALTER TABLE `alunos`
  MODIFY `alunos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `aluno_cursos`
--
ALTER TABLE `aluno_cursos`
  MODIFY `aluno_cursos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `aulas`
--
ALTER TABLE `aulas`
  MODIFY `aulas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `aula_modulos`
--
ALTER TABLE `aula_modulos`
  MODIFY `aula_modulos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `avisos`
--
ALTER TABLE `avisos`
  MODIFY `avisos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `cursos`
--
ALTER TABLE `cursos`
  MODIFY `cursos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `departamento_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- AUTO_INCREMENT for table `empresas`
--
ALTER TABLE `empresas`
  MODIFY `empresa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `encontros`
--
ALTER TABLE `encontros`
  MODIFY `encontros_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `modulos`
--
ALTER TABLE `modulos`
  MODIFY `modulos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `modulo_cursos`
--
ALTER TABLE `modulo_cursos`
  MODIFY `modulo_cursos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `nivel`
--
ALTER TABLE `nivel`
  MODIFY `id_nivel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `nivel_departamento`
--
ALTER TABLE `nivel_departamento`
  MODIFY `id_nivel_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT for table `nivel_permissoes`
--
ALTER TABLE `nivel_permissoes`
  MODIFY `id_nivel_permissao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `planos`
--
ALTER TABLE `planos`
  MODIFY `plano_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `presenca`
--
ALTER TABLE `presenca`
  MODIFY `presenca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `id_professor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `salas`
--
ALTER TABLE `salas`
  MODIFY `salas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `submodulo`
--
ALTER TABLE `submodulo`
  MODIFY `submodulos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IDUser` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `departamentos_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`empresa_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `empresas`
--
ALTER TABLE `empresas`
  ADD CONSTRAINT `fk_empresas_planos1` FOREIGN KEY (`plano_id`) REFERENCES `planos` (`plano_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `nivel_permissoes`
--
ALTER TABLE `nivel_permissoes`
  ADD CONSTRAINT `nivel_permissoes_ibfk_1` FOREIGN KEY (`id_nivel`) REFERENCES `nivel` (`id_nivel`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
