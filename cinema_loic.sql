-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour cinema_loic
CREATE DATABASE IF NOT EXISTS `cinema_loic` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cinema_loic`;

-- Listage de la structure de la table cinema_loic. acteur
CREATE TABLE IF NOT EXISTS `acteur` (
  `id_acteur` int(11) NOT NULL AUTO_INCREMENT,
  `personne_id` int(11) NOT NULL,
  PRIMARY KEY (`id_acteur`),
  KEY `personne_id` (`personne_id`),
  CONSTRAINT `FK_acteur_personne` FOREIGN KEY (`personne_id`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_loic.acteur : ~23 rows (environ)
/*!40000 ALTER TABLE `acteur` DISABLE KEYS */;
INSERT INTO `acteur` (`id_acteur`, `personne_id`) VALUES
	(1, 2),
	(2, 3),
	(3, 4),
	(4, 5),
	(5, 7),
	(6, 8),
	(7, 9),
	(8, 10),
	(9, 12),
	(10, 13),
	(11, 14),
	(12, 15),
	(13, 17),
	(14, 18),
	(15, 18),
	(16, 19),
	(17, 20),
	(18, 22),
	(19, 23),
	(20, 24),
	(21, 26),
	(22, 27),
	(23, 28);
/*!40000 ALTER TABLE `acteur` ENABLE KEYS */;

-- Listage de la structure de la table cinema_loic. film
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `dateSortie` date DEFAULT NULL,
  `dureeMinutes` int(11) DEFAULT NULL,
  `note` int(11) DEFAULT NULL,
  `affiche` varchar(50) DEFAULT NULL,
  `realisateur_id` int(11) NOT NULL,
  PRIMARY KEY (`id_film`),
  KEY `realisateur_id` (`realisateur_id`),
  CONSTRAINT `FK_film_realisateur` FOREIGN KEY (`realisateur_id`) REFERENCES `realisateur` (`id_realisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_loic.film : ~6 rows (environ)
/*!40000 ALTER TABLE `film` DISABLE KEYS */;
INSERT INTO `film` (`id_film`, `titre`, `dateSortie`, `dureeMinutes`, `note`, `affiche`, `realisateur_id`) VALUES
	(1, 'Freddy', '1985-03-06', 91, 4, NULL, 1),
	(2, 'Je suis une légende', '2007-12-19', 100, 3, NULL, 2),
	(3, 'Indiana Jones', '2023-06-28', 154, 4, NULL, 3),
	(4, 'Roméo doit mourir', '2000-08-01', 115, 2, NULL, 4),
	(5, 'Danny the dog', '2005-02-02', 102, 3, NULL, 5),
	(6, 'Le baiser mortel du dragon', '2001-08-01', 98, 3, NULL, 6);
/*!40000 ALTER TABLE `film` ENABLE KEYS */;

-- Listage de la structure de la table cinema_loic. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_loic.genre : ~4 rows (environ)
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` (`id_genre`, `nom`) VALUES
	(1, 'horreur'),
	(2, 'science fiction'),
	(3, 'aventure'),
	(4, 'art marcial'),
	(5, 'action');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;

-- Listage de la structure de la table cinema_loic. jouer
CREATE TABLE IF NOT EXISTS `jouer` (
  `film_id` int(11) DEFAULT NULL,
  `acteur_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  KEY `film_id` (`film_id`),
  KEY `acteur_id` (`acteur_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `FK_jouer_acteur` FOREIGN KEY (`acteur_id`) REFERENCES `acteur` (`id_acteur`),
  CONSTRAINT `FK_jouer_film` FOREIGN KEY (`film_id`) REFERENCES `film` (`id_film`),
  CONSTRAINT `FK_jouer_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_loic.jouer : ~22 rows (environ)
/*!40000 ALTER TABLE `jouer` DISABLE KEYS */;
INSERT INTO `jouer` (`film_id`, `acteur_id`, `role_id`) VALUES
	(1, 1, 1),
	(1, 2, 2),
	(1, 3, 3),
	(1, 4, 4),
	(2, 5, 5),
	(2, 6, 6),
	(2, 7, 7),
	(2, 8, 8),
	(3, 9, 9),
	(3, 10, 10),
	(3, 11, 11),
	(3, 12, 12),
	(4, 13, 13),
	(4, 14, 14),
	(4, 15, 15),
	(4, 16, 16),
	(5, 13, 17),
	(5, 18, 18),
	(5, 19, 19),
	(5, 20, 20),
	(6, 13, 21),
	(6, 21, 22),
	(6, 22, 23),
	(6, 23, 24);
/*!40000 ALTER TABLE `jouer` ENABLE KEYS */;

-- Listage de la structure de la table cinema_loic. personne
CREATE TABLE IF NOT EXISTS `personne` (
  `id_personne` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `sexe` varchar(50) NOT NULL,
  `dateNaissance` date DEFAULT NULL,
  PRIMARY KEY (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_loic.personne : ~28 rows (environ)
/*!40000 ALTER TABLE `personne` DISABLE KEYS */;
INSERT INTO `personne` (`id_personne`, `nom`, `prenom`, `sexe`, `dateNaissance`) VALUES
	(1, 'Craven', 'Wes', 'homme', '1980-03-06'),
	(2, 'Englund', 'Robert', 'homme', '1986-12-15'),
	(3, 'Langenkamp', 'Heather', 'femme', '2003-05-03'),
	(4, 'Depp', 'Johnny', 'homme', '1953-01-23'),
	(5, 'Saxon', 'John', 'homme', '1933-03-05'),
	(6, 'Lawrence', 'Francis', 'homme', '1995-06-12'),
	(7, 'Smith', 'Will', 'homme', '1998-12-05'),
	(8, 'Braga', 'Alice', 'femme', '1970-12-27'),
	(9, 'Tahan', 'Charlie', 'homme', '1975-11-15'),
	(10, 'Richardson', 'Salli', 'femme', '1985-12-04'),
	(11, 'Mangold', 'James', 'homme', '2023-07-11'),
	(12, 'Ford', 'Harrison', 'homme', '2023-07-11'),
	(13, 'Phoebe', 'Waller-Bridge', 'femme', '1923-09-25'),
	(14, 'Mikkelsen', 'Mads', 'homme', '1945-09-25'),
	(15, 'Banderas', 'Antonio', 'homme', '1968-03-02'),
	(16, 'Bartkowiak', 'Andrzej', 'homme', '1968-09-25'),
	(17, 'Li', 'Jet', 'homme', '1952-02-18'),
	(18, 'Aaliyah', 'Danna', 'femme', '1995-06-15'),
	(19, 'Washington', 'Isaiah', 'homme', '1958-06-25'),
	(20, 'Wong', 'Russell', 'homme', '1932-09-15'),
	(21, 'Leterrier', 'Louis', 'homme', '1975-12-12'),
	(22, 'Hoskins', 'Bob', 'homme', '1986-03-19'),
	(23, 'Freeman', 'Morgan', 'homme', '1922-08-25'),
	(24, 'Condon', 'Kerry', 'femme', '1935-08-02'),
	(25, 'Nahon', 'Chris', 'homme', '1915-06-15'),
	(26, 'Fonda', 'Bridget', 'femme', '1910-10-01'),
	(27, 'Karyo', 'Tchéky', 'homme', '1932-02-14'),
	(28, 'Young', 'Ric', 'homme', '1982-05-20');
/*!40000 ALTER TABLE `personne` ENABLE KEYS */;

-- Listage de la structure de la table cinema_loic. posseder
CREATE TABLE IF NOT EXISTS `posseder` (
  `film_id` int(11) DEFAULT NULL,
  `genre_id` int(11) DEFAULT NULL,
  KEY `film_id` (`film_id`),
  KEY `genre_id` (`genre_id`),
  CONSTRAINT `FK_posseder_film` FOREIGN KEY (`film_id`) REFERENCES `film` (`id_film`),
  CONSTRAINT `FK_posseder_genre` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_loic.posseder : ~11 rows (environ)
/*!40000 ALTER TABLE `posseder` DISABLE KEYS */;
INSERT INTO `posseder` (`film_id`, `genre_id`) VALUES
	(1, 1),
	(2, 2),
	(2, 1),
	(3, 3),
	(4, 5),
	(4, 4),
	(5, 5),
	(5, 4),
	(6, 5),
	(6, 4);
/*!40000 ALTER TABLE `posseder` ENABLE KEYS */;

-- Listage de la structure de la table cinema_loic. realisateur
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id_realisateur` int(11) NOT NULL AUTO_INCREMENT,
  `personne_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_realisateur`),
  KEY `personne_id` (`personne_id`),
  CONSTRAINT `FK_realisateur_personne` FOREIGN KEY (`personne_id`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_loic.realisateur : ~6 rows (environ)
/*!40000 ALTER TABLE `realisateur` DISABLE KEYS */;
INSERT INTO `realisateur` (`id_realisateur`, `personne_id`) VALUES
	(1, 1),
	(2, 6),
	(3, 11),
	(4, 16),
	(5, 21),
	(6, 25);
/*!40000 ALTER TABLE `realisateur` ENABLE KEYS */;

-- Listage de la structure de la table cinema_loic. role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_loic.role : ~21 rows (environ)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id_role`, `nom`) VALUES
	(1, 'Freddy Krueger'),
	(2, 'Nancy Thompson'),
	(3, 'Glen Lantz'),
	(4, 'Lt Thompson'),
	(5, 'Robert Neville'),
	(6, 'Anna'),
	(7, 'Ethan'),
	(8, 'Zoe Neville'),
	(9, 'Indiana Jones'),
	(10, 'Helena Shaw'),
	(11, 'Jürgen Shaw'),
	(12, 'Renaldo'),
	(13, 'Han Sing'),
	(14, 'Trish O\'Day'),
	(15, 'Mac'),
	(16, 'Kai'),
	(17, 'Danny'),
	(18, 'Bart'),
	(19, 'Sam'),
	(20, 'Victoria'),
	(21, 'Liu Jian'),
	(22, 'Jessica'),
	(23, 'Jean-Pierre Richard'),
	(24, 'Mister Big');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
