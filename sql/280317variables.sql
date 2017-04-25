/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.13-MariaDB : Database - QMDB
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`QMDB` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `QMDB`;

/*Table structure for table `variable` */

DROP TABLE IF EXISTS `variable`;

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

/*Data for the table `variable` */

insert  into `variable`(`VariableID`,`VariableName`,`Name`,`Description`,`Step`,`Type`,`MinRange`,`MaxRange`) values (1,'id','Sun','Sub Run Unique Indentification Number',2,0,0,11111100000),(2,'File_name',NULL,'The Sub Run related file name (full path)',NULL,0,NULL,NULL),(3,'Run_number','','The Sub Run corresponding Sub Run Number',NULL,0,1,0),(4,'SubRun_number','','The Sub Run Corresponding Run Number',NULL,0,1,0),(5,'TimeSliceIDStart','','The Sub Run Time Slice Start ID number',NULL,0,1,0),(6,'TimeSliceIDEnd','','The Sub Run Time Slice End ID number',NULL,0,1,0),(7,'GPSTimeStart_sec','','The Sub Run GPS Time Start (seconds)',0,1,1,0),(8,'GPSTimeStart_nanosec','','The Sub Run GPS Time Start (nano seconds)',0,1,1,0),(9,'GPSTimeEnd_sec','','The Sub Run GPS Time End (seconds)',0,1,1485470000,0),(10,'GPSTimeEnd_nanosec','','The Sub Run GPS Time End (nano seconds)',0,1,0,0),(11,'UTCTimeStart_datetime',NULL,'The Sub Run UTC Time Start (utc date + utc time)',NULL,0,NULL,NULL),(12,'UTCTimeEnd_datetime',NULL,'The Sub Run UTC Time End (utc date + utc time)',NULL,0,NULL,NULL),(13,'SiderealTimeStart','','The Sub Run Sideral Time Start',NULL,0,1,0),(14,'SiderealTimeEnd','','The Sub Run Sideral Time End',NULL,0,1,0),(15,'EventCount','','The Sub Run Number of events',NULL,0,1,0),(16,'Duration','','The Sub Run Duration',NULL,0,1,0),(17,'EventRate','','The Sub Run Event Rate',NULL,0,1,0),(18,'MaxPMTs','','The Sub Run Max. Number of PMT\'s',NULL,0,1,0),(19,'MaxTanks','','The Sub Run Max. Number of Tanks',NULL,0,1,0),(20,'LivePMTs','','The Sub Run Live PMT\'s',NULL,0,1,0),(21,'median_zenith',NULL,'The Sub Run Zenith median',NULL,0,NULL,NULL),(22,'mean_zenith',NULL,'The Sub Run Zenith mean',NULL,0,NULL,NULL),(23,'RMS_zenith',NULL,'The Sub Run Zenith RMS',NULL,0,NULL,NULL),(24,'median_logMaxPE',NULL,'The Sub Run log Max PE median',NULL,0,NULL,NULL),(25,'mean_logMaxPE',NULL,'The Sub Run log Max PE mean',NULL,0,NULL,NULL),(26,'RMS_logMaxPE',NULL,'The Sub Run log Max PE RMS',NULL,0,NULL,NULL),(27,'median_logNPE',NULL,'The Sub Run log N PE median',NULL,0,NULL,NULL),(28,'mean_logNPE',NULL,'The Sub Run log N PE mean',NULL,0,NULL,NULL),(29,'RMS_logNPE',NULL,'The Sub Run log N PE RMS',NULL,0,NULL,NULL),(30,'median_coreX',NULL,'The Sub Run Core X median',NULL,0,NULL,NULL),(31,'RMS_coreX',NULL,'The Sub Run Core X RMS',NULL,0,NULL,NULL),(32,'median_coreY',NULL,'The Sub Run Core Y median',NULL,0,NULL,NULL),(33,'RMS_coreY',NULL,'The Sub Run Core Y RMS',NULL,0,NULL,NULL),(34,'median_coreFitChi2Ndof',NULL,'The Sub Run Core X Fit (2=NdOf) median',NULL,0,NULL,NULL),(35,'median_angleFitChi2Ndof',NULL,'The Sub Run Angle Fit (2=NdOf) median',NULL,0,NULL,NULL),(36,'median_nHit_CxPE30',NULL,'The Sub Run nHit=CxPE30 median',NULL,0,NULL,NULL),(37,'median_nHit_CxPE40',NULL,'The Sub Run nHit=CxPE40 median',NULL,0,NULL,NULL),(38,'median_nHit_CxPE50',NULL,'The Sub Run nHit=CxPE50 median',NULL,0,NULL,NULL),(39,'median_delta_T_PMT_CxPE30',NULL,'null',NULL,0,NULL,NULL),(40,'RMS_delta_T_PMT_CxPE30',NULL,'null',NULL,0,NULL,NULL),(41,'median_delta_T_CxPE40',NULL,'null',NULL,0,NULL,NULL),(42,'RMS_delta_T_CxPE40',NULL,'null',NULL,0,NULL,NULL),(43,'median_delta_T_CxPE50',NULL,'null',NULL,0,NULL,NULL),(44,'RMS_delta_T_CxPE50',NULL,'null',NULL,0,NULL,NULL),(45,'median_nHit_nChAvail',NULL,'null',NULL,0,NULL,NULL),(46,'median_nChAvail_nChTot',NULL,'null',NULL,0,NULL,NULL),(47,'minimal_nChAvail_nChTot',NULL,'null',NULL,0,NULL,NULL),(48,'nChThres',NULL,'null',NULL,0,NULL,NULL),(49,'evtOK',NULL,'The Sub Run SubRunevtOk=Subrunevents ratio',NULL,0,NULL,NULL),(50,'evtBad',NULL,'The Sub Run SubRunevtBad=Subrunevents ratio',NULL,0,NULL,NULL),(51,'GTC','','',NULL,0,0,0),(52,'noGTC',NULL,'null',NULL,0,NULL,NULL),(53,'GTCerr',NULL,'null',NULL,0,NULL,NULL),(54,'tMin',NULL,'null',NULL,0,NULL,NULL),(55,'tMax',NULL,'null',NULL,0,NULL,NULL),(56,'dTMin',NULL,'null',NULL,0,NULL,NULL),(57,'dTMax',NULL,'null',NULL,0,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
