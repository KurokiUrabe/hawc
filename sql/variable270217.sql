/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.13-MariaDB : Database - qmdb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`qmdb` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `qmdb`;

/*Table structure for table `variable` */

DROP TABLE IF EXISTS `variable`;

CREATE TABLE `variable` (
  `VariableID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  `Description` varchar(120) DEFAULT NULL,
  `Type` int(11) DEFAULT NULL,
  `MinRange` float DEFAULT NULL,
  `MaxRange` float DEFAULT NULL,
  PRIMARY KEY (`VariableID`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

/*Data for the table `variable` */

insert  into `variable`(`VariableID`,`Name`,`Description`,`Type`,`MinRange`,`MaxRange`) values (1,'id','Sub Run Unique Indentification Number',0,NULL,NULL),(2,'File_name','The Sub Run related file name (full path)',0,NULL,NULL),(3,'Run_number','The Sub Run corresponding Sub Run Number',0,NULL,NULL),(4,'SubRun_number','The Sub Run Corresponding Run Number',0,NULL,NULL),(5,'TimeSliceIDStart','The Sub Run Time Slice Start ID number',0,NULL,NULL),(6,'TimeSliceIDEnd','The Sub Run Time Slice End ID number',0,NULL,NULL),(7,'GPSTimeStart_sec','The Sub Run GPS Time Start (seconds)',0,NULL,NULL),(8,'GPSTimeStart_nanosec','The Sub Run GPS Time Start (nano seconds)',0,NULL,NULL),(9,'GPSTimeEnd_sec','The Sub Run GPS Time End (seconds)',0,NULL,NULL),(10,'GPSTimeEnd_nanosec','The Sub Run GPS Time End (nano seconds)',0,NULL,NULL),(11,'UTCTimeStart_datetime','The Sub Run UTC Time Start (utc date + utc time)',0,NULL,NULL),(12,'UTCTimeEnd_datetime','The Sub Run UTC Time End (utc date + utc time)',0,NULL,NULL),(13,'SiderealTimeStart','The Sub Run Sideral Time Start',0,NULL,NULL),(14,'SiderealTimeEnd','The Sub Run Sideral Time End',0,NULL,NULL),(15,'EventCount','The Sub Run Number of events',0,NULL,NULL),(16,'Duration','The Sub Run Duration',0,NULL,NULL),(17,'EventRate','The Sub Run Event Rate',0,NULL,NULL),(18,'MaxPMTs','The Sub Run Max. Number of PMT\'s',0,NULL,NULL),(19,'MaxTanks','The Sub Run Max. Number of Tanks',0,NULL,NULL),(20,'LivePMTs','The Sub Run Live PMT\'s',0,NULL,NULL),(21,'median_zenith','The Sub Run Zenith median',0,NULL,NULL),(22,'mean_zenith','The Sub Run Zenith mean',0,NULL,NULL),(23,'RMS_zenith','The Sub Run Zenith RMS',0,NULL,NULL),(24,'median_logMaxPE','The Sub Run log Max PE median',0,NULL,NULL),(25,'mean_logMaxPE','The Sub Run log Max PE mean',0,NULL,NULL),(26,'RMS_logMaxPE','The Sub Run log Max PE RMS',0,NULL,NULL),(27,'median_logNPE','The Sub Run log N PE median',0,NULL,NULL),(28,'mean_logNPE','The Sub Run log N PE mean',0,NULL,NULL),(29,'RMS_logNPE','The Sub Run log N PE RMS',0,NULL,NULL),(30,'median_coreX','The Sub Run Core X median',0,NULL,NULL),(31,'RMS_coreX','The Sub Run Core X RMS',0,NULL,NULL),(32,'median_coreY','The Sub Run Core Y median',0,NULL,NULL),(33,'RMS_coreY','The Sub Run Core Y RMS',0,NULL,NULL),(34,'median_coreFitChi2Ndof','The Sub Run Core X Fit (2=NdOf) median',0,NULL,NULL),(35,'median_angleFitChi2Ndof','The Sub Run Angle Fit (2=NdOf) median',0,NULL,NULL),(36,'median_nHit_CxPE30','The Sub Run nHit=CxPE30 median',0,NULL,NULL),(37,'median_nHit_CxPE40','The Sub Run nHit=CxPE40 median',0,NULL,NULL),(38,'median_nHit_CxPE50','The Sub Run nHit=CxPE50 median',0,NULL,NULL),(39,'median_delta_T_PMT_CxPE30','null',0,NULL,NULL),(40,'RMS_delta_T_PMT_CxPE30','null',0,NULL,NULL),(41,'median_delta_T_CxPE40','null',0,NULL,NULL),(42,'RMS_delta_T_CxPE40','null',0,NULL,NULL),(43,'median_delta_T_CxPE50','null',0,NULL,NULL),(44,'RMS_delta_T_CxPE50','null',0,NULL,NULL),(45,'median_nHit_nChAvail','null',0,NULL,NULL),(46,'median_nChAvail_nChTot','null',0,NULL,NULL),(47,'minimal_nChAvail_nChTot','null',0,NULL,NULL),(48,'nChThres','null',0,NULL,NULL),(49,'evtOK','The Sub Run SubRunevtOk=Subrunevents ratio',0,NULL,NULL),(50,'evtBad','The Sub Run SubRunevtBad=Subrunevents ratio',0,NULL,NULL),(51,'GTC','null',0,NULL,NULL),(52,'noGTC','null',0,NULL,NULL),(53,'GTCerr','null',0,NULL,NULL),(54,'tMin','null',0,NULL,NULL),(55,'tMax','null',0,NULL,NULL),(56,'dTMin','null',0,NULL,NULL),(57,'dTMax','null',0,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
