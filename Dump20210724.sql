CREATE DATABASE  IF NOT EXISTS `socialnetworking` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `socialnetworking`;
-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: localhost    Database: socialnetworking
-- ------------------------------------------------------
-- Server version	8.0.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (6,'Trí','Nguyễn','minhtripro2903@gmail.com','$2y$10$Ls8EZ5ReuJoPFBRfwKlaYOQ9wIZTXo2z3l7K/m5RrSqO.PE7Ehxsi');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attachments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `questionId` int DEFAULT NULL,
  `commentId` int DEFAULT NULL,
  `fileName` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `filePath` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `fileSize` int DEFAULT NULL,
  `Type` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `createDate` date DEFAULT NULL,
  `modifiedDate` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questionId` (`questionId`),
  KEY `commentId` (`commentId`),
  CONSTRAINT `attachments_ibfk_1` FOREIGN KEY (`questionId`) REFERENCES `questions` (`ID`),
  CONSTRAINT `attachments_ibfk_2` FOREIGN KEY (`commentId`) REFERENCES `comments` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachments`
--

LOCK TABLES `attachments` WRITE;
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoryquestions`
--

DROP TABLE IF EXISTS `categoryquestions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoryquestions` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `catName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `numberOfQuestions` int DEFAULT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoryquestions`
--

LOCK TABLES `categoryquestions` WRITE;
/*!40000 ALTER TABLE `categoryquestions` DISABLE KEYS */;
INSERT INTO `categoryquestions` VALUES (40,'Lập trình',NULL,'Sản phẩm công nghệ ở khắp mọi nơi, rất nhiều những thứ bạn đang nhìn, đang sờ vào đều đã được LẬP TRÌNH'),(41,'Cơ sơ dữ liệu',NULL,'Cơ sở dữ liệu (Database) là một tập hợp các dữ liệu có tổ chức, thường được lưu trữ và truy cập điện tử từ hệ thống máy tính. Khi cơ sở dữ liệu phức tạp hơn, chúng thường được phát triển bằng cách sử dụng các kỹ thuật thiết kế và mô hình hóa chính thức.'),(42,'Giáo dục',NULL,'Giáo dục theo nghĩa chung là hình thức học tập theo đó kiến thức, kỹ năng, và thói quen của một nhóm người được trao truyền từ thế hệ này sang thế hệ khác thông qua giảng dạy, đào tạo, hay nghiên cứu. Giáo dục thường diễn ra dưới sự hướng dẫn của người khác, nhưng cũng có thể thông qua tự học.[1] Bất cứ trải nghiệm nào có ảnh hưởng đáng kể lên cách mà người ta suy nghĩ, cảm nhận, hay hành động đều có thể được xem là có tính giáo dục'),(43,'Mạng máy tính',NULL,'Hệ thống mạng hay mạng máy tính (tiếng Anh: computer network hay network system) là sự kết hợp các máy tính lại với nhau thông qua các thiết bị nối kết mạng và phương tiện truyền thông (giao thức mạng, môi trường truyền dẫn) theo một cấu trúc nào đó và các máy tính này trao đổi thông tin qua lại với nhau.'),(56,'Toán',NULL,'Toán học là ngành nghiên cứu trừu tượng về những chủ đề như: lượng (các con số),[2] cấu trúc,[3] không gian, và sự thay đổi.[4][5][6] Các nhà toán học và triết học có nhiều quan điểm khác nhau về định nghĩa và phạm vi của toán học');
/*!40000 ALTER TABLE `categoryquestions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `questionId` int DEFAULT NULL,
  `ownerUserId` int DEFAULT NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `createdDate` datetime DEFAULT NULL,
  `lastModifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `questionId` (`questionId`),
  KEY `ownerUserId` (`ownerUserId`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`questionId`) REFERENCES `questions` (`ID`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`ownerUserId`) REFERENCES `dbuser` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (75,83,11,'sakfgdsjfgdsgfsgfss','2021-07-17 20:38:04','2021-07-22 21:18:10'),(76,83,11,'ádgfhgyjuh','2021-07-17 20:38:20',NULL),(78,83,11,'oki\r\n\r\n','2021-07-18 10:59:29',NULL),(109,84,10,'dfgdfhgfjjhkjljlk;lkkl;l;','2021-07-23 20:25:47','2021-07-24 12:18:18'),(110,90,10,'jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj','2021-07-23 21:16:01','2021-07-23 21:16:07'),(111,86,10,'ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff','2021-07-24 19:07:34','2021-07-24 19:07:43');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dbuser`
--

DROP TABLE IF EXISTS `dbuser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dbuser` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `lastName` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `userName` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `passWord` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `phoneNumber` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dbuser`
--

LOCK TABLES `dbuser` WRITE;
/*!40000 ALTER TABLE `dbuser` DISABLE KEYS */;
INSERT INTO `dbuser` VALUES (10,'Trí','Nguyễn','iAmNMT','$2y$10$khLb/vkrCuxEegzdZVZbNerqz9OCHGo.buDidJECrqVqRSbuK7sB6','minhtripro2903@gmail.com','0399411381'),(11,'A','Nguyễn','Soong Joong Ki','$2y$10$Ls8EZ5ReuJoPFBRfwKlaYOQ9wIZTXo2z3l7K/m5RrSqO.PE7Ehxsi','nguyenvana@gmail.com','0123456789');
/*!40000 ALTER TABLE `dbuser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `labelinquestion`
--

DROP TABLE IF EXISTS `labelinquestion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `labelinquestion` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `labelId` int DEFAULT NULL,
  `questionId` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `labelId` (`labelId`),
  KEY `questionId` (`questionId`),
  CONSTRAINT `labelinquestion_ibfk_1` FOREIGN KEY (`labelId`) REFERENCES `labels` (`ID`),
  CONSTRAINT `labelinquestion_ibfk_2` FOREIGN KEY (`questionId`) REFERENCES `questions` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `labelinquestion`
--

LOCK TABLES `labelinquestion` WRITE;
/*!40000 ALTER TABLE `labelinquestion` DISABLE KEYS */;
INSERT INTO `labelinquestion` VALUES (7,18,77),(14,19,83),(15,19,84),(16,18,85),(17,2,86),(20,1,88),(21,8,89),(22,12,89),(23,1,90),(24,2,90);
/*!40000 ALTER TABLE `labelinquestion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `labels`
--

DROP TABLE IF EXISTS `labels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `labels` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `labelName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `labels`
--

LOCK TABLES `labels` WRITE;
/*!40000 ALTER TABLE `labels` DISABLE KEYS */;
INSERT INTO `labels` VALUES (1,'C#'),(2,'Java'),(3,'Business Inteligence'),(4,'Python'),(5,'Javascript'),(6,'PHP'),(7,'iPhone'),(8,'SQL'),(9,'Microsoft SQL Server'),(10,'MySQL'),(11,'NoSQL'),(12,'RDBMS'),(13,'Exel'),(14,'Word'),(15,'Win10'),(16,'iOS 14'),(17,'DataWarehouse'),(18,'JUnit '),(19,'HCMUTE ');
/*!40000 ALTER TABLE `labels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `questions` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `catId` int DEFAULT NULL,
  `userId` int DEFAULT NULL,
  `Title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Description` longtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `CreateDate` date DEFAULT NULL,
  `LastModifiedDate` date DEFAULT NULL,
  `NumberOfComments` int DEFAULT NULL,
  `NumberOfVotes` int DEFAULT NULL,
  `NumberOfReports` int DEFAULT NULL,
  `Status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `catId` (`catId`),
  KEY `userId` (`userId`),
  CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`catId`) REFERENCES `categoryquestions` (`ID`),
  CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `dbuser` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (6,40,10,'Outlook 2016 Dropping Connectivity','We are having issues where users are losing connection to their Outlook mailboxes. This is happening frequently and then resolving itself. It is unrepeatable. I believe it is ADFS related as we have just implemented adfs WAP servers.','2014-06-01','2014-06-01',NULL,NULL,NULL,'1'),(77,40,10,'học JUnit ','Ac cho e xin review ngành này của HCMUTE với ? Ngành này có liên quan nhiều đến lập trình ko hay chỉ phần cứng thôi ?','2021-07-15',NULL,NULL,NULL,NULL,'1'),(83,41,10,'Ac cho e xin review ngành này của HCMUTE ','tryhgfhgjhbjhkmjnkjkjkjkjkjkjk','2021-07-17',NULL,NULL,NULL,NULL,'1'),(84,41,11,'Ac cho e xin review ngành này của HCMUTE ','r6utyuty','2021-07-18',NULL,NULL,NULL,NULL,'1'),(85,41,11,'OKie','jytjjk','2021-07-18',NULL,NULL,NULL,NULL,'1'),(86,41,11,'Ac cho e xin review ngành này của HCMUTE ','gjgjghkh','2021-07-18',NULL,NULL,NULL,NULL,'1'),(88,41,10,'hhihihhihihihih','àdghmjgfdsfg','2021-07-20',NULL,NULL,NULL,NULL,'1'),(89,41,10,'fdsghgjhgghkjk','ghkhjkhjkjhkhj','2021-07-20',NULL,NULL,NULL,NULL,'1'),(90,41,10,'test ngày thứ 4 21/7/2021','dfghjklhg','2021-07-21',NULL,NULL,NULL,NULL,'1');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reports` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `commentId` int DEFAULT NULL,
  `reportUserId` int DEFAULT NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `createdDate` date DEFAULT NULL,
  `lastModifiedDate` date DEFAULT NULL,
  `isProcessed` int DEFAULT NULL,
  `Type` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `commentId` (`commentId`),
  KEY `reportUserId` (`reportUserId`),
  CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`commentId`) REFERENCES `comments` (`ID`),
  CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`reportUserId`) REFERENCES `dbuser` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votes`
--

DROP TABLE IF EXISTS `votes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `votes` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `questionId` int DEFAULT NULL,
  `userId` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `questionId` (`questionId`),
  KEY `userId` (`userId`),
  CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`questionId`) REFERENCES `questions` (`ID`),
  CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `dbuser` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votes`
--

LOCK TABLES `votes` WRITE;
/*!40000 ALTER TABLE `votes` DISABLE KEYS */;
INSERT INTO `votes` VALUES (50,77,10),(51,6,10),(52,83,10),(53,83,11),(54,6,11),(55,77,11),(56,84,11),(57,84,10),(58,88,10),(59,86,10);
/*!40000 ALTER TABLE `votes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'socialnetworking'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-24 19:41:17
