/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.1.32-MariaDB : Database - zeerius_laravel
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`chocopeg_zeerius` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `chocopeg_zeerius`;

/*Table structure for table `albums` */

DROP TABLE IF EXISTS `albums`;

CREATE TABLE `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `artist` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `artworkPath` varchar(500) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `albums` */

insert  into `albums`(`id`,`title`,`artist`,`genre`,`artworkPath`,`updated_at`,`created_at`) values (2,'Pizza head',5,10,'uploads/album_photo/energy.jpg','2019-09-21 23:24:12','0000-00-00 00:00:00'),(11,'Going Higher',0,0,'uploads/album_photo/goinghigher.jpg','2019-09-22 08:16:05','2019-09-22 08:08:16'),(12,'Pop Dance',0,0,'uploads/album_photo/popdance.jpg','2019-09-22 08:21:25','2019-09-22 08:21:25');

/*Table structure for table `artist` */

DROP TABLE IF EXISTS `artist`;

CREATE TABLE `artist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `artist` */

insert  into `artist`(`id`,`name`,`updated_at`,`created_at`) values (1,'Mickey Mouse','2019-09-15 00:10:32','0000-00-00 00:00:00'),(2,'Goofy','2019-09-14 17:06:45','0000-00-00 00:00:00'),(3,'Bart Simpson','2019-09-14 17:06:45','0000-00-00 00:00:00'),(4,'Homer','2019-09-14 17:06:45','0000-00-00 00:00:00'),(5,'Bruce Lee','2019-09-14 17:06:45','0000-00-00 00:00:00'),(6,'Chanox','2019-09-14 17:06:45','0000-00-00 00:00:00'),(7,'DJKhaled','2019-09-14 17:06:45','0000-00-00 00:00:00'),(8,'Bruno Mars','2019-09-14 17:06:45','0000-00-00 00:00:00'),(9,'Kendrick Lamar','2019-09-14 17:06:45','0000-00-00 00:00:00'),(10,'Lil UziVert','2019-09-14 17:06:45','0000-00-00 00:00:00'),(11,'Migos feat Gucci Mane','2019-09-14 17:06:45','0000-00-00 00:00:00'),(12,'Playboi Carti','2019-09-14 17:06:45','0000-00-00 00:00:00'),(13,'Post Malone feat Quavo','2019-09-14 17:06:45','0000-00-00 00:00:00'),(14,'Savage','2019-09-14 17:06:45','0000-00-00 00:00:00'),(15,'YFNLucci','2019-09-14 17:06:45','0000-00-00 00:00:00'),(16,'YoGotti feat Nicki Minaj','2019-09-14 17:06:45','0000-00-00 00:00:00'),(17,'Kapatid','2019-09-14 17:06:45','0000-00-00 00:00:00'),(18,'Bensound','2019-09-23 19:15:24','2019-09-23 19:15:24');

/*Table structure for table `genres` */

DROP TABLE IF EXISTS `genres`;

CREATE TABLE `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `genres` */

insert  into `genres`(`id`,`name`,`updated_at`,`created_at`) values (1,'Rock','2019-09-15 00:35:33','0000-00-00 00:00:00'),(2,'Pop','2019-09-14 17:35:24','0000-00-00 00:00:00'),(3,'Hip-hop','2019-09-14 17:35:24','0000-00-00 00:00:00'),(4,'Rap','2019-09-14 17:35:24','0000-00-00 00:00:00'),(5,'R & B','2019-09-14 17:35:24','0000-00-00 00:00:00'),(6,'Classical','2019-09-14 17:35:24','0000-00-00 00:00:00'),(7,'Techno','2019-09-14 17:35:24','0000-00-00 00:00:00'),(8,'jazz','2019-09-14 17:35:24','0000-00-00 00:00:00'),(9,'Folk','2019-09-14 17:35:24','0000-00-00 00:00:00'),(10,'Country','2019-09-14 17:35:24','0000-00-00 00:00:00');

/*Table structure for table `groups` */

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `groups` */

insert  into `groups`(`id`,`name`,`permissions`,`created_at`,`updated_at`) values (1,'System Administrator','{\r\n	\"admin.index\": 1,\r\n	\"admin.artist.lists\": 1,\r\n	\"admin.album.lists\": 1,\r\n	\"admin.genre.lists\": 1,\r\n	\"admin.songs.lists\": 1,\r\n	\"admin.system_user.index\": 1,\r\n	\"admin.system_user.add\": 1,\r\n	\"admin.system_user.edit\": 1,\r\n	\"admin.system_user.delete\": 1,\r\n	\"admin.system_user.submit\": 1\r\n}','2015-03-05 14:09:33','2015-03-05 14:09:33'),(2,'System Editor','{\"admin.index\":1}','2015-03-05 14:09:33','2015-03-05 14:09:33'),(3,'Public User','{}','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`migration`,`batch`) values ('2012_12_06_225921_migration_cartalyst_sentry_install_users',1),('2012_12_06_225929_migration_cartalyst_sentry_install_groups',1),('2012_12_06_225945_migration_cartalyst_sentry_install_users_groups_pivot',1),('2012_12_06_225988_migration_cartalyst_sentry_install_throttle',1);

/*Table structure for table `options` */

DROP TABLE IF EXISTS `options`;

CREATE TABLE `options` (
  `type` varchar(100) NOT NULL DEFAULT '',
  `value` varchar(100) NOT NULL DEFAULT '',
  `text` varchar(100) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `options` */

insert  into `options`(`type`,`value`,`text`,`created_at`,`updated_at`) values ('lesson_status','AP','Approved','2014-11-04 01:41:36','0000-00-00 00:00:00'),('lesson_status','PE','Pending','2014-11-04 01:41:36','0000-00-00 00:00:00'),('lesson_status','DA','For Evaluation','2015-02-20 08:23:16','0000-00-00 00:00:00'),('community_type','1','RURAL','2014-11-09 02:08:09','0000-00-00 00:00:00'),('community_type','2','URBAN','2014-11-09 02:08:09','0000-00-00 00:00:00'),('community_type','3','RURBAN','2014-11-09 02:08:09','0000-00-00 00:00:00'),('grade_level','1','Kinder','2014-11-09 02:08:09','0000-00-00 00:00:00'),('grade_level','2','Grade 1','2014-11-09 02:08:09','0000-00-00 00:00:00'),('grade_level','3','Grade 2','2014-11-09 02:08:09','0000-00-00 00:00:00'),('grade_level','4','Grade 3','2014-11-09 02:08:09','0000-00-00 00:00:00'),('grade_level','5','Grade 4','2014-11-09 02:08:09','0000-00-00 00:00:00'),('grade_level','6','Grade 5','2014-11-09 02:08:09','0000-00-00 00:00:00'),('grade_level','7','Grade 6','2014-11-09 02:08:09','0000-00-00 00:00:00'),('grade_level','8','Grade 7','2014-11-09 02:08:09','0000-00-00 00:00:00'),('grade_level','9','Grade 8','2014-11-09 02:08:09','0000-00-00 00:00:00'),('grade_level','10','Grade 9','2014-11-09 02:08:09','0000-00-00 00:00:00'),('grade_level','11','Grade 10','2014-11-09 02:08:09','0000-00-00 00:00:00'),('grade_level','12','Grade 11','2014-11-09 02:08:09','0000-00-00 00:00:00'),('grade_level','13','Grade 12','2014-11-09 02:08:09','0000-00-00 00:00:00'),('dialect','1','English','2014-11-09 02:08:09','0000-00-00 00:00:00'),('dialect','2','Tagalog','2014-11-09 02:08:09','0000-00-00 00:00:00'),('class_size','1','Small Class','2014-11-09 02:08:09','0000-00-00 00:00:00'),('class_size','2','Standard Class','2014-11-09 02:08:09','0000-00-00 00:00:00'),('class_size','3','Big Class (Less than 35 students)','2014-11-09 02:08:09','0000-00-00 00:00:00'),('class_size','4','Standard Class (35 students)','2014-11-09 02:08:09','0000-00-00 00:00:00'),('class_size','5','Big Class (35 above)','2014-11-09 02:08:09','0000-00-00 00:00:00'),('subject_area','1','English','2014-11-09 02:08:09','0000-00-00 00:00:00'),('subject_area','2','Filipino','2014-11-09 02:08:09','0000-00-00 00:00:00'),('subject_area','3','Science','2014-11-09 02:08:09','0000-00-00 00:00:00'),('subject_area','4','Math','2014-11-09 02:08:09','0000-00-00 00:00:00'),('grading_period','1','1st','2014-11-09 02:08:09','0000-00-00 00:00:00'),('grading_period','2','2nd','2014-11-09 02:08:09','0000-00-00 00:00:00'),('grading_period','3','3rd','2014-11-09 02:08:09','0000-00-00 00:00:00'),('grading_period','4','4rth','2014-11-09 02:08:09','0000-00-00 00:00:00'),('methodology','1','Project method','2014-11-09 02:08:09','0000-00-00 00:00:00'),('methodology','2','Inquiry','2014-11-09 02:08:09','0000-00-00 00:00:00'),('methodology','3','Discovery','2014-11-09 02:08:09','0000-00-00 00:00:00'),('methodology','4','Discussion','2014-11-09 02:08:09','0000-00-00 00:00:00'),('methodology','5','Heuristic','2014-11-09 02:08:09','0000-00-00 00:00:00'),('methodology','6','Expository','2014-11-09 02:08:09','0000-00-00 00:00:00'),('curriculum_standards','1','Core Learning Standard','2014-12-02 13:06:11','0000-00-00 00:00:00'),('curriculum_standards','2','Grade Level Standard','2014-12-02 13:06:24','0000-00-00 00:00:00'),('curriculum_standards','3','Key Stage Standard','2014-12-02 13:06:36','0000-00-00 00:00:00'),('user_type','4','In-Service Teacher','2014-12-24 07:29:36','0000-00-00 00:00:00'),('user_type','5','Pre-Service Teacher','2015-02-10 05:58:12','0000-00-00 00:00:00'),('time_frame','3','Quarterly','2015-02-10 05:55:52','0000-00-00 00:00:00'),('time_frame','2','Monthly','2015-02-10 05:56:32','0000-00-00 00:00:00'),('time_frame','1','Weekly','2015-02-10 05:56:17','0000-00-00 00:00:00');

/*Table structure for table `songs` */

DROP TABLE IF EXISTS `songs`;

CREATE TABLE `songs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `artist` int(11) NOT NULL,
  `album` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `duration` varchar(8) NOT NULL,
  `path` varchar(500) NOT NULL,
  `albumOrder` int(11) NOT NULL,
  `plays` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `songs` */

insert  into `songs`(`id`,`title`,`artist`,`album`,`genre`,`duration`,`path`,`albumOrder`,`plays`,`updated_at`,`created_at`) values (1,'Kapatid-Bleed',17,2,1,'02:10','uploads/musics/kapatid/Kapatid-Bleed.mp3',0,15,'2019-09-23 22:19:27','2019-09-23 19:14:40'),(2,'Kapatid-Buhay',17,2,1,'02:18','uploads/musics/kapatid/Kapatid-Buhay.mp3',0,15,'2019-09-23 22:08:44','2019-09-23 19:14:40'),(3,'Kapatid-Destination',17,2,1,'02:20','uploads/musics/kapatid/Kapatid-Destination.mp3',0,16,'2019-09-23 22:19:52','2019-09-23 19:14:40'),(4,'Kapatid-Doon',17,2,1,'03:00','uploads/musics/kapatid/Kapatid-Doon.mp3',0,15,'2019-09-23 22:12:06','2019-09-23 19:14:40'),(5,'Kapatid-Edsa',17,2,1,'02:08','uploads/musics/kapatid/Kapatid-Edsa.mp3',0,15,'2019-09-23 22:11:57','2019-09-23 19:14:40'),(6,'Kapatid-Fadeaway',17,2,1,'02:19','uploads/musics/kapatid/Kapatid-Fadeaway.mp3',0,15,'2019-09-23 22:12:01','2019-09-23 19:14:40'),(7,'bensound-acousticbreeze',18,12,3,'02:10','uploads/musics/bensound/bensound-acousticbreeze.mp3',0,15,'2019-09-23 22:09:27','2019-09-23 19:15:25'),(8,'bensound-anewbeginning',18,12,3,'02:16','uploads/musics/bensound/bensound-anewbeginning.mp3',0,15,'2019-09-23 22:09:29','2019-09-23 19:15:25'),(9,'bensound-betterdays',18,12,3,'02:29','uploads/musics/bensound/bensound-betterdays.mp3',0,15,'2019-09-23 22:09:31','2019-09-23 19:15:25'),(10,'bensound-buddy',18,12,3,'02:27','uploads/musics/bensound/bensound-buddy.mp3',0,16,'2019-09-23 22:19:49','2019-09-23 19:15:25'),(11,'bensound-clearday',18,12,3,'02:13','uploads/musics/bensound/bensound-clearday.mp3',0,15,'2019-09-23 22:12:18','2019-09-23 19:15:25'),(12,'bensound-cute',18,12,3,'02:19','uploads/musics/bensound/bensound-cute.mp3',0,15,'2019-09-23 22:14:38','2019-09-23 19:15:25'),(13,'bensound-dubstep',18,12,3,'02:39','uploads/musics/bensound/bensound-dubstep.mp3',0,15,'2019-09-23 22:09:40','2019-09-23 19:15:25'),(14,'bensound-energy',18,12,3,'02:10','uploads/musics/bensound/bensound-energy.mp3',0,15,'2019-09-23 22:10:20','2019-09-23 19:15:25');

/*Table structure for table `throttle` */

DROP TABLE IF EXISTS `throttle`;

CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `throttle` */

insert  into `throttle`(`id`,`user_id`,`ip_address`,`attempts`,`suspended`,`banned`,`last_attempt_at`,`suspended_at`,`banned_at`) values (4,2,'::1',0,0,0,NULL,NULL,NULL),(5,1,'::1',1,0,0,'2019-09-14 13:19:14',NULL,NULL),(6,4,'::1',0,0,0,NULL,NULL,NULL),(7,6,'::1',0,0,0,NULL,NULL,NULL),(8,7,'::1',0,0,0,NULL,NULL,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_id` smallint(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_activation_code_index` (`activation_code`),
  KEY `users_reset_password_code_index` (`reset_password_code`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`email`,`password`,`permissions`,`activated`,`activation_code`,`activated_at`,`last_login`,`persist_code`,`reset_password_code`,`first_name`,`last_name`,`group_id`,`created_at`,`updated_at`) values (1,'','k12knowledgesystem@gmail.com','$2y$10$zLwJr6pXeCRr9xWudDg/8.nFd9lgIF7EEXZJDKHnTYh/hBxzO5wNW',NULL,1,NULL,NULL,'2015-04-15 14:57:03','$2y$10$Mv16Ak5jRsvXdBQPVXp5U.5bUdPbf4bghK0YcgW4.2yz07PHSfRtC',NULL,NULL,NULL,1,'2015-02-20 19:43:06','2015-04-15 14:57:03'),(4,'','letranjonel.gizmo@gmail.com','$2y$10$AVe3Wv.T/luwR5icAHdYE.4zk58bWncVkfK9QABK7tgTT3lWsfyGa',NULL,1,NULL,NULL,'2019-09-22 01:24:21','$2y$10$POWWpvK8WxJDTzYmBtaAR.vDFesl/m4jiPfT1K77aFB7PEc38rUAG',NULL,NULL,NULL,1,'2019-09-14 13:21:55','2019-09-22 01:24:21'),(6,'','krit.isidro@gmail.com','$2y$10$AVe3Wv.T/luwR5icAHdYE.4zk58bWncVkfK9QABK7tgTT3lWsfyGa',NULL,1,NULL,NULL,'2019-09-23 19:07:15','$2y$10$rqSFxZC3D/TYnNodUzwmy.CtF7Pv8A/ebNe3qw4QsXoJyUaEGeIW2',NULL,'krit','isidro',1,'2019-09-14 13:46:58','2019-09-23 19:07:15'),(7,'thegizmo','lenojnartel.gizmo@gmail.com','$2y$10$iJZVCyAFcoi0ZPhxuqzYXuvOcPtUN4x89b5TTusqvKhJzSzqdxb8S',NULL,1,'UOxcb7CwLcVn2IRXMpCYXZdNHzs0Kkut8GthjaNxQu',NULL,'2019-09-23 22:19:15','$2y$10$sRKJI9cwtWVjC5HSn.MHLecKq22ybvxoyI9orN5sNzXqvfH.HJQnG',NULL,'Jonel','Letran',3,'2019-09-22 08:53:38','2019-09-23 22:19:15');

/*Table structure for table `users_groups` */

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`),
  CONSTRAINT `ug_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users_groups` */

insert  into `users_groups`(`user_id`,`group_id`) values (1,1),(4,1),(6,1),(7,3);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
