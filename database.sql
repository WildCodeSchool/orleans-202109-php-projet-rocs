-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 26 Octobre 2017 à 13:53
-- Version du serveur :  5.7.19-0ubuntu0.16.04.1
-- Version de PHP :  7.0.22-0ubuntu0.16.04.1

CREATE TABLE `activity` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `description` text NOT NULL,
    `schedule` varchar(155) NOT NULL,
    `days` varchar(60) NOT NULL,
    `who` text NOT NULL,
    `trainer_id` int DEFAULT NULL,
    `image` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `trainer_id` (`trainer_id`),
    CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainer` (`id`)
  ) --
insert into
  activity(
    id,
    name,
    description,
    schedule,
    days,
    who,
    trainer_id,
    image
  )
values(
    '2',
    'Course à pied',
    'La course à pied est, avec la marche, l' un des deux modes de locomotion bip è des de l 'être humain. Caractérisée par une phase de suspension durant laquelle aucun des deux pieds ne touche le sol, elle permet un déplacement plus économe en énergie que la marche pour des vitesses allant d' environ 6 km / h à plus de 40 km / h.',' 19h à 20h30 ',' Mardi - Jeudi ',' Pour les plus petits pleins d 'énergie et les plus grands compétiteurs',
    '1',
    'run.jpg'
  );
insert into
  activity(
    id,
    name,
    description,
    schedule,
    days,
    who,
    trainer_id,
    image
  )
values(
    '3',
    'Artistique',
    'Pratique  éducative,  de  proximité  et  en  groupe  d' activit é s physiques diversifi é es elle sert d 'accompagnement  pour  entretenir,  améliorer,  dynamiser  la  santé,  le  bien-être  et  la  qualité  perçue de la vie  Méthode douce encore peu connue, elle allie  tonification, étirements et relâchement musculaire pour une  sensation immédiate de bien-être. ',
    '10h - 13h',
    'Lundi - Mardi',
    'Martine FERREIRA',
    null,
    'art.jpg'
  );
-- Structure de la table trainer


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `simple-mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `trainer`
--

DROP TABLE IF EXISTS `trainer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trainer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(155) NOT NULL,
  `lastname` varchar(155) NOT NULL,
  `phoneNumber` char(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(3) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainer`
--

/*!40000 ALTER TABLE `trainer` DISABLE KEYS */;
INSERT INTO `trainer` VALUES (1,'Nathan','Chapelle','0617864520','entraineur@rocs.com','Mr','trainer.jpeg');
/*!40000 ALTER TABLE `trainer` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;


--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `schedule` varchar(155) NOT NULL,
  `days` varchar(60) NOT NULL,
  `who` text NOT NULL,
  `trainer_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trainer_id` (`trainer_id`),
  CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainer` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity`
--

/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
INSERT INTO `activity` VALUES (2,'Roller de Vitesse',"Rouler c\'est être libre','19h à 20h30','Mardi - Jeudi','Pour les plus petits pleins d\'énergie et les plus grands compétiteurs",1);
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

--
-- Table structure for table `office`
--

DROP TABLE IF EXISTS `office`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `office` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `firstname` varchar(60) DEFAULT NULL,
  `lastname` varchar(60) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','$2y$10$ZbIZTzygRFIXoI5awo1oU.mDtx1Ingeale5IKGJGkl89KMTS99Lmu');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;


--
-- Contenu de la table `item`
--

INSERT INTO `item` (`id`, `title`) VALUES
(1, 'Stuff'),
(2, 'Doodads');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
