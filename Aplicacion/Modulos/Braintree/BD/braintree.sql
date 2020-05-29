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
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla core_app.bt_customers: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `bt_customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `bt_customers` ENABLE KEYS */;

-- Volcando estructura para tabla core_app.bt_payment_methods
DROP TABLE IF EXISTS `bt_payment_methods`;
CREATE TABLE IF NOT EXISTS `bt_payment_methods` (
  `id_payment_method` int(11) NOT NULL AUTO_INCREMENT,
  `payment_method_nonce` text,
  `id_customer` int(11) DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_payment_method`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla core_app.bt_payment_methods: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `bt_payment_methods` DISABLE KEYS */;
/*!40000 ALTER TABLE `bt_payment_methods` ENABLE KEYS */;

-- Volcando estructura para tabla core_app.bt_subscriptions
DROP TABLE IF EXISTS `bt_subscriptions`;
CREATE TABLE IF NOT EXISTS `bt_subscriptions` (
  `id_subscription` int(11) NOT NULL AUTO_INCREMENT,
  `payment_method_token` text,
  `plan_id` varchar(100) DEFAULT NULL,
  `bt_subscription_id` varchar(100) DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_subscription`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla core_app.bt_subscriptions: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `bt_subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `bt_subscriptions` ENABLE KEYS */;

-- Volcando estructura para tabla core_app.bt_transactions
DROP TABLE IF EXISTS `bt_transactions`;
CREATE TABLE IF NOT EXISTS `bt_transactions` (
  `id_transaction` int(11) NOT NULL AUTO_INCREMENT,
  `amount` decimal(10,2) DEFAULT NULL,
  `id_payment_method` int(11) DEFAULT NULL,
  `bt_transaction_id` varchar(100) DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_transaction`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla core_app.bt_transactions: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `bt_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `bt_transactions` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
