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
-- Table structure for table `dwz_cache`
--

DROP TABLE IF EXISTS `dwz_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dwz_cache` (
  `k` varchar(32) NOT NULL,
  `v` longtext,
  `expire` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`k`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dwz_cache`
--

LOCK TABLES `dwz_cache` WRITE;
/*!40000 ALTER TABLE `dwz_cache` DISABLE KEYS */;
INSERT INTO `dwz_cache` VALUES ('config','a:18:{s:10:\"adminlogin\";s:19:\"2022-08-11 10:58:18\";s:9:\"admin_pwd\";s:12:\"www.qymao.cn\";s:10:\"admin_user\";s:5:\"admin\";s:5:\"build\";s:10:\"2022-08-11\";s:11:\"description\";s:71:\"极简短网址提供网址缩短服务,源码网,bbs.zyzyw.cc\";s:6:\"domain\";s:11:\"47.97.4.172\";s:9:\"dwz_token\";s:0:\"\";s:3:\"icp\";s:0:\"\";s:8:\"is_https\";s:1:\"0\";s:8:\"keywords\";s:85:\"极简短网址,短网址生成,简约短网址程序,源码网,bbs.zyzyw.cc\";s:11:\"link_length\";s:1:\"4\";s:4:\"noqq\";s:1:\"0\";s:4:\"nowx\";s:1:\"0\";s:7:\"qqcheck\";s:1:\"0\";s:6:\"syskey\";s:32:\"11y3TT21FvS6FA22nCTtq3FY3L936c2Q\";s:5:\"title\";s:15:\"极简短网址\";s:8:\"web_name\";s:34:\"极简短网址-源码网\";s:7:\"wxcheck\";s:1:\"0\";}',0);
/*!40000 ALTER TABLE `dwz_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dwz_config`
--

DROP TABLE IF EXISTS `dwz_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dwz_config` (
  `k` varchar(32) NOT NULL,
  `v` text,
  PRIMARY KEY (`k`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dwz_config`
--

LOCK TABLES `dwz_config` WRITE;
/*!40000 ALTER TABLE `dwz_config` DISABLE KEYS */;
INSERT INTO `dwz_config` VALUES ('adminlogin','2022-08-11 10:58:18'),('admin_pwd','bbs.zyzyw.cc'),('admin_user','admin'),('build','2022-08-11'),('cache',''),('description','极简短网址提供网址缩短服务,企业猫源码网,www.qymao.cn'),('domain','47.97.4.172'),('dwz_token',''),('icp',''),('is_https','0'),('keywords','极简短网址,短网址生成,简约短网址程序,企业猫源码网,bbs.zyzyw.cc'),('link_length','4'),('noqq','0'),('nowx','0'),('qqcheck','0'),('syskey','11y3TT21FvS6FA22nCTtq3FY3L936c2Q'),('title','极简短网址'),('web_name','极简短网址-企业猫源码网'),('wxcheck','0');
/*!40000 ALTER TABLE `dwz_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dwz_url`
--

DROP TABLE IF EXISTS `dwz_url`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dwz_url` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `qqsafe` int(1) NOT NULL DEFAULT '1',
  `wxsafe` int(1) NOT NULL DEFAULT '1',
  `status` int(1) NOT NULL DEFAULT '1',
  `view` int(100) NOT NULL DEFAULT '0',
  `url` text NOT NULL,
  `dwz` text NOT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dwz_url`
--

LOCK TABLES `dwz_url` WRITE;
/*!40000 ALTER TABLE `dwz_url` DISABLE KEYS */;
INSERT INTO `dwz_url` VALUES (1,'HdQg',1,1,1,1,'http://bbs.zyzyw.cc','http://d47.97.4.172/HdQg','124.131.232.196','2022-08-11 10:53:03'),(2,'MLip',1,1,1,1,'bbs.zyzyw.cc','http://d47.97.4.172/MLip','124.131.232.196','2022-08-11 10:53:22'),(3,'bd5J',1,1,1,1,'http://bbs.zyzyw.cc','http://d47.97.4.172/bd5J','124.131.232.196','2022-08-11 10:53:50');
/*!40000 ALTER TABLE `dwz_url` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database '47_97_4_172'
--

--
-- Dumping routines for database '47_97_4_172'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-11 11:01:45
