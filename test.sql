-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: localhost    Database: test
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.18.04.1

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
-- Table structure for table `ACT`
--

DROP TABLE IF EXISTS `ACT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ACT` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `act_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bm_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `act_bm_id_foreign` (`bm_id`),
  CONSTRAINT `act_bm_id_foreign` FOREIGN KEY (`bm_id`) REFERENCES `BusinessManager` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ACT`
--

LOCK TABLES `ACT` WRITE;
/*!40000 ALTER TABLE `ACT` DISABLE KEYS */;
INSERT INTO `ACT` VALUES (1,'33333333333333333333','1',12,NULL,NULL),(2,'3333333322222222222','1',12,NULL,NULL),(3,'3211111111123213','1',13,NULL,NULL),(4,'3342624324','1',13,NULL,NULL),(5,'33331231545','1',14,NULL,NULL),(6,'333333323463634634333','1',14,NULL,NULL),(7,'3321536565533','1',15,NULL,NULL),(8,'33321414213333','1',15,NULL,NULL);
/*!40000 ALTER TABLE `ACT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Accounts`
--

DROP TABLE IF EXISTS `Accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Accounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_owner` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `keitaro_comp_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `acc_proxy_id` bigint(20) unsigned NOT NULL,
  `token_fb` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `accounts_acc_owner_foreign` (`acc_owner`),
  KEY `accounts_acc_proxy_id_foreign` (`acc_proxy_id`),
  CONSTRAINT `accounts_acc_owner_foreign` FOREIGN KEY (`acc_owner`) REFERENCES `Owner` (`id`),
  CONSTRAINT `accounts_acc_proxy_id_foreign` FOREIGN KEY (`acc_proxy_id`) REFERENCES `Proxy` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Accounts`
--

LOCK TABLES `Accounts` WRITE;
/*!40000 ALTER TABLE `Accounts` DISABLE KEYS */;
INSERT INTO `Accounts` VALUES (13,'Andrey1',9,NULL,NULL,11111,1,1,0),(14,'Andrey2',9,NULL,NULL,11112,1,1,0),(15,'Andrey3',9,NULL,NULL,11113,1,2,0),(16,'Masha1',9,NULL,NULL,11114,0,3,0),(17,'Yulia1',11,NULL,NULL,11121,1,5,0),(18,'Yulia2',11,NULL,NULL,11122,1,5,0),(19,'Yulia3',11,NULL,NULL,11123,1,6,0),(20,'Masha2',11,NULL,NULL,11124,0,7,0),(21,'Maxim1',10,NULL,NULL,11121,1,9,0),(22,'Maxim2',10,NULL,NULL,11122,1,9,0),(23,'Maxim3',10,NULL,NULL,11123,1,10,0),(24,'Masha4',10,NULL,NULL,11124,0,11,0),(25,'fdf',9,'2019-12-24 16:08:46','2019-12-24 16:08:46',1,1,23,1),(26,'dasda',9,'2019-12-24 16:22:58','2019-12-24 16:22:58',1,1,24,1),(27,'dsads',9,'2019-12-24 19:52:43','2019-12-24 19:52:43',11,1,26,21),(28,'ddsa',9,'2019-12-24 20:02:04','2019-12-24 20:02:04',1,1,27,21),(29,'daa',9,'2019-12-24 20:10:41','2019-12-24 20:10:41',1,1,28,2),(30,'3',9,'2019-12-24 20:12:21','2019-12-24 20:12:21',1,1,30,1),(31,'Max30',10,'2019-12-26 15:01:34','2019-12-26 15:01:34',1,1,31,1),(32,'Max3',10,'2019-12-26 15:03:46','2019-12-26 15:03:46',1,1,32,1),(33,'bb',9,'2019-12-26 15:09:36','2019-12-26 15:09:36',1,1,33,1),(34,'Andrey12',10,'2019-12-26 20:27:40','2019-12-26 20:27:40',1,1,34,1),(35,'Andrey20',9,'2019-12-26 20:30:23','2019-12-26 20:30:23',2,1,35,2),(36,'Fylhtq2',9,'2019-12-30 21:04:35','2019-12-30 21:04:35',123,1,36,32),(37,'Andrey70',9,'2020-01-03 09:45:33','2020-01-03 09:45:33',1,1,37,2);
/*!40000 ALTER TABLE `Accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `BusinessManager`
--

DROP TABLE IF EXISTS `BusinessManager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BusinessManager` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `acc_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bm_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_id` bigint(20) unsigned NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `businessmanager_acc_id_foreign` (`acc_id`),
  CONSTRAINT `businessmanager_acc_id_foreign` FOREIGN KEY (`acc_id`) REFERENCES `Accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BusinessManager`
--

LOCK TABLES `BusinessManager` WRITE;
/*!40000 ALTER TABLE `BusinessManager` DISABLE KEYS */;
INSERT INTO `BusinessManager` VALUES (12,'business01','111111111111001',13,1,NULL,NULL),(13,'business02','111111111111002',14,1,NULL,NULL),(14,'business03','111111111111003',15,1,NULL,NULL),(15,'business04','111111111111004',16,1,NULL,NULL),(16,'business11','111111111111011',17,1,NULL,NULL),(17,'business12','111111111111012',18,1,NULL,NULL),(18,'business13','111111111111013',16,1,NULL,NULL),(19,'business14','111111111111014',17,1,NULL,NULL),(20,'business01','111111111111021',19,1,NULL,NULL),(21,'business01','111111111111023',24,1,NULL,NULL),(22,'business01','111111111111025',23,1,NULL,NULL);
/*!40000 ALTER TABLE `BusinessManager` ENABLE KEYS */;
UNLOCK TABLES;



--
-- Table structure for table `Owner`
--

DROP TABLE IF EXISTS `Owner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Owner` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Owner`
--

LOCK TABLES `Owner` WRITE;
/*!40000 ALTER TABLE `Owner` DISABLE KEYS */;
INSERT INTO `Owner` VALUES (9,'Andrey'),(10,'Maxim'),(11,'Julia');
/*!40000 ALTER TABLE `Owner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Proxy`
--

DROP TABLE IF EXISTS `Proxy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Proxy` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `port` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proxy_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Proxy`
--

LOCK TABLES `Proxy` WRITE;
/*!40000 ALTER TABLE `Proxy` DISABLE KEYS */;
INSERT INTO `Proxy` VALUES (1,'100.10.10.1','6000','login11','pass11','socks',NULL,NULL),(2,'100.10.10.2','6001','login12','pass12','socks',NULL,NULL),(3,'100.10.10.3','6002','login13','pass13','socks',NULL,NULL),(4,'100.10.10.4','6003','login14','pass14','socks',NULL,NULL),(5,'100.10.11.1','6010','login21','pass21','socks',NULL,NULL),(6,'100.10.11.2','6011','login22','pass22','socks',NULL,NULL),(7,'100.10.11.3','6012','login23','pass23','socks',NULL,NULL),(8,'100.10.11.4','6013','login24','pass24','socks',NULL,NULL),(9,'100.10.12.1','6030','login31','pass31','socks',NULL,NULL),(10,'100.10.12.2','6031','login32','pass32','socks',NULL,NULL),(11,'100.10.12.3','6032','login33','pass33','socks',NULL,NULL),(12,'100.10.12.4','6033','login34','pass34','socks',NULL,NULL),(13,'192.0.0.1','2','dsad','asd','as','2019-12-24 15:21:40','2019-12-24 15:21:40'),(14,'192.0.0.1','2','dsad','asd','as','2019-12-24 15:25:01','2019-12-24 15:25:01'),(15,'192.0.0.1','2','dsad','asd','as','2019-12-24 15:33:35','2019-12-24 15:33:35'),(16,'192.0.0.1','2','dsad','asd','as','2019-12-24 15:42:09','2019-12-24 15:42:09'),(17,'192.0.0.1','2','dsad','asd','as','2019-12-24 15:42:31','2019-12-24 15:42:31'),(18,'192.0.0.1','2','dsad','asd','as','2019-12-24 15:43:31','2019-12-24 15:43:31'),(19,'192.0.0.1','2','dsad','asd','as','2019-12-24 15:43:56','2019-12-24 15:43:56'),(20,'192.0.0.1','2','dsad','asd','as','2019-12-24 15:53:00','2019-12-24 15:53:00'),(21,'192.0.0.1','2','dsad','asd','as','2019-12-24 15:53:27','2019-12-24 15:53:27'),(22,'192.0.0.1','2','dsad','asd','as','2019-12-24 15:54:52','2019-12-24 15:54:52'),(23,'192.0.0.1','2','dsad','asd','as','2019-12-24 16:08:46','2019-12-24 16:08:46'),(24,'192.0.0.1','2','dsad','asd','as','2019-12-24 16:22:58','2019-12-24 16:22:58'),(25,'192.168.0.1','2','1','1','1','2019-12-24 19:52:25','2019-12-24 19:52:25'),(26,'192.168.0.1','2','1','1','1','2019-12-24 19:52:43','2019-12-24 19:52:43'),(27,'192.168.0.1','3','1','1','1','2019-12-24 20:02:04','2019-12-24 20:02:04'),(28,'127.1.1.1','3','1','1','1','2019-12-24 20:10:41','2019-12-24 20:10:41'),(29,'127.1.1.1','3','1','1','1','2019-12-24 20:12:15','2019-12-24 20:12:15'),(30,'127.1.1.1','3','1','1','1','2019-12-24 20:12:21','2019-12-24 20:12:21'),(31,'192.168.0.0','10','1','1','1','2019-12-26 15:01:34','2019-12-26 15:01:34'),(32,'192.168.0.0','10','1','1','1','2019-12-26 15:03:46','2019-12-26 15:03:46'),(33,'192.165.0.0','2','2','2','2','2019-12-26 15:09:36','2019-12-26 15:09:36'),(34,'192.168.0.0','22','1','1','1','2019-12-26 20:27:40','2019-12-26 20:27:40'),(35,'192.168.0.1','2','1','1','1','2019-12-26 20:30:23','2019-12-26 20:30:23'),(36,'192.0.0.1','1','1','1','1','2019-12-30 21:04:35','2019-12-30 21:04:35'),(37,'192.168.0.1','2','1','1','1','2020-01-03 09:45:33','2020-01-03 09:45:33');
/*!40000 ALTER TABLE `Proxy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (44,'2019_11_11_192654_accounts',1),(45,'2019_11_11_192901_proxy',1),(46,'2019_11_11_193036_business__manager',1),(47,'2019_11_11_193126_a_c_t',1),(48,'2019_11_11_204458_update_tables_foreign',2),(49,'2019_12_24_092556_update_table_account',3),(50,'2014_10_12_000000_create_users_table',4),(51,'2014_10_12_100000_create_password_resets_table',4),(52,'2019_08_19_000000_create_failed_jobs_table',4),(53,'2019_11_06_105116_foreign_books',4),(54,'2019_11_06_105153_foreign_authors',4),(55,'2019_11_06_155051_add_column',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-03 10:02:14
