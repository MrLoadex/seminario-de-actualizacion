-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-08-2024 a las 18:47:43
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `acces_control_mechanisms_db`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_user_and_password` (IN `p_name` VARCHAR(255), IN `p_password` VARCHAR(255))   SELECT * FROM user WHERE name = p_name AND password = p_password$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_user` (IN `p_name` VARCHAR(255), IN `p_password` VARCHAR(255))   BEGIN
    INSERT INTO user (name, password) VALUES (p_name, p_password);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_user` (IN `p_ID` INT)   BEGIN
    DELETE FROM user WHERE ID = p_ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_all_users` ()   BEGIN
    SELECT ID, name FROM user;  -- No seleccionar las contraseñas por seguridad
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_userID_by_name` (IN `p_name` VARCHAR(255))   BEGIN
    SELECT ID FROM user WHERE name = p_name;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_username_by_id` (IN `p_ID` INT)   SELECT ID, name FROM `user` WHERE ID = p_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_user` (IN `p_name` VARCHAR(255), IN `p_ID` INT)   UPDATE user SET name = p_name WHERE ID = p_ID$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `action`
--

CREATE TABLE `action` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `action`
--

INSERT INTO `action` (`ID`, `name`) VALUES
(1, 'agregarProducto'),
(2, 'retirarProducto'),
(3, 'pesarProducto'),
(4, 'emitirFactura'),
(5, 'pedirProductos'),
(6, 'pagarFactura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `team`
--

CREATE TABLE `team` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `team`
--

INSERT INTO `team` (`ID`, `name`) VALUES
(1, 'vendedor'),
(2, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `team_action`
--

CREATE TABLE `team_action` (
  `ID_team` int(11) NOT NULL,
  `ID_action` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `team_action`
--

INSERT INTO `team_action` (`ID_team`, `ID_action`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 5),
(2, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`ID`, `name`, `password`) VALUES
(1, 'Julian_Nunez', 'password123'),
(2, 'jorge', 'password456'),
(3, 'Toro', 'asdc123'),
(4, 'Aldi', 'passwordA123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_team`
--

CREATE TABLE `user_team` (
  `ID_user` int(11) NOT NULL,
  `ID_team` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_team`
--

INSERT INTO `user_team` (`ID_user`, `ID_team`) VALUES
(1, 1),
(2, 2),
(3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `team_action`
--
ALTER TABLE `team_action`
  ADD PRIMARY KEY (`ID_team`,`ID_action`),
  ADD KEY `ID_action` (`ID_action`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indices de la tabla `user_team`
--
ALTER TABLE `user_team`
  ADD PRIMARY KEY (`ID_user`,`ID_team`),
  ADD KEY `ID_team` (`ID_team`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `action`
--
ALTER TABLE `action`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `team`
--
ALTER TABLE `team`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `team_action`
--
ALTER TABLE `team_action`
  ADD CONSTRAINT `team_action_ibfk_1` FOREIGN KEY (`ID_team`) REFERENCES `team` (`ID`),
  ADD CONSTRAINT `team_action_ibfk_2` FOREIGN KEY (`ID_action`) REFERENCES `action` (`ID`);

--
-- Filtros para la tabla `user_team`
--
ALTER TABLE `user_team`
  ADD CONSTRAINT `user_team_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `user_team_ibfk_2` FOREIGN KEY (`ID_team`) REFERENCES `team` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
