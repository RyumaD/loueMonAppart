-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: localhost    Database: loueMonAppart
-- ------------------------------------------------------
-- Server version	5.6.35

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
-- Table structure for table `commentairelocation`
--

DROP TABLE IF EXISTS `commentairelocation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commentairelocation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `datecreate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `commentairelocation_ibfk_1` (`user_id`),
  KEY `commentairelocation_ibfk_2` (`location_id`),
  CONSTRAINT `commentairelocation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `commentairelocation_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentairelocation`
--

LOCK TABLES `commentairelocation` WRITE;
/*!40000 ALTER TABLE `commentairelocation` DISABLE KEYS */;
INSERT INTO `commentairelocation` VALUES (13,16,10,'hey super villa','2017-08-29 09:27:58'),(14,17,10,'hey c\'est a moi','2017-08-29 10:09:10'),(15,17,10,'yes sa fonctionne','2017-08-29 10:21:11'),(16,16,9,'merci c\'est gentil','2017-08-29 10:53:05'),(18,18,11,'super','2017-08-29 11:57:11');
/*!40000 ALTER TABLE `commentairelocation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favoris`
--

DROP TABLE IF EXISTS `favoris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favoris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fav1` (`user_id`),
  KEY `fav2` (`location_id`),
  CONSTRAINT `fav1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fav2` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favoris`
--

LOCK TABLES `favoris` WRITE;
/*!40000 ALTER TABLE `favoris` DISABLE KEYS */;
INSERT INTO `favoris` VALUES (11,10,16),(12,9,17),(13,11,16),(14,9,18);
/*!40000 ALTER TABLE `favoris` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagelocation`
--

DROP TABLE IF EXISTS `imagelocation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagelocation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `location_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `imagelocation_ibfk_2` (`location_id`),
  KEY `imagelocation_ibfk_3` (`user_id`),
  CONSTRAINT `imagelocation_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE CASCADE,
  CONSTRAINT `imagelocation_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagelocation`
--

LOCK TABLES `imagelocation` WRITE;
/*!40000 ALTER TABLE `imagelocation` DISABLE KEYS */;
INSERT INTO `imagelocation` VALUES (15,9,'villa1.jpg',16),(16,9,'villa2.jpg',16),(17,9,'villa3.jpg',16),(18,11,'stand1.jpg',18),(19,11,'stand2.jpeg',18),(20,11,'stand3.jpg',18),(21,10,'house1.jpg',17),(22,10,'house2.jpg',17),(23,10,'house3.jpg',17);
/*!40000 ALTER TABLE `imagelocation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `prix` float DEFAULT NULL,
  `description` text NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `location_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` VALUES (16,'dragonslayer','Villa de rêve',333,'une villa luxueuse avec toutes les options dont vous pouvez ilmaginer','Perpignan',9),(17,'apocalypse','Petite maison retro',50,'une maison calme et pleine de positive energie','Ceret',10),(18,'jotaroLEKING','Stand tres facile d\'utilisation',3,'stand d\'eclat d\'emeraude tres efficace dans le marche','Tokyo',11);
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messagerie`
--

DROP TABLE IF EXISTS `messagerie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messagerie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exped_id` int(11) NOT NULL,
  `desti_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `datecreate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `messagerie1` (`exped_id`),
  KEY `messagerie2` (`desti_id`),
  CONSTRAINT `messagerie1` FOREIGN KEY (`exped_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messagerie2` FOREIGN KEY (`desti_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messagerie`
--

LOCK TABLES `messagerie` WRITE;
/*!40000 ALTER TABLE `messagerie` DISABLE KEYS */;
INSERT INTO `messagerie` VALUES (20,10,9,'Hello votre offre m\'interesse je souhaiterai m\'entretenir avec vous pour quelques questions','2017-08-29 09:34:09'),(21,11,9,'Hello votre offre m\'interesse je souhaiterai m\'entretenir avec vous pour quelques questions','2017-08-29 11:28:37'),(22,9,11,'pas de probleme j\'ai un peu de temps devant moi','2017-08-29 12:00:55'),(23,9,10,'tres bien mais sachez que vous n\'ete pas le seul','2017-08-29 14:04:11');
/*!40000 ALTER TABLE `messagerie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acheteur_id` int(11) NOT NULL,
  `vendeur_id` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reservation1` (`acheteur_id`),
  KEY `reservation2` (`vendeur_id`),
  CONSTRAINT `reservation1` FOREIGN KEY (`acheteur_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reservation2` FOREIGN KEY (`vendeur_id`) REFERENCES `location` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` VALUES (3,9,17,'2017-08-30','2017-08-31');
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (8,'hellomother','58ad983135fe15c5a8e2e15fb5b501aedcf70dc2','hellomother@momforme.fr',NULL),(9,'dragonslayer','58ad983135fe15c5a8e2e15fb5b501aedcf70dc2','diobrando@zawaldo.fr',NULL),(10,'apocalypse','58ad983135fe15c5a8e2e15fb5b501aedcf70dc2','apocalypse@hotmail.fr',NULL),(11,'jotaroLEKING','58ad983135fe15c5a8e2e15fb5b501aedcf70dc2','diobrando@zawaldo.fr',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-08-29 14:17:06
