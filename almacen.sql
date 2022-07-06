SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `detalle_marca` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `marca` (`id`, `nombre`, `detalle_marca`) VALUES
(1, 'PAN', 'harinas'),
(2, 'MAVESA', 'Aceites comestibles, margarinas y derivados'),
(3, 'Allegri', 'pasta y derivados'),
(4, 'Sindoni', 'pasta y derivados'),
(5, 'MACEITE', 'Aceites comestibles, margarinas y derivados'),
(6, 'Iberia', 'condimentos');

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `marca_id` int(11) DEFAULT NULL,
  `detalle` varchar(100) DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `costo` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `producto` (`id`, `codigo_producto`, `marca_id`, `detalle`, `fecha_vencimiento`, `costo`) VALUES
(1, 1, 1, 'harina de maíz', '2019-03-04', '23800.50'),
(2, 2305, 2, 'margarina', '2020-06-04', '34000.00'),
(3, 421, 3, 'pasta', '2021-07-11', '32000.00'),
(4, 2301, 4, 'pasta', '2020-03-08', '27200.00'),
(5, 2341, 5, 'Aceite comestible', '2020-03-04', '30500.50'),
(6, 1001, 6, 'canela en rama', NULL, '800.50');


ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
