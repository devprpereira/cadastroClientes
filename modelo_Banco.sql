-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.17-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para clientes
CREATE DATABASE IF NOT EXISTS `clientes` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `clientes`;

-- Copiando estrutura para tabela clientes.clientescadastro
CREATE TABLE IF NOT EXISTS `clientescadastro` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `nome` char(50) NOT NULL,
  `dtNascimento` char(10) NOT NULL DEFAULT '',
  `sexo` enum('M','F') NOT NULL DEFAULT 'M',
  `cep` char(8) NOT NULL DEFAULT '',
  `endereco` char(50) NOT NULL DEFAULT '',
  `numero` char(10) NOT NULL DEFAULT '',
  `complemento` char(50) NOT NULL DEFAULT '',
  `bairro` char(50) NOT NULL DEFAULT '',
  `estado` char(2) NOT NULL DEFAULT '',
  `cidade` char(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
