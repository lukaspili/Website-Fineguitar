-- MySQL dump 10.13  Distrib 5.1.49, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: geartoswap
-- ------------------------------------------------------
-- Server version	5.1.49-3

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
-- Table structure for table `oc_accounts`
--

DROP TABLE IF EXISTS `oc_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_accounts` (
  `idAccount` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `email` varchar(145) NOT NULL,
  `password` varchar(145) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  `idLocation` int(10) unsigned DEFAULT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastModifiedDate` datetime DEFAULT NULL,
  `lastSigninDate` datetime DEFAULT NULL,
  `activationToken` varchar(225) NOT NULL,
  PRIMARY KEY (`idAccount`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_accounts`
--

LOCK TABLES `oc_accounts` WRITE;
/*!40000 ALTER TABLE `oc_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `oc_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_categories`
--

DROP TABLE IF EXISTS `oc_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_categories` (
  `idCategory` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `order` int(2) unsigned NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idCategoryParent` int(10) unsigned NOT NULL DEFAULT '0',
  `friendlyName` varchar(64) NOT NULL,
  `description` text,
  `price` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`idCategory`) USING BTREE,
  KEY `Index_fname` (`friendlyName`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_categories`
--

LOCK TABLES `oc_categories` WRITE;
/*!40000 ALTER TABLE `oc_categories` DISABLE KEYS */;
INSERT INTO `oc_categories` VALUES (10,'Jobs',2,'2009-04-22 17:25:11',0,'jobs','The best place to find work is with our job offers. Also you can ask for work in the \'Need\' section.',0),(11,'Full Time',1,'2009-04-22 17:31:43',10,'full-time','Are you looking for a fulltime job? Or do you have a fulltime job to offer? Post your Ad here!',0),(12,'Part Time',2,'2009-04-22 17:32:15',10,'part-time','Are you looking for a parttime job? Or do you have a partime job to offer? Post your Ad here!',0),(13,'Internship',3,'2009-04-22 17:33:05',10,'internship','Are you looking for a internship? Or do you have an internship to offer? Post it here!',0),(14,'Languages',3,'2009-04-22 17:26:26',0,'languages','You want to learn a new language? Or can you teach a language? This is your section!',0),(15,'English',1,'2009-04-22 17:33:52',14,'english','Do you speak English? Or can you teach it? Do you want to learn? This is your category.',0),(16,'Spanish',2,'2009-04-22 17:34:29',14,'spanish','You want to learn Spanish? Or can you teach Spanish? This is your section!',0),(32,'Events',1,'2009-04-22 17:36:13',36,'events','Upcoming Parties, Cinema, Museums, Parades, Birthdays, Dinners.... Everything!',0),(33,'Other Languages',3,'2009-04-22 17:35:34',14,'other-languages','Are you interested in learning or teaching any other language that is not listed? Post it here!',0),(36,'Others',5,'2009-04-22 17:26:50',0,'others','Whatever you can imagine is in this section.',0),(39,'Housing',1,'2009-04-22 17:28:50',0,'housing','Do you need a place to sleep, or you have something to offer; rooms, shared apartments, houses... etc.\r\n\r\nFind your perfect roommate here!',0),(41,'Apartment',1,'2009-04-22 17:39:32',39,'apartment','Apartments, flats, monthly rentals, long terms, for days... this is the section to have your apartment!',0),(43,'Shared Apartments - Rooms',2,'2009-05-03 21:53:57',39,'shared-apartments-rooms','You want to share an apartment? Then you need a room! Ask for rooms or add yours in this section.',0),(46,'House',3,'2009-04-22 17:40:50',39,'house','Rent a house, or offer your house for rent! Here you can find your beach house!',0),(49,'Hobbies',2,'2009-04-22 17:36:55',36,'hobbies','Share your hobby with someone! Football, running, cinema, music, cinema, party ... Post it here!',0),(51,'Market',4,'2009-04-22 17:30:42',0,'market','Buy or sell things that you don`t need anymore, you will find someone interested, or maybe you are going to find exactly what you need.',0),(54,'TV',1,'2009-04-22 17:41:39',51,'tv','TV, Video Games, TFT, Plasma, your old TV, or your new one can find a new owner!',0),(56,'Audio',2,'2009-04-22 17:42:13',51,'audio','HI-FI systems, iPod, MP3 players, MP4, if you dont use it anymore sell it! If you try to find a second hand one, this is your place!',0),(59,'Furniture',3,'2009-04-22 17:43:16',51,'furniture','Do you need to furnish your home? Or would you like to sell your furniture? Post it here!',0),(62,'IT',4,'2009-04-22 17:43:48',51,'it','You need a computer? Laptop? Or do you have some old components? This is the IT market!',0),(65,'Other Market',5,'2009-04-22 17:44:12',51,'other-market','In this market you can sell everything you want! Or search for it!',0),(68,'Services',3,'2009-04-22 17:38:33',36,'services','Do you need a service? Relocation? Insurance? Doctor? Cleaning? Here you can ask for it or offer services!',0),(70,'Friendship',4,'2009-04-22 17:38:52',36,'friendship','Are you alone in the city? Here you can find new friends!',0),(73,'Au pair',4,'2009-06-19 09:26:22',10,'au-pair','Find or require for a Au Pair service. Here is the best place',0);
/*!40000 ALTER TABLE `oc_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_locations`
--

DROP TABLE IF EXISTS `oc_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_locations` (
  `idLocation` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `idLocationParent` int(10) unsigned NOT NULL DEFAULT '0',
  `friendlyName` varchar(64) NOT NULL,
  PRIMARY KEY (`idLocation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_locations`
--

LOCK TABLES `oc_locations` WRITE;
/*!40000 ALTER TABLE `oc_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `oc_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_posts`
--

DROP TABLE IF EXISTS `oc_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_posts` (
  `idPost` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `isAvailable` int(1) NOT NULL DEFAULT '1',
  `isConfirmed` int(1) NOT NULL DEFAULT '0',
  `idCategory` int(10) unsigned NOT NULL DEFAULT '0',
  `type` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(145) NOT NULL,
  `description` text NOT NULL,
  `email` varchar(145) NOT NULL,
  `idLocation` int(10) unsigned NOT NULL DEFAULT '0',
  `place` varchar(145) DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `ip` varchar(18) NOT NULL DEFAULT '',
  `insertDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(8) NOT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `hasImages` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idPost`) USING BTREE,
  KEY `FK_posts_categories` (`idCategory`),
  KEY `Index_title` (`title`),
  CONSTRAINT `FK_posts_categories` FOREIGN KEY (`idCategory`) REFERENCES `oc_categories` (`idCategory`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_posts`
--

LOCK TABLES `oc_posts` WRITE;
/*!40000 ALTER TABLE `oc_posts` DISABLE KEYS */;
INSERT INTO `oc_posts` VALUES (1,1,1,36,0,'Welcome to Open Classifieds!','<b>Welcome to Open Classifieds!</b><div><b><br></b></div><div>Seems that your new classifieds site is working perfect, that`s great! ;)</div><div><br></div><div>We love to see people happy.</div><div><br></div><div>If you need any other help please go to the forum where we will help you. http://open-classifieds.com/forum/</div><div><br></div><div><br></div><div>PS: To delete this welcome message log in in /admin/ and return to the site, then you will see the tools to delete, edit or spam.</div>','admin@site.com',0,'Barcelona','Chema',0,'127.0.0.1','2010-01-01 17:20:00','00000000','',0),(2,1,1,10,0,'sqmlkqsdm','ùsmldkfsùl','zerty@azerty.fr',0,'','sdfgds',0,'172.16.6.1','2012-05-01 21:50:37','ro25ml9u','',0);
/*!40000 ALTER TABLE `oc_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_postshits`
--

DROP TABLE IF EXISTS `oc_postshits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_postshits` (
  `idHit` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idPost` int(10) unsigned NOT NULL,
  `hitTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(18) NOT NULL,
  PRIMARY KEY (`idHit`),
  KEY `FK_PostsHits_idPost` (`idPost`),
  KEY `Index_hitTime` (`hitTime`),
  CONSTRAINT `FK_PostsHits_idPost` FOREIGN KEY (`idPost`) REFERENCES `oc_posts` (`idPost`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_postshits`
--

LOCK TABLES `oc_postshits` WRITE;
/*!40000 ALTER TABLE `oc_postshits` DISABLE KEYS */;
INSERT INTO `oc_postshits` VALUES (1,1,'2012-05-01 21:37:52','172.16.6.1'),(2,2,'2012-05-01 21:50:43','172.16.6.1');
/*!40000 ALTER TABLE `oc_postshits` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-05-03 13:06:41
