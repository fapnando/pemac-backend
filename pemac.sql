-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jul 27, 2015 at 10:44 PM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pemac`
--

-- --------------------------------------------------------

--
-- Table structure for table `administradores`
--

CREATE TABLE `administradores` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `ativo` int(255) DEFAULT NULL,
  `order` int(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `acesso` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `administradores`
--

INSERT INTO `administradores` (`id`, `ativo`, `order`, `nome`, `email`, `senha`, `salt`, `acesso`) VALUES
(1, 1, NULL, 'Pemac', 'pemaceng@pemaceng.com.br', '3e31dc9d2a8fd47b197087d3011bfe0f', '61d63d45c3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `ativo` int(255) DEFAULT NULL,
  `order` int(255) DEFAULT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `conteudo` longtext COLLATE latin1_general_ci,
  `images` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `id_route` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `ativo` int(255) DEFAULT NULL,
  `order` int(255) DEFAULT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `ativo` int(255) DEFAULT NULL,
  `order` int(255) DEFAULT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `images` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `depoimentos`
--

CREATE TABLE `depoimentos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `ativo` int(255) DEFAULT NULL,
  `order` int(255) DEFAULT NULL,
  `nome` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `conteudo` longtext COLLATE latin1_general_ci,
  `empresa` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `galeria`
--

CREATE TABLE `galeria` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `data` longtext,
  `module` longtext,
  `pk` longtext,
  `file` longtext,
  `legenda` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `modulos`
--

CREATE TABLE `modulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modulo` varchar(255) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `ordem` varchar(32) DEFAULT NULL,
  `tipo` varchar(32) DEFAULT NULL,
  `modulo_base` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `modulos`
--

INSERT INTO `modulos` (`id`, `modulo`, `titulo`, `ordem`, `tipo`, `modulo_base`) VALUES
(1, 'administradores', 'Administradores', NULL, 'normal', 'nenhum'),
(2, 'cases', 'Cases', NULL, 'normal', 'nenhum'),
(3, 'depoimentos', 'Depoimentos', NULL, 'normal', 'nenhum'),
(4, 'servicos', 'Serviços', NULL, 'normal', 'nenhum'),
(5, 'categorias', 'Categorias', NULL, 'normal', 'nenhum'),
(6, 'noticias', 'Notícias', NULL, 'normal', 'nenhum'),
(7, 'clientes', 'Clientes', NULL, 'normal', 'nenhum'),
(8, 'slider', 'Slider', NULL, 'normal', 'nenhum');

-- --------------------------------------------------------

--
-- Table structure for table `noticias`
--

CREATE TABLE `noticias` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `ativo` int(255) DEFAULT NULL,
  `order` int(255) DEFAULT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `capa` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `images` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `categoria` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `conteudo` longtext COLLATE latin1_general_ci,
  `id_route` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `repositorio`
--

CREATE TABLE `repositorio` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `module` longtext,
  `pk` int(255) DEFAULT NULL,
  `name` longtext,
  `new_name` longtext,
  `size` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `route` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `servicos`
--

CREATE TABLE `servicos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `ativo` int(255) DEFAULT NULL,
  `order` int(255) DEFAULT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `conteudo` longtext COLLATE latin1_general_ci,
  `id_route` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `modelo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `ativo` int(255) DEFAULT NULL,
  `order` int(255) DEFAULT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `subtitulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `images` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
