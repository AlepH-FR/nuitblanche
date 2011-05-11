-- MySQL dump 10.13  Distrib 5.1.56, for debian-linux-gnu (i486)
--
-- Host: localhost    Database: nuitblanche
-- ------------------------------------------------------
-- Server version	5.1.56-0.dotdeb.0

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
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `body` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526CB5A459A0` (`news_id`),
  KEY `IDX_9474526CF675F31B` (`author_id`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`),
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,1,1,'2011-05-01 17:28:27','a first comment'),(2,1,1,'2011-05-01 17:28:40','and a second form'),(3,1,1,'2011-05-09 10:12:11','klmklmklm'),(4,1,1,'2011-05-09 10:12:39','opopop'),(5,1,1,'2011-05-09 10:15:25','test redir'),(6,1,1,'2011-05-09 10:15:45','test redir'),(7,1,1,'2011-05-09 10:23:15','test v2.'),(8,5,1,'2011-05-10 18:53:14','awesome :)');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game`
--

DROP TABLE IF EXISTS `game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `winner` int(11) DEFAULT NULL,
  `map` varchar(255) NOT NULL,
  `warGame_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_232B318CE42CCA7A` (`warGame_id`),
  CONSTRAINT `game_ibfk_1` FOREIGN KEY (`warGame_id`) REFERENCES `wargame` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game`
--

LOCK TABLES `game` WRITE;
/*!40000 ALTER TABLE `game` DISABLE KEYS */;
INSERT INTO `game` VALUES (25,'2011-05-08 21:36:58',2,'Temple brisÃ©',2),(27,'2011-05-08 21:36:58',2,'Temple brisÃ©',NULL),(28,'2011-05-03 22:03:09',1,'Discord IV',NULL),(29,'2011-05-03 22:03:09',1,'Discord IV',NULL);
/*!40000 ALTER TABLE `game` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gameplayer`
--

DROP TABLE IF EXISTS `gameplayer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gameplayer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) DEFAULT NULL,
  `player_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `race` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `apm` int(11) NOT NULL,
  `team` int(11) NOT NULL,
  `warGame_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2012EF76E48FD905` (`game_id`),
  KEY `IDX_2012EF76E42CCA7A` (`warGame_id`),
  KEY `IDX_2012EF7699E6F5DF` (`player_id`),
  CONSTRAINT `gameplayer_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`),
  CONSTRAINT `gameplayer_ibfk_2` FOREIGN KEY (`warGame_id`) REFERENCES `wargame` (`id`),
  CONSTRAINT `gameplayer_ibfk_3` FOREIGN KEY (`player_id`) REFERENCES `player` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gameplayer`
--

LOCK TABLES `gameplayer` WRITE;
/*!40000 ALTER TABLE `gameplayer` DISABLE KEYS */;
INSERT INTO `gameplayer` VALUES (41,25,NULL,'FOXsMiLe','zerg','FE8A0E',131,2,2),(42,25,NULL,'Sweety','protoss','1CA7EA',118,1,2),(43,27,NULL,'FOXsMiLe','zerg','FE8A0E',131,2,NULL),(44,27,NULL,'Sweety','protoss','1CA7EA',118,1,NULL),(45,28,NULL,'Borislav','protoss','168000',104,1,NULL),(46,28,NULL,'NetskyWeRRa','zerg','B4141E',114,2,NULL),(47,28,NULL,'CaptainOD','protoss','EBE129',163,2,NULL),(48,28,NULL,'NuclearMan','terran','0042FF',156,1,NULL),(49,29,NULL,'Borislav','protoss','168000',104,1,NULL),(50,29,NULL,'NetskyWeRRa','zerg','B4141E',114,2,NULL),(51,29,NULL,'CaptainOD','protoss','EBE129',163,2,NULL),(52,29,NULL,'NuclearMan','terran','0042FF',156,1,NULL);
/*!40000 ALTER TABLE `gameplayer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `league`
--

DROP TABLE IF EXISTS `league`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `league` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `league`
--

LOCK TABLES `league` WRITE;
/*!40000 ALTER TABLE `league` DISABLE KEYS */;
INSERT INTO `league` VALUES (1,'Friendly','FR'),(2,'Pandaria','FR'),(3,'SC2CL','EU'),(4,'SC2F','FR');
/*!40000 ALTER TABLE `league` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1DD39950F675F31B` (`author_id`),
  KEY `IDX_1DD39950296CD8AE` (`team_id`),
  CONSTRAINT `news_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`),
  CONSTRAINT `news_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,1,1,'A first test news','<p>\r\nWith some damn short content\r\n</p>\r\n<p>\r\nSo let\'s add a lil more to it !\r\n</p>','2011-05-01 17:28:07'),(2,1,1,'test news from form','tatatititutu','2011-05-09 11:17:55'),(3,1,1,'opop','<strong>kklmklmklmklmklmkl\r\nklklmk\r\nlklmklmklmklklm\r\nkmlklmkm<em>lklmklmklmkl</em>m\r\nklklmk\r\nkmlklm\r\nklmklmklmklmklmklmk\r\nlkmklmklmklmklm</strong>','2011-05-09 12:03:10'),(4,1,1,'test cw','test insertion clan war\r\n\r\n<strong>titre du war</strong>\r\n\r\n{war:1}\r\n\r\n\r\nET HOP C FINI !','2011-05-09 13:30:48'),(5,1,1,'test war','<p>A short war introduction</p>\r\n\r\n<div class=\"news-war\">{war:2}</div>\r\n\r\n<p>A second paragraph speaking about war results</p>','2011-05-09 14:56:48');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `player`
--

DROP TABLE IF EXISTS `player`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `sc2Role` varchar(255) DEFAULT NULL,
  `sc2Id` int(11) NOT NULL,
  `sc2Race` varchar(255) NOT NULL,
  `sc2ProfileEsl` varchar(255) NOT NULL,
  `sc2ProfileSc2cl` varchar(255) NOT NULL,
  `sc2ProfilePandaria` varchar(255) NOT NULL,
  `sc2Account` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_98197A65A76ED395` (`user_id`),
  CONSTRAINT `player_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `player`
--

LOCK TABLES `player` WRITE;
/*!40000 ALTER TABLE `player` DISABLE KEYS */;
INSERT INTO `player` VALUES (1,1,'Admin',372,'protoss','','','','AlepH');
/*!40000 ALTER TABLE `player` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `replay`
--

DROP TABLE IF EXISTS `replay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `replay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `chart` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `length` varchar(255) NOT NULL,
  `obs` varchar(255) NOT NULL,
  `realm` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL,
  `downloads` int(11) DEFAULT NULL,
  `chatLog` longtext NOT NULL,
  `uploader_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D937F4F2E48FD905` (`game_id`),
  KEY `IDX_D937F4F216678C77` (`uploader_id`),
  CONSTRAINT `replay_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`),
  CONSTRAINT `replay_ibfk_2` FOREIGN KEY (`uploader_id`) REFERENCES `player` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `replay`
--

LOCK TABLES `replay` WRITE;
/*!40000 ALTER TABLE `replay` DISABLE KEYS */;
INSERT INTO `replay` VALUES (25,25,'/home/antoine/workspace/nuitblanche/app/cache/dev/upload/bd/7c6f78e5fe1009317fd10126102fb3/phpqPKcQ4','/upload/chart/phpqPKcQ4.png',164,'1278','a:8:{i:0;s:12:\"FOXAnonymous\";i:1;s:6:\"FOXJim\";i:2;s:6:\"FOXZFE\";i:3;s:5:\"ChiXi\";i:4;s:10:\"IvDUnivOne\";i:5;s:7:\"nBFzero\";i:6;s:6:\"Foumiz\";i:7;s:11:\"Tartiflette\";}','EU','1.18317',0,'a:4:{i:0;a:6:{s:2:\"id\";i:2;s:4:\"name\";s:6:\"Sweety\";s:6:\"target\";i:0;s:4:\"time\";d:8;s:7:\"message\";s:4:\"glhf\";s:5:\"color\";s:6:\"1CA7EA\";}i:1;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"FOXsMiLe\";s:6:\"target\";i:0;s:4:\"time\";d:15;s:7:\"message\";s:6:\"pareil\";s:5:\"color\";s:6:\"FE8A0E\";}i:2;a:6:{s:2:\"id\";i:2;s:4:\"name\";s:6:\"Sweety\";s:6:\"target\";i:0;s:4:\"time\";d:1269;s:7:\"message\";s:2:\"gg\";s:5:\"color\";s:6:\"1CA7EA\";}i:3;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"FOXsMiLe\";s:6:\"target\";i:0;s:4:\"time\";d:1272;s:7:\"message\";s:2:\"gg\";s:5:\"color\";s:6:\"FE8A0E\";}}',NULL),(26,27,'/home/antoine/workspace/nuitblanche/app/cache/dev/upload/08/da6e2e2b2de37553a15219d58f7d38/phpfZXsK3','/upload/chart/phpfZXsK3.png',164,'1278','a:8:{i:0;s:12:\"FOXAnonymous\";i:1;s:6:\"FOXJim\";i:2;s:6:\"FOXZFE\";i:3;s:5:\"ChiXi\";i:4;s:10:\"IvDUnivOne\";i:5;s:7:\"nBFzero\";i:6;s:6:\"Foumiz\";i:7;s:11:\"Tartiflette\";}','EU','1.18317',1,'a:4:{i:0;a:6:{s:2:\"id\";i:2;s:4:\"name\";s:6:\"Sweety\";s:6:\"target\";i:0;s:4:\"time\";d:8;s:7:\"message\";s:4:\"glhf\";s:5:\"color\";s:6:\"1CA7EA\";}i:1;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"FOXsMiLe\";s:6:\"target\";i:0;s:4:\"time\";d:15;s:7:\"message\";s:6:\"pareil\";s:5:\"color\";s:6:\"FE8A0E\";}i:2;a:6:{s:2:\"id\";i:2;s:4:\"name\";s:6:\"Sweety\";s:6:\"target\";i:0;s:4:\"time\";d:1269;s:7:\"message\";s:2:\"gg\";s:5:\"color\";s:6:\"1CA7EA\";}i:3;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"FOXsMiLe\";s:6:\"target\";i:0;s:4:\"time\";d:1272;s:7:\"message\";s:2:\"gg\";s:5:\"color\";s:6:\"FE8A0E\";}}',NULL),(27,28,'/home/antoine/workspace/nuitblanche/web/upload/replay/phpTmIgN1','/upload/chart/phpTmIgN1.png',203,'2004','a:1:{i:0;s:4:\"SyDe\";}','EU','1.18317',NULL,'a:45:{i:0;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:10;s:7:\"message\";s:25:\"da opitam blink stalkeri?\";s:5:\"color\";s:6:\"168000\";}i:1;a:6:{s:2:\"id\";i:4;s:4:\"name\";s:10:\"NuclearMan\";s:6:\"target\";i:2;s:4:\"time\";d:13;s:7:\"message\";s:1:\"k\";s:5:\"color\";s:6:\"0042FF\";}i:2;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:26;s:7:\"message\";s:23:\"ama parvo da oceleem xD\";s:5:\"color\";s:6:\"168000\";}i:3;a:6:{s:2:\"id\";i:4;s:4:\"name\";s:10:\"NuclearMan\";s:6:\"target\";i:2;s:4:\"time\";d:29;s:7:\"message\";s:19:\"samo da se zapushim\";s:5:\"color\";s:6:\"0042FF\";}i:4;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:31;s:7:\"message\";s:2:\"da\";s:5:\"color\";s:6:\"168000\";}i:5;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:32;s:7:\"message\";s:2:\"xd\";s:5:\"color\";s:6:\"168000\";}i:6;a:6:{s:2:\"id\";i:4;s:4:\"name\";s:10:\"NuclearMan\";s:6:\"target\";i:2;s:4:\"time\";d:32;s:7:\"message\";s:5:\"dobre\";s:5:\"color\";s:6:\"0042FF\";}i:7;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:433;s:7:\"message\";s:18:\"az sam rdy s blink\";s:5:\"color\";s:6:\"168000\";}i:8;a:6:{s:2:\"id\";i:4;s:4:\"name\";s:10:\"NuclearMan\";s:6:\"target\";i:2;s:4:\"time\";d:502;s:7:\"message\";s:7:\"chervei\";s:5:\"color\";s:6:\"0042FF\";}i:9;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:505;s:7:\"message\";s:9:\"panika :D\";s:5:\"color\";s:6:\"168000\";}i:10;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:513;s:7:\"message\";s:4:\"shit\";s:5:\"color\";s:6:\"168000\";}i:11;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:542;s:7:\"message\";s:23:\"dai scan tuk sled malko\";s:5:\"color\";s:6:\"168000\";}i:12;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:547;s:7:\"message\";s:10:\"mojesh li?\";s:5:\"color\";s:6:\"168000\";}i:13;a:6:{s:2:\"id\";i:4;s:4:\"name\";s:10:\"NuclearMan\";s:6:\"target\";i:2;s:4:\"time\";d:550;s:7:\"message\";s:2:\"da\";s:5:\"color\";s:6:\"0042FF\";}i:14;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:558;s:7:\"message\";s:3:\"dai\";s:5:\"color\";s:6:\"168000\";}i:15;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:583;s:7:\"message\";s:23:\"basi kak se samoubih xD\";s:5:\"color\";s:6:\"168000\";}i:16;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:585;s:7:\"message\";s:6:\"grozno\";s:5:\"color\";s:6:\"168000\";}i:17;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:784;s:7:\"message\";s:24:\"she praim ht za feedback\";s:5:\"color\";s:6:\"168000\";}i:18;a:6:{s:2:\"id\";i:4;s:4:\"name\";s:10:\"NuclearMan\";s:6:\"target\";i:2;s:4:\"time\";d:797;s:7:\"message\";s:7:\"dobre e\";s:5:\"color\";s:6:\"0042FF\";}i:19;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:804;s:7:\"message\";s:4:\"shit\";s:5:\"color\";s:6:\"168000\";}i:20;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:806;s:7:\"message\";s:8:\"colossi \";s:5:\"color\";s:6:\"168000\";}i:21;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:809;s:7:\"message\";s:3:\";;/\";s:5:\"color\";s:6:\"168000\";}i:22;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:811;s:7:\"message\";s:9:\"em da eba\";s:5:\"color\";s:6:\"168000\";}i:23;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:878;s:7:\"message\";s:8:\"ahgaghaa\";s:5:\"color\";s:6:\"168000\";}i:24;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:887;s:7:\"message\";s:14:\"kur scepiha me\";s:5:\"color\";s:6:\"168000\";}i:25;a:6:{s:2:\"id\";i:4;s:4:\"name\";s:10:\"NuclearMan\";s:6:\"target\";i:2;s:4:\"time\";d:935;s:7:\"message\";s:22:\"trea zlatnite da fanem\";s:5:\"color\";s:6:\"0042FF\";}i:26;a:6:{s:2:\"id\";i:4;s:4:\"name\";s:10:\"NuclearMan\";s:6:\"target\";i:2;s:4:\"time\";d:936;s:7:\"message\";s:8:\"nekak si\";s:5:\"color\";s:6:\"0042FF\";}i:27;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:942;s:7:\"message\";s:6:\"mnz ;s\";s:5:\"color\";s:6:\"168000\";}i:28;a:6:{s:2:\"id\";i:4;s:4:\"name\";s:10:\"NuclearMan\";s:6:\"target\";i:2;s:4:\"time\";d:971;s:7:\"message\";s:1:\"b\";s:5:\"color\";s:6:\"0042FF\";}i:29;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:994;s:7:\"message\";s:13:\"nema kak da b\";s:5:\"color\";s:6:\"168000\";}i:30;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:996;s:7:\"message\";s:2:\"tt\";s:5:\"color\";s:6:\"168000\";}i:31;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:996;s:7:\"message\";s:2:\"xd\";s:5:\"color\";s:6:\"168000\";}i:32;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:1060;s:7:\"message\";s:13:\"rofl stomp me\";s:5:\"color\";s:6:\"168000\";}i:33;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:1116;s:7:\"message\";s:24:\"nema infestori pone mai \";s:5:\"color\";s:6:\"168000\";}i:34;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:1117;s:7:\"message\";s:2:\";s\";s:5:\"color\";s:6:\"168000\";}i:35;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:1136;s:7:\"message\";s:4:\"\\ima\";s:5:\"color\";s:6:\"168000\";}i:36;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:1137;s:7:\"message\";s:7:\"aghagha\";s:5:\"color\";s:6:\"168000\";}i:37;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:1305;s:7:\"message\";s:3:\"omg\";s:5:\"color\";s:6:\"168000\";}i:38;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:1343;s:7:\"message\";s:2:\"em\";s:5:\"color\";s:6:\"168000\";}i:39;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:1344;s:7:\"message\";s:2:\":(\";s:5:\"color\";s:6:\"168000\";}i:40;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:1345;s:7:\"message\";s:3:\"kur\";s:5:\"color\";s:6:\"168000\";}i:41;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:1347;s:7:\"message\";s:8:\"dobri sa\";s:5:\"color\";s:6:\"168000\";}i:42;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:1573;s:7:\"message\";s:10:\"stoi stoi \";s:5:\"color\";s:6:\"168000\";}i:43;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:1575;s:7:\"message\";s:15:\"az she vidq tam\";s:5:\"color\";s:6:\"168000\";}i:44;a:6:{s:2:\"id\";i:3;s:4:\"name\";s:9:\"CaptainOD\";s:6:\"target\";i:0;s:4:\"time\";d:1998;s:7:\"message\";s:2:\"gg\";s:5:\"color\";s:6:\"EBE129\";}}',NULL),(28,29,'/home/antoine/workspace/nuitblanche/web/upload/replay/phpaImCnm','/upload/chart/phpaImCnm.png',203,'2004','a:1:{i:0;s:4:\"SyDe\";}','EU','1.18317',1,'a:45:{i:0;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:10;s:7:\"message\";s:25:\"da opitam blink stalkeri?\";s:5:\"color\";s:6:\"168000\";}i:1;a:6:{s:2:\"id\";i:4;s:4:\"name\";s:10:\"NuclearMan\";s:6:\"target\";i:2;s:4:\"time\";d:13;s:7:\"message\";s:1:\"k\";s:5:\"color\";s:6:\"0042FF\";}i:2;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:26;s:7:\"message\";s:23:\"ama parvo da oceleem xD\";s:5:\"color\";s:6:\"168000\";}i:3;a:6:{s:2:\"id\";i:4;s:4:\"name\";s:10:\"NuclearMan\";s:6:\"target\";i:2;s:4:\"time\";d:29;s:7:\"message\";s:19:\"samo da se zapushim\";s:5:\"color\";s:6:\"0042FF\";}i:4;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:31;s:7:\"message\";s:2:\"da\";s:5:\"color\";s:6:\"168000\";}i:5;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:32;s:7:\"message\";s:2:\"xd\";s:5:\"color\";s:6:\"168000\";}i:6;a:6:{s:2:\"id\";i:4;s:4:\"name\";s:10:\"NuclearMan\";s:6:\"target\";i:2;s:4:\"time\";d:32;s:7:\"message\";s:5:\"dobre\";s:5:\"color\";s:6:\"0042FF\";}i:7;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:433;s:7:\"message\";s:18:\"az sam rdy s blink\";s:5:\"color\";s:6:\"168000\";}i:8;a:6:{s:2:\"id\";i:4;s:4:\"name\";s:10:\"NuclearMan\";s:6:\"target\";i:2;s:4:\"time\";d:502;s:7:\"message\";s:7:\"chervei\";s:5:\"color\";s:6:\"0042FF\";}i:9;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:505;s:7:\"message\";s:9:\"panika :D\";s:5:\"color\";s:6:\"168000\";}i:10;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:513;s:7:\"message\";s:4:\"shit\";s:5:\"color\";s:6:\"168000\";}i:11;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:542;s:7:\"message\";s:23:\"dai scan tuk sled malko\";s:5:\"color\";s:6:\"168000\";}i:12;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:547;s:7:\"message\";s:10:\"mojesh li?\";s:5:\"color\";s:6:\"168000\";}i:13;a:6:{s:2:\"id\";i:4;s:4:\"name\";s:10:\"NuclearMan\";s:6:\"target\";i:2;s:4:\"time\";d:550;s:7:\"message\";s:2:\"da\";s:5:\"color\";s:6:\"0042FF\";}i:14;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:558;s:7:\"message\";s:3:\"dai\";s:5:\"color\";s:6:\"168000\";}i:15;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:583;s:7:\"message\";s:23:\"basi kak se samoubih xD\";s:5:\"color\";s:6:\"168000\";}i:16;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:585;s:7:\"message\";s:6:\"grozno\";s:5:\"color\";s:6:\"168000\";}i:17;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:784;s:7:\"message\";s:24:\"she praim ht za feedback\";s:5:\"color\";s:6:\"168000\";}i:18;a:6:{s:2:\"id\";i:4;s:4:\"name\";s:10:\"NuclearMan\";s:6:\"target\";i:2;s:4:\"time\";d:797;s:7:\"message\";s:7:\"dobre e\";s:5:\"color\";s:6:\"0042FF\";}i:19;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:804;s:7:\"message\";s:4:\"shit\";s:5:\"color\";s:6:\"168000\";}i:20;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:806;s:7:\"message\";s:8:\"colossi \";s:5:\"color\";s:6:\"168000\";}i:21;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:809;s:7:\"message\";s:3:\";;/\";s:5:\"color\";s:6:\"168000\";}i:22;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:811;s:7:\"message\";s:9:\"em da eba\";s:5:\"color\";s:6:\"168000\";}i:23;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:878;s:7:\"message\";s:8:\"ahgaghaa\";s:5:\"color\";s:6:\"168000\";}i:24;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:887;s:7:\"message\";s:14:\"kur scepiha me\";s:5:\"color\";s:6:\"168000\";}i:25;a:6:{s:2:\"id\";i:4;s:4:\"name\";s:10:\"NuclearMan\";s:6:\"target\";i:2;s:4:\"time\";d:935;s:7:\"message\";s:22:\"trea zlatnite da fanem\";s:5:\"color\";s:6:\"0042FF\";}i:26;a:6:{s:2:\"id\";i:4;s:4:\"name\";s:10:\"NuclearMan\";s:6:\"target\";i:2;s:4:\"time\";d:936;s:7:\"message\";s:8:\"nekak si\";s:5:\"color\";s:6:\"0042FF\";}i:27;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:942;s:7:\"message\";s:6:\"mnz ;s\";s:5:\"color\";s:6:\"168000\";}i:28;a:6:{s:2:\"id\";i:4;s:4:\"name\";s:10:\"NuclearMan\";s:6:\"target\";i:2;s:4:\"time\";d:971;s:7:\"message\";s:1:\"b\";s:5:\"color\";s:6:\"0042FF\";}i:29;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:994;s:7:\"message\";s:13:\"nema kak da b\";s:5:\"color\";s:6:\"168000\";}i:30;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:996;s:7:\"message\";s:2:\"tt\";s:5:\"color\";s:6:\"168000\";}i:31;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:996;s:7:\"message\";s:2:\"xd\";s:5:\"color\";s:6:\"168000\";}i:32;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:1060;s:7:\"message\";s:13:\"rofl stomp me\";s:5:\"color\";s:6:\"168000\";}i:33;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:1116;s:7:\"message\";s:24:\"nema infestori pone mai \";s:5:\"color\";s:6:\"168000\";}i:34;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:1117;s:7:\"message\";s:2:\";s\";s:5:\"color\";s:6:\"168000\";}i:35;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:1136;s:7:\"message\";s:4:\"\\ima\";s:5:\"color\";s:6:\"168000\";}i:36;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:1137;s:7:\"message\";s:7:\"aghagha\";s:5:\"color\";s:6:\"168000\";}i:37;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:1305;s:7:\"message\";s:3:\"omg\";s:5:\"color\";s:6:\"168000\";}i:38;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:1343;s:7:\"message\";s:2:\"em\";s:5:\"color\";s:6:\"168000\";}i:39;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:1344;s:7:\"message\";s:2:\":(\";s:5:\"color\";s:6:\"168000\";}i:40;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:1345;s:7:\"message\";s:3:\"kur\";s:5:\"color\";s:6:\"168000\";}i:41;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:1347;s:7:\"message\";s:8:\"dobri sa\";s:5:\"color\";s:6:\"168000\";}i:42;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:1573;s:7:\"message\";s:10:\"stoi stoi \";s:5:\"color\";s:6:\"168000\";}i:43;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Borislav\";s:6:\"target\";i:2;s:4:\"time\";d:1575;s:7:\"message\";s:15:\"az she vidq tam\";s:5:\"color\";s:6:\"168000\";}i:44;a:6:{s:2:\"id\";i:3;s:4:\"name\";s:9:\"CaptainOD\";s:6:\"target\";i:0;s:4:\"time\";d:1998;s:7:\"message\";s:2:\"gg\";s:5:\"color\";s:6:\"EBE129\";}}',NULL);
/*!40000 ALTER TABLE `replay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `season`
--

DROP TABLE IF EXISTS `season`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `season` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `league_id` int(11) DEFAULT NULL,
  `number` int(11) NOT NULL,
  `division` int(11) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `ended` tinyint(1) NOT NULL,
  `wins` int(11) NOT NULL,
  `draws` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F0E45BA958AFC4DE` (`league_id`),
  CONSTRAINT `season_ibfk_1` FOREIGN KEY (`league_id`) REFERENCES `league` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `season`
--

LOCK TABLES `season` WRITE;
/*!40000 ALTER TABLE `season` DISABLE KEYS */;
INSERT INTO `season` VALUES (1,2,1,3,'2010-09-19 17:25:02','2010-12-15 17:25:10',1,7,0,2,1),(2,1,1,0,'2010-09-01 17:46:51','0000-00-00 00:00:00',0,0,0,0,0),(3,2,2,3,'2011-04-24 17:20:24','2011-07-03 17:20:28',0,1,0,0,0);
/*!40000 ALTER TABLE `season` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `tag` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team`
--

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` VALUES (1,'nB.SC2','/bundles/ihqsnuitblanche/images/ico/nb_boy.png','nB)'),(2,'nB.SC2 Ladies','/bundles/ihqsnuitblanche/images/ico/nb_girl.png','nB)'),(3,'nB.SC2 Oldies','/bundles/ihqsnuitblanche/images/ico/nb_boy.png','nB)');
/*!40000 ALTER TABLE `team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_player`
--

DROP TABLE IF EXISTS `team_player`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_player` (
  `team_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  PRIMARY KEY (`team_id`,`player_id`),
  KEY `IDX_EE023DBC296CD8AE` (`team_id`),
  KEY `IDX_EE023DBC99E6F5DF` (`player_id`),
  CONSTRAINT `team_player_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE,
  CONSTRAINT `team_player_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `player` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_player`
--

LOCK TABLES `team_player` WRITE;
/*!40000 ALTER TABLE `team_player` DISABLE KEYS */;
INSERT INTO `team_player` VALUES (1,1);
/*!40000 ALTER TABLE `team_player` ENABLE KEYS */;
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
  `avatar` varchar(255) DEFAULT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `skype` varchar(255) NOT NULL,
  `msn` varchar(255) NOT NULL,
  `lastActivity` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'AlepH','leeloo07','lysimaque@gmail.com','/upload/avatar/aleph.gif','Antoine','Berranger','Nantes','France','','AlepH-FR','aleph_44','lysimaque@hotmail.com','2011-05-11 16:12:26');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `war`
--

DROP TABLE IF EXISTS `war`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `war` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) DEFAULT NULL,
  `season_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `maps` varchar(255) NOT NULL,
  `teamScore` int(11) NOT NULL,
  `opponentName` varchar(255) NOT NULL,
  `opponentScore` int(11) NOT NULL,
  `opponentCountry` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6C12ED31296CD8AE` (`team_id`),
  KEY `IDX_6C12ED314EC001D1` (`season_id`),
  CONSTRAINT `war_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`),
  CONSTRAINT `war_ibfk_2` FOREIGN KEY (`season_id`) REFERENCES `season` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `war`
--

LOCK TABLES `war` WRITE;
/*!40000 ALTER TABLE `war` DISABLE KEYS */;
INSERT INTO `war` VALUES (2,1,3,'2011-05-10 17:21:02','',2,'FOX',2,'FR','draw');
/*!40000 ALTER TABLE `war` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wargame`
--

DROP TABLE IF EXISTS `wargame`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wargame` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `war_id` int(11) DEFAULT NULL,
  `team1Score` int(11) NOT NULL,
  `team2Score` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F676B01B5B81B612` (`war_id`),
  CONSTRAINT `wargame_ibfk_1` FOREIGN KEY (`war_id`) REFERENCES `war` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wargame`
--

LOCK TABLES `wargame` WRITE;
/*!40000 ALTER TABLE `wargame` DISABLE KEYS */;
INSERT INTO `wargame` VALUES (2,2,1,2);
/*!40000 ALTER TABLE `wargame` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-05-11 18:52:36
