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

CREATE TABLE `activity` (
  `id`INT AUTO_INCREMENT NOT NULL,
  `name`VARCHAR(100) NOT NULL,
  `description` TEXT NOT NULL,
  `schedule`VARCHAR(155) NOT NULL,
  `days`VARCHAR(60) NOT NULL,
    `who`TEXT NOT NULL,
  `trainer_id` INT,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`trainer_id`) REFERENCES trainer(`id`)
);

--
-- Contenu de la table `activity`
--

INSERT INTO `activity` (
  `name`,
  `description`,
  `schedule`,
  `days`,
  `who`,
  `trainer_id`
) VALUES (
  'Roller de Vitesse',
  "Rouler c'est être libre",
  '19h à 20h30',
  'Mardi - Jeudi',
  "Pour les plus petits pleins d'énergie et les plus grands compétiteurs",
  '1'
);

--
-- Structure de la table trainer
--
CREATE TABLE `trainer` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `firstname` VARCHAR(155) NOT NULL,
  `lastname` VARCHAR(155) NOT NULL,
  `phoneNumber` CHARACTER(10) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `gender`VARCHAR(3),
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
  `gender`
) VALUES (
  'Nathan',
  'Chapelle',
  '0617864520',
  'entraineur@rocs.com',
  'Mr'
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
