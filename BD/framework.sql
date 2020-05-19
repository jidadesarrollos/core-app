-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: framework
-- ------------------------------------------------------
-- Server version	5.7.18-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clasifications`
--

DROP TABLE IF EXISTS `clasifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clasifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clasification` varchar(100) DEFAULT NULL,
  `identifier` varchar(100) DEFAULT NULL,
  `father` int(11) DEFAULT NULL,
  `son` int(11) DEFAULT NULL,
  `key_name` varchar(100) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `permission` int(11) DEFAULT NULL,
  `total_post` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `language_id` varchar(5) DEFAULT NULL,
  `original_text` int(11) DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lenguage_idx` (`language_id`),
  KEY `fk_original_text_idx` (`original_text`),
  KEY `fk_status_clasifications_idx` (`status_id`),
  CONSTRAINT `fk_clasifications_languages` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_clasifications_original_text` FOREIGN KEY (`original_text`) REFERENCES `clasifications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_status_clasifications` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clasifications`
--

LOCK TABLES `clasifications` WRITE;
/*!40000 ALTER TABLE `clasifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `clasifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `components`
--

DROP TABLE IF EXISTS `components`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `components` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `identifier` varchar(100) DEFAULT NULL,
  `original_text` int(11) DEFAULT NULL,
  `language_id` varchar(5) DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_original_text_idx` (`original_text`),
  KEY `fk_languages_components_idx` (`language_id`),
  CONSTRAINT `fk_languages_components` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_original_text_components` FOREIGN KEY (`original_text`) REFERENCES `components` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `components`
--

LOCK TABLES `components` WRITE;
/*!40000 ALTER TABLE `components` DISABLE KEYS */;
INSERT INTO `components` VALUES (1,'principal',NULL,'principal',NULL,NULL,NULL,NULL,NULL,NULL),(2,'jadmin',NULL,'jadmin',NULL,NULL,NULL,NULL,NULL,NULL),(3,'admin',NULL,'admin',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `components` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `elements`
--

DROP TABLE IF EXISTS `elements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `elements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `element` varchar(45) DEFAULT NULL,
  `data` text,
  `area` varchar(80) DEFAULT NULL,
  `identifier` varchar(100) DEFAULT NULL,
  `language_id` varchar(5) DEFAULT NULL,
  `original_text` int(11) DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_elements_languages_idx` (`language_id`),
  KEY `fk_elements_original_text_idx` (`original_text`),
  CONSTRAINT `fk_elements_languages` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_elements_original_text` FOREIGN KEY (`original_text`) REFERENCES `elements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `elements`
--

LOCK TABLES `elements` WRITE;
/*!40000 ALTER TABLE `elements` DISABLE KEYS */;
/*!40000 ALTER TABLE `elements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `id` varchar(5) NOT NULL,
  `language` varchar(45) DEFAULT NULL,
  `default` tinyint(4) DEFAULT NULL,
  `identifier` varchar(45) DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES ('en','Ingles',1,'ingles',NULL,NULL,NULL,NULL),('es','Español',0,'español',NULL,NULL,NULL,NULL),('fr','Frances',NULL,'frances',NULL,NULL,NULL,NULL),('it','Italiano',NULL,'italiano',NULL,NULL,NULL,NULL),('pt','Portugues',NULL,'portugues',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_banners`
--

DROP TABLE IF EXISTS `media_banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(100) DEFAULT NULL,
  `directory` varchar(100) DEFAULT NULL,
  `media_type` varchar(45) DEFAULT NULL,
  `internal` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `legend` text,
  `meta_data` text,
  `language_id` varchar(5) DEFAULT NULL,
  `original_text` int(11) DEFAULT NULL,
  `video_opt` varchar(100) DEFAULT NULL,
  `video_id` varchar(45) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_languages_media_banners_idx` (`language_id`),
  KEY `fk_media_banners_original_text_idx` (`original_text`),
  CONSTRAINT `fk_languages_media_banners` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_media_banners_original_text` FOREIGN KEY (`original_text`) REFERENCES `media_banners` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_banners`
--

LOCK TABLES `media_banners` WRITE;
/*!40000 ALTER TABLE `media_banners` DISABLE KEYS */;
/*!40000 ALTER TABLE `media_banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_objects`
--

DROP TABLE IF EXISTS `media_objects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media_objects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media_object` varchar(100) DEFAULT NULL,
  `directory` varchar(100) DEFAULT NULL,
  `media_type` int(11) DEFAULT NULL,
  `internal` int(11) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `legend` varchar(150) DEFAULT NULL,
  `alt` varchar(45) DEFAULT NULL,
  `meta_data` varchar(500) DEFAULT NULL,
  `language_id` varchar(5) DEFAULT NULL,
  `original_text` int(11) DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_languages_media_objects_idx` (`language_id`),
  KEY `fk_media_objects_original_text_idx` (`original_text`),
  CONSTRAINT `fk_languages_media_objects` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_media_objects_original_text` FOREIGN KEY (`original_text`) REFERENCES `media_objects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_objects`
--

LOCK TABLES `media_objects` WRITE;
/*!40000 ALTER TABLE `media_objects` DISABLE KEYS */;
/*!40000 ALTER TABLE `media_objects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_options`
--

DROP TABLE IF EXISTS `menu_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_option` varchar(100) DEFAULT NULL,
  `url_option` varchar(100) DEFAULT NULL,
  `identifier` varchar(120) DEFAULT NULL,
  `father` int(11) DEFAULT NULL,
  `son` int(11) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `icon_selector` int(11) DEFAULT NULL,
  `method_id` int(11) DEFAULT NULL,
  `original_text` int(11) DEFAULT NULL,
  `lenguage_id` varchar(5) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_menu_options_menus_idx` (`menu_id`),
  KEY `fk_menu_options_methods_idx` (`method_id`),
  KEY `fk_menu_options_status_idx` (`status_id`),
  KEY `fk_languages_menu_options_idx` (`lenguage_id`),
  KEY `fk_menu_options_original_text_idx` (`original_text`),
  CONSTRAINT `fk_languages_menu_options` FOREIGN KEY (`lenguage_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_menu_options_menus` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_menu_options_methods` FOREIGN KEY (`method_id`) REFERENCES `methods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_menu_options_original_text` FOREIGN KEY (`original_text`) REFERENCES `menu_options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_menu_options_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_options`
--

LOCK TABLES `menu_options` WRITE;
/*!40000 ALTER TABLE `menu_options` DISABLE KEYS */;
INSERT INTO `menu_options` VALUES (1,'Formularios','/jadmin/forms/',NULL,0,1,'fa fa-check',2,1,1,1,NULL,NULL,NULL,'2014-02-13 13:01:11','2014-08-08 10:56:35',NULL,NULL),(2,'Menus','/jadmin/menus/',NULL,0,0,'fa fa-bars',3,1,1,1,NULL,NULL,NULL,'2014-02-13 13:01:11',NULL,NULL,NULL),(3,'ACL',NULL,NULL,0,1,'fa fa-dashboard',1,1,1,1,NULL,NULL,NULL,'2014-02-13 13:01:11',NULL,NULL,NULL),(9,'Perfiles','/jadmin/perfiles/',NULL,3,0,NULL,NULL,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,'Cerrar Sesión','/jadmin/users/cierresesion/',NULL,0,0,'fa fa-power-off',10,1,1,1,NULL,NULL,NULL,NULL,'2014-09-02 22:30:26',NULL,NULL),(11,'Usuarios','/jadmin/users/',NULL,3,0,NULL,NULL,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `menu_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(45) DEFAULT NULL,
  `meta_data` varchar(200) DEFAULT NULL,
  `identifier` varchar(45) DEFAULT NULL,
  `original_text` int(11) DEFAULT NULL,
  `language_id` varchar(5) DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_languages_menus_idx` (`language_id`),
  KEY `fk_menus_original_text_idx` (`original_text`),
  CONSTRAINT `fk_languages_menus` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_menus_original_text` FOREIGN KEY (`original_text`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Principal',NULL,'principal',NULL,NULL,NULL,NULL,NULL,NULL),(2,'Administrador',NULL,'administrador',NULL,NULL,NULL,NULL,NULL,NULL),(3,'topCliente',NULL,'topcliente',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `methods`
--

DROP TABLE IF EXISTS `methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) DEFAULT NULL,
  `method` varchar(150) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `identifier` varchar(160) DEFAULT NULL,
  `login` int(11) DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_methods_objects_idx` (`object_id`),
  CONSTRAINT `fk_methods_objects` FOREIGN KEY (`object_id`) REFERENCES `objects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `methods`
--

LOCK TABLES `methods` WRITE;
/*!40000 ALTER TABLE `methods` DISABLE KEYS */;
INSERT INTO `methods` VALUES (38,22,'index',NULL,NULL,0,NULL,NULL,NULL,NULL),(39,23,'index',NULL,NULL,0,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `objects`
--

DROP TABLE IF EXISTS `objects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `objects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component_id` int(11) DEFAULT NULL,
  `object` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `identifier` varchar(120) DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_components_objects_idx` (`component_id`),
  CONSTRAINT `fk_components_objects` FOREIGN KEY (`component_id`) REFERENCES `components` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objects`
--

LOCK TABLES `objects` WRITE;
/*!40000 ALTER TABLE `objects` DISABLE KEYS */;
INSERT INTO `objects` VALUES (22,2,'Jadmin',NULL,'jadmin',NULL,NULL,NULL,NULL),(23,3,'Admin',NULL,'admin',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `objects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post` varchar(160) DEFAULT NULL,
  `content` text,
  `meta_description` varchar(200) DEFAULT NULL,
  `identifier` varchar(180) DEFAULT NULL,
  `relevance` int(11) DEFAULT NULL,
  `principal_media_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `publish_date` datetime DEFAULT NULL,
  `visits_total` int(11) DEFAULT NULL,
  `post_status_id` int(11) DEFAULT NULL,
  `visibility` int(11) DEFAULT NULL,
  `post_name` varchar(100) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `data` text,
  `language_id` varchar(5) DEFAULT NULL,
  `original_text` int(11) DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_languages_posts_idx` (`language_id`),
  KEY `fk_posts_original_text_idx` (`original_text`),
  KEY `fk_media_objects_posts_idx` (`principal_media_id`),
  KEY `fk_clasifications_posts_idx` (`section_id`),
  KEY `fk_posts_status_posts_idx` (`post_status_id`),
  CONSTRAINT `fk_clasifications_posts` FOREIGN KEY (`section_id`) REFERENCES `clasifications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_languages_posts` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_media_objects_posts` FOREIGN KEY (`principal_media_id`) REFERENCES `media_objects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_posts_original_text` FOREIGN KEY (`original_text`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_posts_status_posts` FOREIGN KEY (`post_status_id`) REFERENCES `posts_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts_clasification`
--

DROP TABLE IF EXISTS `posts_clasification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts_clasification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `clasification_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_post_posts_clasifications_idx` (`post_id`),
  KEY `fk_clasifications_posts_clasification_idx` (`clasification_id`),
  CONSTRAINT `fk_clasifications_posts_clasification` FOREIGN KEY (`clasification_id`) REFERENCES `clasifications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_post_posts_clasifications` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts_clasification`
--

LOCK TABLES `posts_clasification` WRITE;
/*!40000 ALTER TABLE `posts_clasification` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts_clasification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts_comments`
--

DROP TABLE IF EXISTS `posts_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_comment` text,
  `names` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_posts_posts_comments_idx` (`post_id`),
  KEY `fk_users_posts_comments_idx` (`user_id`),
  CONSTRAINT `fk_posts_posts_comments` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_users_posts_comments` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts_comments`
--

LOCK TABLES `posts_comments` WRITE;
/*!40000 ALTER TABLE `posts_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts_status`
--

DROP TABLE IF EXISTS `posts_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_status` varchar(45) DEFAULT NULL,
  `identifier` varchar(45) DEFAULT NULL,
  `language_id` varchar(5) DEFAULT NULL,
  `original_text` int(11) DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_languages_posts_status_idx` (`language_id`),
  KEY `fk_posts_status_original_text_idx` (`original_text`),
  CONSTRAINT `fk_languages_posts_status` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_posts_status_original_text` FOREIGN KEY (`original_text`) REFERENCES `posts_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts_status`
--

LOCK TABLES `posts_status` WRITE;
/*!40000 ALTER TABLE `posts_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `identifier` varchar(60) DEFAULT NULL,
  `language_id` varchar(5) DEFAULT NULL,
  `original_text` int(11) DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_languages_profiles_idx` (`language_id`),
  KEY `fk_profiles_original_text_idx` (`original_text`),
  CONSTRAINT `fk_languages_profiles` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_profiles_original_text` FOREIGN KEY (`original_text`) REFERENCES `profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (1,'Jida Administrador','2014-02-13 13:01:11','jadmin',NULL,NULL,NULL,NULL,NULL,NULL),(2,'Administrador','2014-02-13 13:01:11','admin',NULL,NULL,NULL,NULL,NULL,NULL),(3,'Cliente','2014-02-13 13:01:11','cliente',NULL,NULL,NULL,0,NULL,NULL);
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles_components`
--

DROP TABLE IF EXISTS `profiles_components`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles_components` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) DEFAULT NULL,
  `component_id` int(11) DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_profile_profiles_components_idx` (`profile_id`),
  KEY `fk_components_profiles_components_idx` (`component_id`),
  CONSTRAINT `fk_components_profiles_components` FOREIGN KEY (`component_id`) REFERENCES `components` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_profile_profiles_components` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles_components`
--

LOCK TABLES `profiles_components` WRITE;
/*!40000 ALTER TABLE `profiles_components` DISABLE KEYS */;
INSERT INTO `profiles_components` VALUES (1,1,2,NULL,NULL,NULL,NULL),(2,1,3,NULL,NULL,NULL,NULL),(3,2,3,NULL,NULL,NULL,NULL),(4,1,1,NULL,NULL,NULL,NULL),(5,2,1,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `profiles_components` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles_menu_options`
--

DROP TABLE IF EXISTS `profiles_menu_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles_menu_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_option_id` int(11) DEFAULT NULL,
  `profile_id` int(11) DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_profiles_profiles_menu_opt_idx` (`profile_id`),
  KEY `fk_menu_options_prof_men_opt_idx` (`menu_option_id`),
  CONSTRAINT `fk_menu_options_prof_men_opt` FOREIGN KEY (`menu_option_id`) REFERENCES `menu_options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_profiles_profiles_menu_opt` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles_menu_options`
--

LOCK TABLES `profiles_menu_options` WRITE;
/*!40000 ALTER TABLE `profiles_menu_options` DISABLE KEYS */;
INSERT INTO `profiles_menu_options` VALUES (1,1,1,NULL,NULL,NULL,NULL),(2,2,1,NULL,NULL,NULL,NULL),(3,3,1,NULL,NULL,NULL,NULL),(6,9,1,NULL,NULL,NULL,NULL),(7,10,1,NULL,NULL,NULL,NULL),(8,11,1,NULL,NULL,NULL,NULL),(12,1,1,NULL,NULL,NULL,NULL),(13,2,1,NULL,NULL,NULL,NULL),(14,10,1,NULL,NULL,NULL,NULL),(15,3,1,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `profiles_menu_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles_methods`
--

DROP TABLE IF EXISTS `profiles_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles_methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `method_id` int(11) DEFAULT NULL,
  `profile_id` int(11) DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `identifier_user_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_methods_profiles_methods_idx` (`method_id`),
  KEY `fk_profiles_profiles_methods_idx` (`profile_id`),
  CONSTRAINT `fk_methods_profiles_methods` FOREIGN KEY (`method_id`) REFERENCES `methods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_profiles_profiles_methods` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles_methods`
--

LOCK TABLES `profiles_methods` WRITE;
/*!40000 ALTER TABLE `profiles_methods` DISABLE KEYS */;
/*!40000 ALTER TABLE `profiles_methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles_objects`
--

DROP TABLE IF EXISTS `profiles_objects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles_objects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) DEFAULT NULL,
  `object_id` int(11) DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_profile_profiles_objects_idx` (`profile_id`),
  KEY `fk_objects_profiles_objects_idx` (`object_id`),
  CONSTRAINT `fk_objects_profiles_objects` FOREIGN KEY (`object_id`) REFERENCES `objects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_profile_profiles_objects` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles_objects`
--

LOCK TABLES `profiles_objects` WRITE;
/*!40000 ALTER TABLE `profiles_objects` DISABLE KEYS */;
/*!40000 ALTER TABLE `profiles_objects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  `identifier` varchar(45) DEFAULT NULL,
  `language_id` varchar(5) DEFAULT NULL,
  `original_text` int(11) DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_languages_status_idx` (`language_id`),
  KEY `fk_original_text_status_idx` (`original_text`),
  CONSTRAINT `fk_languages_status` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_original_text_status` FOREIGN KEY (`original_text`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'Activo','activo',NULL,NULL,NULL,NULL,NULL,NULL),(2,'Inactivo','inactivo',NULL,NULL,NULL,NULL,NULL,NULL),(3,'Eliminado','eliminado',NULL,NULL,NULL,NULL,NULL,NULL),(4,'Data Incompleta','data_incompleta',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `identifier` varchar(100) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `last_session` datetime DEFAULT NULL,
  `validation` varchar(500) DEFAULT NULL,
  `names` varchar(100) DEFAULT NULL,
  `lastnames` varchar(100) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `recovery_code` varchar(80) DEFAULT NULL,
  `sex` int(11) DEFAULT NULL,
  `profile_image` varchar(100) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `account_type` varchar(25) DEFAULT NULL,
  `facebook_account` varchar(50) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_status_users_idx` (`status_id`),
  CONSTRAINT `fk_status_users` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'jadmin','e10adc3949ba59abbe56e057f20f883e',NULL,1,1,NULL,'1','Julio','Rodriguez','jrodriguez@jidadesarrollos.com',NULL,NULL,NULL,'0000-00-00','','','','2019-11-14 16:33:00','2019-11-14 16:33:02',0,0),(2,'jcontreras','e10adc3949ba59abbe56e057f20f883e',NULL,1,1,NULL,'1','Jean','Contreras','jcontreras@jidadesarrollos.com',NULL,NULL,NULL,'0000-00-00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'ftovar','e10adc3949ba59abbe56e057f20f883e',NULL,1,1,NULL,'1','Felix','Tovar','ftovar@jidadesarrollos.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'dgonzalez','e10adc3949ba59abbe56e057f20f883e',NULL,1,1,NULL,'1','Dayan','Gonzalez','dgonzalez@jidadesarrollos.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_profiles`
--

DROP TABLE IF EXISTS `users_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `profile_id` int(11) DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `modifier_user_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_profiles_users_profiles_idx` (`profile_id`),
  KEY `fk_users_users_profiles_idx` (`user_id`),
  CONSTRAINT `fk_profiles_users_profiles` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_users_users_profiles` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_profiles`
--

LOCK TABLES `users_profiles` WRITE;
/*!40000 ALTER TABLE `users_profiles` DISABLE KEYS */;
INSERT INTO `users_profiles` VALUES (1,1,1,NULL,NULL,NULL,NULL),(2,1,2,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `users_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'framework'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-18 19:27:28
