-- phpMyAdmin SQL Dump
-- version 4.1.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 01, 2019 at 03:59 AM
-- Server version: 5.1.62
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_upa`
--
CREATE DATABASE IF NOT EXISTS `db_upa` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_upa`;

-- --------------------------------------------------------

--
-- Table structure for table `consulta`
--

CREATE TABLE IF NOT EXISTS `consulta` (
  `cod_consulta` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `paciente_cartao_sus` int(11) NOT NULL,
  `medico_crm` int(11) NOT NULL,
  PRIMARY KEY (`cod_consulta`,`paciente_cartao_sus`,`medico_crm`),
  KEY `fk_consulta_paciente1_idx` (`paciente_cartao_sus`),
  KEY `fk_consulta_medico2` (`medico_crm`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `consulta`
--

INSERT INTO `consulta` (`cod_consulta`, `descricao`, `data`, `paciente_cartao_sus`, `medico_crm`) VALUES
(6, 'Paciente com fratura no cabelo ', '2020-05-23', 4730, 2739),
(7, 'Paciente com dores no corpo ', '2019-08-24', 4736, 2739),
(8, 'Paciente com sintomas esquisitos', '2019-09-25', 10237, 28381),
(9, 'Paciente sem noção ', '2020-09-24', 68318, 28691),
(10, 'Paciente com febre e gripe ', '2021-11-25', 83268, 28691);

-- --------------------------------------------------------

--
-- Table structure for table `endereco`
--

CREATE TABLE IF NOT EXISTS `endereco` (
  `cod_endereco` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `rua` varchar(80) NOT NULL,
  `bairro` varchar(80) NOT NULL,
  `cidade` varchar(80) NOT NULL,
  `estado` varchar(20) NOT NULL,
  PRIMARY KEY (`cod_endereco`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `endereco`
--

INSERT INTO `endereco` (`cod_endereco`, `numero`, `rua`, `bairro`, `cidade`, `estado`) VALUES
(1, 219, 'Av. Rui Barbosa ', 'Santa Clara', 'SANTARÉM', 'PARÁ'),
(2, 342, 'Rui Barbosa ', 'Interventoria', 'SANTARÉM', 'PARÁ'),
(4, 396, 'Rui Barbosa ', 'Interventoria', 'SANTARÉM', 'PARÁ'),
(8, 245, 'Trav. Antônio Carlos ', 'Aeroporto velho', 'SANTARÉM', 'PARÁ'),
(6, 253, 'Marajá ', 'Interventoria', 'SANTARÉM', 'PARÁ'),
(9, 139, 'Av. Mendonça Furtado ', 'Matinha', 'SANTARÉM', 'PARÁ'),
(10, 283, 'Trav. Antônio Carlos ', 'Jaderlândia', 'SANTARÉM', 'PARÁ'),
(11, 273, 'Boa Vista', 'Nova Vitória', 'SANTARÉM', 'PARÁ'),
(12, 53, 'Boa viagem ', 'Interventoria', 'SANTARÉM', 'PARÁ'),
(13, 286, 'Vera Cruz ', 'Interventoria', 'SANTARÉM', 'PARÁ'),
(14, 153, 'Bela vista', 'Interventoria', 'SANTARÉM', 'PARÁ'),
(15, 105, 'Bela vista', 'Interventoria', 'SANTARÉM', 'PARÁ'),
(16, 203, 'Entrada do São Nunca ', 'Interventoria', 'SANTARÉM', 'PARÁ');

-- --------------------------------------------------------

--
-- Table structure for table `medico`
--

CREATE TABLE IF NOT EXISTS `medico` (
  `crm` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `contato` varchar(14) NOT NULL,
  `especialidade` varchar(30) NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `usuario_matricula` int(11) NOT NULL,
  `endereco_cod_endereco` int(11) NOT NULL,
  PRIMARY KEY (`crm`,`usuario_matricula`,`endereco_cod_endereco`),
  KEY `fk_medico_usuario1_idx` (`usuario_matricula`),
  KEY `fk_medico_endereco1_idx` (`endereco_cod_endereco`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medico`
--

INSERT INTO `medico` (`crm`, `nome`, `contato`, `especialidade`, `sexo`, `usuario_matricula`, `endereco_cod_endereco`) VALUES
(2739, 'Fernando Almeida ', '93992405793', 'Cardiologista ', '', 2019008428, 5),
(13449, 'Lucas Micael ', '93992405793', 'Otorrinolaringologista', '', 2019008428, 9),
(28381, 'Guilherme Garcia ', '93992405793', 'Cirurgião Geral ', '', 2019008428, 11),
(28691, 'Juliana Alves ', '93992405793', 'Odontologia ', '', 2019008428, 12),
(28391, 'Luciano Almeida', '93992405793', 'Detetive particular ', '', 2019008428, 13),
(28304, 'Creuza Oliveira ', '93992405793', 'Terapeuta ', '', 2019008428, 16);

-- --------------------------------------------------------

--
-- Table structure for table `paciente`
--

CREATE TABLE IF NOT EXISTS `paciente` (
  `cartao_sus` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `idade` int(11) NOT NULL,
  `nascimento` date NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `rg` int(11) NOT NULL,
  `contato` varchar(14) NOT NULL,
  `mae` varchar(50) NOT NULL,
  `usuario_matricula` int(11) NOT NULL,
  `endereco_cod_endereco` int(11) NOT NULL,
  PRIMARY KEY (`cartao_sus`,`usuario_matricula`,`endereco_cod_endereco`),
  KEY `fk_paciente_usuario1_idx` (`usuario_matricula`),
  KEY `fk_paciente_endereco1_idx` (`endereco_cod_endereco`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `paciente`
--

INSERT INTO `paciente` (`cartao_sus`, `nome`, `idade`, `nascimento`, `sexo`, `rg`, `contato`, `mae`, `usuario_matricula`, `endereco_cod_endereco`) VALUES
(12394, 'Ana Clara', 12, '2007-08-31', '', 25138, '93992405793', 'Maria dos Santos ', 2019008428, 1),
(4736, 'Ana Paula ', 25, '2019-08-31', '', 9866, '93992405793', 'Andressa ', 2019008428, 2),
(4730, 'Flávio Dino ', 12, '2019-08-31', '', 86653, '93992405793', 'Bom dia ', 2019008428, 4),
(10237, 'Amanda Telles ', 19, '1992-08-21', '', 3193, '93992405793', 'FernandA Silva', 2019008428, 8),
(68318, 'Amanda Gomes ', 11, '2009-08-31', '', 28616, '93992405793', 'Maria de Fátima ', 2019008428, 10),
(83268, 'Pandora Almeida', 16, '2003-08-31', '', 28643, '93992405793', 'Maria dos Santos ', 2019008428, 14),
(83824, 'Jubileu Araújo', 16, '2003-08-31', '', 28643, '93992405793', 'Maria dos Santos ', 2019008428, 15);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `matricula` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(45) NOT NULL,
  `contato` varchar(14) NOT NULL,
  `senha` varchar(100) NOT NULL,
  PRIMARY KEY (`matricula`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`matricula`, `nome`, `email`, `contato`, `senha`) VALUES
(2019008428, 'Fernando Almeida ', 'tinhofernando44@gmail.com', '93992405793', 'dGluaG8wMA==');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
