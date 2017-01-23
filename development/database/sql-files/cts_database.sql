CREATE DATABASE  IF NOT EXISTS `cts` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `cts`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: cts
-- ------------------------------------------------------
-- Server version	5.5.32

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
-- Table structure for table `adjustment`
--

DROP TABLE IF EXISTS `adjustment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adjustment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kennzahl_id` int(11) NOT NULL,
  `serviceline_id` int(11) NOT NULL,
  `vertragshater_id` int(11) NOT NULL,
  `stichtag_id` int(11) NOT NULL,
  `wert` decimal(10,2) NOT NULL,
  `monat_id` int(11) NOT NULL,
  `jahr_id` int(11) NOT NULL,
  `benutzer_id` int(11) NOT NULL,
  `zeitstempel` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_stichtag_idx` (`stichtag_id`),
  KEY `fkvertragshalter_idx` (`vertragshater_id`),
  KEY `fk_serviceline_idx` (`serviceline_id`),
  KEY `fk_monat_idx` (`monat_id`),
  KEY `fk_kennzahl_idx` (`kennzahl_id`),
  KEY `fk_jahr_idx` (`jahr_id`),
  KEY `fk_benutzer_idx` (`benutzer_id`),
  CONSTRAINT `fk_benutzer` FOREIGN KEY (`benutzer_id`) REFERENCES `benutzer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_jahr` FOREIGN KEY (`jahr_id`) REFERENCES `jahr` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_kennzahl` FOREIGN KEY (`kennzahl_id`) REFERENCES `kennzahl` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_monat` FOREIGN KEY (`monat_id`) REFERENCES `monat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_serviceline` FOREIGN KEY (`serviceline_id`) REFERENCES `serviceline` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_stichtag` FOREIGN KEY (`stichtag_id`) REFERENCES `stichtag` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_vertragshalter` FOREIGN KEY (`vertragshater_id`) REFERENCES `vertragshalter` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adjustment`
--

LOCK TABLES `adjustment` WRITE;
/*!40000 ALTER TABLE `adjustment` DISABLE KEYS */;
/*!40000 ALTER TABLE `adjustment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `benutzer`
--

DROP TABLE IF EXISTS `benutzer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `benutzer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `passwort` varchar(255) NOT NULL,
  `vorname` varchar(255) NOT NULL,
  `nachname` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefon` varchar(255) DEFAULT NULL,
  `mobil` varchar(255) DEFAULT NULL,
  `sprache_id` int(11) NOT NULL,
  `rolle_id` int(11) NOT NULL,
  `vertragshalter_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `benutzer_login_UNIQUE` (`login`),
  KEY `fk_benutzer_vertragshalter_idx` (`vertragshalter_id`),
  KEY `fk_benutzer_sprache_idx` (`sprache_id`),
  KEY `fk_benutzer_rolle_idx` (`rolle_id`),
  CONSTRAINT `fk_benutzer_rolle` FOREIGN KEY (`rolle_id`) REFERENCES `rolle` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_benutzer_sprache` FOREIGN KEY (`sprache_id`) REFERENCES `sprache` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_benutzer_vertragshalter` FOREIGN KEY (`vertragshalter_id`) REFERENCES `vertragshalter` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `benutzer`
--

LOCK TABLES `benutzer` WRITE;
/*!40000 ALTER TABLE `benutzer` DISABLE KEYS */;
INSERT INTO `benutzer` VALUES (1,'admin','admin','Der','Administrator','',NULL,NULL,1,1,1),(2,'controller','passwort','Ein','Controller',NULL,NULL,NULL,1,2,1),(3,'anwender','passwort','Ein','Anwender',NULL,NULL,NULL,1,3,9);
/*!40000 ALTER TABLE `benutzer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `benutzer_subsegment`
--

DROP TABLE IF EXISTS `benutzer_subsegment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `benutzer_subsegment` (
  `benutzer_id` int(11) NOT NULL,
  `subsegment_id` int(11) NOT NULL,
  PRIMARY KEY (`benutzer_id`,`subsegment_id`),
  KEY `fk_benutzer_subsegment_subsegment_idx` (`subsegment_id`),
  KEY `fk_benutzer_subsegment_benutzer_idx` (`benutzer_id`),
  CONSTRAINT `fk_benutzer_subsegment_benutzer` FOREIGN KEY (`benutzer_id`) REFERENCES `benutzer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_benutzer_subsegment_subsegment` FOREIGN KEY (`subsegment_id`) REFERENCES `subsegment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `benutzer_subsegment`
--

LOCK TABLES `benutzer_subsegment` WRITE;
/*!40000 ALTER TABLE `benutzer_subsegment` DISABLE KEYS */;
INSERT INTO `benutzer_subsegment` VALUES (2,1),(3,1),(2,2),(2,3);
/*!40000 ALTER TABLE `benutzer_subsegment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `businesstype`
--

DROP TABLE IF EXISTS `businesstype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `businesstype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `businesstype`
--

LOCK TABLES `businesstype` WRITE;
/*!40000 ALTER TABLE `businesstype` DISABLE KEYS */;
INSERT INTO `businesstype` VALUES (1,'3rd Party'),(2,'Intersegment'),(3,'Other');
/*!40000 ALTER TABLE `businesstype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `datensatz`
--

DROP TABLE IF EXISTS `datensatz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `datensatz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projekt_id` int(11) NOT NULL,
  `subkennzahl_id` int(11) NOT NULL,
  `vertragshalter_id` int(11) NOT NULL,
  `vertragsbestandteil_id` int(11) NOT NULL,
  `stichtag_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `monat_id` int(11) NOT NULL,
  `jahr_id` int(11) NOT NULL,
  `wert_kein_risiko` decimal(10,2) NOT NULL,
  `wert_mittleres_risiko` decimal(10,2) NOT NULL DEFAULT '0.00',
  `wert_hohes_risiko` decimal(10,2) NOT NULL DEFAULT '0.00',
  `wert_gebucht` decimal(10,2) NOT NULL DEFAULT '0.00',
  `wert_potenzial` decimal(10,2) NOT NULL DEFAULT '0.00',
  `wert_adjustment` decimal(10,2) NOT NULL DEFAULT '0.00',
  `kommentar` varchar(255) DEFAULT NULL,
  `benutzer_id` int(11) NOT NULL,
  `zeitstempel` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quelle_id` int(11) NOT NULL,
  `serviceline_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_datensatz_stichtag_idx` (`stichtag_id`),
  KEY `fk_datensatz_vertragshalter_idx` (`vertragsbestandteil_id`),
  KEY `fk_datensatz_subkennzahl_idx` (`subkennzahl_id`),
  KEY `fk_datensatz_projekt_idx` (`projekt_id`),
  KEY `fk_datensatz_monat_idx` (`monat_id`),
  KEY `fk_datensatz_jahr_idx` (`jahr_id`),
  KEY `fk_datensatz_status_idx` (`status_id`),
  KEY `fk_datensatz_vertragshalter_idx1` (`vertragshalter_id`),
  KEY `fk_datensatz_benutzer_idx` (`benutzer_id`),
  KEY `fk_datensatz_quelle_idx` (`quelle_id`),
  KEY `fk_datensatz_serviceline_idx` (`serviceline_id`),
  CONSTRAINT `fk_datensatz_benutzer` FOREIGN KEY (`benutzer_id`) REFERENCES `benutzer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_datensatz_jahr` FOREIGN KEY (`jahr_id`) REFERENCES `jahr` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_datensatz_monat` FOREIGN KEY (`monat_id`) REFERENCES `monat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_datensatz_projekt` FOREIGN KEY (`projekt_id`) REFERENCES `projekt` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_datensatz_quelle` FOREIGN KEY (`quelle_id`) REFERENCES `quelle` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_datensatz_serviceline` FOREIGN KEY (`serviceline_id`) REFERENCES `serviceline` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_datensatz_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_datensatz_stichtag` FOREIGN KEY (`stichtag_id`) REFERENCES `stichtag` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_datensatz_subkennzahl` FOREIGN KEY (`subkennzahl_id`) REFERENCES `subkennzahl` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_datensatz_vertragsbestandteil` FOREIGN KEY (`vertragsbestandteil_id`) REFERENCES `vertragshalter` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_datensatz_vertragshalter` FOREIGN KEY (`vertragshalter_id`) REFERENCES `vertragshalter` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datensatz`
--

LOCK TABLES `datensatz` WRITE;
/*!40000 ALTER TABLE `datensatz` DISABLE KEYS */;
INSERT INTO `datensatz` VALUES (1,6,3,1,1,1,1,1,14,11000.00,0.00,0.00,0.00,0.00,0.00,NULL,2,'2014-11-25 22:53:41',1,1),(2,6,3,9,9,1,1,2,14,12000.00,0.00,0.00,0.00,0.00,0.00,NULL,2,'2014-11-25 22:53:41',1,1),(3,7,1,1,1,1,1,1,14,13000.00,0.00,0.00,0.00,0.00,0.00,NULL,2,'2014-11-25 22:53:41',1,1),(4,7,1,9,9,1,1,2,14,14000.00,0.00,0.00,0.00,0.00,0.00,NULL,2,'2014-11-25 22:53:41',1,1),(5,8,5,1,1,1,1,1,14,15000.00,0.00,0.00,0.00,0.00,0.00,NULL,2,'2014-11-25 22:53:41',1,1),(6,8,5,1,1,1,1,2,14,16000.00,0.00,0.00,0.00,0.00,0.00,NULL,2,'2014-11-25 22:53:41',1,1),(7,9,2,1,1,1,1,1,14,17000.00,0.00,0.00,0.00,0.00,0.00,NULL,2,'2014-11-25 22:53:41',1,1),(8,9,4,21,21,1,1,1,14,18000.00,0.00,0.00,0.00,0.00,0.00,NULL,2,'2014-11-25 22:53:41',1,1),(9,10,6,1,1,1,1,2,14,19000.00,0.00,0.00,0.00,0.00,0.00,'',2,'2015-03-01 15:52:43',1,1),(10,10,7,1,1,1,1,2,14,20000.00,0.00,0.00,0.00,0.00,0.00,NULL,2,'2014-11-25 22:53:41',1,1),(11,11,9,1,1,1,1,1,15,5000000.00,150000.00,20000.00,5.00,15.00,0.00,'Nico',2,'2015-01-14 11:31:08',1,18),(12,10,6,1,1,1,1,1,14,0.00,0.00,0.00,0.00,0.00,0.00,'',2,'2015-03-01 15:52:43',1,1),(13,10,6,1,1,1,1,3,14,0.00,0.00,0.00,0.00,0.00,0.00,'',2,'2015-03-01 22:03:47',1,1),(14,10,6,1,1,1,1,4,14,0.00,0.00,0.00,0.00,0.00,0.00,'',2,'2015-03-01 15:52:43',1,1),(15,10,6,1,1,1,1,5,14,0.00,0.00,0.00,0.00,0.00,0.00,'',2,'2015-01-27 21:12:19',1,1),(16,10,6,1,1,1,1,6,14,0.00,0.00,0.00,0.00,0.00,0.00,'',2,'2015-03-01 15:52:43',1,1),(17,10,6,1,1,1,1,7,14,0.00,0.00,0.00,0.00,0.00,0.00,'',2,'2015-03-01 15:52:43',1,1),(18,10,6,1,1,1,1,8,14,0.00,0.00,0.00,0.00,0.00,0.00,'',2,'2015-03-01 15:52:43',1,1),(19,10,6,1,1,1,1,9,14,0.00,0.00,0.00,0.00,0.00,0.00,'',2,'2015-03-01 15:52:43',1,1),(20,10,6,1,1,1,1,10,14,0.00,0.00,0.00,0.00,0.00,0.00,'',2,'2015-03-01 15:52:43',1,1),(21,10,6,1,1,1,1,11,14,0.00,0.00,0.00,0.00,0.00,0.00,'',2,'2015-03-01 15:52:43',1,1),(22,10,6,1,1,1,1,5,14,0.00,0.00,0.00,10.00,0.00,0.00,'',2,'2015-03-01 22:03:47',1,1),(33,10,6,1,1,1,1,2,14,19000.00,0.00,0.00,10.00,0.00,0.00,'',2,'2015-03-01 22:03:47',1,1),(34,10,6,1,1,1,1,1,14,0.00,0.00,0.00,20.00,0.00,0.00,'',2,'2015-03-01 22:03:47',1,1),(35,10,6,1,1,1,1,4,14,0.00,0.00,0.00,5.00,0.00,0.00,'',2,'2015-03-01 22:03:47',1,1),(36,10,6,1,1,1,1,6,14,0.00,0.00,0.00,15.00,0.00,0.00,'',2,'2015-03-01 22:03:47',1,1),(37,10,6,1,1,1,1,7,14,0.00,0.00,0.00,20.00,0.00,0.00,'',2,'2015-03-01 22:03:47',1,1),(38,10,6,1,1,1,1,8,14,0.00,0.00,0.00,30.00,0.00,0.00,'',2,'2015-03-01 22:03:47',1,1),(39,10,6,1,1,1,1,9,14,0.00,0.00,0.00,50.00,0.00,0.00,'',2,'2015-03-01 22:03:47',1,1),(40,10,6,1,1,1,1,10,14,0.00,0.00,0.00,100.00,0.00,0.00,'',2,'2015-03-01 22:03:47',1,1),(41,10,6,1,1,1,1,11,14,0.00,0.00,0.00,50.00,0.00,0.00,'',2,'2015-03-01 22:03:47',1,1),(44,10,5,1,1,1,1,2,14,19000.00,0.00,0.00,0.00,0.00,0.00,'',2,'2015-03-01 22:02:01',1,1),(45,10,5,1,1,1,1,1,14,0.00,0.00,0.00,0.00,0.00,0.00,'',2,'2015-03-01 22:02:01',1,1),(46,10,5,1,1,1,1,3,14,0.00,0.00,0.00,0.00,0.00,0.00,'',2,'2015-03-01 22:03:47',1,1),(47,10,5,1,1,1,1,4,14,0.00,0.00,0.00,0.00,0.00,0.00,'',2,'2015-03-01 22:02:01',1,1),(48,10,5,1,1,1,1,5,14,0.00,0.00,0.00,0.00,0.00,0.00,'',2,'2015-03-01 22:02:01',1,1),(49,10,5,1,1,1,1,6,14,0.00,0.00,0.00,0.00,0.00,0.00,'',2,'2015-03-01 22:02:01',1,1),(50,10,5,1,1,1,1,7,14,0.00,0.00,0.00,0.00,0.00,0.00,'',2,'2015-03-01 22:02:01',1,1),(51,10,5,1,1,1,1,8,14,0.00,0.00,0.00,0.00,0.00,0.00,'',2,'2015-03-01 22:02:01',1,1),(52,10,5,1,1,1,1,9,14,0.00,0.00,0.00,0.00,0.00,0.00,'',2,'2015-03-01 22:02:01',1,1),(53,10,5,1,1,1,1,10,14,0.00,0.00,0.00,0.00,0.00,0.00,'',2,'2015-03-01 22:02:01',1,1),(54,10,5,1,1,1,1,11,14,0.00,0.00,0.00,0.00,0.00,0.00,'',2,'2015-03-01 22:02:01',1,1),(55,10,5,1,1,1,1,5,14,0.00,0.00,0.00,10.00,0.00,0.00,'',2,'2015-03-01 22:02:01',1,1),(56,10,5,1,1,1,1,2,14,19000.00,0.00,0.00,10.00,0.00,0.00,'',2,'2015-03-01 22:02:01',1,1),(57,10,5,1,1,1,1,1,14,0.00,0.00,0.00,20.00,0.00,0.00,'',2,'2015-03-01 22:02:01',1,1),(58,10,5,1,1,1,1,4,14,0.00,0.00,0.00,5.00,0.00,0.00,'',2,'2015-03-01 22:02:01',1,1),(59,10,5,1,1,1,1,6,14,0.00,0.00,0.00,15.00,0.00,0.00,'',2,'2015-03-01 22:02:01',1,1),(60,10,5,1,1,1,1,7,14,0.00,0.00,0.00,20.00,0.00,0.00,'',2,'2015-03-01 22:02:01',1,1),(61,10,5,1,1,1,1,8,14,0.00,0.00,0.00,30.00,0.00,0.00,'',2,'2015-03-01 22:02:01',1,1),(62,10,5,1,1,1,1,9,14,0.00,0.00,0.00,50.00,0.00,0.00,'',2,'2015-03-01 22:02:01',1,1),(63,10,5,1,1,1,1,10,14,0.00,0.00,0.00,100.00,0.00,0.00,'',2,'2015-03-01 22:02:01',1,1),(64,10,5,1,1,1,1,11,14,0.00,0.00,0.00,50.00,0.00,0.00,'',2,'2015-03-01 22:02:01',1,1),(75,10,5,1,1,1,1,2,14,19000.00,0.00,0.00,20.00,0.00,0.00,'',2,'2015-03-01 22:03:47',1,1),(76,10,5,1,1,1,1,1,14,0.00,0.00,0.00,40.00,0.00,0.00,'',2,'2015-03-01 22:03:47',1,1),(77,10,5,1,1,1,1,4,14,0.00,0.00,0.00,10.00,0.00,0.00,'',2,'2015-03-01 22:03:47',1,1),(78,10,5,1,1,1,1,5,14,0.00,0.00,0.00,20.00,0.00,0.00,'',2,'2015-03-01 22:03:47',1,1),(79,10,5,1,1,1,1,6,14,0.00,0.00,0.00,30.00,0.00,0.00,'',2,'2015-03-01 22:03:47',1,1),(80,10,5,1,1,1,1,7,14,0.00,0.00,0.00,40.00,0.00,0.00,'',2,'2015-03-01 22:03:47',1,1),(81,10,5,1,1,1,1,8,14,0.00,0.00,0.00,60.00,0.00,0.00,'',2,'2015-03-01 22:03:47',1,1),(82,10,5,1,1,1,1,9,14,0.00,0.00,0.00,100.00,0.00,0.00,'',2,'2015-03-01 22:03:47',1,1),(83,10,5,1,1,1,1,10,14,0.00,0.00,0.00,200.00,0.00,0.00,'',2,'2015-03-01 22:03:47',1,1),(84,10,5,1,1,1,1,11,14,0.00,0.00,0.00,100.00,0.00,0.00,'',2,'2015-03-01 22:03:47',1,1);
/*!40000 ALTER TABLE `datensatz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `frame`
--

DROP TABLE IF EXISTS `frame`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `frame` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `frame`
--

LOCK TABLES `frame` WRITE;
/*!40000 ALTER TABLE `frame` DISABLE KEYS */;
INSERT INTO `frame` VALUES (1,'4000F'),(2,'Other');
/*!40000 ALTER TABLE `frame` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jahr`
--

DROP TABLE IF EXISTS `jahr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jahr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jahr`
--

LOCK TABLES `jahr` WRITE;
/*!40000 ALTER TABLE `jahr` DISABLE KEYS */;
INSERT INTO `jahr` VALUES (1,'2001'),(2,'2002'),(3,'2003'),(4,'2004'),(5,'2005'),(6,'2006'),(7,'2007'),(8,'2008'),(9,'2009'),(10,'2010'),(11,'2011'),(12,'2012'),(13,'2013'),(14,'2014'),(15,'2015'),(16,'2016'),(17,'2017'),(18,'2018'),(19,'2019'),(20,'2020');
/*!40000 ALTER TABLE `jahr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kaufmann`
--

DROP TABLE IF EXISTS `kaufmann`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kaufmann` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vorname` varchar(255) NOT NULL,
  `nachname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kaufmann`
--

LOCK TABLES `kaufmann` WRITE;
/*!40000 ALTER TABLE `kaufmann` DISABLE KEYS */;
INSERT INTO `kaufmann` VALUES (1,'Anne','Fehre'),(2,'Lukas','Termath'),(3,'Julia','Richter'),(4,'Aylin','Bettermann');
/*!40000 ALTER TABLE `kaufmann` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kennzahl`
--

DROP TABLE IF EXISTS `kennzahl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kennzahl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `akronym` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `akronym_UNIQUE` (`akronym`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kennzahl`
--

LOCK TABLES `kennzahl` WRITE;
/*!40000 ALTER TABLE `kennzahl` DISABLE KEYS */;
INSERT INTO `kennzahl` VALUES (1,'Auftragseingang','OE'),(2,'Umsatz','REV'),(3,'Bruttomarge','GM'),(4,'EBIT','EBIT'),(5,'Free Cash Flow','NETCASH'),(6,'Gemeinkosten','SG&A'),(7,'Research and Developement','R&D'),(8,'Zahlungseingang','CASHIN'),(9,'Headcount','HC'),(10,'Other','OT');
/*!40000 ALTER TABLE `kennzahl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `land`
--

DROP TABLE IF EXISTS `land`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `land` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `code_UNIQUE` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `land`
--

LOCK TABLES `land` WRITE;
/*!40000 ALTER TABLE `land` DISABLE KEYS */;
INSERT INTO `land` VALUES (1,'Deutschland','DE'),(2,'Vereinigt Arabische Emirate','AE'),(3,'Afghanistan','AF'),(4,'Bahrain','BH'),(5,'Algerien','DZ'),(6,'Ägypten','EG'),(7,'Äthiopien','ET'),(8,'Westsahara','EH'),(9,'Israel','IL'),(10,'Indien','IN'),(11,'Irak','IQ'),(12,'Iran','IR'),(13,'Jordanien','JO'),(14,'Kuwait','KW'),(15,'Libanon','LB'),(16,'Lybien','LY'),(17,'Maroko','MA'),(18,'Oman','OM'),(19,'Pakistan','PK'),(20,'Katar','QA'),(21,'Saudi Arabien','SA'),(22,'Syrien','SY'),(23,'Tunesien','TN'),(24,'Jemen','YE'),(25,'Various','VA');
/*!40000 ALTER TABLE `land` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monat`
--

DROP TABLE IF EXISTS `monat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `monat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `akronym` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monat`
--

LOCK TABLES `monat` WRITE;
/*!40000 ALTER TABLE `monat` DISABLE KEYS */;
INSERT INTO `monat` VALUES (1,'Oktober','Okt'),(2,'November','Nov'),(3,'Dezember','Dez'),(4,'Januar','Jan'),(5,'Februar','Feb'),(6,'März','Mär'),(7,'April','Apr'),(8,'Mai','Mai'),(9,'Juni','Jun'),(10,'Juli','Jul'),(11,'August','Aug'),(12,'September','Sep');
/*!40000 ALTER TABLE `monat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projekt`
--

DROP TABLE IF EXISTS `projekt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projekt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `definition` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `land_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `verantwortlicher_id` int(11) NOT NULL,
  `frame_id` int(11) NOT NULL,
  `kaufmann_id` int(11) NOT NULL,
  `businesstype_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `definition_UNIQUE` (`definition`),
  KEY `fk_projekt_projektart_idx` (`frame_id`),
  KEY `fk_projekt_land_idx` (`land_id`),
  KEY `fk_projekt_projektart_idx1` (`art_id`),
  KEY `fk_projekt_kaufmann_idx` (`kaufmann_id`),
  KEY `fk_projekt_verantwortlicher_idx` (`verantwortlicher_id`),
  KEY `fk_projekt_businesstype_idx` (`businesstype_id`),
  CONSTRAINT `fk_projekt_businesstype` FOREIGN KEY (`businesstype_id`) REFERENCES `businesstype` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_projekt_frame` FOREIGN KEY (`frame_id`) REFERENCES `frame` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_projekt_kaufmann` FOREIGN KEY (`kaufmann_id`) REFERENCES `kaufmann` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_projekt_land` FOREIGN KEY (`land_id`) REFERENCES `land` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_projekt_projektart` FOREIGN KEY (`art_id`) REFERENCES `projektart` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_projekt_verantwortlicher` FOREIGN KEY (`verantwortlicher_id`) REFERENCES `verantwortlicher` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projekt`
--

LOCK TABLES `projekt` WRITE;
/*!40000 ALTER TABLE `projekt` DISABLE KEYS */;
INSERT INTO `projekt` VALUES (6,'O-0480','NubTalKur',6,1,4,1,1,1),(7,'O-0878','OPSA Damietta II',6,1,4,1,2,1),(8,'O-1999','Biskra',14,1,2,1,3,1),(9,'O-0987','Berrouaghia',18,1,5,1,3,1),(10,'W-0329838','Kostensammler Iraq',11,2,1,1,2,2),(11,'SG&A','SG&A',25,3,11,2,4,3),(12,'R&D','R&D',25,3,11,2,4,3),(13,'Headcount','Headcount',25,3,11,2,4,3),(14,'Others','Others',25,3,11,2,4,3);
/*!40000 ALTER TABLE `projekt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projekt_jahr`
--

DROP TABLE IF EXISTS `projekt_jahr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projekt_jahr` (
  `projekt_id` int(11) NOT NULL,
  `jahr_id` int(11) NOT NULL,
  PRIMARY KEY (`projekt_id`,`jahr_id`),
  KEY `fk_projekt_jahr_jahr_idx` (`jahr_id`),
  KEY `fk_projekt_jahr_projekt_idx` (`projekt_id`),
  CONSTRAINT `fk_projekt_jahr_jahr` FOREIGN KEY (`jahr_id`) REFERENCES `jahr` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_projekt_jahr_projekt` FOREIGN KEY (`projekt_id`) REFERENCES `projekt` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projekt_jahr`
--

LOCK TABLES `projekt_jahr` WRITE;
/*!40000 ALTER TABLE `projekt_jahr` DISABLE KEYS */;
INSERT INTO `projekt_jahr` VALUES (6,14),(7,14),(8,14),(9,14),(10,14);
/*!40000 ALTER TABLE `projekt_jahr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projektart`
--

DROP TABLE IF EXISTS `projektart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projektart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projektart`
--

LOCK TABLES `projektart` WRITE;
/*!40000 ALTER TABLE `projektart` DISABLE KEYS */;
INSERT INTO `projektart` VALUES (2,'Kostensammler'),(1,'Normales Projekt'),(3,'Other');
/*!40000 ALTER TABLE `projektart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projektart_kennzahl`
--

DROP TABLE IF EXISTS `projektart_kennzahl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projektart_kennzahl` (
  `projektart_id` int(11) NOT NULL,
  `kennzahl_id` int(11) NOT NULL,
  PRIMARY KEY (`projektart_id`,`kennzahl_id`),
  KEY `fk_projektart_kennzahl_kennzahl_idx` (`kennzahl_id`),
  CONSTRAINT `fk_projektart_kennzahl_kennzahl` FOREIGN KEY (`kennzahl_id`) REFERENCES `kennzahl` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_projektart_kennzahl_projektart` FOREIGN KEY (`projektart_id`) REFERENCES `projektart` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projektart_kennzahl`
--

LOCK TABLES `projektart_kennzahl` WRITE;
/*!40000 ALTER TABLE `projektart_kennzahl` DISABLE KEYS */;
INSERT INTO `projektart_kennzahl` VALUES (2,3),(2,5);
/*!40000 ALTER TABLE `projektart_kennzahl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quelle`
--

DROP TABLE IF EXISTS `quelle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quelle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quelle`
--

LOCK TABLES `quelle` WRITE;
/*!40000 ALTER TABLE `quelle` DISABLE KEYS */;
INSERT INTO `quelle` VALUES (1,'CTSProgramm');
/*!40000 ALTER TABLE `quelle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rolle`
--

DROP TABLE IF EXISTS `rolle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rolle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rolle`
--

LOCK TABLES `rolle` WRITE;
/*!40000 ALTER TABLE `rolle` DISABLE KEYS */;
INSERT INTO `rolle` VALUES (1,'Administrator'),(3,'Anwender'),(2,'Controller');
/*!40000 ALTER TABLE `rolle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `serviceline`
--

DROP TABLE IF EXISTS `serviceline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `serviceline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `subsegment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_serviceline_subsegment_idx` (`subsegment_id`),
  CONSTRAINT `fk_serviceline_subsegment` FOREIGN KEY (`subsegment_id`) REFERENCES `subsegment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `serviceline`
--

LOCK TABLES `serviceline` WRITE;
/*!40000 ALTER TABLE `serviceline` DISABLE KEYS */;
INSERT INTO `serviceline` VALUES (1,'LTP',1),(2,'O&M',2),(3,'CT Comp',3),(4,'CT FS',3),(5,'CT FS OE',3),(6,'CT Repair',3),(7,'ST Comp',3),(8,'ST FS',3),(9,'ST FS OE',3),(10,'ST Repair',3),(11,'CT Mods',3),(12,'ST Mods',3),(13,'Geno Comp',3),(14,'Geno FS',3),(15,'Geno FS OE',3),(16,'Geno Repair',3),(17,'Geno Mods',3),(18,'Other',4);
/*!40000 ALTER TABLE `serviceline` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `serviceline_projekt`
--

DROP TABLE IF EXISTS `serviceline_projekt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `serviceline_projekt` (
  `serviceline_id` int(11) NOT NULL,
  `projekt_id` int(11) NOT NULL,
  PRIMARY KEY (`serviceline_id`,`projekt_id`),
  KEY `fk_serviceline_projekt_projekt_idx` (`projekt_id`),
  KEY `fk_serviceline_projekt_serviceline_idx` (`serviceline_id`),
  CONSTRAINT `fk_serviceline_projekt_projekt` FOREIGN KEY (`projekt_id`) REFERENCES `projekt` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_serviceline_projekt_serviceline` FOREIGN KEY (`serviceline_id`) REFERENCES `serviceline` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `serviceline_projekt`
--

LOCK TABLES `serviceline_projekt` WRITE;
/*!40000 ALTER TABLE `serviceline_projekt` DISABLE KEYS */;
INSERT INTO `serviceline_projekt` VALUES (1,6),(1,7),(3,8),(2,9),(1,10),(2,10),(3,10),(18,11),(18,12),(18,13),(18,14);
/*!40000 ALTER TABLE `serviceline_projekt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sprache`
--

DROP TABLE IF EXISTS `sprache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sprache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `iso639_1` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `iso639_1_UNIQUE` (`iso639_1`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sprache`
--

LOCK TABLES `sprache` WRITE;
/*!40000 ALTER TABLE `sprache` DISABLE KEYS */;
INSERT INTO `sprache` VALUES (1,'Deutsch','de'),(2,'English','en');
/*!40000 ALTER TABLE `sprache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'Forecast'),(2,'Actual'),(3,'Budget');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stichtag`
--

DROP TABLE IF EXISTS `stichtag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stichtag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` date NOT NULL,
  `vertragshalter_id` int(11) NOT NULL,
  `subsegment_id` int(11) NOT NULL,
  `benutzer_id` int(11) NOT NULL,
  `zeitstempel` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_stichtag_benutzer_idx` (`benutzer_id`),
  KEY `fk_stichtag_vetragshalter_idx` (`vertragshalter_id`),
  KEY `fk_stichtag_subsegment_idx` (`subsegment_id`),
  CONSTRAINT `fk_stichtag_benutzer` FOREIGN KEY (`benutzer_id`) REFERENCES `benutzer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_stichtag_subsegment` FOREIGN KEY (`subsegment_id`) REFERENCES `subsegment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_stichtag_vertragshalter` FOREIGN KEY (`vertragshalter_id`) REFERENCES `vertragshalter` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stichtag`
--

LOCK TABLES `stichtag` WRITE;
/*!40000 ALTER TABLE `stichtag` DISABLE KEYS */;
INSERT INTO `stichtag` VALUES (1,'2014-10-08',1,1,2,'2014-11-25 22:52:46');
/*!40000 ALTER TABLE `stichtag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subkennzahl`
--

DROP TABLE IF EXISTS `subkennzahl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subkennzahl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `akronym` varchar(255) NOT NULL,
  `kennzahl_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_subkennzahl_kennzahl_idx` (`kennzahl_id`),
  CONSTRAINT `fk_subkennzahl_kennzahl` FOREIGN KEY (`kennzahl_id`) REFERENCES `kennzahl` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subkennzahl`
--

LOCK TABLES `subkennzahl` WRITE;
/*!40000 ALTER TABLE `subkennzahl` DISABLE KEYS */;
INSERT INTO `subkennzahl` VALUES (1,'Order Entry Related Book&Bill','OE related B&B',1),(2,'Order Entry','OE',1),(3,'Backlog Revenue','REV',2),(4,'Book&Bill Revenue','B&B REV',2),(5,'Backlog Grossmargin','GM',3),(6,'Book&Bill Grossmargin','B&B GM',3),(7,'EBIT','EBIT',4),(8,'Free Cash Flow','NETCASH',5),(9,'Selling Expensises','SE',6),(10,'General & Administrative Expensis','G&A',6),(11,'Research Expensis','RE',7),(12,'Development Expensis','DE',7),(13,'Zahlungseingang','CASHIN',8),(14,'Headcount','HC',9),(15,'Provisions on AR','PAR',10),(16,'Commision in SLA','CSLA',10);
/*!40000 ALTER TABLE `subkennzahl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subsegment`
--

DROP TABLE IF EXISTS `subsegment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subsegment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subsegment`
--

LOCK TABLES `subsegment` WRITE;
/*!40000 ALTER TABLE `subsegment` DISABLE KEYS */;
INSERT INTO `subsegment` VALUES (1,'LTP'),(2,'O&M'),(4,'Other'),(3,'Standardgeschäft');
/*!40000 ALTER TABLE `subsegment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `verantwortlicher`
--

DROP TABLE IF EXISTS `verantwortlicher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `verantwortlicher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `verantwortlicher`
--

LOCK TABLES `verantwortlicher` WRITE;
/*!40000 ALTER TABLE `verantwortlicher` DISABLE KEYS */;
INSERT INTO `verantwortlicher` VALUES (1,'Schmitz / Esser'),(2,'Schmitz / Knaup'),(3,'Schmitz'),(4,'Schlagowski / Schlausch'),(5,'Metz'),(6,'Ciftci'),(7,'Strobelt'),(8,'SEI'),(9,'Qureshi'),(10,'Klingemann'),(11,'Bettermann');
/*!40000 ALTER TABLE `verantwortlicher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vertragshalter`
--

DROP TABLE IF EXISTS `vertragshalter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vertragshalter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vertragshalter`
--

LOCK TABLES `vertragshalter` WRITE;
/*!40000 ALTER TABLE `vertragshalter` DISABLE KEYS */;
INSERT INTO `vertragshalter` VALUES (2,'ISCOSA'),(6,'LG Afghanistan'),(9,'LG Ägypten'),(8,'LG Algerien'),(11,'LG Äthiopien'),(7,'LG Bahrain'),(13,'LG Indien'),(14,'LG Irak'),(15,'LG Iran'),(12,'LG Israel'),(27,'LG Jemen'),(16,'LG Jordanien'),(23,'LG Katar'),(17,'LG Kuwait'),(18,'LG Libanon'),(19,'LG Lybien'),(20,'LG Maroko'),(21,'LG Oman'),(22,'LG Pakistan'),(24,'LG Saudi Arabien'),(25,'LG Syrien'),(26,'LG Tunesien'),(10,'LG Westsahara'),(4,'SEI'),(1,'Siemens AG'),(3,'UAE'),(5,'US');
/*!40000 ALTER TABLE `vertragshalter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vertragshalter_land`
--

DROP TABLE IF EXISTS `vertragshalter_land`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vertragshalter_land` (
  `vertragshalter_id` int(11) NOT NULL,
  `land_id` int(11) NOT NULL,
  PRIMARY KEY (`vertragshalter_id`,`land_id`),
  KEY `fk_vertragshalter_land_land_idx` (`land_id`),
  KEY `fk_vertragshalter_land_vertragshalter_idx` (`vertragshalter_id`),
  CONSTRAINT `fk_vertragshalter_land_land` FOREIGN KEY (`land_id`) REFERENCES `land` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_vertragshalter_land_vertragshalter` FOREIGN KEY (`vertragshalter_id`) REFERENCES `vertragshalter` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vertragshalter_land`
--

LOCK TABLES `vertragshalter_land` WRITE;
/*!40000 ALTER TABLE `vertragshalter_land` DISABLE KEYS */;
INSERT INTO `vertragshalter_land` VALUES (1,1),(1,2),(2,2),(3,2),(1,3),(6,3),(1,4),(2,4),(3,4),(7,4),(1,5),(8,5),(1,6),(3,6),(9,6),(1,7),(11,7),(1,8),(10,8),(1,9),(12,9),(1,10),(13,10),(1,11),(3,11),(4,11),(14,11),(1,12),(15,12),(1,13),(16,13),(1,14),(3,14),(17,14),(1,15),(18,15),(1,16),(19,16),(1,17),(20,17),(1,18),(3,18),(21,18),(1,19),(3,19),(22,19),(1,20),(3,20),(23,20),(1,21),(2,21),(3,21),(5,21),(24,21),(1,22),(25,22),(1,23),(26,23),(1,24),(27,24);
/*!40000 ALTER TABLE `vertragshalter_land` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vertragshalter_projekt`
--

DROP TABLE IF EXISTS `vertragshalter_projekt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vertragshalter_projekt` (
  `vertragshalter_id` int(11) NOT NULL,
  `projekt_id` int(11) NOT NULL,
  PRIMARY KEY (`vertragshalter_id`,`projekt_id`),
  KEY `fk_vertragshalter_projekt_projekt_idx` (`projekt_id`),
  KEY `fk_vertragshalter_projekt_vertragshalter_idx` (`vertragshalter_id`),
  CONSTRAINT `fk_vertragshalter_projekt_projekt` FOREIGN KEY (`projekt_id`) REFERENCES `projekt` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_vertragshalter_projekt_vertragshalter` FOREIGN KEY (`vertragshalter_id`) REFERENCES `vertragshalter` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vertragshalter_projekt`
--

LOCK TABLES `vertragshalter_projekt` WRITE;
/*!40000 ALTER TABLE `vertragshalter_projekt` DISABLE KEYS */;
INSERT INTO `vertragshalter_projekt` VALUES (1,6),(9,6),(1,7),(9,7),(1,8),(1,9),(21,9),(1,10),(1,11),(2,11),(3,11),(4,11),(5,11),(6,11),(7,11),(8,11),(9,11),(10,11),(11,11),(12,11),(13,11),(14,11),(15,11),(16,11),(17,11),(18,11),(19,11),(20,11),(21,11),(22,11),(23,11),(24,11),(25,11),(26,11),(27,11),(1,12),(2,12),(3,12),(4,12),(5,12),(6,12),(7,12),(8,12),(9,12),(10,12),(11,12),(12,12),(13,12),(14,12),(15,12),(16,12),(17,12),(18,12),(19,12),(20,12),(21,12),(22,12),(23,12),(24,12),(25,12),(26,12),(27,12),(1,13),(2,13),(3,13),(4,13),(5,13),(6,13),(7,13),(8,13),(9,13),(10,13),(11,13),(12,13),(13,13),(14,13),(15,13),(16,13),(17,13),(18,13),(19,13),(20,13),(21,13),(22,13),(23,13),(24,13),(25,13),(26,13),(27,13),(1,14),(2,14),(3,14),(4,14),(5,14),(6,14),(7,14),(8,14),(9,14),(10,14),(11,14),(12,14),(13,14),(14,14),(15,14),(16,14),(17,14),(18,14),(19,14),(20,14),(21,14),(22,14),(23,14),(24,14),(25,14),(26,14),(27,14);
/*!40000 ALTER TABLE `vertragshalter_projekt` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-12 23:00:20
