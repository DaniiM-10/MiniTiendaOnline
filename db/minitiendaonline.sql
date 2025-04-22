-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 22, 2025 at 03:37 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minitiendaonline`
--

-- --------------------------------------------------------

--
-- Table structure for table `compra`
--

CREATE TABLE `compra` (
  `compra_id` int NOT NULL,
  `compra_precio_total` decimal(10,2) NOT NULL,
  `compra_fecha_compra` date NOT NULL,
  `compra_pais` varchar(50) DEFAULT NULL,
  `compra_provincia` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `compra_ciudad` varchar(50) DEFAULT NULL,
  `compra_barrio` varchar(50) DEFAULT NULL,
  `compra_calle` varchar(100) DEFAULT NULL,
  `compra_nro` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `img_producto`
--

CREATE TABLE `img_producto` (
  `producto_id` int NOT NULL,
  `img_producto_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `img_producto`
--

INSERT INTO `img_producto` (`producto_id`, `img_producto_url`) VALUES
(1, 'accesorio_1.jpg'),
(2, 'pantalon_1.jpg'),
(3, 'remera_1.jpg'),
(4, 'calzado_1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pertenece`
--

CREATE TABLE `pertenece` (
  `compra_id` int NOT NULL,
  `producto_id` int NOT NULL,
  `pertenece_cantidad` int NOT NULL,
  `pertenece_precio_cantidad` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `producto_id` int NOT NULL,
  `producto_nombre` varchar(100) NOT NULL,
  `producto_descripcion` text,
  `producto_stock` int NOT NULL,
  `producto_precio` decimal(10,2) NOT NULL,
  `producto_dimension` varchar(100) NOT NULL,
  `producto_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`producto_id`, `producto_nombre`, `producto_descripcion`, `producto_stock`, `producto_precio`, `producto_dimension`, `producto_categoria`) VALUES
(1, 'Collar artesanal', 'Collar con cuentas blancas, negras y marrones, diseño artesanal', 12, 8099.99, 'Largo: 45 cm', 'Accesorio'),
(2, 'Pantalón cargo verde', 'Pantalón cargo con bolsillos laterales, estilo casual', 6, 12300.50, 'S,M,L,XL', 'Ropa'),
(3, 'Remera \"The Moon\"', 'Remera negra con ilustración de la luna y sus fases', 9, 87000.99, 'S,M,L,XL', 'Ropa'),
(4, 'Zapatillas Adidas Campus', 'Zapatillas Adidas negras con detalles blancos, suela de goma clara', 5, 199999.99, '38,40,44', 'Calzado');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`compra_id`);

--
-- Indexes for table `img_producto`
--
ALTER TABLE `img_producto`
  ADD PRIMARY KEY (`producto_id`,`img_producto_url`);

--
-- Indexes for table `pertenece`
--
ALTER TABLE `pertenece`
  ADD PRIMARY KEY (`compra_id`,`producto_id`),
  ADD KEY `pertenece_ibfk_2` (`producto_id`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`producto_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `compra`
--
ALTER TABLE `compra`
  MODIFY `compra_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `producto_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `img_producto`
--
ALTER TABLE `img_producto`
  ADD CONSTRAINT `img_producto_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`producto_id`);

--
-- Constraints for table `pertenece`
--
ALTER TABLE `pertenece`
  ADD CONSTRAINT `pertenece_ibfk_1` FOREIGN KEY (`compra_id`) REFERENCES `compra` (`compra_id`),
  ADD CONSTRAINT `pertenece_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`producto_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
