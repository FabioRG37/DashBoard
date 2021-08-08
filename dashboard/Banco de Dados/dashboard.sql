-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 20-Out-2020 às 14:47
-- Versão do servidor: 5.7.23
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dashboard`
--
CREATE DATABASE IF NOT EXISTS `dashboard` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `dashboard`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `lucro_vendedor`
--

DROP TABLE IF EXISTS `lucro_vendedor`;
CREATE TABLE IF NOT EXISTS `lucro_vendedor` (
  `idlucro_vendedor` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `lucro` float NOT NULL,
  PRIMARY KEY (`idlucro_vendedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `lucro_vendedor`
--

INSERT INTO `lucro_vendedor` (`idlucro_vendedor`, `nome`, `lucro`) VALUES
(1, 'Nonato', 0.225),
(2, 'Rodrigo', 0.15),
(3, 'Aurelion', 0.2),
(4, 'Francisco', 0.1),
(5, 'Marcos', 0.2),
(6, 'Maria', 0.25);

-- --------------------------------------------------------

--
-- Estrutura da tabela `preco_produto`
--

DROP TABLE IF EXISTS `preco_produto`;
CREATE TABLE IF NOT EXISTS `preco_produto` (
  `idpreco_produto` int(11) NOT NULL,
  `produto` varchar(45) NOT NULL,
  `preco` float NOT NULL,
  PRIMARY KEY (`idpreco_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `preco_produto`
--

INSERT INTO `preco_produto` (`idpreco_produto`, `produto`, `preco`) VALUES
(1, 'Chapéu de Praia', 5),
(2, 'Chapéu Brother', 6),
(3, 'Carteira', 7),
(4, 'Brinco', 3),
(5, 'Bolsa', 15),
(6, 'Anel', 50);

-- --------------------------------------------------------

--
-- Estrutura da tabela `quantidade_loja_ano`
--

DROP TABLE IF EXISTS `quantidade_loja_ano`;
CREATE TABLE IF NOT EXISTS `quantidade_loja_ano` (
  `idquantidade_loja_ano` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  PRIMARY KEY (`idquantidade_loja_ano`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `quantidade_loja_ano`
--

INSERT INTO `quantidade_loja_ano` (`idquantidade_loja_ano`, `ano`, `quantidade`) VALUES
(1, 2010, 47),
(2, 2011, 65),
(3, 2012, 81),
(4, 2013, 99),
(5, 2014, 103),
(6, 2015, 110),
(7, 2016, 116),
(8, 2017, 129),
(9, 2018, 135),
(10, 2019, 143);

-- --------------------------------------------------------

--
-- Estrutura da tabela `quantidade_regiao`
--

DROP TABLE IF EXISTS `quantidade_regiao`;
CREATE TABLE IF NOT EXISTS `quantidade_regiao` (
  `idquantidade_regiao` int(11) NOT NULL,
  `regiao` varchar(45) NOT NULL,
  `quantidade` int(11) NOT NULL,
  PRIMARY KEY (`idquantidade_regiao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `quantidade_regiao`
--

INSERT INTO `quantidade_regiao` (`idquantidade_regiao`, `regiao`, `quantidade`) VALUES
(1, 'Centro', 60),
(2, 'Centro-Oeste', 17),
(3, 'Nordeste', 1433),
(4, 'Norte', 121),
(5, 'Sudeste', 24),
(6, 'Sul', 340);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
