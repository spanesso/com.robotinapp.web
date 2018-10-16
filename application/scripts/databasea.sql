-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2018 a las 06:25:13
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clean_app_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category_plan`
--

CREATE TABLE `category_plan` (
  `id_category` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `category_plan`
--

INSERT INTO `category_plan` (`id_category`, `name`, `description`) VALUES
(1, 'Monthly', 'Category #1'),
(2, 'Quarterly', 'Category #2'),
(3, 'Biannual', 'Category #3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `housekeeping_services`
--

CREATE TABLE `housekeeping_services` (
  `id_housekeeping_service` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `id_housekeeping` int(11) NOT NULL,
  `id_service_status` int(11) NOT NULL,
  `finish_service` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plans`
--

CREATE TABLE `plans` (
  `id_plan` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `url_payment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promotions`
--

CREATE TABLE `promotions` (
  `id_promotion` int(11) NOT NULL,
  `title` text NOT NULL,
  `code` text NOT NULL,
  `init_date` text NOT NULL,
  `finish_date` text NOT NULL,
  `discount` text NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rol` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`) VALUES
(1, 'Admin'),
(2, 'Client'),
(3, 'Keeping');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service`
--

CREATE TABLE `service` (
  `id_service` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_plan` int(11) NOT NULL,
  `date` text NOT NULL,
  `place_lat` text NOT NULL,
  `place_long` text NOT NULL,
  `place_address` text NOT NULL,
  `place_name` text NOT NULL,
  `description` text NOT NULL,
  `pay_service` int(11) NOT NULL,
  `schedule_service` int(11) NOT NULL,
  `label_address` text NOT NULL,
  `service_status` int(11) NOT NULL,
  `zip_code` text NOT NULL,
  `apto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service_status`
--

CREATE TABLE `service_status` (
  `id_service_status` int(11) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `service_status`
--

INSERT INTO `service_status` (`id_service_status`, `status`) VALUES
(1, 'registered / pending pay'),
(2, 'pay / pending assing'),
(3, 'on asigned'),
(4, 'asigned'),
(5, 'started'),
(6, 'finished'),
(7, 'closed'),
(99, 'Canceled');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shcedule_pay_services`
--

CREATE TABLE `shcedule_pay_services` (
  `id_shcedule_pay_services` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `pay_service_date` text NOT NULL,
  `promotion` int(11) NOT NULL,
  `total_payment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_promotions`
--

CREATE TABLE `users_promotions` (
  `id_user_promotion` int(11) NOT NULL,
  `id_promotion` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `adquire_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_admin`
--

CREATE TABLE `user_admin` (
  `id_admin` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user_admin`
--

INSERT INTO `user_admin` (`id_admin`, `id_rol`, `name`, `last_name`, `email`, `password`, `status`) VALUES
(1, 1, 'sebastian', 'panesso', 'spanesso@gmail.com', '123', 1),
(2, 1, 'pepe', 'grillo', 'pepe@gmail.com', 'pepe@gmail.com', 1),
(3, 1, 'awer', 'awer', 'awer@asf.com', 'awer@asf.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_client`
--

CREATE TABLE `user_client` (
  `id_client` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `name` text NOT NULL,
  `photo` text NOT NULL,
  `email` text NOT NULL,
  `birth_date` text NOT NULL,
  `phone` text NOT NULL,
  `other_phone` text NOT NULL,
  `password` text NOT NULL,
  `folder` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_housekeeping`
--

CREATE TABLE `user_housekeeping` (
  `id_housekeeping` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `medicare` text NOT NULL,
  `name` text NOT NULL,
  `last_name` text NOT NULL,
  `home_address` text NOT NULL,
  `photo` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `phone` text NOT NULL,
  `other_phone` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `folder` text NOT NULL,
  `code` text NOT NULL,
  `birthdate` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_notifications`
--

CREATE TABLE `user_notifications` (
  `id_notification` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `title` text NOT NULL,
  `message` text NOT NULL,
  `date` text NOT NULL,
  `image` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `category_plan`
--
ALTER TABLE `category_plan`
  ADD PRIMARY KEY (`id_category`);

--
-- Indices de la tabla `housekeeping_services`
--
ALTER TABLE `housekeeping_services`
  ADD PRIMARY KEY (`id_housekeeping_service`),
  ADD KEY `id_service_status` (`id_service_status`),
  ADD KEY `id_service` (`id_service`),
  ADD KEY `id_housekeeping` (`id_housekeeping`);

--
-- Indices de la tabla `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id_plan`),
  ADD KEY `id_category` (`id_category`);

--
-- Indices de la tabla `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id_promotion`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_service`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_plan` (`id_plan`);

--
-- Indices de la tabla `service_status`
--
ALTER TABLE `service_status`
  ADD PRIMARY KEY (`id_service_status`);

--
-- Indices de la tabla `shcedule_pay_services`
--
ALTER TABLE `shcedule_pay_services`
  ADD PRIMARY KEY (`id_shcedule_pay_services`),
  ADD KEY `id_service` (`id_service`);

--
-- Indices de la tabla `users_promotions`
--
ALTER TABLE `users_promotions`
  ADD PRIMARY KEY (`id_user_promotion`),
  ADD KEY `id_service` (`id_service`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_promotion` (`id_promotion`);

--
-- Indices de la tabla `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `user_client`
--
ALTER TABLE `user_client`
  ADD PRIMARY KEY (`id_client`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `user_housekeeping`
--
ALTER TABLE `user_housekeeping`
  ADD PRIMARY KEY (`id_housekeeping`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD PRIMARY KEY (`id_notification`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_service` (`id_service`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `category_plan`
--
ALTER TABLE `category_plan`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `housekeeping_services`
--
ALTER TABLE `housekeeping_services`
  MODIFY `id_housekeeping_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `plans`
--
ALTER TABLE `plans`
  MODIFY `id_plan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id_promotion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `service`
--
ALTER TABLE `service`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT de la tabla `service_status`
--
ALTER TABLE `service_status`
  MODIFY `id_service_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT de la tabla `shcedule_pay_services`
--
ALTER TABLE `shcedule_pay_services`
  MODIFY `id_shcedule_pay_services` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `users_promotions`
--
ALTER TABLE `users_promotions`
  MODIFY `id_user_promotion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `user_client`
--
ALTER TABLE `user_client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `user_housekeeping`
--
ALTER TABLE `user_housekeeping`
  MODIFY `id_housekeeping` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `id_notification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `housekeeping_services`
--
ALTER TABLE `housekeeping_services`
  ADD CONSTRAINT `housekeeping_services_ibfk_1` FOREIGN KEY (`id_service_status`) REFERENCES `service_status` (`id_service_status`),
  ADD CONSTRAINT `housekeeping_services_ibfk_2` FOREIGN KEY (`id_service`) REFERENCES `service` (`id_service`),
  ADD CONSTRAINT `housekeeping_services_ibfk_3` FOREIGN KEY (`id_housekeeping`) REFERENCES `user_housekeeping` (`id_housekeeping`);

--
-- Filtros para la tabla `plans`
--
ALTER TABLE `plans`
  ADD CONSTRAINT `plans_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category_plan` (`id_category`);

--
-- Filtros para la tabla `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `user_client` (`id_client`),
  ADD CONSTRAINT `service_ibfk_2` FOREIGN KEY (`id_plan`) REFERENCES `plans` (`id_plan`);

--
-- Filtros para la tabla `shcedule_pay_services`
--
ALTER TABLE `shcedule_pay_services`
  ADD CONSTRAINT `shcedule_pay_services_ibfk_1` FOREIGN KEY (`id_service`) REFERENCES `service` (`id_service`);

--
-- Filtros para la tabla `users_promotions`
--
ALTER TABLE `users_promotions`
  ADD CONSTRAINT `users_promotions_ibfk_1` FOREIGN KEY (`id_service`) REFERENCES `service` (`id_service`),
  ADD CONSTRAINT `users_promotions_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `user_client` (`id_client`),
  ADD CONSTRAINT `users_promotions_ibfk_3` FOREIGN KEY (`id_promotion`) REFERENCES `promotions` (`id_promotion`);

--
-- Filtros para la tabla `user_admin`
--
ALTER TABLE `user_admin`
  ADD CONSTRAINT `user_admin_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);

--
-- Filtros para la tabla `user_client`
--
ALTER TABLE `user_client`
  ADD CONSTRAINT `user_client_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);

--
-- Filtros para la tabla `user_housekeeping`
--
ALTER TABLE `user_housekeeping`
  ADD CONSTRAINT `user_housekeeping_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);

--
-- Filtros para la tabla `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD CONSTRAINT `user_notifications_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `user_client` (`id_client`),
  ADD CONSTRAINT `user_notifications_ibfk_2` FOREIGN KEY (`id_service`) REFERENCES `service` (`id_service`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
