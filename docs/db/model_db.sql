-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: octp
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu18.04.1

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
-- Table structure for table `document`
--

DROP TABLE IF EXISTS `document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posting_user_id` int(11) NOT NULL,
  `date_created` date DEFAULT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `language_document` (`language_id`),
  KEY `posting_user_id` (`posting_user_id`),
  CONSTRAINT `document_ibfk_1` FOREIGN KEY (`posting_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document`
--

LOCK TABLES `document` WRITE;
/*!40000 ALTER TABLE `document` DISABLE KEYS */;
INSERT INTO `document` VALUES (1,5,'2018-05-31',1,'Abc'),(2,5,'2018-05-31',1,'Def'),(3,5,'2018-05-31',1,'Ghi'),(5,5,'2018-05-31',1,'Mno'),(6,5,'2018-05-31',1,'Pqr'),(8,7,'2018-06-01',1,'test doc'),(9,7,'2018-06-01',1,'test doc'),(10,7,'2018-06-01',1,'newdoc'),(11,5,'2018-06-21',2,'Siege of Constantinople (717–718)'),(12,5,'2018-06-21',1,'Муслиманска освајања');
/*!40000 ALTER TABLE `document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `knows_language`
--

DROP TABLE IF EXISTS `knows_language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `knows_language` (
  `user_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `knows_language_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `knows_language_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `knows_language`
--

LOCK TABLES `knows_language` WRITE;
/*!40000 ALTER TABLE `knows_language` DISABLE KEYS */;
INSERT INTO `knows_language` VALUES (5,1),(7,1),(8,1),(9,1);
/*!40000 ALTER TABLE `knows_language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `language`
--

LOCK TABLES `language` WRITE;
/*!40000 ALTER TABLE `language` DISABLE KEYS */;
INSERT INTO `language` VALUES (1,'Serbian'),(2,'English'),(3,'German');
/*!40000 ALTER TABLE `language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(4,'2018_05_28_160102_add_remember_token_to_user_table',2),(5,'2018_05_30_212522_create_password_resets_table',3),(6,'2018_05_30_214611_rename_password_hash_column',3),(7,'2018_05_31_153730_add_title_to_document_table',4),(8,'2018_06_03_204252_add_num_of_ratings_column',5),(9,'2018_06_05_212148_add_column_num_of_ratings_in_translations',6),(10,'2018_06_05_232459_drop_num_of_ratings_columns',6),(11,'2018_06_05_233024_drop_integer_num_of_ratings',6),(12,'2018_06_05_233326_add_sum_user_ratings_column',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rating` (
  `user_id` int(11) NOT NULL,
  `translation_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `rating_value` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`translation_id`),
  KEY `translation_id` (`translation_id`),
  CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`translation_id`) REFERENCES `translation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rating`
--

LOCK TABLES `rating` WRITE;
/*!40000 ALTER TABLE `rating` DISABLE KEYS */;
INSERT INTO `rating` VALUES (5,1,'2018-06-05',5),(5,2,'2018-06-03',5),(5,3,'2018-06-21',1),(5,4,'2018-06-03',5),(5,5,'2018-06-05',5),(5,7,'2018-06-21',5),(5,8,'2018-06-05',2),(5,9,'2018-06-05',5),(5,10,'2018-06-05',5),(5,11,'2018-06-03',1),(5,12,'2018-06-05',5),(5,14,'2018-06-06',2),(5,15,'2018-06-06',4),(5,16,'2018-06-06',5),(5,17,'2018-06-06',4),(5,18,'2018-06-06',3),(5,19,'2018-06-06',5),(5,20,'2018-06-21',4),(5,21,'2018-06-21',1),(5,22,'2018-06-21',4),(5,23,'2018-06-21',3),(5,24,'2018-06-21',5),(5,25,'2018-06-21',3),(5,26,'2018-06-21',3),(7,23,'2018-06-21',5),(7,24,'2018-06-21',1),(7,25,'2018-06-21',5),(8,3,'2018-06-21',1),(8,7,'2018-06-21',3),(8,20,'2018-06-21',5),(8,21,'2018-06-21',5),(8,22,'2018-06-21',3),(8,23,'2018-06-21',5),(8,24,'2018-06-21',1),(8,25,'2018-06-21',1),(8,27,'2018-06-21',5),(8,28,'2018-06-21',3),(9,2,'2018-06-03',5),(9,4,'2018-06-03',1),(9,11,'2018-06-03',2);
/*!40000 ALTER TABLE `rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report` (
  `document_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `explanation` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`document_id`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `report_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `report_ibfk_2` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report`
--

LOCK TABLES `report` WRITE;
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
/*!40000 ALTER TABLE `report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sentence`
--

DROP TABLE IF EXISTS `sentence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sentence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `document_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `document_id` (`document_id`),
  CONSTRAINT `sentence_ibfk_1` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sentence`
--

LOCK TABLES `sentence` WRITE;
/*!40000 ALTER TABLE `sentence` DISABLE KEYS */;
INSERT INTO `sentence` VALUES (2,'Lorem Ipsum is simply dummy text of the printing and typesetting industry',1),(3,' Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',1),(4,' It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged',1),(5,' It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum',1),(6,'end of document1',1),(7,'Lorem Ipsum is simply dummy text of the printing and typesetting industry',2),(8,' Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',2),(9,' It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged',2),(10,' It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum',2),(11,'end of document2',2),(12,'Lorem Ipsum is simply dummy text of the printing and typesetting industry',3),(13,' Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',3),(14,' It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged',3),(15,' It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum',3),(16,'end of document3',3),(18,'Prva recenica',5),(19,' Druga recenica',5),(20,' Treca recenica',5),(21,'end of document5',5),(22,'First sentence',6),(23,' Second sentence',6),(24,' Third sentence',6),(25,'end of document6',6),(28,'Text sentence 1',8),(29,' Text sentence 2',8),(30,'Testing',9),(31,' Testing',9),(32,'Test sentence.',10),(33,' Another test sentence.',10),(34,'The Second Arab siege of Constantinople in 717–718 was a combined land and sea offensive by the Muslim Arabs of the Umayyad Caliphate against the capital city of the Byzantine Empire, Constantinople.',11),(35,' The campaign marked the culmination of twenty years of attacks and progressive Arab occupation of the Byzantine borderlands, while Byzantine strength was sapped by prolonged internal turmoil.',11),(36,' In 716, after years of preparations, the Arabs, led by Maslama ibn Abd al-Malik, invaded Byzantine Asia Minor.',11),(37,' The Arabs initially hoped to exploit Byzantine civil strife and made common cause with the general Leo III the Isaurian, who had risen up against Emperor Theodosius III.',11),(38,' Leo, however, tricked them and secured the Byzantine throne for himself.',11),(39,'\r\n\r\nAfter wintering in the western coastlands of Asia Minor, the Arab army crossed into Thrace in early summer 717 and built siege lines to blockade the city, which was protected by the massive Theodosian Walls.',11),(40,' The Arab fleet, which accompanied the land army and was meant to complete the city\'s blockade by sea, was neutralized soon after its arrival by the Byzantine navy through the use of Greek fire.',11),(41,' This allowed Constantinople to be resupplied by sea, while the Arab army was crippled by famine and disease during the unusually hard winter that followed.',11),(42,' In spring 718, two Arab fleets sent as reinforcements were destroyed by the Byzantines after their Christian crews defected, and an additional army sent overland through Asia Minor was ambushed and defeated.',11),(43,' Coupled with attacks by the Bulgars on their rear, the Arabs were forced to lift the siege on 15 August 718.',11),(44,' On its return journey, the Arab fleet was almost completely destroyed by natural disasters and Byzantine attacks.',11),(45,'\r\n\r\nThe siege\'s failure had wide-ranging repercussions.',11),(46,' The rescue of Constantinople ensured the continued survival of Byzantium, while the Caliphate\'s strategic outlook was altered: although regular attacks on Byzantine territories continued, the goal of outright conquest was abandoned.',11),(47,' Historians consider the siege to be one of history\'s most important battles, as its failure postponed the Muslim advance into Southeastern Europe for centuries.',11),(48,'Муслиманска освајања (арапски: الغزوات‎, ел-Газават или الفتوحات الإسلامية, ел-Фатухат ел-Исламија) такође позната и као Исламска освајања или Арапска освајања,[1] је назив који у свом традиционалном смислу подразумијевају низ оружаних сукоба, односно освајачких похода које је арапска муслиманска држава, касније позната као Калифат, предузела од свог настанка 620-их до око 750.',12),(49,' године, а који су резултирали освајањем целог Блиског Истока, Северне Африке, те делова Централне и јужне Азије, односно Кавказа и јужне Европе.',12),(50,' Муслиманска освајања су за поседицу имала нагло ширење ислама и његово претварање у једну од највећих светских религија, односно ширење арапског језика, писма и културе као и стварање једног од највећих царстава у историји света, од кога је настао данашњи исламски свет.',12),(51,' Муслиманска освајања се обично деле на она за живота пророка Мухамеда (до 632), која су укључивала Арабијско полуострво; она за време прва четири калифа, односно Рашидунског Калифата (632 - 661) када су освојени Левант, Персија, Египат, Јерменија и Кипар; затим освајања за време Омејадског Калифата када су освојени Северна Африка, највећи део Иберијског полуострва, данашњег Авганистана и Пакистана, као и делови Кавказа и Централне Азије.',12),(52,' Царство створено муслиманским освајањима се распало када је збачена династија Омејада, а на место калифа дошла Абасидска династија, чију су власт, пак преживели Омејади успешно оспорили основавши супарничку државу познату као Кордопски Калифат.',12),(53,' Тада су престала муслиманска освајања у ужем/традиционалном смислу речи, иако су касније створене муслиманске државе наставиле у седећим вековима са припајњем територија не-муслиманских држава и тако ширитле ислам, при чему се посебно истакло Османско царство на западу и Могулско царство на истоку.',12);
/*!40000 ALTER TABLE `sentence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translation`
--

DROP TABLE IF EXISTS `translation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `translation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `translation_text` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `language_id` int(11) NOT NULL,
  `average_rating` float DEFAULT NULL,
  `sentence_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `language_translation` (`language_id`),
  KEY `R_17` (`sentence_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `translation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translation`
--

LOCK TABLES `translation` WRITE;
/*!40000 ALTER TABLE `translation` DISABLE KEYS */;
INSERT INTO `translation` VALUES (1,'2018-05-31','Lorem ipsum1',9,2,1.2,2),(2,'2018-05-31','Lorem ipsum',9,2,5,2),(3,'2018-05-31','Lorem ipsum',9,1,1,9),(4,'2018-05-31','Lorem ipsum',7,1,2.5,4),(5,'2018-05-31','Lorem ipsum',7,1,4.2,15),(6,'2018-06-02','Moj prevod',7,1,1.1,19),(7,'2018-06-02','New translation',7,1,4.99707,7),(8,'2018-06-02','safasfsaf',7,2,4.9,5),(9,'2018-06-03','translation1',5,1,2.2,12),(10,'2018-06-03','translation2',5,1,4.2,12),(11,'2018-06-03','yes it was',5,2,1.6,5),(12,'2018-06-05','jkhj',5,1,NULL,17),(13,'2018-06-06','lkjkl',5,2,NULL,32),(14,'2018-06-06','xz',5,1,NULL,22),(15,'2018-06-06','kjklj',5,1,NULL,24),(16,'2018-06-06','as',5,1,NULL,24),(17,'2018-06-06','as',5,1,NULL,25),(18,'2018-06-06','as',5,1,3,25),(19,'2018-06-06','as',5,1,5,25),(20,'2018-06-21','Die Belagerung von Konstantinopel von 717 bis 718 war der zweite schwere Angriff der Araber auf die byzantinische Hauptstadt. Er endete mit der erfolgreichen Behauptung der Stadt durch die Byzantiner und Bulgaren und gebot damit der Islamischen Expansion vorläufig Einhalt.',5,3,4.59445,34),(21,'2018-06-21','Im Sommer 715 ließ Kalif Sulaiman bei Aleppo ein Heer versammeln. Unter dem Befehl seines Bruders Maslama sollte es Kleinasien Richtung Konstantinopel durchqueren. Gleichzeitig machte sich eine Flotte von 1.800 Schiffen unter Sula',5,3,3.33614,47),(22,'2018-06-21','afeneinfahrt hatte spannen lassen, im Goldenen Horn. Am 3. September rückte die muslimische Flotte vor, um die Byzantiner in den Häfen im Marmarameer von Osten und Norden einzuschließen. Die Nachhut von zwanzig schweren Schiffen verlor dabei den Anschluss, was Leo III. sofort aus',5,3,3.4215,39),(23,'2018-06-21','The early Muslim conquests (Arabic: الفتوحات الإسلامية‎, al-Futūḥāt al-Islāmiyya) also referred to as the Arab conquests[4] and early Islamic conquests[5] began with the Islamic prophet Muhammad in the 7th century. He established a new unified polity in the Arabian Peninsula which under the subsequent Rashidun and Umayyad Caliphates saw a century of rapid expansion.',5,2,4.48719,48),(24,'2018-06-21','Fred McGraw Donner, however, suggests that formation of a state in the Arabian peninsula and ideological (i.e. religious) coherence and mobilization was a primary reason why the Muslim armies in the space of a hundred years were able to establish the largest pre-modern empire until that time.',5,2,2.05695,51),(25,'2018-06-21','and welcomed the Muslim forces, largely because of religious conflict in both empires.[7] However, this is not universally accepted. It has also been suggested that later Syriac Christians reinterpreted the events of the conquest to serve a political or religious in',5,2,2.99958,51),(26,'2018-06-21','lasjdkljsakldjkllasjdkljsakldjkllasjdkljsakldjkllasjdkljsakldjkllasjdkljsakldjkllasjdkljsakldjkllasjdkljsakldjkllasjdkljsakldjkl',5,1,3,15),(27,'2018-06-21','1960s with the release of Letraset sheets containing Lorem I',8,1,5,10),(28,'2018-06-21','/традиционалном смислу речи, иако су касније створене муслиманске државе наставиле у седећим вековима са припајњем територија не-муслиманских држава и тако ширитле ислам, при чему се посебно истакло Османско царство н',8,2,3,53);
/*!40000 ALTER TABLE `translation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `date_joined` date DEFAULT NULL,
  `access_level` int(11) DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `sum_user_ratings` double(6,2) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (5,'admin','$2y$10$xGqqUlHfO9Dp4b0vYOCFwuJeqo9pXbOKTfnIvfVIduCogxK3jo3Iq','Admin','Admin','admin@test.com','2018-05-03','2018-05-31',10,67.4344,11.85,'6pC7a16Js67ByhFBaVy4SmA6sSxB3epff4NgVrla5PugOojHDyzfieO4MDGj'),(7,'pera','$2y$10$tnTj3q/fWn0yNDPCggsvPOXBXNFBTS0A4hQ7jfB.fr6Y1FARLoI4i','Pera','Peric','pera@test.com','2018-05-09','2018-05-31',1,99.9421,0.69,'Zt6nO5idPYxjBnr9taea4dJtbxcV8uRs9BBvHHRrGRnddyXuMw4fKuE7u7fv'),(8,'mika','$2y$10$1TVr7QQbw0KzsJEJT1iIYuEd6mAyBPX6rhz2E9eCKCsbqSHXMmc.6','Mika','Mikic','mika@test.com','2018-05-25','2018-05-31',1,60,1.00,'EQ5GGTEMClqYMnfFClnhqjZQCPfQ4enBiaINqBA4am969C3whLvq4WfYtJbL'),(9,'johndoe','$2y$10$b/Dv9FCYzO88NKTYqKQvSuJgpivaBTJ9lWMbWgt.WDBZ0SzlZtYWu','John','Doe','jonndoe@test.com','2018-05-08','2018-05-31',1,20,0.69,'JvUFXReE5TuPYWXmjGYtEMDTdNI1IHJ1NIodELH2nk8yQum3j6hYu9LSpKpL');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wanted_translations`
--

DROP TABLE IF EXISTS `wanted_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wanted_translations` (
  `document_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  PRIMARY KEY (`document_id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `wanted_translations_ibfk_1` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `wanted_translations_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wanted_translations`
--

LOCK TABLES `wanted_translations` WRITE;
/*!40000 ALTER TABLE `wanted_translations` DISABLE KEYS */;
INSERT INTO `wanted_translations` VALUES (2,1),(3,1),(5,1),(6,1),(1,2),(9,2),(10,2),(12,2),(8,3),(11,3);
/*!40000 ALTER TABLE `wanted_translations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-21 23:26:44
