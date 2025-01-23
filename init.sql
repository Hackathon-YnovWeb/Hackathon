SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `hackathon`;
USE `hackathon`;

-- Structure de la table `messages`
CREATE TABLE `messages` (
                            `id` int(11) NOT NULL,
                            `author` varchar(255) NOT NULL,
                            `text` text NOT NULL,
                            `time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `messages`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `messages`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

-- Structure de la table `info`
CREATE TABLE `info` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `nom` varchar(255) NOT NULL,
                        `description` text,
                        `niveauDanger` varchar(50) NOT NULL,
                        `type` varchar(100) NOT NULL,
                        `date` datetime NOT NULL,
                        `zone` int(11) NOT NULL,
                        `intensite_valeur` decimal(10,2),
                        `intensite_unite` varchar(50),
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Structure de la table `activities`
CREATE TABLE `activities` (
                              `id` int(11) NOT NULL AUTO_INCREMENT,
                              `nom` varchar(255) NOT NULL,
                              `type` varchar(100) NOT NULL,
                              `description` text,
                              `dateEtHeure` datetime NOT NULL,
                              `danger` varchar(255) NOT NULL,
                              `nombreDeParticipants` int(11) NOT NULL,
                              `zone` int(11) NOT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertion d'un exemple dans la table activities
INSERT INTO `activities` (`nom`, `type`, `description`, `dateEtHeure`, `danger`, `nombreDeParticipants`, `zone`)
VALUES (
           'Course en radeau improvisé',
           'inondation',
           'Fabriquez un radeau avec des matériaux recyclés et naviguez sur un parcours aquatique.',
           '2025-03-10 10:00:00',
           'Modéré : attention aux éclaboussures.',
           8,
           2
       );

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;