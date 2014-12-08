-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-12-2014 a las 19:34:46
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `practica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios`
--

CREATE TABLE IF NOT EXISTS `envios` (
`cod_envio` int(11) NOT NULL,
  `destinatario` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `poblacion` varchar(25) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cod_postal` varchar(15) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `provincia` char(2) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` char(1) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'p',
  `fecha_crea` date NOT NULL,
  `fecha_ent` date DEFAULT NULL,
  `observaciones` varchar(300) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `envios`
--

INSERT INTO `envios` (`cod_envio`, `destinatario`, `telefono`, `direccion`, `poblacion`, `cod_postal`, `provincia`, `email`, `estado`, `fecha_crea`, `fecha_ent`, `observaciones`) VALUES
(1, 'Ángel Candón Fuentes', '657849392', 'C/ Roble, 3', 'Huelva', '21004', '21', 'mangel@gmail.com', 'E', '2014-11-12', NULL, 'Entregado sin problemas'),
(2, 'Manuel García Alcudia', '656748322', 'C/ Puerto, 16, 4ºB', 'Huelva', '21007', '21', 'mgalcudia@gmail.com', 'p', '2014-11-12', NULL, 'Urgente'),
(3, 'Joaquín Lobo Rodríguez', '682977647', 'C/ Almonaster, 3, 3ºC', 'Huelva', '21006', '21', 'jwolf@gmail.com', 'd', '2014-11-26', NULL, 'Urgente'),
(5, 'Javier Conde Alcántara', '678019287', 'C/ Velázquez, 47', 'Villaviciosa de Odón', '28670', '28', 'jacoal@gmail.com', 'E', '2014-11-26', '2014-12-08', 'Nada a destacar'),
(6, 'Juan Gómez Ramirez', '654892123', 'C/ Cuzco, 7, 7ºB', 'Málaga', '29010', '29', 'juango@gmail.com', 'p', '2014-11-26', NULL, 'Urgente'),
(7, 'Lorena Carleos Gómez', '654372811', 'C/ Juan Mateo Jiménez', 'Huelva', '21004', '21', 'lorecarleos@gmail.com', 'p', '2014-11-26', NULL, 'Nada destacable'),
(8, 'Alejandro Gomez García', '677895543', 'C/ Valdelamusa, 33', 'Huelva', '21007', '21', 'alegogar@hotmail.com', 'p', '2014-11-26', NULL, ''),
(9, 'Antonio Romero Roldán', '654334667', 'C/ Galaroza, 6, 4ºB', 'Huelva', '21001', '21', 'anromrol@gmail.com', 'p', '2014-11-26', NULL, 'Frágil'),
(10, 'Mª Ángeles Rodríguez Contreras', '675483920', 'C/ Focha, 35', 'El Portil', '21459', '21', 'mangelesrodcon@gmail.com', 'p', '2014-11-26', NULL, 'Urgente'),
(12, 'Francisco García Ponce', '654888855', 'C/ Federico Molina, 56', 'Almería', '29311', '05', 'fragarpon@gmail.com', 'E', '2014-11-30', '2014-12-07', 'Nada en especial'),
(13, 'Mª Dolores Roldán', '654332829', 'C/ La Mancha, 57, 5ºE', 'Ávila', '28939', '05', 'mdolrol@hotmail.es', 'E', '2014-12-08', '2014-12-08', 'Urgente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE IF NOT EXISTS `provincias` (
  `cod_provincia` char(2) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '00' COMMENT 'Código de la provincia de dos digitos(caracteres)',
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT 'Nombre de la provincia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci COMMENT='Provincias de españa; 99 para seleccionar a Nacional';

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`cod_provincia`, `nombre`) VALUES
('01', 'Alava'),
('02', 'Albacete'),
('03', 'Alicante'),
('04', 'Almera'),
('33', 'Asturias'),
('05', 'Avila'),
('06', 'Badajoz'),
('07', 'Balears (Illes)'),
('08', 'Barcelona'),
('09', 'Burgos'),
('10', 'Cáceres'),
('11', 'Cádiz'),
('39', 'Cantabria'),
('12', 'Castellón'),
('51', 'Ceuta'),
('13', 'Ciudad Real'),
('14', 'Córdoba'),
('15', 'Coruña (A)'),
('16', 'Cuenca'),
('17', 'Girona'),
('18', 'Granada'),
('19', 'Guadalajara'),
('20', 'Guipzcoa'),
('21', 'Huelva'),
('22', 'Huesca'),
('23', 'Jaén'),
('24', 'León'),
('25', 'Lleida'),
('27', 'Lugo'),
('28', 'Madrid'),
('29', 'Málaga'),
('52', 'Melilla'),
('30', 'Murcia'),
('31', 'Navarra'),
('32', 'Ourense'),
('34', 'Palencia'),
('35', 'Palmas (Las)'),
('36', 'Pontevedra'),
('26', 'Rioja (La)'),
('37', 'Salamanca'),
('38', 'Santa Cruz de Tenerife'),
('40', 'Segovia'),
('41', 'Sevilla'),
('42', 'Soria'),
('43', 'Tarragona'),
('44', 'Teruel'),
('45', 'Toledo'),
('46', 'Valencia'),
('47', 'Valladolid'),
('48', 'Vizcaya'),
('49', 'Zamora'),
('50', 'Zaragoza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuario` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `password`) VALUES
('admin', '$2y$10$aCHOqOfP2KMNdzQelqiUF.sEzLXztt6rszG56TNmY4CddVvHCaxRK'),
('empleado', '$2y$10$kLINh7DsvfAx45G8nFj.7OdB6xvL8uP9MeJXRfWrCD1IBbSUOyXVW'),
('root', '$2y$10$BHJHO3AF6EW1v2zL1.rlSumhAd0qSOLDs.38AlqtRz1h4FkwbefdW'),
('user', '$2y$10$saUQwTJS6WCfAhwKmKiE7et.JlI5z3pu9qEJ7RrgqZsS7QrWZNq.a');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `envios`
--
ALTER TABLE `envios`
 ADD PRIMARY KEY (`cod_envio`), ADD KEY `fk_idx` (`provincia`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
 ADD PRIMARY KEY (`cod_provincia`), ADD KEY `nombre` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `envios`
--
ALTER TABLE `envios`
MODIFY `cod_envio` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `envios`
--
ALTER TABLE `envios`
ADD CONSTRAINT `fk_provincias` FOREIGN KEY (`provincia`) REFERENCES `provincias` (`cod_provincia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
