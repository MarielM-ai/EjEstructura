-- Crear base de datos para proyecto
-- Por ejemplo: proyecto_bd
CREATE DATABASE proyecto_bd;
use proyecto_bd;


-- Tabla Usuarios
CREATE TABLE `Usuarios` (
  `mail` varchar(100) NOT NULL,
  `numero` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `App` varchar(100) NOT NULL,
  `apm` varchar(100) NOT NULL,
  `fecha` date DEFAULT CURRENT_DATE(),
  `login` varchar(100) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `rol` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`mail`),
  UNIQUE KEY `numero` (`numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
