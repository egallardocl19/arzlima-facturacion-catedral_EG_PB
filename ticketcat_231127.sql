-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: localhost    Database: ticketcat
-- ------------------------------------------------------
-- Server version	8.0.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clase_ticket`
--

DROP TABLE IF EXISTS `clase_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clase_ticket` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `idestado_dato` int NOT NULL,
  `idrecibos_serial` varchar(5) COLLATE utf8mb3_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estado_dato_clase_idx` (`idestado_dato`),
  CONSTRAINT `estado_dato_clase` FOREIGN KEY (`idestado_dato`) REFERENCES `estado_dato` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clase_ticket`
--

LOCK TABLES `clase_ticket` WRITE;
/*!40000 ALTER TABLE `clase_ticket` DISABLE KEYS */;
INSERT INTO `clase_ticket` VALUES (1,'NACIONALES',1,'00001'),(2,'EXTRANJEROS',1,'00001'),(3,'AGENCIAS AL CRÉDITO',1,'00002'),(4,'AGENCIAS ANTICIPADA',1,'00003');
/*!40000 ALTER TABLE `clase_ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cobranza`
--

DROP TABLE IF EXISTS `cobranza`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cobranza` (
  `id` int NOT NULL AUTO_INCREMENT,
  `n_cobranza` varchar(10) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `fecha` date NOT NULL,
  `idticket` int NOT NULL,
  `importe` double NOT NULL,
  `idformapago` int NOT NULL,
  `n_deposito` varchar(50) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `n_referencia` varchar(50) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `idbanco` int DEFAULT NULL,
  `idcuenta` int DEFAULT NULL,
  `observaciones` text COLLATE utf8mb3_spanish2_ci,
  `iduser_add` int NOT NULL,
  `fecha_add` date DEFAULT NULL,
  `iduser_upd` int NOT NULL,
  `fecha_upd` date DEFAULT NULL,
  `iduser_del` int NOT NULL,
  `fecha_del` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_idticket_idx` (`idticket`),
  KEY `fk_idformapago_idx` (`idformapago`),
  KEY `fk_iduser_idx` (`iduser_add`),
  KEY `fk_iduser2_idx` (`iduser_upd`),
  KEY `fk_iduser3_idx` (`iduser_del`),
  CONSTRAINT `fk_idformapago` FOREIGN KEY (`idformapago`) REFERENCES `formapago` (`id`),
  CONSTRAINT `fk_idticket` FOREIGN KEY (`idticket`) REFERENCES `ticket` (`id`),
  CONSTRAINT `fk_iduser` FOREIGN KEY (`iduser_add`) REFERENCES `user` (`id`),
  CONSTRAINT `fk_iduser2` FOREIGN KEY (`iduser_upd`) REFERENCES `user` (`id`),
  CONSTRAINT `fk_iduser3` FOREIGN KEY (`iduser_del`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cobranza`
--

LOCK TABLES `cobranza` WRITE;
/*!40000 ALTER TABLE `cobranza` DISABLE KEYS */;
INSERT INTO `cobranza` VALUES (27,'2023110001','2023-11-21',14,20,5,'','4854789',1,1,'',1,'2023-11-21',2,NULL,2,NULL),(28,'2023110002','2023-11-21',15,690,6,'0004514','',1,1,'DDDDDD',1,'2023-11-21',2,NULL,2,NULL),(29,'2023110003','2023-11-22',17,30,4,'','',1,1,'',1,'2023-11-22',2,NULL,2,NULL),(30,'2023110004','2023-11-22',18,15,4,'','',1,1,'',1,'2023-11-22',2,NULL,2,NULL),(31,'2023110005','2023-11-22',19,15,4,'','',1,1,'',1,'2023-11-22',2,NULL,2,NULL),(32,'2023110006','2023-11-23',20,5,4,'','',1,1,'',1,'2023-11-23',2,NULL,2,NULL);
/*!40000 ALTER TABLE `cobranza` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_dato`
--

DROP TABLE IF EXISTS `estado_dato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estado_dato` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_dato`
--

LOCK TABLES `estado_dato` WRITE;
/*!40000 ALTER TABLE `estado_dato` DISABLE KEYS */;
INSERT INTO `estado_dato` VALUES (1,'ACTIVO'),(2,'INACTIVO');
/*!40000 ALTER TABLE `estado_dato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_ticket`
--

DROP TABLE IF EXISTS `estado_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estado_ticket` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_ticket`
--

LOCK TABLES `estado_ticket` WRITE;
/*!40000 ALTER TABLE `estado_ticket` DISABLE KEYS */;
INSERT INTO `estado_ticket` VALUES (1,'PENDIENTE'),(2,'PAGADO'),(3,'ANULADO');
/*!40000 ALTER TABLE `estado_ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formapago`
--

DROP TABLE IF EXISTS `formapago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `formapago` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `idestado_dato` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formapago`
--

LOCK TABLES `formapago` WRITE;
/*!40000 ALTER TABLE `formapago` DISABLE KEYS */;
INSERT INTO `formapago` VALUES (4,'EFECTIVO',1),(5,'IZIPAY',1),(6,'DEPOSITO',1),(7,'TRANSFERENCIA',1);
/*!40000 ALTER TABLE `formapago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recibos_serial`
--

DROP TABLE IF EXISTS `recibos_serial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recibos_serial` (
  `serial` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `idestado_dato` int NOT NULL,
  `abrev` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `idrecibos_tipos` int NOT NULL,
  `activo` int NOT NULL DEFAULT '0',
  `anio` varchar(4) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `idsubmodulo` int NOT NULL,
  PRIMARY KEY (`abrev`),
  KEY `codigo_serial_estado_idx` (`idestado_dato`),
  KEY `codigo_serial_tiporecibo_idx` (`idrecibos_tipos`),
  KEY `codigo_serial_activo_idx` (`activo`),
  KEY `codigo_serial_submodulo_idx` (`idsubmodulo`),
  CONSTRAINT `codigo_serial_activo` FOREIGN KEY (`activo`) REFERENCES `estado_dato` (`id`),
  CONSTRAINT `codigo_serial_estado` FOREIGN KEY (`idestado_dato`) REFERENCES `estado_dato` (`id`),
  CONSTRAINT `codigo_serial_submodulo` FOREIGN KEY (`idsubmodulo`) REFERENCES `seguridad_submodulo` (`idsubmodulo`),
  CONSTRAINT `codigo_serial_tiporecibo` FOREIGN KEY (`idrecibos_tipos`) REFERENCES `recibos_tipos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recibos_serial`
--

LOCK TABLES `recibos_serial` WRITE;
/*!40000 ALTER TABLE `recibos_serial` DISABLE KEYS */;
INSERT INTO `recibos_serial` VALUES ('00001',1,'00001',1,1,'2023',2),('00002',1,'00002',1,1,'2023',2),('00003',1,'00003',1,1,'2023',2);
/*!40000 ALTER TABLE `recibos_serial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recibos_tipos`
--

DROP TABLE IF EXISTS `recibos_tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recibos_tipos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `idestado_dato` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `codigo_tipos_estado_idx` (`idestado_dato`),
  CONSTRAINT `codigo_tipos_estado` FOREIGN KEY (`idestado_dato`) REFERENCES `estado_dato` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recibos_tipos`
--

LOCK TABLES `recibos_tipos` WRITE;
/*!40000 ALTER TABLE `recibos_tipos` DISABLE KEYS */;
INSERT INTO `recibos_tipos` VALUES (1,'TICKET',1);
/*!40000 ALTER TABLE `recibos_tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seguridad_modulo`
--

DROP TABLE IF EXISTS `seguridad_modulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seguridad_modulo` (
  `idmodulo` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `fijo` int NOT NULL DEFAULT '0',
  `icono` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `idestado_dato` int NOT NULL,
  PRIMARY KEY (`idmodulo`),
  KEY `idestado_dato_idx` (`idestado_dato`),
  CONSTRAINT `idestado_dato_fk` FOREIGN KEY (`idestado_dato`) REFERENCES `estado_dato` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguridad_modulo`
--

LOCK TABLES `seguridad_modulo` WRITE;
/*!40000 ALTER TABLE `seguridad_modulo` DISABLE KEYS */;
INSERT INTO `seguridad_modulo` VALUES (1,'Dashboard',1,'fa fa-dashboard',1),(2,'Ticket',0,'fa fa-book',1),(3,'Reportes',0,'fa fa-area-chart',1),(4,'Usuarios',0,'fa fa-users',1),(5,'Configuración',0,'fa fa-cogs',1);
/*!40000 ALTER TABLE `seguridad_modulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seguridad_permisos`
--

DROP TABLE IF EXISTS `seguridad_permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seguridad_permisos` (
  `idpermisos` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `idsubmodulo` int NOT NULL,
  `idestado_dato` int NOT NULL,
  PRIMARY KEY (`idpermisos`),
  KEY `idestado_dato_fk3_idx` (`idestado_dato`),
  KEY `idsubmodulo_fk_idx` (`idsubmodulo`),
  CONSTRAINT `idestado_dato_fk3` FOREIGN KEY (`idestado_dato`) REFERENCES `estado_dato` (`id`),
  CONSTRAINT `idsubmodulo_fk` FOREIGN KEY (`idsubmodulo`) REFERENCES `seguridad_submodulo` (`idsubmodulo`)
) /*!50100 TABLESPACE `innodb_system` */ ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguridad_permisos`
--

LOCK TABLES `seguridad_permisos` WRITE;
/*!40000 ALTER TABLE `seguridad_permisos` DISABLE KEYS */;
INSERT INTO `seguridad_permisos` VALUES (1,'VER',2,1),(2,'CREAR',2,1),(3,'ACTUALIZAR',2,1),(4,'ELIMINAR',2,1),(5,'VER',3,1),(6,'CREAR',3,1),(7,'ACTUALIZAR',3,1),(8,'ELIMINAR',3,1),(9,'VER',4,1),(10,'CREAR',4,1),(11,'ACTUALIZAR',4,1),(12,'ELIMINAR',4,1),(13,'VER',5,1),(14,'VER',6,1),(15,'CREAR',6,1),(16,'ACTUALIZAR',6,1),(17,'ELIMINAR',6,1),(18,'VER',7,1),(19,'CREAR',7,1),(20,'ACTUALIZAR',7,1),(21,'ELIMINAR',7,1),(22,'VER',8,1),(23,'CREAR',8,1),(24,'ACTUALIZAR',8,1),(25,'ELIMINAR',8,1),(145,'VER',64,1),(146,'CREAR',64,1),(147,'ACTUALIZAR',64,1),(148,'ELIMINAR',64,1),(149,'VER',65,1),(150,'CREAR',65,1),(151,'ACTUALIZAR',65,1),(152,'ELIMINAR',65,1);
/*!40000 ALTER TABLE `seguridad_permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seguridad_roles`
--

DROP TABLE IF EXISTS `seguridad_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seguridad_roles` (
  `idroles` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `descripcion` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `iduser` int NOT NULL,
  `idpermisos` int NOT NULL,
  `idestado_dato` int NOT NULL,
  PRIMARY KEY (`idroles`),
  KEY `iduser_fk_idx` (`iduser`),
  KEY `idpermisos_fk_idx` (`idpermisos`),
  KEY `idestado_dato_fk3_idx` (`idestado_dato`),
  CONSTRAINT `idestado_dato_fk4` FOREIGN KEY (`idestado_dato`) REFERENCES `estado_dato` (`id`),
  CONSTRAINT `idpermisos_fk` FOREIGN KEY (`idpermisos`) REFERENCES `seguridad_permisos` (`idpermisos`),
  CONSTRAINT `iduser_fk` FOREIGN KEY (`iduser`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguridad_roles`
--

LOCK TABLES `seguridad_roles` WRITE;
/*!40000 ALTER TABLE `seguridad_roles` DISABLE KEYS */;
INSERT INTO `seguridad_roles` VALUES (1,'ROL','ROL',1,1,1),(2,'ROL','ROL',1,2,1),(3,'ROL','ROL',1,3,1),(4,'ROL','ROL',1,4,1),(5,'ROL','ROL',1,5,1),(6,'ROL','ROL',1,6,1),(7,'ROL','ROL',1,7,1),(8,'ROL','ROL',1,8,1),(9,'ROL','ROL',1,9,1),(10,'ROL','ROL',1,10,1),(11,'ROL','ROL',1,11,1),(12,'ROL','ROL',1,12,1),(13,'ROL','ROL',1,13,1),(14,'ROL','ROL',1,14,1),(15,'ROL','ROL',1,15,1),(16,'ROL','ROL',1,16,1),(17,'ROL','ROL',1,17,1),(18,'ROL','ROL',1,18,1),(19,'ROL','ROL',1,19,1),(20,'ROL','ROL',1,20,1),(21,'ROL','ROL',1,21,1),(22,'ROL','ROL',1,22,1),(23,'ROL','ROL',1,23,1),(24,'ROL','ROL',1,24,1),(25,'ROL','ROL',1,25,1),(26,'ROL','ROL',1,145,1),(27,'ROL','ROL',1,146,1),(28,'ROL','ROL',1,147,1),(29,'ROL','ROL',1,148,1),(33,'ROL','ROL',1,149,1),(34,'ROL','ROL',1,150,1),(35,'ROL','ROL',1,151,1),(36,'ROL','ROL',1,152,1),(40,'ROL','ROL',18,13,1),(41,'ROL','ROL',18,1,1),(48,'ROL','ROL',18,2,1),(49,'ROL','ROL',18,3,1),(50,'ROL','ROL',18,4,1),(51,'ROL','ROL',18,145,1),(52,'ROL','ROL',18,14,1),(53,'ROL','ROL',18,15,1),(54,'ROL','ROL',18,16,1),(55,'ROL','ROL',18,17,1);
/*!40000 ALTER TABLE `seguridad_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seguridad_submodulo`
--

DROP TABLE IF EXISTS `seguridad_submodulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seguridad_submodulo` (
  `idsubmodulo` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `archivo` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `icono` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `idmodulo` int NOT NULL,
  `idestado_dato` int NOT NULL,
  `observacion` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  PRIMARY KEY (`idsubmodulo`),
  KEY `idmodulo_fk_idx` (`idmodulo`),
  KEY `idestado_dato_fk_idx` (`idestado_dato`),
  CONSTRAINT `idestado_dato_fk2` FOREIGN KEY (`idestado_dato`) REFERENCES `estado_dato` (`id`),
  CONSTRAINT `idmodulo_fk` FOREIGN KEY (`idmodulo`) REFERENCES `seguridad_modulo` (`idmodulo`)
) /*!50100 TABLESPACE `innodb_system` */ ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguridad_submodulo`
--

LOCK TABLES `seguridad_submodulo` WRITE;
/*!40000 ALTER TABLE `seguridad_submodulo` DISABLE KEYS */;
INSERT INTO `seguridad_submodulo` VALUES (2,'Propios','recibos.php','fa fa-dot-circle-o',2,1,'Ticket Propios'),(3,'Clientes','recibos.php','fa fa-dot-circle-o',2,2,'Ticket Cliente'),(4,'Generales','recibos.php','fa fa-dot-circle-o',2,2,'Ticket Generales'),(5,'Reportes Generales','reportes.php','fa fa-dot-circle-o',3,1,'Reportes'),(6,'Usuario','usersadmin.php','fa fa-dot-circle-o',4,1,'Usuario'),(7,'Recibos','recibo_serie.php','fa fa-dot-circle-o',5,1,'Recibos'),(8,'Modulos & Permisos','permisos.php','fa fa-dot-circle-o',5,1,'Modulo & Permisos'),(64,'Control','recibos_control.php','fa fa-dot-circle-o',2,1,'Control Ticket'),(65,'Cobranza','recibos_cobranza.php','fa fa-dot-circle-o',2,1,'Cobranza');
/*!40000 ALTER TABLE `seguridad_submodulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ticket` (
  `id` int NOT NULL AUTO_INCREMENT,
  `serie` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `numero` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `dni` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `direccion` varchar(200) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `cantidad` int NOT NULL,
  `monto_total` double NOT NULL,
  `idestado_ticket` int NOT NULL,
  `idestado_registro` int NOT NULL,
  `idtipo_ticket` int NOT NULL,
  `idestado_dato` int NOT NULL,
  `observaciones` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `iduser_add` int NOT NULL,
  `fecha_add` date DEFAULT NULL,
  `iduser_upd` int NOT NULL,
  `fecha_upd` date DEFAULT NULL,
  `iduser_del` int NOT NULL,
  `fecha_del` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idserie_idx` (`serie`),
  KEY `idestado_ticket_idx` (`idestado_ticket`),
  KEY `idtipo_ticket_idx` (`idtipo_ticket`),
  KEY `idestado_dato_idx` (`idestado_dato`),
  KEY `idestado_datoticket_idx` (`idestado_dato`),
  KEY `iduser1_idx` (`iduser_add`),
  KEY `iduser2_idx` (`iduser_upd`),
  KEY `iduser3_idx` (`iduser_del`),
  CONSTRAINT `idestado_datoticket` FOREIGN KEY (`idestado_dato`) REFERENCES `estado_dato` (`id`),
  CONSTRAINT `idestado_ticket` FOREIGN KEY (`idestado_ticket`) REFERENCES `estado_ticket` (`id`),
  CONSTRAINT `idserie` FOREIGN KEY (`serie`) REFERENCES `recibos_serial` (`abrev`),
  CONSTRAINT `idtipo_ticket` FOREIGN KEY (`idtipo_ticket`) REFERENCES `tipos_ticket` (`id`),
  CONSTRAINT `iduser1` FOREIGN KEY (`iduser_add`) REFERENCES `user` (`id`),
  CONSTRAINT `iduser2` FOREIGN KEY (`iduser_upd`) REFERENCES `user` (`id`),
  CONSTRAINT `iduser3` FOREIGN KEY (`iduser_del`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES (14,'00001','0000000001','2023-11-21','12:08:33','20600732561','REPRESENTACIONES INVAC S.A.C.','AV. HUAYRUROPATA NRO 1634 URB. SAN FRANCISCO',1,20,2,1,1,1,'',1,'2023-11-21',2,NULL,2,NULL),(15,'00002','0000000001','2023-11-21','12:09:35','47504514','BRYAN ANDERSON OCHOA QUISPE','',23,690,2,1,7,1,'',1,'2023-11-21',2,NULL,2,NULL),(16,'00003','0000000001','2023-11-21','12:09:56','47504514','BRYAN ANDERSON OCHOA QUISPE','',30,900,1,1,8,1,'',1,'2023-11-21',2,NULL,2,NULL),(17,'00001','0000000002','2023-11-22','12:20:24','47504514','BRYAN ANDERSON OCHOA QUISPE','',1,30,2,1,5,1,'',1,'2023-11-22',2,NULL,2,NULL),(18,'00001','0000000003','2023-11-22','12:21:29','12345678','','',1,15,2,1,6,1,'',1,'2023-11-22',2,NULL,2,NULL),(19,'00001','0000000004','2023-11-22','12:21:38','12345678','','',1,15,2,1,6,1,'',1,'2023-11-22',2,NULL,2,NULL),(20,'00001','0000000005','2023-11-23','04:59:55','47504514','BRYAN ANDERSON OCHOA QUISPE','',1,5,2,1,4,1,'',1,'2023-11-23',2,NULL,2,NULL);
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_control`
--

DROP TABLE IF EXISTS `ticket_control`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ticket_control` (
  `id` int NOT NULL AUTO_INCREMENT,
  `serie` varchar(5) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `numero` varchar(10) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `dni` varchar(11) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `direccion` varchar(200) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `cantidad` int NOT NULL,
  `monto_total` double NOT NULL,
  `idestado_ticket` int NOT NULL,
  `idestado_registro` int NOT NULL,
  `idtipo_ticket` int NOT NULL,
  `idestado_dato` int NOT NULL,
  `observaciones` varchar(100) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `iduser_add` int NOT NULL,
  `fecha_add` date DEFAULT NULL,
  `iduser_upd` int NOT NULL,
  `fecha_upd` date DEFAULT NULL,
  `iduser_del` int NOT NULL,
  `fecha_del` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idserie_idx` (`serie`),
  KEY `idestado_ticket_idx` (`idestado_ticket`),
  KEY `idtipo_ticket_idx` (`idtipo_ticket`),
  KEY `idestado_dato_idx` (`idestado_dato`),
  KEY `idestado_datoticket_idx` (`idestado_dato`),
  KEY `iduser1_idx` (`iduser_add`),
  KEY `iduser2_idx` (`iduser_upd`),
  KEY `iduser3_idx` (`iduser_del`),
  CONSTRAINT `idestado_datoticketx` FOREIGN KEY (`idestado_dato`) REFERENCES `estado_dato` (`id`),
  CONSTRAINT `idestado_ticketx` FOREIGN KEY (`idestado_ticket`) REFERENCES `estado_ticket` (`id`),
  CONSTRAINT `idseriex` FOREIGN KEY (`serie`) REFERENCES `recibos_serial` (`abrev`),
  CONSTRAINT `idtipo_ticketx` FOREIGN KEY (`idtipo_ticket`) REFERENCES `tipos_ticket` (`id`),
  CONSTRAINT `iduser1x` FOREIGN KEY (`iduser_add`) REFERENCES `user` (`id`),
  CONSTRAINT `iduser2x` FOREIGN KEY (`iduser_upd`) REFERENCES `user` (`id`),
  CONSTRAINT `iduser3x` FOREIGN KEY (`iduser_del`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_control`
--

LOCK TABLES `ticket_control` WRITE;
/*!40000 ALTER TABLE `ticket_control` DISABLE KEYS */;
INSERT INTO `ticket_control` VALUES (5,'00003','0000000001','2023-11-23','05:39:12','47504514','BRYAN ANDERSON OCHOA QUISPE','',30,900,1,1,8,1,'',1,'2023-11-23',2,NULL,2,NULL),(6,'00003','0000000001','2023-11-23','05:39:20','47504514','BRYAN ANDERSON OCHOA QUISPE','',30,900,1,1,8,1,'',1,'2023-11-23',2,NULL,2,NULL),(7,'00003','0000000001','2023-11-23','05:39:32','47504514','BRYAN ANDERSON OCHOA QUISPE','',30,900,1,1,8,1,'',1,'2023-11-23',2,NULL,2,NULL),(8,'00003','0000000001','2023-11-23','05:39:43','47504514','BRYAN ANDERSON OCHOA QUISPE','',30,900,1,1,8,1,'',1,'2023-11-23',2,NULL,2,NULL),(9,'00003','0000000001','2023-11-23','05:42:44','47504514','BRYAN ANDERSON OCHOA QUISPE','',30,900,1,1,8,1,'',1,'2023-11-23',2,NULL,2,NULL),(10,'00003','0000000001','2023-11-23','05:43:05','47504514','BRYAN ANDERSON OCHOA QUISPE','',30,900,1,1,8,1,'',1,'2023-11-23',2,NULL,2,NULL),(11,'00003','0000000001','2023-11-23','05:43:14','47504514','BRYAN ANDERSON OCHOA QUISPE','',30,900,1,1,8,1,'',1,'2023-11-23',2,NULL,2,NULL),(12,'00003','0000000001','2023-11-27','03:37:51','47504514','BRYAN ANDERSON OCHOA QUISPE','',30,900,1,1,8,1,'',1,'2023-11-27',2,NULL,2,NULL),(13,'00003','0000000001','2023-11-27','03:38:08','47504514','BRYAN ANDERSON OCHOA QUISPE','',30,900,1,1,8,1,'',1,'2023-11-27',2,NULL,2,NULL),(14,'00003','0000000001','2023-11-27','03:38:16','47504514','BRYAN ANDERSON OCHOA QUISPE','',30,900,1,1,8,1,'',1,'2023-11-27',2,NULL,2,NULL),(15,'00003','0000000001','2023-11-27','03:38:39','47504514','BRYAN ANDERSON OCHOA QUISPE','',30,900,1,1,8,1,'',1,'2023-11-27',2,NULL,2,NULL),(16,'00003','0000000001','2023-11-27','03:39:07','47504514','BRYAN ANDERSON OCHOA QUISPE','',30,900,1,1,8,1,'',1,'2023-11-27',2,NULL,2,NULL),(17,'00003','0000000001','2023-11-27','03:39:10','47504514','BRYAN ANDERSON OCHOA QUISPE','',30,900,1,1,8,1,'',1,'2023-11-27',2,NULL,2,NULL),(18,'00003','0000000001','2023-11-27','03:39:12','47504514','BRYAN ANDERSON OCHOA QUISPE','',30,900,1,1,8,1,'',1,'2023-11-27',2,NULL,2,NULL),(19,'00003','0000000001','2023-11-27','03:39:14','47504514','BRYAN ANDERSON OCHOA QUISPE','',30,900,1,1,8,1,'',1,'2023-11-27',2,NULL,2,NULL),(20,'00003','0000000001','2023-11-27','03:39:18','47504514','BRYAN ANDERSON OCHOA QUISPE','',30,900,1,1,8,1,'',1,'2023-11-27',2,NULL,2,NULL),(21,'00003','0000000001','2023-11-27','03:39:22','47504514','BRYAN ANDERSON OCHOA QUISPE','',30,900,1,1,8,1,'',1,'2023-11-27',2,NULL,2,NULL),(22,'00003','0000000001','2023-11-27','03:39:26','47504514','BRYAN ANDERSON OCHOA QUISPE','',30,900,1,1,8,1,'',1,'2023-11-27',2,NULL,2,NULL),(23,'00003','0000000001','2023-11-27','03:39:29','47504514','BRYAN ANDERSON OCHOA QUISPE','',30,900,1,1,8,1,'',1,'2023-11-27',2,NULL,2,NULL),(24,'00003','0000000001','2023-11-27','03:39:44','47504514','BRYAN ANDERSON OCHOA QUISPE','',30,900,1,1,8,1,'',1,'2023-11-27',2,NULL,2,NULL),(25,'00003','0000000001','2023-11-27','03:39:48','47504514','BRYAN ANDERSON OCHOA QUISPE','',30,900,1,1,8,1,'',1,'2023-11-27',2,NULL,2,NULL);
/*!40000 ALTER TABLE `ticket_control` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_moneda`
--

DROP TABLE IF EXISTS `tipo_moneda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_moneda` (
  `id` int NOT NULL AUTO_INCREMENT,
  `signo` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_moneda`
--

LOCK TABLES `tipo_moneda` WRITE;
/*!40000 ALTER TABLE `tipo_moneda` DISABLE KEYS */;
INSERT INTO `tipo_moneda` VALUES (1,'S/.','SOLES');
/*!40000 ALTER TABLE `tipo_moneda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_venta`
--

DROP TABLE IF EXISTS `tipo_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_venta` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `idestado_dato` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estado_dato_tipoventa_idx` (`idestado_dato`),
  CONSTRAINT `estado_dato_tipoventa` FOREIGN KEY (`idestado_dato`) REFERENCES `estado_dato` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_venta`
--

LOCK TABLES `tipo_venta` WRITE;
/*!40000 ALTER TABLE `tipo_venta` DISABLE KEYS */;
INSERT INTO `tipo_venta` VALUES (1,'CONTADO',1),(2,'AL CREDITO',1),(3,'ANTICIPADA',1);
/*!40000 ALTER TABLE `tipo_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_ticket`
--

DROP TABLE IF EXISTS `tipos_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipos_ticket` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idclase_ticket` int NOT NULL,
  `idtipo_venta` int NOT NULL,
  `idtipo_moneda` int NOT NULL,
  `nombre` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `importe` double NOT NULL DEFAULT '0',
  `idestado_dato` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idclase_ticket_idx` (`idclase_ticket`),
  KEY `idtipo_venta_idx` (`idtipo_venta`),
  KEY `idtipo_moneda_idx` (`idtipo_moneda`),
  KEY `idestado_dato_idx` (`idestado_dato`),
  CONSTRAINT `idclase_ticket` FOREIGN KEY (`idclase_ticket`) REFERENCES `clase_ticket` (`id`),
  CONSTRAINT `idestado_dato` FOREIGN KEY (`idestado_dato`) REFERENCES `estado_dato` (`id`),
  CONSTRAINT `idtipo_moneda` FOREIGN KEY (`idtipo_moneda`) REFERENCES `tipo_moneda` (`id`),
  CONSTRAINT `idtipo_venta` FOREIGN KEY (`idtipo_venta`) REFERENCES `tipo_venta` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_ticket`
--

LOCK TABLES `tipos_ticket` WRITE;
/*!40000 ALTER TABLE `tipos_ticket` DISABLE KEYS */;
INSERT INTO `tipos_ticket` VALUES (1,1,1,1,'General Nacional',20,1),(2,1,1,1,'Adulto Mayor y niñ@ Nacional',10,1),(3,1,1,1,'Universitario / Intituto Nacional',10,1),(4,1,1,1,'Delegaciones Escolares Nacionales',5,1),(5,2,1,1,'General Extranjero',30,1),(6,2,1,1,'Niñ@s Extranjeros',15,1),(7,3,2,1,'General Extranjero',30,1),(8,4,3,1,'General Extranjero',30,1);
/*!40000 ALTER TABLE `tipos_ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `username` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `profile_pic` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `idestado` int NOT NULL,
  `created_at` date NOT NULL,
  `dni` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `celular` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `ruc` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `razonsocial` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `direccion` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `profile_pictwo` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `idroles` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `codigo_user_estado_idx` (`idestado`),
  CONSTRAINT `codigo_user_estado` FOREIGN KEY (`idestado`) REFERENCES `estado_dato` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'1','BOCHOA','BRYAN OCHOA QUISPE','bryan.aoq@gmail.com','a99c5b0cdf5c86b5fc0039dcd14381311536e973','default.png',1,'2022-02-18','','','20139538561','ARZOBISPADO DE LIMA','JR. CHANCAY 282','logo4.png',1),(2,'2','NULO','NULO','NULO','7352d2cce7ad175b5205655b4ead7f7c24cd64d3',NULL,1,'2022-02-18','','','','','',NULL,NULL),(18,'3','MBORJA','MANUEL BORJA','sistemas@arzobispadodelima.org','ba6c80a00eb1780a8bd0a2424ef1d52b976d85bf','default.png',1,'2023-11-27','','','99999999999','ARZOBISPADO DE LIMA','','logo4.png',2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'ticketcat'
--
/*!50003 DROP PROCEDURE IF EXISTS `add_roles` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_roles`(in iduser1 varchar(2), in idpermisos1 varchar(3), in idsubmodulo1 varchar(2))
BEGIN
if idpermisos1=1 then
insert into seguridad_roles (select 0,'ROL','ROL',iduser1,idpermisos,1 from seguridad_permisos 
where idsubmodulo=idsubmodulo1 and idpermisos not in(select idpermisos from seguridad_roles where iduser=iduser1));
END IF;
if idpermisos1>1 then
insert into seguridad_roles 
(select 0,'ROL','ROL',iduser1,idpermisos,1 from seguridad_permisos 
where idsubmodulo=idsubmodulo1 and idpermisos=idpermisos1 and  idpermisos not in
(select idpermisos from seguridad_roles where iduser=iduser1 and idpermisos=idpermisos1));
END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `add_submodulo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_submodulo`(in nombre varchar(100), in modulo varchar(2), in plantilla varchar(50), in icono1 varchar(50), in observa1 varchar(50))
BEGIN
insert into seguridad_submodulo (nombre,archivo,icono,idmodulo,idestado_dato,observacion) value (nombre,plantilla,icono1,modulo,1,observa1);
insert into seguridad_permisos (nombre,idsubmodulo,idestado_dato) value ('VER',(select max(idsubmodulo) from seguridad_submodulo),1);
insert into seguridad_permisos (nombre,idsubmodulo,idestado_dato) value ('CREAR',(select max(idsubmodulo) from seguridad_submodulo),1);
insert into seguridad_permisos (nombre,idsubmodulo,idestado_dato) value ('ACTUALIZAR',(select max(idsubmodulo) from seguridad_submodulo),1);
insert into seguridad_permisos (nombre,idsubmodulo,idestado_dato) value ('ELIMINAR',(select max(idsubmodulo) from seguridad_submodulo),1);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `dashboard` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `dashboard`(in moneda varchar(1),in estado varchar(1),in estado2 varchar(1),in estado3 varchar(1))
BEGIN

SELECT sum(importe) as mes1,
  
    (SELECT count(numero) FROM ticket where idestado_ticket=estado and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 0 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 0 MONTH))) as mes1xx, 
    (SELECT count(numero) FROM ticket where idestado_ticket=estado2 and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 0 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 0 MONTH))) as mes1xxx,
    (SELECT count(numero) FROM ticket where idestado_ticket=estado3 and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 0 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 0 MONTH))) as mes1xxxx,
    (SELECT sum(importe) FROM cobranza where  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 1 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 1 MONTH))) as mes2,
   
    (SELECT count(numero) FROM ticket where idestado_ticket=estado and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 1 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 1 MONTH))) as mes2xx, 
    (SELECT count(numero) FROM ticket where idestado_ticket=estado2 and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 1 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 1 MONTH))) as mes2xxx, 
    (SELECT count(numero) FROM ticket where idestado_ticket=estado3 and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 1 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 1 MONTH))) as mes2xxxx,
    (SELECT sum(importe) FROM cobranza where  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 2 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 2 MONTH))) as mes3, 
  
    (SELECT count(numero) FROM ticket where idestado_ticket=estado and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 2 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 2 MONTH))) as mes3xx, 
    (SELECT count(numero) FROM ticket where idestado_ticket=estado2 and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 2 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 2 MONTH))) as mes3xxx,  
    (SELECT count(numero) FROM ticket where idestado_ticket=estado3 and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 2 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 2 MONTH))) as mes3xxxx,  
   
    (SELECT sum(importe) FROM cobranza where MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 3 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 3 MONTH))) as mes4,
   
    (SELECT count(numero) FROM ticket where idestado_ticket=estado and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 3 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 3 MONTH))) as mes4xx, 
    (SELECT count(numero) FROM ticket where idestado_ticket=estado2 and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 3 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 3 MONTH))) as mes4xxx,  
    (SELECT count(numero) FROM ticket where idestado_ticket=estado3 and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 3 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 3 MONTH))) as mes4xxxx,  
   
    (SELECT sum(importe) FROM cobranza where MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 4 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 4 MONTH))) as mes5, 

    (SELECT count(numero) FROM ticket where idestado_ticket=estado and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 4 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 4 MONTH))) as mes5xx, 
    (SELECT count(numero) FROM ticket where idestado_ticket=estado2 and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 4 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 4 MONTH))) as mes5xxx,  
    (SELECT count(numero) FROM ticket where idestado_ticket=estado3 and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 4 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 4 MONTH))) as mes5xxxx,  
    
    (SELECT sum(importe) FROM cobranza where  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 5 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 5 MONTH))) as mes6, 
 
    (SELECT count(numero) FROM ticket where idestado_ticket=estado and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 5 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 5 MONTH))) as mes6xx, 
    (SELECT count(numero) FROM ticket where idestado_ticket=estado2 and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 5 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 5 MONTH))) as mes6xxx,  
    (SELECT count(numero) FROM ticket where idestado_ticket=estado3 and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 5 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 5 MONTH))) as mes6xxxx,  
    
    (SELECT sum(importe) FROM cobranza where  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 6 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 6 MONTH))) as mes7, 
  
    (SELECT count(numero) FROM ticket where idestado_ticket=estado and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 6 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 6 MONTH))) as mes7xx, 
    (SELECT count(numero) FROM ticket where idestado_ticket=estado2 and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 6 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 6 MONTH))) as mes7xxx,  
    (SELECT count(numero) FROM ticket where idestado_ticket=estado3 and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 6 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 6 MONTH))) as mes7xxxx,  
    
    (SELECT sum(importe) FROM cobranza where MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 7 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 7 MONTH))) as mes8, 
  
    (SELECT count(numero) FROM ticket where idestado_ticket=estado and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 7 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 7 MONTH))) as mes8xx, 
    (SELECT count(numero) FROM ticket where idestado_ticket=estado2 and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 7 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 7 MONTH))) as mes8xxx,  
    (SELECT count(numero) FROM ticket where idestado_ticket=estado3 and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 7 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 7 MONTH))) as mes8xxxx,  
    
    (SELECT sum(importe) FROM cobranza where  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 8 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 8 MONTH))) as mes9, 
   
    (SELECT count(numero) FROM ticket where idestado_ticket=estado and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 8 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 8 MONTH))) as mes9xx, 
    (SELECT count(numero) FROM ticket where idestado_ticket=estado2 and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 8 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 8 MONTH))) as mes9xxx,  
    (SELECT count(numero) FROM ticket where idestado_ticket=estado3 and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 8 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 8 MONTH))) as mes9xxxx,  
    
    (SELECT sum(importe) FROM cobranza where  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 9 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 9 MONTH))) as mes10, 

    (SELECT count(numero) FROM ticket where idestado_ticket=estado and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 9 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 9 MONTH))) as mes10xx, 
    (SELECT count(numero) FROM ticket where idestado_ticket=estado2 and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 9 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 9 MONTH))) as mes10xxx,  
    (SELECT count(numero) FROM ticket where idestado_ticket=estado3 and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 9 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 9 MONTH))) as mes10xxxx,  
    
    (SELECT sum(importe) FROM cobranza where  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 10 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 10 MONTH))) as mes11,
 
    (SELECT count(numero) FROM ticket where idestado_ticket=estado and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 10 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 10 MONTH))) as mes11xx, 
    (SELECT count(numero) FROM ticket where idestado_ticket=estado2 and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 10 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 10 MONTH))) as mes11xxx,  
    (SELECT count(numero) FROM ticket where idestado_ticket=estado3 and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 10 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 10 MONTH))) as mes11xxxx,  
    
    (SELECT sum(importe) FROM cobranza where  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 11 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 11 MONTH))) as mes12,
    
    (SELECT count(numero) FROM ticket where idestado_ticket=estado and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 11 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 11 MONTH))) as mes12xx, 
    (SELECT count(numero) FROM ticket where idestado_ticket=estado2 and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 11 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 11 MONTH))) as mes12xxx,
    (SELECT count(numero) FROM ticket where idestado_ticket=estado3 and  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 11 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 11 MONTH))) as mes12xxxx
    
    FROM cobranza  where  MONTH(fecha) =MONTH(DATE_SUB(NOW(), INTERVAL 0 MONTH)) AND YEAR(fecha) = YEAR(DATE_SUB(NOW(), INTERVAL 0 MONTH));


      
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `mantenimiento_cobranza` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `mantenimiento_cobranza`(in codigo_editar int(11),in tipo_ingreso1 int(11),in fecha_inicio1 date,in submodulo1 int(11),
in tipopago1 int(11), in n_pago1 varchar(50),in n_deposito1 varchar(50),in banco1 int(11),in cuenta1 int(11),in observacion1 varchar(50),
in user1 int(11),in fecha_add1 date,out resultado varchar(100),out resultado1 varchar(100))
BEGIN
IF (tipo_ingreso1=1) THEN
/*SCRIPT PARA OBTENER CODIGO COBRANZA*/
    set @numero_cobranza=(SELECT MIN(LPAD((@i := @i +1)+(SELECT count(n_cobranza) FROM cobranza where date_format(fecha, '%Y-%m')=date_format(fecha_inicio1, '%Y-%m')),4,'0')) as codigo 
	FROM cobranza cross join (select @i := 0) c where  date_format(fecha, '%Y-%m')=date_format(fecha_inicio1, '%Y-%m'));
    if (@numero_cobranza>0) THEN
	set @numero_cobranza_insertar=concat(date_format(fecha_inicio1, '%Y%m'),@numero_cobranza);
	else
	set @numero_cobranza_insertar=concat(date_format(fecha_inicio1, '%Y%m'),'0001');
	END IF; 
  
/*SCRIPT PARA FILTRO DE VERIFICACION COBRANZA*/
set @verificar_ticket=(select idticket from cobranza where idticket=codigo_editar);
 set @importe_ticket=(select monto_total from ticket where id=codigo_editar);
 
 /*SCRIPT PARA FILTRO DE PERMISOS*/
	set @permisosgeneral=(select idsubmodulo from seguridad_submodulo where idestado_dato=1 and idsubmodulo=submodulo1);
	set @permisos=(select idpermisos from seguridad_permisos where idpermisos in (select idpermisos from seguridad_roles where iduser=user1 and idestado_dato=1) and idsubmodulo=submodulo1 and nombre= 'CREAR');
	
	if (@permisosgeneral > 0) THEN
		if (@permisos > 0) THEN
			if (@verificar_ticket is null) THEN
				 insert into cobranza value(0,@numero_cobranza_insertar,fecha_inicio1,codigo_editar,@importe_ticket,tipopago1,n_deposito1,
                 n_pago1,1,1,observacion1,user1,fecha_add1,2,null,2,null);
				 update ticket set idestado_ticket=2 where id=codigo_editar;
				 set resultado=concat('La cobranza ha sido ingresado satisfactoriamente.');
				 set resultado1='0';
			else
				set resultado='El Ticket Ingresado ya tiene cobranza Registrada, refresque el formulario con Boton NUEVO.';
				set resultado1='1';
            END IF;
		else     
			set resultado='El Registro no fue guardado por motivo de permisos de Usuario.';
			set resultado1='1';
		END IF;
    	
	else     
		set resultado='El Registro no fue guardado por motivo de permisos de Usuario.';
		set resultado1='1';
	END IF;  
END IF;  
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `mantenimiento_recibo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `mantenimiento_recibo`(in codigo_editar int(11),in tipo_ingreso1 int(11),in serie1 varchar(5),in numero1 varchar(10),
in submodulo1 int(11),in fecha_inicio1 date,in cantidad1 int(11),in dni1 varchar(11),in nombre1 varchar(100),in direccion1 varchar(200),in idtipo1 int(11),in monto_total1 double,
in tipopago1 int(11), in n_pago1 varchar(50),in user1 int(11),in fecha_add1 date,out resultado varchar(100),out resultado1 varchar(100))
BEGIN
IF (tipo_ingreso1=1) THEN
/*set   @x= 1;
while @x<= cantidad1 DO 
SET @x = @x+1;*/
  
   /*SCRIPT PARA GENERAR CORRELATIVO*/
	set @codigo_recibo=(SELECT LPAD((@i := @i +1)+(SELECT numero FROM ticket where id=(select max(id) from ticket where serie=serie1)),10,'0') as codigo
	FROM ticket cross join (select @i := 0) c where serie=serie1 and id=(select max(id) from ticket where serie=serie1));
	if (@codigo_recibo>0) THEN
	set @codigo_recibo=@codigo_recibo;
	else
	set @codigo_recibo='0000000001';
	END IF;     
    
	/*SCRIPT PARA FILTRO DE CODIGO RECIBO*/
	set @validar_codigo_recibo=(select numero from ticket where serie=serie1 and numero=@codigo_recibo);
	if (@validar_codigo_recibo!='') THEN
	set @validar_codigo_recibo=@validar_codigo_recibo;
	else
	set @validar_codigo_recibo='';
	END IF;  
    
    /*SCRIPT PARA FILTRO VALIDAR PAGO*/
	if (tipopago1=4 or tipopago1=5) THEN
	set @idestado_ticket=2;
	else
	set @idestado_ticket=1;
	END IF;  
    
    /*SCRIPT PARA OBTENER CODIGO COBRANZA*/
    set @numero_cobranza=(SELECT MIN(LPAD((@i := @i +1)+(SELECT count(n_cobranza) FROM cobranza where date_format(fecha, '%Y-%m')=date_format(fecha_inicio1, '%Y-%m')),4,'0')) as codigo 
	FROM cobranza cross join (select @i := 0) c where  date_format(fecha, '%Y-%m')=date_format(fecha_inicio1, '%Y-%m'));
    if (@numero_cobranza>0) THEN
	set @numero_cobranza_insertar=concat(date_format(fecha_inicio1, '%Y%m'),@numero_cobranza);
	else
	set @numero_cobranza_insertar=concat(date_format(fecha_inicio1, '%Y%m'),'0001');
	END IF; 
    
	/*SCRIPT PARA FILTRO DE PERMISOS*/
	set @permisosgeneral=(select idsubmodulo from seguridad_submodulo where idestado_dato=1 and idsubmodulo=submodulo1);
	set @permisos=(select idpermisos from seguridad_permisos where idpermisos in (select idpermisos from seguridad_roles where iduser=user1 and idestado_dato=1) and idsubmodulo=submodulo1 and nombre= 'CREAR');
	set @hora=(SELECT DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 5 HOUR), "%H:%i:%S" ));
	if (@permisosgeneral > 0) THEN
		if (@permisos > 0) THEN
				if (@validar_codigo_recibo = '') THEN
							insert into ticket value(0,serie1,@codigo_recibo,fecha_inicio1,@hora,dni1,nombre1,direccion1,cantidad1,monto_total1,@idestado_ticket,1,idtipo1,1,'',user1,fecha_add1,2,null,2,null);
                            /*INSERTAR COBRANZA*/
                            set @codigo_id_ticket=(select id from ticket where serie=serie1 and numero=@codigo_recibo);
                            set @importe_ticket=(select monto_total from ticket where serie=serie1 and numero=@codigo_recibo);
                            if (@idestado_ticket=2) THEN
                            insert into cobranza value(0,@numero_cobranza_insertar,fecha_inicio1,@codigo_id_ticket,@importe_ticket,tipopago1,'',n_pago1,1,1,'',user1,fecha_add1,2,null,2,null);
                            END IF; 
                            /*FIN*/
									set resultado=concat('El Registro ha sido ingresado satisfactoriamente.');
									set resultado1='0';
					else     
					set resultado='El Código Recibo ya se encuentra Registrado.';
					set resultado1='1';  
					END IF; 
		else     
			set resultado='El Registro no fue guardado por motivo de permisos de Usuario.';
			set resultado1='1';
			END IF;
    	
	else     
		set resultado='El Registro no fue guardado por motivo de permisos de Usuario.';
		set resultado1='1';
	END IF;  
   /*END WHILE;*/ 
END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `mantenimiento_recibo_serie` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `mantenimiento_recibo_serie`(in usuario int(11),in codigo int(11),in tipo_ingreso1 int(11),
in serial1 varchar(5),in abrevi1 varchar(5),in recibos_tipos1 int(11),in activo1 int(11),in anio1 varchar(4),
in submodulo1 int(11),out resultado varchar(100),out resultado1 varchar(100))
BEGIN
if (tipo_ingreso1=1) THEN
set @permisosgeneral=(select idsubmodulo from seguridad_submodulo where idestado_dato=1 and idsubmodulo=7);
set @seria=(select serial from recibos_serial where serial=serial1);
set @abrev=(select serial from recibos_serial where abrev=abrevi1);
	
		if (@permisosgeneral > 0) THEN
			set @permisos=(select idpermisos from seguridad_permisos where idpermisos in (select idpermisos from seguridad_roles where iduser=usuario and idestado_dato=1) and idsubmodulo=7 and nombre= 'CREAR');
			if (@permisos > 0) THEN
				if (@seria IS NULL) THEN
					if (@abrev IS NULL) THEN
					insert into recibos_serial (serial,idestado_dato,abrev,idrecibos_tipos,activo,anio,idsubmodulo) 
					value (serial1,1,abrevi1,recibos_tipos1,activo1,anio1,submodulo1);
							set resultado='El Registro ha sido ingresado satisfactoriamente.';
							set resultado1='0';
					else     
					set resultado='Ya existe una SERIE SISTEMA en el Registro con el mismo nombre. Intente Nuevamente.';
					set resultado1='1';
					END IF; 
				else     
				set resultado='Ya existe una SERIE TICKET en el Registro con el mismo nombre. Intente Nuevamente.';
				set resultado1='1';
				END IF; 
			 else     
					set resultado='El Registro no fue guardado por motivo de permisos de Usuario.';
					set resultado1='1';
			 END IF;
		else     
				set resultado='El Registro no fue guardado por motivo de permisos de Usuario.';
				set resultado1='1';
		 END IF;  
     
END IF;

IF (tipo_ingreso1=2) THEN
set @permisosgeneral=(select idsubmodulo from seguridad_submodulo where idestado_dato=1 and idsubmodulo=7);
	if (@permisosgeneral > 0) THEN
			set @permisos=(select idpermisos from seguridad_permisos where idpermisos in (select idpermisos from seguridad_roles where iduser=usuario and idestado_dato=1) and idsubmodulo=7 and nombre= 'ACTUALIZAR');
			if (@permisos > 0) THEN
					update recibos_serial set activo=activo1 , anio=anio1 where abrev=codigo;
					set resultado='El Registro ha sido actualizado satisfactoriamente.';
					set resultado1='0';
			 else     
					set resultado='El Registro no fue actualizado por motivo de permisos de Usuario.';
					set resultado1='1';
			 END IF;
    else     
			set resultado='El Registro no fue guardado por motivo de permisos de Usuario.';
            set resultado1='1';
	 END IF;           
END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `menu` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `menu`(in iduser1 varchar(2))
BEGIN
select * from seguridad_modulo where fijo=0 and idestado_dato=1 and idmodulo in(
select idmodulo from seguridad_submodulo where idestado_dato=1 and idsubmodulo in(
select idsubmodulo from seguridad_permisos where nombre='VER' and idestado_dato=1 and idpermisos in(
select idpermisos from seguridad_roles where idestado_dato=1 and iduser=iduser1)));
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `permisos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `permisos`(in iduser1 varchar(2),in idsubmodulo1 varchar(2),in idpermiso1 varchar(2))
BEGIN
select * from seguridad_permisos where idpermisos in 
(select idpermisos from seguridad_roles where iduser=iduser1 and idestado_dato=1)
and idsubmodulo=idsubmodulo1 and nombre= case idpermiso1 when '0' then 'VER' when '1' then 'CREAR' when '2' then 'ACTUALIZAR' when '3' then 'ELIMINAR' END;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `recibo_pago` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `recibo_pago`(in idcobranza int(11))
BEGIN
SELECT t.serie,t.numero,t.dni,t.nombre,direccion,c.fecha,
(select signo from tipo_moneda where id=(select idtipo_moneda from tipos_ticket where id=t.idtipo_ticket)) as moneda,
(select importe from tipos_ticket where id=t.idtipo_ticket) importe_unitario,t.cantidad,c.importe,
(select nombre from recibos_tipos where id=rs.idrecibos_tipos) tipo_recibo FROM cobranza c,ticket t, recibos_serial rs 
where c.idticket=t.id and t.serie=rs.abrev and c.id=idcobranza; 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `recibo_ticket` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `recibo_ticket`(in codigo int(11))
BEGIN
select t.id,t.serie,t.numero,t.fecha,t.dni,format(t.monto_total,2) as monto_total,t.cantidad,tt.nombre,tm.signo,format(tt.importe,2) as importe,
(select nombre from estado_ticket where id=t.idestado_ticket) as estado,concat('PAGO ',
(select nombre from tipo_venta where id =(select idtipo_venta from tipos_ticket where id=t.idtipo_ticket))) as tipo_pago
from ticket t, tipos_ticket tt, tipo_moneda tm where t.idtipo_ticket=tt.id and tt.idtipo_moneda=tm.id and t.id=codigo;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `reporte_cobranza` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `reporte_cobranza`(in tipo varchar(1),in condi1 varchar(1000))
BEGIN
DECLARE SELECCION VARCHAR(10000);
if tipo="1" then
  SET @SELECCION = CONCAT('select c.n_cobranza,c.fecha as fecha_cobranza,t.dni,t.nombre,t.serie,t.numero,(select nombre from clase_ticket where id=tt.idclase_ticket) as clase,t.idtipo_ticket,
tt.nombre as tipo,t.cantidad,(select signo from tipo_moneda where id=tt.idtipo_moneda) as moneda,tt.importe,c.importe as cobrado,c.idformapago,
(select nombre from formapago where id=c.idformapago) as forma_pago,c.n_deposito,c.n_referencia,c.observaciones
 from cobranza c,ticket t,tipos_ticket tt where c.idticket=t.id and t.idtipo_ticket=tt.id ', condi1 ,';');
            PREPARE SELECCION FROM @SELECCION;
			EXECUTE  SELECCION ;
END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `reporte_ticket` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `reporte_ticket`(in tipo varchar(1),in condi1 varchar(1000))
BEGIN
DECLARE SELECCION VARCHAR(10000);
if tipo="1" then
  SET @SELECCION = CONCAT('select t.id,t.serie,t.numero,t.fecha,t.hora,t.dni,t.nombre,t.direccion,t.cantidad,(select signo from tipo_moneda where id=tt.idtipo_moneda) as moneda,
(select importe from tipos_ticket where id=t.idtipo_ticket) as importe,
t.monto_total,t.idestado_ticket,(select nombre from estado_ticket where id=t.idestado_ticket) as estado,t.idtipo_ticket,
tt.nombre as tipo_ticket,(select nombre from clase_ticket where id=tt.idclase_ticket) as clase,
(select count(id) from ticket_control where serie=t.serie and numero=t.numero) as control from ticket t, tipos_ticket tt where t.idtipo_ticket=tt.id ', condi1 ,';');
            PREPARE SELECCION FROM @SELECCION;
			EXECUTE  SELECCION ;
END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `reporte_ticket_control` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `reporte_ticket_control`(in tipo varchar(1),in condi1 varchar(1000))
BEGIN
DECLARE SELECCION VARCHAR(10000);
if tipo="1" then
  SET @SELECCION = CONCAT('select t.id,t.serie,t.numero,t.fecha,t.hora,t.dni,t.nombre,t.direccion,t.cantidad,(select signo from tipo_moneda where id=tt.idtipo_moneda) as moneda,
(select importe from tipos_ticket where id=t.idtipo_ticket) as importe,
t.monto_total,t.idestado_ticket,(select nombre from estado_ticket where id=t.idestado_ticket) as estado,t.idtipo_ticket,
tt.nombre as tipo_ticket,(select nombre from clase_ticket where id=tt.idclase_ticket) as clase,
(select count(id) from ticket_control where serie=t.serie and numero=t.numero) as control from ticket_control t, tipos_ticket tt where t.idtipo_ticket=tt.id ', condi1 ,';');
            PREPARE SELECCION FROM @SELECCION;
			EXECUTE  SELECCION ;
END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `session_login` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `session_login`(in correo varchar(100),in pass varchar(500))
BEGIN
set @validador=(SELECT correo LIKE "%@%");
if @validador=1 THEN
select * from user where email=correo  and password=pass and idestado=1;
else
select * from user where  username=correo and password=pass and idestado=1;
END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `submenu` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `submenu`(in iduser1 varchar(2),in idmodulo1 varchar(2),in idsubmodulo1 varchar(2))
BEGIN
if idsubmodulo1=1 then
select idsubmodulo,nombre as nombre_submodulo,icono as icono_submodulo,idmodulo as idmodulosub,idestado_dato as estado_submodulo,archivo 
from seguridad_submodulo where idestado_dato=1 and idsubmodulo in(
select idsubmodulo from seguridad_permisos where nombre='VER' and idestado_dato=1 and idpermisos in(
select idpermisos from seguridad_roles where idestado_dato=1 and iduser=iduser1 and idmodulo=idmodulo1)) order by nombre_submodulo desc;
END IF;
if idsubmodulo1>1 then
select idsubmodulo,nombre as nombre_submodulo,icono as icono_submodulo,idmodulo as idmodulosub,idestado_dato as estado_submodulo,archivo 
from seguridad_submodulo where idestado_dato=1 and idsubmodulo=idsubmodulo1;
END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-27  9:06:43
