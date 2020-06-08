-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         10.1.37-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla core_app.bt_customers
DROP TABLE IF EXISTS `bt_customers`;
CREATE TABLE IF NOT EXISTS `bt_customers` (
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `bt_customer_id` varchar(100) DEFAULT NULL,
  `id_usuario_creador` int(11) DEFAULT NULL,
  `id_usuario_modificador` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla core_app.bt_payment_methods
DROP TABLE IF EXISTS `bt_payment_methods`;
CREATE TABLE IF NOT EXISTS `bt_payment_methods` (
  `id_payment_method` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `payment_method_nonce` text,
  `id_usuario_creador` int(11) DEFAULT NULL,
  `id_usuario_modificador` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,,
  PRIMARY KEY (`id_payment_method`),
  KEY `FK_bt_payment_methods_bt_customers` (`customer_id`),
  CONSTRAINT `FK_bt_payment_methods_bt_customers` FOREIGN KEY (`customer_id`) REFERENCES `bt_customers` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla core_app.bt_subscriptions
DROP TABLE IF EXISTS `bt_subscriptions`;
CREATE TABLE IF NOT EXISTS `bt_subscriptions` (
  `id_subscription` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `payment_method_token` text,
  `plan_id` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `bt_subscription_id` varchar(100) DEFAULT NULL,
  `id_usuario_creador` int(11) DEFAULT NULL,
  `id_usuario_modificador` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,,
  PRIMARY KEY (`id_subscription`),
  KEY `FK_bt_subscriptions_bt_customers` (`customer_id`),
  CONSTRAINT `FK_bt_subscriptions_bt_customers` FOREIGN KEY (`customer_id`) REFERENCES `bt_customers` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla core_app.bt_transactions
DROP TABLE IF EXISTS `bt_transactions`;
CREATE TABLE IF NOT EXISTS `bt_transactions` (
  `id_transaction` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `id_payment_method` int(11) DEFAULT NULL,
  `bt_transaction_id` varchar(100) DEFAULT NULL,
  `id_usuario_creador` int(11) DEFAULT NULL,
  `id_usuario_modificador` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,,
  PRIMARY KEY (`id_transaction`),
  KEY `FK_bt_transactions_bt_customers` (`customer_id`),
  CONSTRAINT `FK_bt_transactions_bt_customers` FOREIGN KEY (`customer_id`) REFERENCES `bt_customers` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
