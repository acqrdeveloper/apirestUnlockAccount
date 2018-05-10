/*
SQLyog Ultimate v12.4.0 (64 bit)
MySQL - 10.1.19-MariaDB : Database - db_unlock_reset_ad
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_unlock_reset_ad` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `db_unlock_reset_ad`;

/*Table structure for table `config` */

DROP TABLE IF EXISTS `config`;

CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL,
  `interval` varchar(100) DEFAULT NULL,
  `caller_id` varchar(100) DEFAULT NULL,
  `extention` varchar(100) DEFAULT NULL,
  `schedule` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `config_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `config` */

insert  into `config`(`id`,`project_id`,`action`,`interval`,`caller_id`,`extention`,`schedule`) values 
(1,1,'unlock_ad','\'NOW() - INTERVAL 2 HOUR\'','2192323','5555','24'),
(2,1,'reset_ad','\'NOW() - INTERVAL 2 HOUR\'','2192323','7777','10'),
(3,2,'unlock_ad','\'NOW() - INTERVAL 2 HOUR\'','7453434','423','3'),
(4,2,'reset_ad','\'NOW() - INTERVAL 2 HOUR\'','2192323','7777','10');

/*Table structure for table `projects` */

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `projects` */

insert  into `projects`(`id`,`name`) values 
(1,'Interbank'),
(2,'Entel'),
(3,'Sura'),
(4,'Engie'),
(5,'Claro');

/*Table structure for table `reset_ad` */

DROP TABLE IF EXISTS `reset_ad`;

CREATE TABLE `reset_ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `attempt` int(11) DEFAULT '1',
  `description` text,
  `message` text,
  `ip` varchar(100) DEFAULT NULL,
  `name_provider` varchar(100) DEFAULT NULL,
  `code_security` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `reset_ad_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `reset_ad` */

/*Table structure for table `search_ad` */

DROP TABLE IF EXISTS `search_ad`;

CREATE TABLE `search_ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `description` text,
  `message` text,
  `ip` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `search_ad_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `search_ad` */

/*Table structure for table `unlock_ad` */

DROP TABLE IF EXISTS `unlock_ad`;

CREATE TABLE `unlock_ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `attempt` int(11) DEFAULT '1',
  `description` text,
  `message` text,
  `ip` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `unlock_ad_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `unlock_ad` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `age` char(3) DEFAULT NULL,
  `from` varchar(100) DEFAULT NULL,
  `dni` char(8) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `last_session` datetime DEFAULT CURRENT_TIMESTAMP,
  `time_locked` time DEFAULT '00:00:00',
  `quantity_locked` int(11) DEFAULT '0',
  `phone_number` varchar(25) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`username`,`email`,`password`,`age`,`from`,`dni`,`area`,`last_session`,`time_locked`,`quantity_locked`,`phone_number`,`status`,`created_at`,`updated_at`) values 
(1,'Alex Christian','master','master.developer@gmail.com','master','24','ate','98923847','mesa de ayuda','2018-03-31 16:30:38','00:00:00',0,'908978743',1,'2018-03-31 16:30:38','2018-05-09 22:19:26');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
