-- MySQL dump 10.13  Distrib 5.5.40, for Linux (x86_64)
--
-- Host: localhost    Database: dB
-- ------------------------------------------------------
-- Server version	5.5.40

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
-- Table structure for table `emaillist`
--

DROP TABLE IF EXISTS `emaillist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emaillist` (
  `emailadd` varchar(255) NOT NULL,
  PRIMARY KEY (`emailadd`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='List of all gotten emails';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emaillist`
--

LOCK TABLES `emaillist` WRITE;
/*!40000 ALTER TABLE `emaillist` DISABLE KEYS */;
/*!40000 ALTER TABLE `emaillist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `finishedurls`
--

DROP TABLE IF EXISTS `finishedurls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `finishedurls` (
  `urlname` varchar(255) NOT NULL,
  PRIMARY KEY (`urlname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='List of finished urls';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `finishedurls`
--

LOCK TABLES `finishedurls` WRITE;
/*!40000 ALTER TABLE `finishedurls` DISABLE KEYS */;
/*!40000 ALTER TABLE `finishedurls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workingurls`
--

DROP TABLE IF EXISTS `workingurls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workingurls` (
  `urlname` varchar(255) NOT NULL,
  PRIMARY KEY (`urlname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='List of current working urls';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workingurls`
--

LOCK TABLES `workingurls` WRITE;
/*!40000 ALTER TABLE `workingurls` DISABLE KEYS */;
/*!40000 ALTER TABLE `workingurls` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-02-10 21:06:22
