-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.3.13-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para luisdorao_apellidos
CREATE DATABASE IF NOT EXISTS `luisdorao_apellidos` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `luisdorao_apellidos`;

-- Volcando estructura para tabla luisdorao_apellidos.alumnos
CREATE TABLE IF NOT EXISTS `alumnos` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) DEFAULT NULL,
  `apellido1` varchar(30) DEFAULT NULL,
  `apellido2` varchar(30) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `id_curso` varchar(3) DEFAULT NULL,
  `letra` varchar(1) DEFAULT NULL,
  `beca` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_id_curso` (`id_curso`),
  CONSTRAINT `FK_id_curso` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla luisdorao_apellidos.alumnos: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `alumnos` DISABLE KEYS */;
INSERT INTO `alumnos` (`id`, `nombre`, `apellido1`, `apellido2`, `email`, `id_curso`, `letra`, `beca`) VALUES
	(1, 'Alberto', 'Alonso', 'Albar', 'alonso.albar@mail.com', 'LH1', 'A', 50),
	(2, 'Belen', 'Balenciaga', 'Burgo', 'balenciaga.burgo@mail.com', 'HH3', 'A', 0),
	(3, 'Carlos', 'Cortes', 'Calatrava', 'cortes.calatrava@mail.com', 'LH3', 'B', 0),
	(4, 'David', 'Davila', 'Duran', 'davila.duran@mail.com', 'HH2', 'A', 0),
	(5, 'Elena', 'Estevez', 'Estebaez', 'estevez.estebanez@telefonica.net', 'LH6', 'B', 0),
	(6, 'Florentino', 'Fernandez', 'Flores', 'fernandez.flores@terra.com', 'LH4', 'A', 0),
	(7, 'Gema', 'Garcia', 'Gonzalez', 'garcia.gonzalez@euskaltel.eus', 'HH5', 'B', 0);
/*!40000 ALTER TABLE `alumnos` ENABLE KEYS */;

-- Volcando estructura para tabla luisdorao_apellidos.cursos
CREATE TABLE IF NOT EXISTS `cursos` (
  `id` varchar(3) NOT NULL,
  `curso_txt` varchar(25) DEFAULT NULL,
  `gasto_material` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla luisdorao_apellidos.cursos: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` (`id`, `curso_txt`, `gasto_material`) VALUES
	('HH2', 'Haur Hezkuntza 2 Urte', 30),
	('HH3', 'Haur Hezkuntza 3 Urte', 35),
	('HH4', 'Haur Hezkuntza 4 Urte', 40),
	('HH5', 'Haur Hezkuntza 5 Urte', 45),
	('LH1', 'Lehen Hezkuntza 1', 50),
	('LH2', 'Lehen Hezkuntza 2', 60),
	('LH3', 'Lehen Hezkuntza 3', 70),
	('LH4', 'Lehen Hezkuntza 4', 80),
	('LH5', 'Lehen Hezkuntza 5', 90),
	('LH6', 'Lehen Hezkuntza 6', 100);
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;

-- Volcando estructura para tabla luisdorao_apellidos.hermanos
CREATE TABLE IF NOT EXISTS `hermanos` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `apellido1` varchar(30) DEFAULT NULL,
  `apellido2` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla luisdorao_apellidos.hermanos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `hermanos` DISABLE KEYS */;
/*!40000 ALTER TABLE `hermanos` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
