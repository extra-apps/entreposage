-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 04 nov. 2022 à 19:57
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `entreposage`
--
CREATE DATABASE IF NOT EXISTS `entreposage` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `entreposage`;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `idadmin` int(11) NOT NULL,
  `nom` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `telephone` varchar(128) DEFAULT NULL,
  `mdp` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `idclient` int(11) NOT NULL,
  `nomclient` varchar(128) DEFAULT NULL,
  `telephone` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `mdp` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `idcompte` int(11) NOT NULL,
  `login` varchar(128) DEFAULT NULL,
  `pwd` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `declarant`
--

CREATE TABLE `declarant` (
  `iddeclarant` int(11) NOT NULL,
  `nomdeclarant` varchar(128) DEFAULT NULL,
  `codedeclarant` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `mdp` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `declaration`
--

CREATE TABLE `declaration` (
  `iddeclaration` int(11) NOT NULL,
  `iddeclarant` int(11) NOT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `numero_declaration` varchar(128) DEFAULT NULL,
  `numero_liquidation` varchar(128) DEFAULT NULL,
  `qte` int(11) DEFAULT NULL,
  `idmarchandise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `detailentree`
--

CREATE TABLE `detailentree` (
  `iddetailentree` int(11) NOT NULL,
  `qteentree` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `detailsortie`
--

CREATE TABLE `detailsortie` (
  `iddetailsortie` int(11) NOT NULL,
  `qtesortie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `entree`
--

CREATE TABLE `entree` (
  `identree` int(11) NOT NULL,
  `numeroentree` varchar(128) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `immat` varchar(128) DEFAULT NULL,
  `nomchauffeur` varchar(128) DEFAULT NULL,
  `qte` int(11) DEFAULT NULL,
  `idmarchandise` int(11) NOT NULL,
  `idverificateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `marchandise`
--

CREATE TABLE `marchandise` (
  `idmarchandise` int(11) NOT NULL,
  `code` varchar(128) DEFAULT NULL,
  `nommarchandise` varchar(128) DEFAULT NULL,
  `typemarchandise` varchar(128) DEFAULT NULL,
  `iddeclarant` int(11) NOT NULL,
  `dateajout` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `idnotification` int(11) NOT NULL,
  `contenu` text DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `parametre`
--

CREATE TABLE `parametre` (
  `idparametre` int(11) NOT NULL,
  `nomparametre` varchar(128) DEFAULT NULL,
  `reglage` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `quittance`
--

CREATE TABLE `quittance` (
  `idquittance` int(11) NOT NULL,
  `numero_quittance` varchar(128) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `montant` varchar(128) DEFAULT NULL,
  `taux` varchar(128) DEFAULT NULL,
  `reference` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sortie`
--

CREATE TABLE `sortie` (
  `idsortie` int(11) NOT NULL,
  `numerosortie` text DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `immat` varchar(128) DEFAULT NULL,
  `nomchauffeur` varchar(128) DEFAULT NULL,
  `qte` int(11) DEFAULT NULL,
  `idmarchandise` int(11) NOT NULL,
  `idverificateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `verificateur`
--

CREATE TABLE `verificateur` (
  `idverificateur` int(11) NOT NULL,
  `codeverif` varchar(128) DEFAULT NULL,
  `nomverif` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `mdp` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idclient`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`idcompte`);

--
-- Index pour la table `declarant`
--
ALTER TABLE `declarant`
  ADD PRIMARY KEY (`iddeclarant`);

--
-- Index pour la table `declaration`
--
ALTER TABLE `declaration`
  ADD PRIMARY KEY (`iddeclaration`),
  ADD KEY `fk_declaration_declarant_idx` (`iddeclarant`),
  ADD KEY `fk_declaration_marchandise1_idx` (`idmarchandise`);

--
-- Index pour la table `detailentree`
--
ALTER TABLE `detailentree`
  ADD PRIMARY KEY (`iddetailentree`);

--
-- Index pour la table `detailsortie`
--
ALTER TABLE `detailsortie`
  ADD PRIMARY KEY (`iddetailsortie`);

--
-- Index pour la table `entree`
--
ALTER TABLE `entree`
  ADD PRIMARY KEY (`identree`),
  ADD KEY `fk_entree_marchandise1_idx` (`idmarchandise`),
  ADD KEY `fk_entree_verificateur1_idx` (`idverificateur`);

--
-- Index pour la table `marchandise`
--
ALTER TABLE `marchandise`
  ADD PRIMARY KEY (`idmarchandise`),
  ADD KEY `fk_marchandise_declarant1_idx` (`iddeclarant`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`idnotification`);

--
-- Index pour la table `parametre`
--
ALTER TABLE `parametre`
  ADD PRIMARY KEY (`idparametre`);

--
-- Index pour la table `quittance`
--
ALTER TABLE `quittance`
  ADD PRIMARY KEY (`idquittance`);

--
-- Index pour la table `sortie`
--
ALTER TABLE `sortie`
  ADD PRIMARY KEY (`idsortie`),
  ADD KEY `fk_sortie_marchandise1_idx` (`idmarchandise`),
  ADD KEY `fk_sortie_verificateur1_idx` (`idverificateur`);

--
-- Index pour la table `verificateur`
--
ALTER TABLE `verificateur`
  ADD PRIMARY KEY (`idverificateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `idadmin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `idclient` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `idcompte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `declarant`
--
ALTER TABLE `declarant`
  MODIFY `iddeclarant` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `declaration`
--
ALTER TABLE `declaration`
  MODIFY `iddeclaration` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `detailentree`
--
ALTER TABLE `detailentree`
  MODIFY `iddetailentree` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `detailsortie`
--
ALTER TABLE `detailsortie`
  MODIFY `iddetailsortie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `entree`
--
ALTER TABLE `entree`
  MODIFY `identree` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `marchandise`
--
ALTER TABLE `marchandise`
  MODIFY `idmarchandise` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `idnotification` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `parametre`
--
ALTER TABLE `parametre`
  MODIFY `idparametre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `quittance`
--
ALTER TABLE `quittance`
  MODIFY `idquittance` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sortie`
--
ALTER TABLE `sortie`
  MODIFY `idsortie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `verificateur`
--
ALTER TABLE `verificateur`
  MODIFY `idverificateur` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `declaration`
--
ALTER TABLE `declaration`
  ADD CONSTRAINT `fk_declaration_declarant` FOREIGN KEY (`iddeclarant`) REFERENCES `declarant` (`iddeclarant`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_declaration_marchandise1` FOREIGN KEY (`idmarchandise`) REFERENCES `marchandise` (`idmarchandise`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `entree`
--
ALTER TABLE `entree`
  ADD CONSTRAINT `fk_entree_marchandise1` FOREIGN KEY (`idmarchandise`) REFERENCES `marchandise` (`idmarchandise`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_entree_verificateur1` FOREIGN KEY (`idverificateur`) REFERENCES `verificateur` (`idverificateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `marchandise`
--
ALTER TABLE `marchandise`
  ADD CONSTRAINT `fk_marchandise_declarant1` FOREIGN KEY (`iddeclarant`) REFERENCES `declarant` (`iddeclarant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `sortie`
--
ALTER TABLE `sortie`
  ADD CONSTRAINT `fk_sortie_marchandise1` FOREIGN KEY (`idmarchandise`) REFERENCES `marchandise` (`idmarchandise`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sortie_verificateur1` FOREIGN KEY (`idverificateur`) REFERENCES `verificateur` (`idverificateur`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
