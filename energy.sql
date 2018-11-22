-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 12 avr. 2018 à 06:37
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `energy`
--

-- --------------------------------------------------------

--
-- Structure de la table `bans`
--

DROP TABLE IF EXISTS `bans`;
CREATE TABLE IF NOT EXISTS `bans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emailmj` varchar(255) DEFAULT NULL,
  `serveur` varchar(255) DEFAULT NULL,
  `userban` varchar(255) NOT NULL,
  `raisons` varchar(255) DEFAULT NULL,
  `tempban` varchar(255) DEFAULT NULL,
  `pseudomj` varchar(255) DEFAULT NULL,
  `send` varchar(1) NOT NULL DEFAULT '0',
  `pseudom` varchar(255) DEFAULT NULL,
  `m_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `bans`
--

INSERT INTO `bans` (`id`, `emailmj`, `serveur`, `userban`, `raisons`, `tempban`, `pseudomj`, `send`, `pseudom`, `m_date`) VALUES
(23, 'alexdsp@outlook.fr', 'EnergyCheat', 'qsgqsg', 'qsg', '50', 'Soow', '1', NULL, NULL),
(28, 'alexdsp@outlook.fr', 'EnergyFight', 'TEST', 'zsrgerseg', '10', 'Sowo', '1', NULL, NULL),
(25, 'alexdsp@outlook.fr', 'EnergyCheat', 'ezfgrfdf', 'sqqsdsdsdqseqf', '30', 'Soow', '1', NULL, NULL),
(26, 'alexdsp@outlook.fr', 'EnergyCheat', 'TEST', 'Spam', 'DÃ©finitif', 'Sowo', '1', NULL, NULL),
(27, 'alexdsp@outlook.fr', 'EnergyFight', 'TEDSXXTDF', '8976854', '10', 'Sowo', '1', NULL, NULL),
(29, 'alexdsp@outlook.fr', 'EnergyCheat', 'LOLOLI', '/*/-*/', '*-/*/-*/-*/-*/-', 'Sowo', '1', NULL, NULL),
(30, 'alexdsp@outlook.fr', 'EnergyCheat', 'efhdhfdqs', 'fhfdcfhdfwx', 'nhwdxnwx', 'Sowo', '1', NULL, NULL),
(31, 'alexdsp@outlook.fr', 'EnergyCheat', 'TA MERE LA PUTE', 'FDP', 'NTM', 'Sowo', '1', NULL, NULL),
(32, 'ddd@dddd.fr', 'EnergyCheat', 'dsfsdf', 'sdfsdf', '305613', 'Soow', '1', NULL, NULL),
(33, 'ddd@dddd.fr', 'EnergyCheat', 'Cheat', 'qegqsdgsq', '10', 'Soow', '1', NULL, NULL),
(34, 'ddd@dddd.fr', 'EnergyCheat', 'qfqfqs', 'ddgqsd', '10', 'Soow', '1', NULL, NULL),
(35, 'alexdsp@outlook.fr', 'EnergyCheat', 'qsgqsg', 'qsg', '50', 'Soow', '1', NULL, NULL),
(36, 'alexdsp@outlook.fr', 'EnergyCheat', 'ezfgrfdf', 'sqqsdsdsdqseqf', '30', 'Soow', '1', NULL, NULL),
(37, 'alexdsp@outlook.fr', 'EnergyCheat', 'TEST', 'Spam', 'DÃ©finitif', 'Sowo', '1', NULL, NULL),
(38, 'alexdsp@outlook.fr', 'EnergyFight', 'TEDSXXTDF', '8976854', '10', 'Sowo', '1', NULL, NULL),
(39, 'alexdsp@outlook.fr', 'EnergyFight', 'TEST', 'zsrgerseg', '10', 'Sowo', '1', NULL, NULL),
(40, 'alexdsp@outlook.fr', 'EnergyCheat', 'LOLOLI', '/*/-*/', '*-/*/-*/-*/-*/-', 'Sowo', '1', NULL, NULL),
(41, 'alexdsp@outlook.fr', 'EnergyCheat', 'efhdhfdqs', 'fhfdcfhdfwx', 'nhwdxnwx', 'Sowo', '1', NULL, NULL),
(42, 'alexdsp@outlook.fr', 'EnergyCheat', 'TA MERE LA PUTE', 'FDP', 'NTM', 'Sowo', '1', NULL, NULL),
(43, 'ddd@dddd.fr', 'EnergyCheat', 'dsfsdf', 'sdfsdf', '305613', 'Soow', '1', NULL, NULL),
(45, 'ddd@dddd.fr', 'EnergyCheat', 'qfqfqs', 'ddgqsd', '10', 'Soow', '1', NULL, NULL),
(46, 'alexdrey@hotmail.fr', 'EnergyFight', 'Pistouille', 'Refus de vÃ©rif', '40', 'Zorak', '1', NULL, NULL),
(47, 'alexdrey@hotmail.fr', 'EnergyFight', 'Pistouille', 'Refus de vÃ©rif', '40', 'Zorak', '1', 'Sowo', '2018-04-08 07:40:15'),
(48, 'alexdsp@outlook.fr', 'EnergyFight', 'TEST', 'zsrgerseg', '10', 'Sowo', '1', NULL, NULL),
(49, 'alexdsp@outlook.fr', 'EnergyFight', 'TEDSXXTDF', '8976854', '10', 'Sowo', '1', NULL, NULL),
(50, 'alexdsp@outlook.fr', 'EnergyFight', 'TEDSXXTDF', '8976854', '10', 'Sowo', '1', NULL, NULL),
(51, 'alexdsp@outlook.fr', 'EnergyFight', 'TEST', 'zsrgerseg', '10', 'Sowo', '1', NULL, NULL),
(52, 'alexdrey@hotmail.fr', 'EnergyFight', 'Pistouille', 'Refus de vÃ©rif', '40', 'Zorak', '1', NULL, NULL),
(53, 'alexdrey@hotmail.fr', 'EnergyFight', 'Pistouille', 'Refus de vÃ©rif', '40', 'Zorak', '1', 'Sowo', '2018-04-08 07:47:48'),
(54, 'alexdsp@outlook.fr', 'EnergyFight', 'TEST', 'zsrgerseg', '10', 'Sowo', '1', NULL, NULL),
(55, 'alexdsp@outlook.fr', 'EnergyFight', 'TEDSXXTDF', '8976854', '10', 'Sowo', '1', NULL, NULL),
(56, 'alexdsp@outlook.fr', 'EnergyFight', 'TEDSXXTDF', '8976854', '10', 'Sowo', '1', NULL, NULL),
(57, 'alexdsp@outlook.fr', 'EnergyFight', 'TEST', 'zsrgerseg', '10', 'Sowo', '1', NULL, NULL),
(58, 'alexdrey@hotmail.fr', 'EnergyFight', 'Pistouille', 'Refus de vÃ©rif', '40', 'Zorak', '1', NULL, NULL),
(59, 'alexdrey@hotmail.fr', 'EnergyFight', 'Pistouille', 'Refus de vÃ©rif', '40', 'Zorak', '1', 'Sowo', '2018-04-08 07:47:50'),
(60, 'alexdsp@outlook.fr', 'EnergyFight', 'TEST', 'zsrgerseg', '10', 'Sowo', '1', NULL, NULL),
(61, 'ddd@dddd.fr', 'EnergyFight', 'qsf', 'ssf', '30', 'Soow', '1', 'Sowo', '2018-04-08 17:48:51'),
(62, 'ddd@dddd.fr', 'EnergyCheat', 'qgsqdgsqgqsgqsqsg', 'PUTEUD', '80', 'Soow', '1', 'Sowo', '2018-04-08 17:48:45'),
(63, 'alexdrey@hotmail.fr', 'EnergyFight', 'Pistouille', 'Refus de vÃ©rif', '40', 'Zorak', '1', NULL, NULL),
(64, 'alexdrey@hotmail.fr', 'EnergyFight', 'Pistouille', 'Refus de vÃ©rif', '40', 'Zorak', '1', 'Sowo', '2018-04-08 07:47:50'),
(65, 'alexdsp@outlook.fr', 'EnergyFight', 'TEST', 'zsrgerseg', '10', 'Sowo', '1', NULL, NULL),
(66, 'ddd@dddd.fr', 'EnergyFight', 'qsf', 'ssf', '30', 'Soow', '1', 'Sowo', '2018-04-08 17:48:51'),
(88, 'ddd@dddd.fr', 'EnergyCheat', 'dfhdsh', 'jkjkjkjkjjk', '123', 'Soow', '0', NULL, NULL),
(85, 'ddd@dddd.fr', 'EnergyCheat', 'sdjdjd', 'gjsfj', '0', 'Soow', '0', NULL, NULL),
(86, 'ddd@dddd.fr', 'EnergyCheat', 'sqdgsqdg', 'sdgsqdgs', '0', 'Soow', '0', NULL, NULL),
(87, 'ddd@dddd.fr', 'EnergyCheat', 'qsdgsqg', 'sdqgsqdg', '0', 'Soow', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirmation_token` varchar(60) DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `reset_token` varchar(60) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `remember_token` varchar(250) DEFAULT NULL,
  `rank` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `confirmation_token`, `confirmed_at`, `reset_token`, `reset_at`, `remember_token`, `rank`) VALUES
(22, 'Sowo', 'alexdsp@outlook.fr', '$2y$10$tJ5UFvTUcXbDCMmVrSHmsOrc9cyQKF9HY60TGkXy6ByqLnksyQbcW', NULL, '2018-04-04 20:56:27', NULL, NULL, '42dQ6PM8I38fEcNebIioALbbImAjblJdIhGFR4ZfYdex3hCjIKPHNdfcqqIlEI6wIKnKjx03dsEgMhurI35o9ul5WhGWWILfheqVfXtRlIgSHYRCwf7yQAT1DjNFfFBCOu1KbfTswQgPL8YJKw8Kk61nL8bLSId0Veb37lhxsjmrDJ3Pg6SuPuIG2EQBt6tozhaVCOPXZk3YZdOHEs9zgsTwvjq0eNU9DzS6Cv164R7WOD82Rnp9dQhw0a', '4'),
(23, 'Soow', 'ddd@dddd.fr', '$2y$10$tJ5UFvTUcXbDCMmVrSHmsOrc9cyQKF9HY60TGkXy6ByqLnksyQbcW', NULL, '2018-04-04 20:56:27', NULL, NULL, '42dQ6PM8I38fEcNebIioALbbImAjblJdIhGFR4ZfYdex3hCjIKPHNdfcqqIlEI6wIKnKjx03dsEgMhurI35o9ul5WhGWWILfheqVfXtRlIgSHYRCwf7yQAT1DjNFfFBCOu1KbfTswQgPL8YJKw8Kk61nL8bLSId0Veb37lhxsjmrDJ3Pg6SuPuIG2EQBt6tozhaVCOPXZk3YZdOHEs9zgsTwvjq0eNU9DzS6Cv164R7WOD82Rnp9dQhw0a', '2C'),
(24, 'Zorak', 'alexdrey@hotmail.fr', '$2y$10$sDXMv0M1rkUaV2znBW9VBOI0waZH5wcxtDSET1XtWFP2.tSRA4lQS', NULL, '2018-04-07 03:57:00', NULL, NULL, NULL, '2C');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
