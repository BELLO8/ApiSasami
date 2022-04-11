-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 11 avr. 2022 à 14:45
-- Version du serveur :  5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `takecareof_bd`
--

-- --------------------------------------------------------

--
-- Structure de la table `alerte`
--

CREATE TABLE `alerte` (
  `id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `incident` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `assigner`
--

CREATE TABLE `assigner` (
  `id` int(11) NOT NULL,
  `frequenceD` int(3) DEFAULT NULL,
  `dates` date DEFAULT NULL,
  `id_personneV` int(11) DEFAULT NULL,
  `id_dispositif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `constante`
--

CREATE TABLE `constante` (
  `id` int(11) NOT NULL,
  `temperature` double DEFAULT NULL,
  `nombre_pas` double DEFAULT NULL,
  `frequence_res` double DEFAULT NULL,
  `rythme_card` double DEFAULT NULL,
  `dates` date DEFAULT NULL,
  `id_assigner` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `dispositif`
--

CREATE TABLE `dispositif` (
  `id` int(11) NOT NULL,
  `ref` varchar(15) DEFAULT NULL,
  `fiche` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `incident`
--

CREATE TABLE `incident` (
  `id` int(11) NOT NULL,
  `libincident` varchar(255) DEFAULT NULL,
  `id_dispositif` int(11) NOT NULL,
  `dates` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2022_04_11_144156_create_alerte_table', 0),
(2, '2022_04_11_144156_create_assigner_table', 0),
(3, '2022_04_11_144156_create_constante_table', 0),
(4, '2022_04_11_144156_create_dispositif_table', 0),
(5, '2022_04_11_144156_create_incident_table', 0),
(6, '2022_04_11_144156_create_personneAffilee_table', 0),
(7, '2022_04_11_144156_create_personneVulnerable_table', 0),
(8, '2022_04_11_144156_create_profiling_table', 0),
(9, '2022_04_11_144156_create_serviceUrgence_table', 0),
(10, '2022_04_11_144156_create_surveiller_table', 0),
(11, '2022_04_11_144156_create_users_table', 0),
(12, '2022_04_11_144157_add_foreign_keys_to_alerte_table', 0),
(13, '2022_04_11_144157_add_foreign_keys_to_assigner_table', 0),
(14, '2022_04_11_144157_add_foreign_keys_to_constante_table', 0),
(15, '2022_04_11_144157_add_foreign_keys_to_incident_table', 0),
(16, '2022_04_11_144157_add_foreign_keys_to_profiling_table', 0),
(17, '2022_04_11_144157_add_foreign_keys_to_serviceUrgence_table', 0),
(18, '2022_04_11_144157_add_foreign_keys_to_surveiller_table', 0);

-- --------------------------------------------------------

--
-- Structure de la table `personneAffilee`
--

CREATE TABLE `personneAffilee` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `adresse` varchar(25) DEFAULT NULL,
  `telephone` varchar(10) DEFAULT NULL,
  `age` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `personneVulnerable`
--

CREATE TABLE `personneVulnerable` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `adresse` varchar(25) DEFAULT NULL,
  `telephone` varchar(10) DEFAULT NULL,
  `age` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `profiling`
--

CREATE TABLE `profiling` (
  `id` int(11) NOT NULL,
  `temperatureM` double DEFAULT NULL,
  `nombre_pasM` double DEFAULT NULL,
  `frequence_resM` double DEFAULT NULL,
  `rythme_cardM` double DEFAULT NULL,
  `dates` date DEFAULT NULL,
  `id_assigner` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `serviceUrgence`
--

CREATE TABLE `serviceUrgence` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `telephone` varchar(10) DEFAULT NULL,
  `fixe` varchar(10) DEFAULT NULL,
  `alerte` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `surveiller`
--

CREATE TABLE `surveiller` (
  `id` int(11) NOT NULL,
  `personne_vulnerable` int(11) DEFAULT NULL,
  `personne_Affilee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `alerte`
--
ALTER TABLE `alerte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_incident` (`incident`);

--
-- Index pour la table `assigner`
--
ALTER TABLE `assigner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_dispositif` (`id_dispositif`),
  ADD KEY `FK_personneV` (`id_personneV`);

--
-- Index pour la table `constante`
--
ALTER TABLE `constante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_assigner` (`id_assigner`);

--
-- Index pour la table `dispositif`
--
ALTER TABLE `dispositif`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `incident`
--
ALTER TABLE `incident`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_dispositifs` (`id_dispositif`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `personneAffilee`
--
ALTER TABLE `personneAffilee`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `personneVulnerable`
--
ALTER TABLE `personneVulnerable`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `profiling`
--
ALTER TABLE `profiling`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_assigners` (`id_assigner`);

--
-- Index pour la table `serviceUrgence`
--
ALTER TABLE `serviceUrgence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_alerte` (`alerte`);

--
-- Index pour la table `surveiller`
--
ALTER TABLE `surveiller`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_personne_Affilee` (`personne_Affilee`),
  ADD KEY `fk_personne_vulnerable` (`personne_vulnerable`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `alerte`
--
ALTER TABLE `alerte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `assigner`
--
ALTER TABLE `assigner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `constante`
--
ALTER TABLE `constante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `dispositif`
--
ALTER TABLE `dispositif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `incident`
--
ALTER TABLE `incident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `personneAffilee`
--
ALTER TABLE `personneAffilee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `personneVulnerable`
--
ALTER TABLE `personneVulnerable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `profiling`
--
ALTER TABLE `profiling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `serviceUrgence`
--
ALTER TABLE `serviceUrgence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `surveiller`
--
ALTER TABLE `surveiller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `alerte`
--
ALTER TABLE `alerte`
  ADD CONSTRAINT `fk_incident` FOREIGN KEY (`incident`) REFERENCES `incident` (`id`);

--
-- Contraintes pour la table `assigner`
--
ALTER TABLE `assigner`
  ADD CONSTRAINT `FK_dispositif` FOREIGN KEY (`id_dispositif`) REFERENCES `dispositif` (`id`),
  ADD CONSTRAINT `FK_personneV` FOREIGN KEY (`id_personneV`) REFERENCES `personneVulnerable` (`id`);

--
-- Contraintes pour la table `constante`
--
ALTER TABLE `constante`
  ADD CONSTRAINT `FK_assigner` FOREIGN KEY (`id_assigner`) REFERENCES `assigner` (`id`);

--
-- Contraintes pour la table `incident`
--
ALTER TABLE `incident`
  ADD CONSTRAINT `FK_dispositifs` FOREIGN KEY (`id_dispositif`) REFERENCES `dispositif` (`id`);

--
-- Contraintes pour la table `profiling`
--
ALTER TABLE `profiling`
  ADD CONSTRAINT `FK_assigners` FOREIGN KEY (`id_assigner`) REFERENCES `assigner` (`id`);

--
-- Contraintes pour la table `serviceUrgence`
--
ALTER TABLE `serviceUrgence`
  ADD CONSTRAINT `fk_alerte` FOREIGN KEY (`alerte`) REFERENCES `alerte` (`id`);

--
-- Contraintes pour la table `surveiller`
--
ALTER TABLE `surveiller`
  ADD CONSTRAINT `fk_personne_Affilee` FOREIGN KEY (`personne_Affilee`) REFERENCES `personneAffilee` (`id`),
  ADD CONSTRAINT `fk_personne_vulnerable` FOREIGN KEY (`personne_vulnerable`) REFERENCES `personneVulnerable` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
