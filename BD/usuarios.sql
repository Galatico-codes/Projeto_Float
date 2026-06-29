-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 23/06/2026 às 22:25
-- Versão do servidor: 8.4.7
-- Versão do PHP: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `usuarios`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashFoto` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caminhoFoto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `hashFoto`, `caminhoFoto`) VALUES
(1, 'Ana Silva', 'ana.silva@gmail.com', 'senha123', '9a32ca1db54989ff9ca0a91eb6739883fe707f7b64af5f94e9811ccd7602cc2e', 'ImagemUsuario/default.jpg'),
(2, 'Carlos Souza', 'carlos.souza@email.com', 'carlos@2026', '9a32ca1db54989ff9ca0a91eb6739883fe707f7b64af5f94e9811ccd7602cc2e', 'ImagemUsuario/default.jpg'),
(3, 'Mariana Costa', 'mari.costa@email.com', 'p@ssword', '9a32ca1db54989ff9ca0a91eb6739883fe707f7b64af5f94e9811ccd7602cc2e', 'ImagemUsuario/default.jpg'),
(4, 'Ricardo Almeida', 'ricardo.a@email.com', 'admin123', '9a32ca1db54989ff9ca0a91eb6739883fe707f7b64af5f94e9811ccd7602cc2e', 'ImagemUsuario/default.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
