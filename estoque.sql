-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 15-Jan-2021 às 18:58
-- Versão do servidor: 10.3.16-MariaDB
-- versão do PHP: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `id12834938_estoque`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `cnpj` varchar(50) DEFAULT NULL,
  `uf` varchar(3) DEFAULT NULL,
  `tipo_estabelecimento` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fornecedores`
--

INSERT INTO `fornecedores` (`id`, `nome`, `cnpj`, `uf`, `tipo_estabelecimento`) VALUES
(1, 'Confecções Fê Flores ', '22.315.708/0001-74', 'SP', 'Loja'),
(2, 'Guria Ousada', '0', 'SP', 'Loja'),
(3, 'Isaac Modas', '19.760.242/0001-01', 'SP', 'Loja');

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimentacoes`
--

CREATE TABLE `movimentacoes` (
  `entrada` int(11) DEFAULT NULL,
  `saida` int(11) DEFAULT NULL,
  `devolucao` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `movimentacoes`
--

INSERT INTO `movimentacoes` (`entrada`, `saida`, `devolucao`) VALUES
(0, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimentacoes_estoque`
--

CREATE TABLE `movimentacoes_estoque` (
  `id` int(11) NOT NULL,
  `produto` int(11) DEFAULT NULL,
  `quant_mov` decimal(10,0) DEFAULT NULL,
  `motivo` varchar(500) DEFAULT NULL,
  `data_mov` datetime NOT NULL DEFAULT current_timestamp(),
  `movimentacao` int(11) NOT NULL,
  `responsavel` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `codigo` int(11) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `quantidade` decimal(10,0) DEFAULT NULL,
  `unidade` varchar(60) DEFAULT NULL,
  `tipo` varchar(60) DEFAULT NULL,
  `fornecedor` varchar(100) NOT NULL,
  `data_cadastro` datetime DEFAULT current_timestamp(),
  `data_alteracao` datetime DEFAULT NULL,
  `responsavel` varchar(60) DEFAULT NULL,
  `valor_unidade` decimal(10,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`codigo`, `descricao`, `quantidade`, `unidade`, `tipo`, `fornecedor`, `data_cadastro`, `data_alteracao`, `responsavel`, `valor_unidade`) VALUES
(1, 'Blusa canelada manguinha preta', 3, 'Unidade', 'Blusa', '1', '2020-07-28 23:59:18', NULL, 'gabriela', 25.00),
(2, 'Blusa canelada mc marinho', 2, 'Unidade', 'Blusa', '1', '2020-07-29 00:00:01', NULL, 'gabriela', 35.00),
(3, 'Blusa canelada bufante branca', 2, 'Unidade', 'Blusa', '1', '2020-07-29 00:00:40', NULL, 'gabriela', 30.00),
(4, 'Blusa canelada cinza', 1, 'Unidade', 'Blusa', '1', '2020-07-29 00:01:02', NULL, 'gabriela', 30.00),
(5, 'Vestido canelado s/ manga preto', 2, 'Unidade', 'Diversos', '2', '2020-07-29 00:02:29', NULL, 'gabriela', 40.00),
(6, 'Calça cirrê M', 1, 'Unidade', 'Calca', '2', '2020-07-29 00:03:18', NULL, 'gabriela', 50.00),
(7, 'Calça cirrê G', 1, 'Unidade', 'Calca', '2', '2020-07-29 00:03:44', NULL, 'gabriela', 50.00),
(8, 'Calça zíper M', 1, 'Unidade', 'Calca', '2', '2020-07-29 00:07:55', NULL, 'gabriela', 60.00),
(9, 'Moletom USA M rosa', 2, 'Unidade', 'Moletom', '3', '2020-07-29 00:25:58', NULL, 'gabriela', 75.00),
(10, 'Moletom USA M cinza', 1, 'Unidade', 'Moletom', '3', '2020-07-29 00:26:43', NULL, 'gabriela', 75.00);

-- --------------------------------------------------------

--
-- Estrutura da tabela `relatorios`
--

CREATE TABLE `relatorios` (
  `id` int(11) NOT NULL,
  `nome` varchar(70) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `relatorios`
--

INSERT INTO `relatorios` (`id`, `nome`) VALUES
(1, 'Relatorio Estoque - Produto por ordem alfabetica'),
(2, 'Relatorio Estoque - Produto por menor  quantidade em estoque'),
(3, 'Relatorio Estoque - Produto por maior quantidade em estoque'),
(4, 'Relatorio Estoque - Produto por data de cadastro'),
(5, 'Relatorio Estoque - Produto por data de alteracao'),
(6, 'Relatorio Estoque - Produto por codigo'),
(7, 'Relatorio Estoque - Produto por unidade'),
(8, 'Relatorio Estoque - Produto por tipo de produto'),
(9, 'Relatorio Estoque - Produto por excesso de estoque'),
(10, 'Relatorio Estoque - Produto por estoque minimo'),
(11, 'Relatorio Estoque - Produto por responsavel');

-- --------------------------------------------------------

--
-- Estrutura da tabela `suporte`
--

CREATE TABLE `suporte` (
  `id` int(11) NOT NULL,
  `mensagem` varchar(900) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(80) DEFAULT NULL,
  `senha` varchar(80) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `senha`) VALUES
(1, 'gabriela', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `movimentacoes_estoque`
--
ALTER TABLE `movimentacoes_estoque`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`codigo`);

--
-- Índices para tabela `relatorios`
--
ALTER TABLE `relatorios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `suporte`
--
ALTER TABLE `suporte`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `movimentacoes_estoque`
--
ALTER TABLE `movimentacoes_estoque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `relatorios`
--
ALTER TABLE `relatorios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `suporte`
--
ALTER TABLE `suporte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
