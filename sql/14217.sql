/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.9-MariaDB : Database - qmdb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`qmdb` /*!40100 DEFAULT CHARACTER SET utf8 */;

/*Table structure for table `numbertype` */

DROP TABLE IF EXISTS `numbertype`;

CREATE TABLE `numbertype` (
  `NumberTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`NumberTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `numbertype` */

/*Table structure for table `variable` */

DROP TABLE IF EXISTS `variable`;

CREATE TABLE `variable` (
  `VariableID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  `Description` varchar(120) DEFAULT NULL,
  `Type` int(11) DEFAULT NULL,
  PRIMARY KEY (`VariableID`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

/*Data for the table `variable` */

insert  into `variable`(`VariableID`,`Name`,`Description`,`Type`) values (1,'id','Sub Run Unique Indentification Number',0),(2,'File_name','The Sub Run related file name (full path)',0),(3,'Run_number','The Sub Run corresponding Sub Run Number',0),(4,'SubRun_number','The Sub Run Corresponding Run Number',0),(5,'TimeSliceIDStart','The Sub Run Time Slice Start ID number',0),(6,'TimeSliceIDEnd','The Sub Run Time Slice End ID number',0),(7,'GPSTimeStart_sec','The Sub Run GPS Time Start (seconds)',0),(8,'GPSTimeStart_nanosec','The Sub Run GPS Time Start (nano seconds)',0),(9,'GPSTimeEnd_sec','The Sub Run GPS Time End (seconds)',0),(10,'GPSTimeEnd_nanosec','The Sub Run GPS Time End (nano seconds)',0),(11,'UTCTimeStart_datetime','The Sub Run UTC Time Start (utc date + utc time)',0),(12,'UTCTimeEnd_datetime','The Sub Run UTC Time End (utc date + utc time)',0),(13,'SiderealTimeStart','The Sub Run Sideral Time Start',0),(14,'SiderealTimeEnd','The Sub Run Sideral Time End',0),(15,'EventCount','The Sub Run Number of events',0),(16,'Duration','The Sub Run Duration',0),(17,'EventRate','The Sub Run Event Rate',0),(18,'MaxPMTs','The Sub Run Max. Number of PMT\'s',0),(19,'MaxTanks','The Sub Run Max. Number of Tanks',0),(20,'LivePMTs','The Sub Run Live PMT\'s',0),(21,'median_zenith','The Sub Run Zenith median',0),(22,'mean_zenith','The Sub Run Zenith mean',0),(23,'RMS_zenith','The Sub Run Zenith RMS',0),(24,'median_logMaxPE','The Sub Run log Max PE median',0),(25,'mean_logMaxPE','The Sub Run log Max PE mean',0),(26,'RMS_logMaxPE','The Sub Run log Max PE RMS',0),(27,'median_logNPE','The Sub Run log N PE median',0),(28,'mean_logNPE','The Sub Run log N PE mean',0),(29,'RMS_logNPE','The Sub Run log N PE RMS',0),(30,'median_coreX','The Sub Run Core X median',0),(31,'RMS_coreX','The Sub Run Core X RMS',0),(32,'median_coreY','The Sub Run Core Y median',0),(33,'RMS_coreY','The Sub Run Core Y RMS',0),(34,'median_coreFitChi2Ndof','The Sub Run Core X Fit (2=NdOf) median',0),(35,'median_angleFitChi2Ndof','The Sub Run Angle Fit (2=NdOf) median',0),(36,'median_nHit_CxPE30','The Sub Run nHit=CxPE30 median',0),(37,'median_nHit_CxPE40','The Sub Run nHit=CxPE40 median',0),(38,'median_nHit_CxPE50','The Sub Run nHit=CxPE50 median',0),(39,'median_delta_T_PMT_CxPE30','null',0),(40,'RMS_delta_T_PMT_CxPE30','null',0),(41,'median_delta_T_CxPE40','null',0),(42,'RMS_delta_T_CxPE40','null',0),(43,'median_delta_T_CxPE50','null',0),(44,'RMS_delta_T_CxPE50','null',0),(45,'median_nHit_nChAvail','null',0),(46,'median_nChAvail_nChTot','null',0),(47,'minimal_nChAvail_nChTot','null',0),(48,'nChThres','null',0),(49,'evtOK','The Sub Run SubRunevtOk=Subrunevents ratio',0),(50,'evtBad','The Sub Run SubRunevtBad=Subrunevents ratio',0),(51,'GTC','null',0),(52,'noGTC','null',0),(53,'GTCerr','null',0),(54,'tMin','null',0),(55,'tMax','null',0),(56,'dTMin','null',0),(57,'dTMax','null',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
