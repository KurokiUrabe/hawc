-- MySQL dump 10.13  Distrib 5.5.55, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: QMDB
-- ------------------------------------------------------
-- Server version	5.5.55-0+deb8u1

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
-- Table structure for table `variable`
--

DROP TABLE IF EXISTS `variable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `variable` (
  `VariableID` int(11) NOT NULL AUTO_INCREMENT,
  `VariableName` varchar(45) DEFAULT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Description` varchar(120) DEFAULT NULL,
  `Step` float DEFAULT NULL,
  `Type` int(11) DEFAULT NULL,
  `MinRange` float DEFAULT NULL,
  `MaxRange` float DEFAULT NULL,
  PRIMARY KEY (`VariableID`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variable`
--

LOCK TABLES `variable` WRITE;
/*!40000 ALTER TABLE `variable` DISABLE KEYS */;
INSERT INTO `variable` VALUES (1,'id','Sun','Sub Run Unique Indentification Number',2,0,0,11111100000),(2,'File_name',NULL,'The Sub Run related file name (full path)',NULL,0,NULL,NULL),(3,'Run_number','','The Sub Run corresponding Sub Run Number',NULL,0,1,0),(4,'SubRun_number','','The Sub Run Corresponding Run Number',NULL,0,1,0),(5,'TimeSliceIDStart','','The Sub Run Time Slice Start ID number',NULL,0,1,0),(6,'TimeSliceIDEnd','','The Sub Run Time Slice End ID number',NULL,0,1,0),(7,'GPSTimeStart_sec','','The Sub Run GPS Time Start (seconds)',1,0,1,1000000000),(8,'GPSTimeStart_nanosec','','The Sub Run GPS Time Start (nano seconds)',1,0,0,1000000000),(9,'GPSTimeEnd_sec','','The Sub Run GPS Time End (seconds)',1,0,0,1000000000),(10,'GPSTimeEnd_nanosec','','The Sub Run GPS Time End (nano seconds)',1,0,0,1000000000),(11,'UTCTimeStart_datetime','','The Sub Run UTC Time Start (utc date + utc time)',1,1,1325450000,4113660000),(12,'UTCTimeEnd_datetime','','The Sub Run UTC Time End (utc date + utc time)',1,1,1494440000,1494440000),(13,'SiderealTimeStart','','The Sub Run Sideral Time Start',NULL,0,1,0),(14,'SiderealTimeEnd','','The Sub Run Sideral Time End',NULL,0,1,0),(15,'EventCount','','The Sub Run Number of events',NULL,0,1,0),(16,'Duration','','The Sub Run Duration',NULL,0,1,0),(17,'EventRate','','The Sub Run Event Rate',NULL,0,1,0),(18,'MaxPMTs','','The Sub Run Max. Number of PMT\'s',NULL,0,1,0),(19,'MaxTanks','','The Sub Run Max. Number of Tanks',NULL,0,1,0),(20,'LivePMTs','','The Sub Run Live PMT\'s',NULL,0,1,0),(21,'median_zenith',NULL,'The Sub Run Zenith median',NULL,0,NULL,NULL),(22,'mean_zenith',NULL,'The Sub Run Zenith mean',NULL,0,NULL,NULL),(23,'RMS_zenith',NULL,'The Sub Run Zenith RMS',NULL,0,NULL,NULL),(24,'median_logMaxPE',NULL,'The Sub Run log Max PE median',NULL,0,NULL,NULL),(25,'mean_logMaxPE',NULL,'The Sub Run log Max PE mean',NULL,0,NULL,NULL),(26,'RMS_logMaxPE',NULL,'The Sub Run log Max PE RMS',NULL,0,NULL,NULL),(27,'median_logNPE',NULL,'The Sub Run log N PE median',NULL,0,NULL,NULL),(28,'mean_logNPE',NULL,'The Sub Run log N PE mean',NULL,0,NULL,NULL),(29,'RMS_logNPE',NULL,'The Sub Run log N PE RMS',NULL,0,NULL,NULL),(30,'median_coreX','','The Sub Run Core X median',0.001,0,0,0),(31,'RMS_coreX','','The Sub Run Core X RMS',1,0,-10000,10000),(32,'median_coreY',NULL,'The Sub Run Core Y median',NULL,0,NULL,NULL),(33,'RMS_coreY',NULL,'The Sub Run Core Y RMS',NULL,0,NULL,NULL),(34,'median_coreFitChi2Ndof',NULL,'The Sub Run Core X Fit (2=NdOf) median',NULL,0,NULL,NULL),(35,'median_angleFitChi2Ndof',NULL,'The Sub Run Angle Fit (2=NdOf) median',NULL,0,NULL,NULL),(36,'median_nHit_CxPE30',NULL,'The Sub Run nHit=CxPE30 median',NULL,0,NULL,NULL),(37,'median_nHit_CxPE40',NULL,'The Sub Run nHit=CxPE40 median',NULL,0,NULL,NULL),(38,'median_nHit_CxPE50',NULL,'The Sub Run nHit=CxPE50 median',NULL,0,NULL,NULL),(39,'median_delta_T_PMT_CxPE30',NULL,'null',NULL,0,NULL,NULL),(40,'RMS_delta_T_PMT_CxPE30',NULL,'null',NULL,0,NULL,NULL),(41,'median_delta_T_CxPE40',NULL,'null',NULL,0,NULL,NULL),(42,'RMS_delta_T_CxPE40',NULL,'null',NULL,0,NULL,NULL),(43,'median_delta_T_CxPE50',NULL,'null',NULL,0,NULL,NULL),(44,'RMS_delta_T_CxPE50',NULL,'null',NULL,0,NULL,NULL),(45,'median_nHit_nChAvail',NULL,'null',NULL,0,NULL,NULL),(46,'median_nChAvail_nChTot',NULL,'null',NULL,0,NULL,NULL),(47,'minimal_nChAvail_nChTot',NULL,'null',NULL,0,NULL,NULL),(48,'nChThres',NULL,'null',NULL,0,NULL,NULL),(49,'evtOK',NULL,'The Sub Run SubRunevtOk=Subrunevents ratio',NULL,0,NULL,NULL),(50,'evtBad',NULL,'The Sub Run SubRunevtBad=Subrunevents ratio',NULL,0,NULL,NULL),(51,'GTC','','',NULL,0,0,0),(52,'noGTC',NULL,'null',NULL,0,NULL,NULL),(53,'GTCerr',NULL,'null',NULL,0,NULL,NULL),(54,'tMin',NULL,'null',NULL,0,NULL,NULL),(55,'tMax',NULL,'null',NULL,0,NULL,NULL),(56,'dTMin',NULL,'null',NULL,0,NULL,NULL),(57,'dTMax',NULL,'null',NULL,0,NULL,NULL);
/*!40000 ALTER TABLE `variable` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-26 22:41:51
