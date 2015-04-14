/*
SQLyog Community Edition- MySQL GUI v7.1 
MySQL - 6.0.4-alpha-community-log : Database - tiendavirtual
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`tiendavirtual` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `tiendavirtual`;

/*Table structure for table `carritodecompras` */

DROP TABLE IF EXISTS `carritodecompras`;

CREATE TABLE `carritodecompras` (
  `idprod` varchar(30) DEFAULT NULL,
  `idcliente` varchar(30) DEFAULT NULL,
  `fecha` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `carritodecompras` */

insert  into `carritodecompras`(`idprod`,`idcliente`,`fecha`) values ('P0014','1','1227086020'),('P0006','1','1227086007'),('P0006','1','1227089575');

/*Table structure for table `categorias` */

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `IdCat` varchar(45) NOT NULL,
  `NombreCat` varchar(45) NOT NULL,
  PRIMARY KEY (`IdCat`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `categorias` */

insert  into `categorias`(`IdCat`,`NombreCat`) values ('C001','Abstracto'),('C002','Cubista'),('C003','Expresionista'),('C004','Figurativo'),('C005','Hiperrealista'),('C006','Impresionista'),('C007','Pop'),('C008','Realista'),('C009','Surrealista'),('C010','Symchromista');

/*Table structure for table `cliente` */

DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (
  `user` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `cedula` int(30) NOT NULL,
  `telefono` int(30) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `admin` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `cliente` */

insert  into `cliente`(`user`,`password`,`nombre`,`apellido`,`cedula`,`telefono`,`direccion`,`email`,`admin`) values ('mari','1234','mari','nelly',666969,7373737,'owrutoirutiuerot','kjshdfkjd@hotmail.com',0),('andre','1234','AndrǸs','Visbal',1140821235,3525362,'calle80c#35d-61','andres_visbal@hotmail.com',1);

/*Table structure for table `factura` */

DROP TABLE IF EXISTS `factura`;

CREATE TABLE `factura` (
  `codigofact` int(30) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `formapago` varchar(30) NOT NULL,
  `user` varchar(30) DEFAULT NULL,
  `valortotal` int(30) DEFAULT NULL,
  PRIMARY KEY (`codigofact`,`fecha`,`formapago`),
  UNIQUE KEY `codigo` (`codigofact`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `factura` */

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `IdProd` varchar(45) NOT NULL,
  `NombreP` varchar(45) NOT NULL,
  `Categoria` varchar(45) NOT NULL,
  `Cantidad` int(10) unsigned NOT NULL,
  `Precio` int(10) unsigned NOT NULL,
  `Autor` varchar(45) NOT NULL,
  `Pais` varchar(45) NOT NULL,
  `Dimensiones` varchar(45) NOT NULL,
  `Imagen` varchar(45) NOT NULL,
  `Tecnica` varchar(45) NOT NULL,
  `Soporte` varchar(45) NOT NULL,
  PRIMARY KEY (`IdProd`),
  KEY `Categoria` (`Categoria`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `producto` */

insert  into `producto`(`IdProd`,`NombreP`,`Categoria`,`Cantidad`,`Precio`,`Autor`,`Pais`,`Dimensiones`,`Imagen`,`Tecnica`,`Soporte`) values ('P0001','Abstracte','C001',0,300000,'Susana Prats','Italia','65 x 54 cms','images/Abstracte.jpg','Acrilico','Lienzo'),('P0002','blanco y negro','C001',4,400000,'Jeremie Iordanoff','Francia','50 x 65 cms','images/blanco y negro.jpg','Tecnica mixta','Tela'),('P0003','Choque de culturas','C001',3,350000,'Susana Prats','Italia','55 x 65 cms','images/Choque de culturas.jpg','Acrilico','Papel'),('P0004','La Felicidad de Claudia y Jorge','C001',5,400000,'Jorge Restrepo','Portugal','140 x 114 cms','images/La Felicidad de Claudia y Jorge.jpg','Acrilico','Tela'),('P0005','Sens','C001',3,370000,'Juan Diego Ramos','Italia','100 x 81 cms','images/Sens.jpg','Tecnica mixta','Tela'),('P0006','The big bang','C001',3,375000,'Cipri','Italia','40 x 50 cms','images/The big bang.jpg','Acrilico','Papel'),('P0007','Tres Uno','C001',3,450000,'Jeremie Iordanoff','Francia','41 x 33 cms','images/Tres Uno.jpg','Oleo','Tela'),('P0008','Juegos','C004',3,600000,'Pere Ventura Julia','Italia','55 x 46 cms','images/Juegos.jpg','Oleo','Tela'),('P0009','Madres negras','C004',2,900000,'Martin La Spina','Italia','100 x 70 cms','images/Madres negras.jpg','Tecnica mixta','Papel'),('P0010','Superficie de dolor','C004',3,900000,'Martn La Spina','Italia','70 x 100 cms','images/Superficie de dolor.jpg','Tecnica Mixta','Tela'),('P0011','Maternal','C004',2,650000,'Pere Ventura Julia','Italia','33 x 24 cms','images/Maternal.jpg','Oleo','Tela'),('P0012','Cristo de las penas','C002',2,700000,'Raul Canestro Caballero','Alemania','116 x 89 cms','images/Cristo de las penas.jpg','Oleo','Tela'),('P0013','Contemplando','C002',2,700000,'Federico Vivanco Garcia ','Italia','50 x 60 cms','images/Contemplando.jpg','Oleo','Tela'),('P0014','De la linea al caballo','C002',2,750000,'Mario Alberto Gonzalez','Colombia','90 x 60 cms','images/De la linea al caballo.jpg','Oleo','Lienzo'),('P0015','Detras del espejo','C002',3,800000,'Mario Patino','Mexico','80 x 100 cms','images/Detras del espejo.jpg','Acrilico','Lienzo'),('P0016','Cuerpo de hombre','C003',2,900000,'Rufi Garcia Nadal','Mexico','54 x 65 cms','images/Cuerpo de hombre.jpg','Acrilico','Tela'),('P0017','Primer premio','C003',2,950000,'Juan Rozos','Colombia','60 x 70 cms','images/Primer premio.jpg','Acuarela','Papel'),('P0018','Vida infinita','C005',4,1000000,'Emmanuel Cruz Muñoz','Alemania','70 x 80 cms','images/Vida infinita.jpg','Grafico','Opalina'),('P0019','Rostro','C005',4,1300000,'Elia Verano','Alemania','100 x 70 cms','images/Rostro.jpg','Grafico','Opalina'),('P0020','A cal y canto','C005',3,900000,'Jose Madrid','Brazil','90 x 80 cms','images/A cal y canto.jpg','Oleo','Tela'),('P0021','Emociones artificiales','C005',3,800000,'Emmanuel Cruz','Brazil','95 x 80 cms','images/Emociones artificiales.jpg','Carbon y acrilico','Papel');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
