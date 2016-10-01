-- MySQL dump 10.13  Distrib 5.6.30, for Linux (x86_64)
--
-- Host: localhost    Database: u4837p3054_stora
-- ------------------------------------------------------
-- Server version	5.6.30-cll-lve

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
-- Table structure for table `storage_performance`
--

DROP TABLE IF EXISTS `storage_performance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `storage_performance` (
  `metric_mid` int(11) NOT NULL AUTO_INCREMENT,
  `metric_mbsec` int(11) NOT NULL,
  `metric_iops` int(11) NOT NULL,
  `metric_sizeiokbytes` int(11) NOT NULL,
  `metric_latencyms` int(11) NOT NULL,
  `metric_outstandingios` int(11) NOT NULL,
  `metric_type` varchar(32) NOT NULL,
  `metric_target` varchar(128) NOT NULL,
  `metric_scenario` varchar(128) NOT NULL,
  `metric_testname` varchar(64) NOT NULL,
  `metric_unixdate` int(11) NOT NULL,
  `metric_sysid_fk` int(11) NOT NULL,
  PRIMARY KEY (`metric_mid`,`metric_sysid_fk`)
) ENGINE=InnoDB AUTO_INCREMENT=40286 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `storage_system`
--

DROP TABLE IF EXISTS `storage_system`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `storage_system` (
  `system_sysid` int(11) NOT NULL AUTO_INCREMENT,
  `system_name` varchar(254) NOT NULL,
  `system_os` varchar(32) NOT NULL,
  `system_api_key` varchar(32) NOT NULL,
  `system_private` tinyint(1) NOT NULL DEFAULT '0',
  `system_email` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`system_sysid`),
  KEY `system_name` (`system_name`,`system_os`),
  KEY `system_api_key` (`system_api_key`),
  KEY `system_email` (`system_email`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

