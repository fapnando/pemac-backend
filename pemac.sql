-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 28-Jul-2015 às 02:35
-- Versão do servidor: 5.6.21
-- PHP Version: 5.6.3

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
-- Estrutura da tabela `administradores`
--

CREATE TABLE IF NOT EXISTS `administradores` (
`id` int(255) NOT NULL,
  `ativo` int(255) DEFAULT NULL,
  `order` int(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `acesso` varchar(255) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `administradores`
--

INSERT INTO `administradores` (`id`, `ativo`, `order`, `nome`, `email`, `senha`, `salt`, `acesso`) VALUES
(1, 1, NULL, 'Pemac', 'pemaceng@pemaceng.com.br', '3e31dc9d2a8fd47b197087d3011bfe0f', '61d63d45c3', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cases`
--

CREATE TABLE IF NOT EXISTS `cases` (
`id` int(255) NOT NULL,
  `ativo` int(255) DEFAULT NULL,
  `order` int(255) DEFAULT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `conteudo` longtext COLLATE latin1_general_ci,
  `images` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `id_route` varchar(255) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
`id` int(255) NOT NULL,
  `ativo` int(255) DEFAULT NULL,
  `order` int(255) DEFAULT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
`id` int(255) NOT NULL,
  `ativo` int(255) DEFAULT NULL,
  `order` int(255) DEFAULT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `images` varchar(255) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contato`
--

CREATE TABLE IF NOT EXISTS `contato` (
`id` int(255) NOT NULL,
  `ativo` int(255) DEFAULT NULL,
  `order` int(255) DEFAULT NULL,
  `nome` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `telefone` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `assunto` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `empresa` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `mensagem` longtext COLLATE latin1_general_ci
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `depoimentos`
--

CREATE TABLE IF NOT EXISTS `depoimentos` (
`id` int(255) NOT NULL,
  `ativo` int(255) DEFAULT NULL,
  `order` int(255) DEFAULT NULL,
  `nome` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `conteudo` longtext COLLATE latin1_general_ci,
  `empresa` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `galeria`
--

CREATE TABLE IF NOT EXISTS `galeria` (
`id` int(255) NOT NULL,
  `data` longtext,
  `module` longtext,
  `pk` longtext,
  `file` longtext,
  `legenda` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulos`
--

CREATE TABLE IF NOT EXISTS `modulos` (
`id` int(11) NOT NULL,
  `modulo` varchar(255) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `ordem` varchar(32) DEFAULT NULL,
  `tipo` varchar(32) DEFAULT NULL,
  `modulo_base` varchar(255) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modulos`
--

INSERT INTO `modulos` (`id`, `modulo`, `titulo`, `ordem`, `tipo`, `modulo_base`) VALUES
(1, 'administradores', 'Administradores', NULL, 'normal', 'nenhum'),
(2, 'cases', 'Cases', NULL, 'normal', 'nenhum'),
(3, 'depoimentos', 'Depoimentos', NULL, 'normal', 'nenhum'),
(4, 'servicos', 'Serviços', NULL, 'normal', 'nenhum'),
(5, 'categorias', 'Categorias', NULL, 'normal', 'nenhum'),
(6, 'noticias', 'Notícias', NULL, 'normal', 'nenhum'),
(7, 'clientes', 'Clientes', NULL, 'normal', 'nenhum'),
(8, 'slider', 'Slider', NULL, 'normal', 'nenhum'),
(9, 'contato', 'Contato', NULL, 'normal', 'nenhum');

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
`id` int(255) NOT NULL,
  `ativo` int(255) DEFAULT NULL,
  `order` int(255) DEFAULT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `capa` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `images` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `categoria` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `conteudo` longtext COLLATE latin1_general_ci,
  `id_route` varchar(255) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `repositorio`
--

CREATE TABLE IF NOT EXISTS `repositorio` (
`id` int(255) NOT NULL,
  `module` longtext,
  `pk` int(255) DEFAULT NULL,
  `name` longtext,
  `new_name` longtext,
  `size` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `routes`
--

CREATE TABLE IF NOT EXISTS `routes` (
`id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `route` varchar(32) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

CREATE TABLE IF NOT EXISTS `servicos` (
`id` int(255) NOT NULL,
  `ativo` int(255) DEFAULT NULL,
  `order` int(255) DEFAULT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `conteudo` longtext COLLATE latin1_general_ci,
  `id_route` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `modelo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
`id` int(255) NOT NULL,
  `ativo` int(255) DEFAULT NULL,
  `order` int(255) DEFAULT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `subtitulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `images` varchar(255) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administradores`
--
ALTER TABLE `administradores`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contato`
--
ALTER TABLE `contato`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `depoimentos`
--
ALTER TABLE `depoimentos`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galeria`
--
ALTER TABLE `galeria`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modulos`
--
ALTER TABLE `modulos`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `noticias`
--
ALTER TABLE `noticias`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repositorio`
--
ALTER TABLE `repositorio`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servicos`
--
ALTER TABLE `servicos`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administradores`
--
ALTER TABLE `administradores`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contato`
--
ALTER TABLE `contato`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `depoimentos`
--
ALTER TABLE `depoimentos`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `galeria`
--
ALTER TABLE `galeria`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `modulos`
--
ALTER TABLE `modulos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `noticias`
--
ALTER TABLE `noticias`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `repositorio`
--
ALTER TABLE `repositorio`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `servicos`
--
ALTER TABLE `servicos`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
