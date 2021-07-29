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
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (144,112,10,'For dictionaries x and y, z becomes a shallowly-merged dictionary with values from y replacing those from x.','2021-07-28 21:49:14','2021-07-28 21:49:35'),(146,142,10,'If you just want to check whether there\'s any value, you can do if (strValue) {\r\n    //do something\r\n}','2021-07-29 19:21:54',NULL),(147,142,10,'I have tried several of the examples suggested here. My goal was to not only be able to check for empty, but also !empty. This was the result The only thing I could not find in any of these solutions is how to detect an undefined within the function if it has not, at least, been declared. perhaps that is not possible.','2021-07-29 19:22:23',NULL),(148,141,10,'I have a function that does a foreach loop in a list of views and needs to send an AJAX request for each view in the loop. When it gets the results in the success function, it checked if a specific Id is returned and, if it is, adds this view to a selectBox. The problem is that when I tried to define the .change event on the selectBox it gave me an error as no option have been added. I have thought about adding ajaxStop, but I have other different AJAX request. Does anybody knows how could i wait till those Ajax request have been finished, but no others','2021-07-29 19:23:34',NULL),(149,141,10,'Think of it like you\'re just calling JavaScript functions. You can\'t use a for loop where the arguments to a function call would go:','2021-07-29 19:23:56',NULL),(150,138,10,'phải port này không bạn','2021-07-29 19:25:05',NULL),(151,138,10,'Bạn thử bỏ s ở https đi xem','2021-07-29 19:25:15',NULL),(152,139,10,'Dùng hẳn VNPay cho tiện bác ơi','2021-07-29 19:25:39',NULL),(153,139,10,'có quá nhiều id cùng tên \'frmMaintainance\' sao ý bạn','2021-07-29 19:25:51',NULL),(154,140,10,'Quá ngon luôn anh.aaaaaaaaaaaaaa','2021-07-29 19:26:45',NULL),(155,140,10,'Em mở f12 lên rồi xem tab network xem request đẩy lên lỗi gì','2021-07-29 19:26:53',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `labelinquestion`
--

LOCK TABLES `labelinquestion` WRITE;
/*!40000 ALTER TABLE `labelinquestion` DISABLE KEYS */;
INSERT INTO `labelinquestion` VALUES (47,4,112),(48,22,112),(49,4,113),(75,1,138),(76,1,139),(77,1,140),(78,23,140),(79,2,141),(80,24,142);
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `labels`
--

LOCK TABLES `labels` WRITE;
/*!40000 ALTER TABLE `labels` DISABLE KEYS */;
INSERT INTO `labels` VALUES (1,'C#'),(2,'Java'),(3,'Business Inteligence'),(4,'Python'),(5,'Javascript'),(6,'PHP'),(7,'iPhone'),(8,'SQL'),(9,'Microsoft SQL Server'),(10,'MySQL'),(11,'NoSQL'),(12,'RDBMS'),(13,'Exel'),(14,'Word'),(15,'Win10'),(16,'iOS 14'),(17,'DataWarehouse'),(18,'JUnit '),(19,'HCMUTE '),(20,'Android'),(21,'listview'),(22,'extend'),(23,' asp.net'),(24,'JS');
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
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (112,40,10,'What is the difference between Python\'s list methods append and extend?','What\'s the difference between the list methods append() and extend()','2021-07-28',NULL,NULL,NULL,NULL,'1'),(113,40,10,'What is the difference between __str__ and __repr__?','What is the difference between __str__ and __repr__ in Python?','2021-07-28',NULL,NULL,NULL,NULL,'1'),(114,40,10,'Issues with the QNA Maker REST API Get Operation Details','We are using Qna Maker REST API V4.0 API and using the Create Knowledgebase API for creating a new knowledgebase. We got the Response code 200 and &quot;operationState&quot;: &quot;NotStarted&quot;, In the Next Step, without any delay we are calling the next API Get Operation Details to get the operation details and mostly, We are getting &quot;operationState&quot;: &quot;NotStarted&quot;, But after retry in sometime, we are getting response &quot;operationState&quot;: &quot;Succeeded&quot; Do we Need to Put any delay between this API Call, Because in the API documentation It’s not mentioned for any delay or wait.','2021-07-28',NULL,NULL,NULL,NULL,'1'),(138,41,10,'Ac cho e xin review ngành này của HCMUTE ','Ac cho e xin review ngành này của HCMUTE ','2021-07-29',NULL,NULL,NULL,NULL,'1'),(139,40,10,'Windows authentication for SignalR service hosted in Kestrel (AspNet Core 5.0)','I have a SignalR (AspNet Core 5.0) hosted in a console app using Kestrel as the web host.\r\n\r\nI want to access the user Identity of any request in a Hub implementation, when accessing the following the Identity values are NULL.\r\n\r\nI\'ve looked at the available documentation on MSDN and made the following changes, but not getting the Identity populated as I expected, also not finding any examples for AspNet Core 5.0 anywhere.','2021-07-29',NULL,NULL,NULL,NULL,'1'),(140,40,10,'SignalR .NET Client connecting to Azure SignalR Service in a Blazor .NET Core 3 application','I\'m trying to make a connection between my ASP.NET Core 3.0 Blazor (server-side) application and the Azure SignalR Service. I\'ll end up injecting my SignalR client (service) in to a few Blazor components so they\'ll update my UI/DOM in realtime.\r\n\r\nMy issue is that I\'m receiving the following message when I call my .StartAsync() method on the hub connection:','2021-07-29',NULL,NULL,NULL,NULL,'1'),(141,40,10,'How to identify new element appear on the exixting webpage using selenide','I did automation for a React web application.\r\nLooking for help to achieve the below scenario,\r\n\r\nI\'m Clicking a button on the page. After clicking the button there is an image load to the page. To load the image it will take around 5 seconds.\r\nAlso, image load to newly created element,\r\n(In the page before click there is no div for the image load, but after I clicked on the button it appears on the page, and inside of that div image loaded).\r\nIn my method I\'m trying to verify the image is loaded after the button click.\r\nBut always it returns NoSuchElementException.','2021-07-29',NULL,NULL,NULL,NULL,'1'),(142,40,10,'How can I check for an empty/undefined/null string in JavaScript?','I saw this question, but I didn\'t see a JavaScript specific example. Is there a simple string.Empty available in JavaScript, or is it just a case of checking for &quot;&quot;?','2021-07-29',NULL,NULL,NULL,NULL,'1');
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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votes`
--

LOCK TABLES `votes` WRITE;
/*!40000 ALTER TABLE `votes` DISABLE KEYS */;
INSERT INTO `votes` VALUES (62,112,10),(63,139,10),(64,142,10),(65,141,10),(66,140,10);
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

-- Dump completed on 2021-07-29 19:29:16
