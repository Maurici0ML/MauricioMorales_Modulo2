-- MariaDB dump 10.19  Distrib 10.4.18-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: MoralesMauInd
-- ------------------------------------------------------
-- Server version	10.4.18-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `libro`
--

DROP TABLE IF EXISTS `libro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libro` (
  `id_libro` smallint(6) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `creador` varchar(50) DEFAULT NULL,
  `año` year(4) DEFAULT NULL,
  `editorial` varchar(50) NOT NULL,
  `lugar` varchar(50) NOT NULL,
  PRIMARY KEY (`id_libro`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro`
--

LOCK TABLES `libro` WRITE;
/*!40000 ALTER TABLE `libro` DISABLE KEYS */;
INSERT INTO `libro` VALUES (1,'EL PRINCIPITO','ANTOINE DE SAINT EXUPERY',1943,'SALAMANDRA','MÉXICO'),(2,'NIEBLA','MIGUEL DE UNAMUNO',1914,'RENACIMIENTO','ESPAÑA'),(3,'LOS BANDIDOS DE RIO FRIO','MANUEL PAYNO',2010,'EPOCA','MÉXICO'),(4,'METAMORFOSIS','FRANZ KAFKA',2013,'ALIANZA','MÉXICO'),(5,'LA FAMILIA DE PASCUAL DUARTE','CAMILO JOSE CELA',1942,'ALDECOA','ESPAÑA');
/*!40000 ALTER TABLE `libro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `musica`
--

DROP TABLE IF EXISTS `musica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `musica` (
  `id_musica` smallint(6) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `creador` varchar(50) DEFAULT NULL,
  `año` year(4) DEFAULT NULL,
  `album` varchar(50) NOT NULL DEFAULT 'The Wall',
  PRIMARY KEY (`id_musica`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `musica`
--

LOCK TABLES `musica` WRITE;
/*!40000 ALTER TABLE `musica` DISABLE KEYS */;
INSERT INTO `musica` VALUES (1,'LONG COOL WOMAN','THE HOLLIES',1971,'DISTANT LIGHT'),(2,'DANI CALIFORNIA','RED HOT CHILLIE PEPPERS',2006,'STADIUM ARCADIUM'),(3,'PARADISE CITY','GUNS AND ROSES',1988,'APPETITE FOR DESTRUCTION'),(4,'YOU ONLY LIVE ONCE','THE STROKES',2005,'FIRST IMPRESSIONS OF EARTH'),(5,'BLAME','CALVIN HARRIS',2014,'MOTION');
/*!40000 ALTER TABLE `musica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pelicula`
--

DROP TABLE IF EXISTS `pelicula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pelicula` (
  `id_pelicula` smallint(6) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `creador` varchar(50) DEFAULT NULL,
  `año` year(4) DEFAULT NULL,
  `actorPrincip` varchar(50) NOT NULL,
  `clasificacion` enum('AA','A','B','B15','C') NOT NULL DEFAULT 'AA',
  PRIMARY KEY (`id_pelicula`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pelicula`
--

LOCK TABLES `pelicula` WRITE;
/*!40000 ALTER TABLE `pelicula` DISABLE KEYS */;
/*!40000 ALTER TABLE `pelicula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videojuego`
--

DROP TABLE IF EXISTS `videojuego`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videojuego` (
  `id_videojuego` smallint(6) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `creador` varchar(50) DEFAULT NULL,
  `año` year(4) DEFAULT NULL,
  `protagonista` varchar(50) NOT NULL DEFAULT 'Sans',
  PRIMARY KEY (`id_videojuego`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videojuego`
--

LOCK TABLES `videojuego` WRITE;
/*!40000 ALTER TABLE `videojuego` DISABLE KEYS */;
INSERT INTO `videojuego` VALUES (1,'THE LAST OF US','NAUGHTY DOG',2013,'JOEL'),(2,'GTA SAN ANDREAS','ROCKSTAR GAMES',2004,'CARL JOHNSON'),(3,'SILENT HILL','KONAMI',1999,'HARRY MASON'),(4,'DARKSIDERS','VIGIL GAMES',2010,'JINETE GUERRA'),(5,'MINECRAFT','MOJANG STUDIOS',2011,'STEVE');
/*!40000 ALTER TABLE `videojuego` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-12 10:05:44
