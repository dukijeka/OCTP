-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 31, 2018 at 05:24 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `octp`
--

-- --------------------------------------------------------

--
-- Table structure for table `document`
--
USE octp;
DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posting_user_id` int(11) NOT NULL,
  `date_created` date DEFAULT NULL,
  `language_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `language_document` (`language_id`),
  KEY `posting_user_id` (`posting_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `posting_user_id`, `date_created`, `language_id`) VALUES
(1, 5, '2018-05-31', 1),
(2, 5, '2018-05-31', 1),
(3, 5, '2018-05-31', 1),
(4, 5, '2018-05-31', 1),
(5, 5, '2018-05-31', 1),
(6, 5, '2018-05-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `knows_language`
--

DROP TABLE IF EXISTS `knows_language`;
CREATE TABLE IF NOT EXISTS `knows_language` (
  `user_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`language_id`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `knows_language`
--

INSERT INTO `knows_language` (`user_id`, `language_id`) VALUES
(5, 1),
(7, 1),
(8, 1),
(9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `name`) VALUES
(1, 'Serbian'),
(2, 'English'),
(3, 'German');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2018_05_28_160102_add_remember_token_to_user_table', 2),
(5, '2018_05_30_212522_create_password_resets_table', 3),
(6, '2018_05_30_214611_rename_password_hash_column', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `user_id` int(11) NOT NULL,
  `translation_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `rating_value` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`translation_id`),
  KEY `translation_id` (`translation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
CREATE TABLE IF NOT EXISTS `report` (
  `document_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `explanation` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`document_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sentence`
--

DROP TABLE IF EXISTS `sentence`;
CREATE TABLE IF NOT EXISTS `sentence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `document_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `document_id` (`document_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sentence`
--

INSERT INTO `sentence` (`id`, `text`, `document_id`) VALUES
(2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 1),
(3, ' Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 1),
(4, ' It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged', 1),
(5, ' It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 1),
(6, '', 1),
(7, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 2),
(8, ' Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 2),
(9, ' It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged', 2),
(10, ' It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 2),
(11, '', 2),
(12, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 3),
(13, ' Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 3),
(14, ' It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged', 3),
(15, ' It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 3),
(16, '', 3),
(17, 'Abc def ghi', 4),
(18, 'Prva recenica', 5),
(19, ' Druga recenica', 5),
(20, ' Treca recenica', 5),
(21, '', 5),
(22, 'First sentence', 6),
(23, ' Second sentence', 6),
(24, ' Third sentence', 6),
(25, '', 6);

-- --------------------------------------------------------

--
-- Table structure for table `translation`
--

DROP TABLE IF EXISTS `translation`;
CREATE TABLE IF NOT EXISTS `translation` (
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
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `translation`
--

INSERT INTO `translation` (`id`, `date`, `translation_text`, `user_id`, `language_id`, `average_rating`, `sentence_id`) VALUES
(1, '2018-05-31', 'Lorem ipsum', 9, 2, NULL, 2),
(2, '2018-05-31', 'Lorem ipsum', 9, 2, NULL, 2),
(3, '2018-05-31', 'Lorem ipsum', 9, 1, NULL, 9),
(4, '2018-05-31', 'Lorem ipsum', 7, 1, NULL, 4),
(5, '2018-05-31', 'Lorem ipsum', 7, 1, NULL, 15);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
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
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `date_of_birth`, `date_joined`, `access_level`, `rating`, `remember_token`) VALUES
(5, 'admin', '$2y$10$xGqqUlHfO9Dp4b0vYOCFwuJeqo9pXbOKTfnIvfVIduCogxK3jo3Iq', 'Admin', 'Admin', 'admin@test.com', '2018-05-03', '2018-05-31', 10, 0, 'Uoxq18a4RpcQxmsokz5eU8REVUrHKrfFt1K55MFqlw4KDb52LBMGqUrN0BOm'),
(7, 'pera', '$2y$10$tnTj3q/fWn0yNDPCggsvPOXBXNFBTS0A4hQ7jfB.fr6Y1FARLoI4i', 'Pera', 'Peric', 'pera@test.com', '2018-05-09', '2018-05-31', 1, 0, 'YQRlP8dQ37RYgOMm4gqoWBycXsYAlwDS1jlJYctLIWUfhBAVaHIIU0MoxedV'),
(8, 'mika', '$2y$10$1TVr7QQbw0KzsJEJT1iIYuEd6mAyBPX6rhz2E9eCKCsbqSHXMmc.6', 'Mika', 'Mikic', 'mika@test.com', '2018-05-25', '2018-05-31', 1, 0, 'EQ5GGTEMClqYMnfFClnhqjZQCPfQ4enBiaINqBA4am969C3whLvq4WfYtJbL'),
(9, 'johndoe', '$2y$10$b/Dv9FCYzO88NKTYqKQvSuJgpivaBTJ9lWMbWgt.WDBZ0SzlZtYWu', 'John', 'Doe', 'jonndoe@test.com', '2018-05-08', '2018-05-31', 1, 0, 'GML52wNBbsJ7I7vH79oryrGDsB9Kb0i0p6OfggHlzHYiibRQDSaYt6XNlc1q');

-- --------------------------------------------------------

--
-- Table structure for table `wanted_translations`
--

DROP TABLE IF EXISTS `wanted_translations`;
CREATE TABLE IF NOT EXISTS `wanted_translations` (
  `document_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  PRIMARY KEY (`document_id`,`language_id`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wanted_translations`
--

INSERT INTO `wanted_translations` (`document_id`, `language_id`) VALUES
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(1, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `document_ibfk_1` FOREIGN KEY (`posting_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `knows_language`
--
ALTER TABLE `knows_language`
  ADD CONSTRAINT `knows_language_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `knows_language_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`translation_id`) REFERENCES `translation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sentence`
--
ALTER TABLE `sentence`
  ADD CONSTRAINT `sentence_ibfk_1` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `translation`
--
ALTER TABLE `translation`
  ADD CONSTRAINT `translation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wanted_translations`
--
ALTER TABLE `wanted_translations`
  ADD CONSTRAINT `wanted_translations_ibfk_1` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wanted_translations_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
