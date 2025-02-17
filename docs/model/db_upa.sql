-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 15, 2025 at 04:09 PM
-- Server version: 8.0.40-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_upa`
--

-- --------------------------------------------------------

--
-- Table structure for table `consulta`
--

CREATE TABLE `consulta` (
  `cod_consulta` int NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `paciente_cartao_sus` int NOT NULL,
  `medico_crm` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `endereco`
--

CREATE TABLE `endereco` (
  `cod_endereco` int NOT NULL,
  `numero` int NOT NULL,
  `rua` varchar(80) NOT NULL,
  `bairro` varchar(80) NOT NULL,
  `cidade` varchar(80) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `endereco`
--

INSERT INTO `endereco` (`cod_endereco`, `numero`, `rua`, `bairro`, `cidade`, `estado`) VALUES
(63, 232, 'Alameda 23', 'Amparo Conquista', 'SANTARÉM', 'PARÁ'),
(64, 562, 'Tr. Onze Horas', 'Jaderlândia', 'SANTARÉM', 'PARÁ'),
(62, 232, 'Alameda doze', 'Interventoria', 'SANTARÉM', 'PARÁ'),
(60, 101, 'FBI Academy', 'Quantico', 'Virginia', 'EUA'),
(46, 666, 'Rue Fossette', 'Interventoria', 'SANTARÉM', 'PARÁ'),
(45, 123, '221B Baker Street', 'Princeton Plainsboro', 'Princeton', 'New Jersey');

-- --------------------------------------------------------

--
-- Table structure for table `medico`
--

CREATE TABLE `medico` (
  `crm` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `contato` varchar(14) NOT NULL,
  `especialidade` varchar(30) NOT NULL,
  `sexo` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `endereco_cod_endereco` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `medico`
--

INSERT INTO `medico` (`crm`, `nome`, `contato`, `especialidade`, `sexo`, `endereco_cod_endereco`) VALUES
(987654, 'Dr. Gregory House', '6091234567', 'Diagnóstico', 'Masculino', 45),
(131313, 'Dr. Hannibal Lecter', '92993345665', 'Psiquiatria', 'Masculino', 46);

-- --------------------------------------------------------

--
-- Table structure for table `paciente`
--

CREATE TABLE `paciente` (
  `cartao_sus` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `idade` varchar(15) NOT NULL,
  `sexo` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `rg` varchar(15) NOT NULL,
  `contato` varchar(14) NOT NULL,
  `mae` varchar(50) NOT NULL,
  `endereco_cod_endereco` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `paciente`
--

INSERT INTO `paciente` (`cartao_sus`, `nome`, `idade`, `sexo`, `rg`, `contato`, `mae`, `endereco_cod_endereco`) VALUES
(1234567, 'Clarice Starling', '32', 'Feminino', '9876543', '555198765', 'Ruth Starling', 60),
(582245, 'Clarice Lispector', '33', 'Feminino', '684562', '93992405795', 'Inacia Almeida', 62),
(334626, 'Maria Eduarda da Silva Cavalcante', '56', 'Feminino', '323444', '9399240545', 'Maria de Socorro ', 63),
(353432, 'Alessandra Batista', '54', 'Feminino', '333156', '924067564', 'Maria de Socorro ', 64);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `matricula` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(45) NOT NULL,
  `contato` varchar(14) NOT NULL,
  `senha` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`matricula`, `nome`, `email`, `contato`, `senha`) VALUES
(2019008428, 'Fernando Almeida do Carmo', 'tinhofernando44@gmail.com', '93992405793', 'MzkwLlBpY28=');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`cod_consulta`,`paciente_cartao_sus`,`medico_crm`),
  ADD KEY `fk_consulta_paciente1_idx` (`paciente_cartao_sus`),
  ADD KEY `fk_consulta_medico2` (`medico_crm`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`cod_endereco`);

--
-- Indexes for table `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`crm`,`endereco_cod_endereco`),
  ADD KEY `fk_medico_endereco1_idx` (`endereco_cod_endereco`);

--
-- Indexes for table `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`cartao_sus`,`endereco_cod_endereco`),
  ADD KEY `fk_paciente_endereco1_idx` (`endereco_cod_endereco`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`matricula`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consulta`
--
ALTER TABLE `consulta`
  MODIFY `cod_consulta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `cod_endereco` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
