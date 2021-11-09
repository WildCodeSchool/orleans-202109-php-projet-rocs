-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 26 Octobre 2017 à 13:53
-- Version du serveur :  5.7.19-0ubuntu0.16.04.1
-- Version de PHP :  7.0.22-0ubuntu0.16.04.1

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
-- Structure de la table `item`
--

CREATE TABLE `item` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



--
-- Structure de la table activity
-- /!\ Need to import trainer table before /!\
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
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trainer_id` (`trainer_id`),
  CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainer` (`id`)
) 

--
insert into activity(id,name,description,schedule,days,who,trainer_id,image) values('2','Course à pied','La course à pied est, avec la marche, l'un des deux modes de locomotion bipèdes de l'être humain. Caractérisée par une phase de suspension durant laquelle aucun des deux pieds ne touche le sol, elle permet un déplacement plus économe en énergie que la marche pour des vitesses allant d'environ 6 km/h à plus de 40 km/h.','19h à 20h30','Mardi - Jeudi','Pour les plus petits pleins d'énergie et les plus grands compétiteurs','1','run.jpg');
insert into activity(id,name,description,schedule,days,who,trainer_id,image) values('3','Artistique','Pratique  éducative,  de  proximité  et  en  groupe  d'activités  physiques  diversifiées  elle  sert  d'accompagnement  pour  entretenir,  améliorer,  dynamiser  la  santé,  le  bien-être  et  la  qualité  perçue de la vie  Méthode douce encore peu connue, elle allie  tonification, étirements et relâchement musculaire pour une  sensation immédiate de bien-être. ','10h - 13h','Lundi - Mardi','Martine FERREIRA',null,'art.jpg');

-- Structure de la table trainer
--
CREATE TABLE `trainer` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `firstname` VARCHAR(155) NOT NULL,
  `lastname` VARCHAR(155) NOT NULL,
  `phoneNumber` CHARACTER(10) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `gender`VARCHAR(3),
  `image` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Contenu de la table `trainer`
--
INSERT INTO `trainer` (
  `firstname`,
  `lastname`,
  `phoneNumber`,
  `email`,
  `gender`,
  `image`
) VALUES (
  'Nathan',
  'Chapelle',
  '0617864520',
  'entraineur@rocs.com',
  'Mr',
  'trainer.jpeg'
);

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
