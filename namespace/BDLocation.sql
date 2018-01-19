-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 18 Janvier 2018 à 13:53
-- Version du serveur :  5.7.20-0ubuntu0.16.04.1
-- Version de PHP :  7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `BDLocation`
--

-- --------------------------------------------------------

--
-- Structure de la table `Bien`
--

CREATE TABLE `Bien` (
  `id` int(11) NOT NULL,
  `Nom` varchar(32) NOT NULL,
  `adress` varchar(32) NOT NULL,
  `montantLocation` int(15) NOT NULL,
  `commission` varchar(30) NOT NULL,
  `idTypeBien` int(11) NOT NULL,
  `idProprietaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Bien`
--

INSERT INTO `Bien` (`id`, `Nom`, `adress`, `montantLocation`, `commission`, `idTypeBien`, `idProprietaire`) VALUES
(1, 'Portable', 'Dakar', 500000, '2', 1, 6),
(2, 'Ventilateur', 'Thies', 500000, '5', 2, 9),
(6, 'voiture', 'guediawye', 250000, '2', 8, 15),
(7, 'Montre', 'hamo', 2000, '2', 9, 6);

-- --------------------------------------------------------

--
-- Structure de la table `Proprietaire`
--

CREATE TABLE `Proprietaire` (
  `id` int(11) NOT NULL,
  `numPiece` varchar(15) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `tel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Proprietaire`
--

INSERT INTO `Proprietaire` (`id`, `numPiece`, `Nom`, `tel`) VALUES
(6, '1766199602229', 'Saliou GNING', '781025004'),
(7, '012552', 'Fatou Mbathi', '78451266'),
(9, '0124896542', 'Maguette', '77548220'),
(15, '125478522', 'Malick', '7784522'),
(16, '123456789', 'samba ka', '0000000');

-- --------------------------------------------------------

--
-- Structure de la table `typeBien`
--

CREATE TABLE `typeBien` (
  `id` int(11) NOT NULL,
  `Nom` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `typeBien`
--

INSERT INTO `typeBien` (`id`, `Nom`) VALUES
(1, 'Informatique'),
(2, 'Electroménager'),
(5, 'fdsq'),
(6, 'azdsc'),
(7, ''),
(8, 'vehicule'),
(9, 'electronique');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nomComplet` varchar(32) DEFAULT NULL,
  `login` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `profil` varchar(32) DEFAULT NULL,
  `etat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nomComplet`, `login`, `password`, `profil`, `etat`) VALUES
(1, 'saliou', 'admin', 'admin', 'admin', 1),
(2, 'basse', 'user', 'user', 'agent', 1),
(3, 'Maguette', 'maguisha', 'passer', 'gerant', 0),
(5, 'Moustapha', 'tapha', 'passer', 'admin', -1),
(6, 'ahmadou diop', 'ahmad', 'secret', 'agent', 1),
(7, 'PathÃ© Gueye', 'pathe', 'secret', 'gerant', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Bien`
--
ALTER TABLE `Bien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bien_prop` (`idProprietaire`),
  ADD KEY `fk_bien_type` (`idTypeBien`);

--
-- Index pour la table `Proprietaire`
--
ALTER TABLE `Proprietaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeBien`
--
ALTER TABLE `typeBien`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Bien`
--
ALTER TABLE `Bien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `Proprietaire`
--
ALTER TABLE `Proprietaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `typeBien`
--
ALTER TABLE `typeBien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
