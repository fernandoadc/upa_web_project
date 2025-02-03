-- phpMyAdmin SQL Dump
-- version 4.1.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 31, 2019 at 12:53 AM
-- Server version: 5.1.62
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `upa`
--
CREATE DATABASE IF NOT EXISTS `upa` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `upa`;

-- --------------------------------------------------------

--
-- Table structure for table `consulta`
--

CREATE TABLE IF NOT EXISTS `consulta` (
  `cod_consulta` int(11) NOT NULL AUTO_INCREMENT,
  `paciente` varchar(100) NOT NULL,
  `paciente_cartao_sus` int(15) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `medico` varchar(100) NOT NULL,
  `medico_crm` int(15) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`cod_consulta`),
  KEY `paciente_cartao_sus` (`paciente_cartao_sus`),
  KEY `medico_crm` (`medico_crm`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `consulta`
--

INSERT INTO `consulta` (`cod_consulta`, `paciente`, `paciente_cartao_sus`, `descricao`, `medico`, `medico_crm`, `data`) VALUES
(1, 'Ana Clara ', 250966, 'Dor de cabeça', 'Mariana Gomes', 1399, '0000-00-00'),
(2, 'Enéias', 14226, 'Febre', 'Mariana Gomes', 1399, '2019-08-25'),
(3, 'Fernando ', 14226, 'Gripe', 'Mariana Gomes', 1399, '2019-08-25'),
(4, 'Ana Clara ', 250966, 'Dor de cabeça ', 'Mariana Gomes', 1399, '2019-08-26'),
(5, 'Ana Clara', 250966, 'Tudo', 'Mariana Gomes', 1399, '2019-08-26'),
(6, 'Ana Clara', 250966, 'Febre', 'Mariana Gomes', 1399, '2019-08-28');

-- --------------------------------------------------------

--
-- Table structure for table `endereco`
--

CREATE TABLE IF NOT EXISTS `endereco` (
  `numero` int(11) NOT NULL,
  `rua` varchar(80) CHARACTER SET utf8 NOT NULL,
  `bairro` varchar(80) CHARACTER SET utf8 NOT NULL,
  `cidade` varchar(80) CHARACTER SET utf8 NOT NULL,
  `estado` varchar(20) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`numero`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `endereço`
--

INSERT INTO `endereco` (`numero`, `rua`, `bairro`, `cidade`, `estado`) VALUES
(200, 'Santa cruz ', 'Interventoria', 'SANTARÉM', 'PARÁ'),
(234, 'Rui Barbosa ', 'Interventoria', 'SANTARÉM', 'PARÁ'),
(155, 'Antônio justa', 'Interventoria', 'SANTARÉM', 'PARÁ'),
(555, 'Bela vista', 'Interventoria', 'SANTARÉM', 'PARÁ'),
(209, 'Monte Alegre', 'Interventoria', 'SANTARÉM', 'PARÁ'),
(258, 'Av. Mendonça Furtado ', 'Santa Clara', 'SANTARÉM', 'PARÁ');

-- --------------------------------------------------------

--
-- Table structure for table `medico`
--

CREATE TABLE IF NOT EXISTS `medico` (
  `crm` int(11) NOT NULL,
  `nome` varchar(100) CHARACTER SET utf8 NOT NULL,
  `contato` varchar(14) CHARACTER SET utf8 NOT NULL,
  `especialidade` varchar(30) CHARACTER SET utf8 NOT NULL,
  `sexo` enum('M','F') CHARACTER SET utf8 NOT NULL,
  `usuario_matricula` int(11) NOT NULL,
  `endereco_numero` int(11) NOT NULL,
  PRIMARY KEY (`crm`),
  KEY `matricula` (`usuario_matricula`),
  KEY `endereco_numero` (`endereco_numero`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medico`
--

INSERT INTO `medico` (`crm`, `nome`, `contato`, `especialidade`, `sexo`, `usuario_matricula`, `endereco_numero`) VALUES
(1399, 'Mariana Gomes', '93992405793', 'Odontologia ', '', 2019008421, 200),
(59963, 'Fernando Almeida ', '93992405793', 'Cardiologista ', '', 2019008421, 209),
(2268, 'André Oliveira ', '93992405793', 'Clínico Geral', '', 2019008421, 258);

-- --------------------------------------------------------

--
-- Table structure for table `paciente`
--

CREATE TABLE IF NOT EXISTS `paciente` (
  `cartao_sus` int(11) NOT NULL,
  `nome` varchar(100) CHARACTER SET utf8 NOT NULL,
  `idade` int(11) NOT NULL,
  `nascimento` date NOT NULL,
  `sexo` enum('M','F') CHARACTER SET utf8 NOT NULL,
  `rg` int(11) NOT NULL,
  `contato` varchar(14) CHARACTER SET utf8 NOT NULL,
  `mae` varchar(50) CHARACTER SET utf8 NOT NULL,
  `usuario_matricula` int(11) NOT NULL,
  `endereco_numero` int(11) NOT NULL,
  `medico_crm` int(11) NOT NULL,
  PRIMARY KEY (`cartao_sus`),
  KEY `fk_paciente_usuario1_idx` (`usuario_matricula`),
  KEY `fk_paciente_endereço1_idx` (`endereco_numero`),
  KEY `fk_paciente_medico1_idx` (`medico_crm`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paciente`
--

INSERT INTO `paciente` (`cartao_sus`, `nome`, `idade`, `nascimento`, `sexo`, `rg`, `contato`, `mae`, `usuario_matricula`, `endereco_numero`, `medico_crm`) VALUES
(14226, 'Enéias ', 25, '2008-08-24', 'M', 285599, '93992405793', 'Maria dos Santos ', 2019008421, 555, 0),
(250966, 'Ana Clara ', 12, '2019-08-25', '', 2559, '93992405793', 'Andressa ', 2019008421, 155, 0),
(656477, 'Maria de Fátima ', 12, '2019-08-24', 'F', 588985, '93992405793', 'Maria de Fátima ', 2019008421, 234, 0);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `matricula` int(11) NOT NULL,
  `nome` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(45) CHARACTER SET utf8 NOT NULL,
  `contato` varchar(14) CHARACTER SET utf8 NOT NULL,
  `senha` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`matricula`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`matricula`, `nome`, `email`, `contato`, `senha`) VALUES
(2019008428, 'Maurício de Sousa ', 'tinhofernando44@gmail.com', '93992405793', 'ZmFjZmFjMDA='),
(2019008422, 'Fernando Almeida', 'inadiaalmeida10@gmail.com', '93992405793', 'dGluaG8wMA=='),
(2019008421, 'Maurício dos Santos ', 'mna@gmail.com', '93992405793', 'MTIzNDU2');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;