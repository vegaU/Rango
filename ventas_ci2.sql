

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL DEFAULT '0',
  `nombre` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `descripcion` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `codigo`, `nombre`, `descripcion`, `estado`) VALUES
	(1, 22, 'Jugos', 'Jugos de Frutas', 1),
	(2, 0, 'Lacteos', 'Leches Enlatado', 1),
	(3, 0, 'coca', 'Gaseosas', 1),
	(4, 0, 'Celulares', 'Todas las Marcas', 1),
	(5, 0, 'asdsd', 'asdssd', 1),
	(6, 0, 'cate prueba', 'esto es una prueba modificada', 0);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  `direccion` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `tipo_cliente_id` int(11) DEFAULT NULL,
  `tipo_documento_id` int(11) DEFAULT NULL,
  `num_documento` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tipo_cliente_idx` (`tipo_cliente_id`),
  KEY `fk_tipo_documento_idx` (`tipo_documento_id`),
  CONSTRAINT `fk_tipo_cliente` FOREIGN KEY (`tipo_cliente_id`) REFERENCES `tipo_cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tipo_documento` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`id`, `nombre`, `telefono`, `direccion`, `tipo_cliente_id`, `tipo_documento_id`, `num_documento`, `estado`) VALUES
	(1, 'ALEXIS2', '021222', '2R ITAUGUA', 1, 2, '54455', 1),
	(2, 'Aldo Moreno', '096885', 'AV Caceres 43000', 2, 1, '4987545', 1),
	(3, 'Jorge', '4444', 'itaugua', 1, 1, '552', 1);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

DROP TABLE IF EXISTS `compras`;
CREATE TABLE IF NOT EXISTS `compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_compra` date DEFAULT NULL,
  `subtotal` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `igv` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `descuento` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `total` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `tipo_comprobante_id` int(11) DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `num_comprobante` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `num_serie` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_compra_idx` (`usuario_id`),
  KEY `fk_proveedor_compra_idx` (`proveedor_id`),
  KEY `fk_tipo_comprobante_compra_idx` (`tipo_comprobante_id`),
  CONSTRAINT `fk_tipo_comprobante_compra` FOREIGN KEY (`tipo_comprobante_id`) REFERENCES `tipo_comprobante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_compra` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
INSERT INTO `compras` (`id`, `fecha_compra`, `subtotal`, `igv`, `descuento`, `total`, `tipo_comprobante_id`, `proveedor_id`, `usuario_id`, `num_comprobante`, `num_serie`, `estado`) VALUES
	(28, '2019-04-10', '55000.00', '0.00', '0.00', '55000.00', 1, 1, 8, '131', '03312', NULL);
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;

DROP TABLE IF EXISTS `detalle_compras`;
CREATE TABLE IF NOT EXISTS `detalle_compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) DEFAULT NULL,
  `compras_id` int(11) DEFAULT NULL,
  `precio_compra_unidad` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `cantidad` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `importe` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*!40000 ALTER TABLE `detalle_compras` DISABLE KEYS */;
INSERT INTO `detalle_compras` (`id`, `producto_id`, `compras_id`, `precio_compra_unidad`, `cantidad`, `importe`) VALUES
	(1, 3, 28, '5500', '10', '55000.00');
/*!40000 ALTER TABLE `detalle_compras` ENABLE KEYS */;

DROP TABLE IF EXISTS `detalle_venta`;
CREATE TABLE IF NOT EXISTS `detalle_venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) DEFAULT NULL,
  `venta_id` int(11) DEFAULT NULL,
  `precio` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `cantidad` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `importe` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_venta_detalle_idx` (`venta_id`),
  KEY `fk_producto_detalle_idx` (`producto_id`),
  CONSTRAINT `fk_producto_detalle` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_detalle` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*!40000 ALTER TABLE `detalle_venta` DISABLE KEYS */;
INSERT INTO `detalle_venta` (`id`, `producto_id`, `venta_id`, `precio`, `cantidad`, `importe`) VALUES
	(10, 3, 8, '6.50', '5', '32.50'),
	(11, 1, 8, '3.50', '3', '10.50'),
	(12, 2, 8, '3.00', '2', '6.00'),
	(13, 1, 9, '3.50', '10', '35.00'),
	(14, 3, 14, '5.50', '2', '11.00'),
	(15, 3, 15, '5500', '1', '5500'),
	(16, 3, 16, '5500', '3', '16500.00'),
	(17, 1, 17, '5000', '3', '15000.00'),
	(18, 4, 18, '250000', '10', '2500000.00'),
	(19, 2, 19, '3.000', '5', '15.00'),
	(20, 2, 20, '3.000', '5', '15.00'),
	(21, 2, 22, '3000', '1', '3000'),
	(22, 1, 23, '5000', '1', '5000'),
	(23, 1, 24, '5000', '1', '5000'),
	(24, 1, 25, '5000', '1', '5000'),
	(25, 3, 26, '5500', '12', '66000.00'),
	(26, 3, 27, '5500', '3', '16500.00');
/*!40000 ALTER TABLE `detalle_venta` ENABLE KEYS */;

DROP TABLE IF EXISTS `marcas`;
CREATE TABLE IF NOT EXISTS `marcas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`marca`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
INSERT INTO `marcas` (`id`, `marca`, `estado`) VALUES
	(1, 'tokio', 1);
/*!40000 ALTER TABLE `marcas` ENABLE KEYS */;

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `link` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` (`id`, `nombre`, `link`) VALUES
	(1, 'Inicio', 'Dashboard'),
	(2, 'Categorias', 'mantenimiento/Categorias'),
	(3, 'Clientes', 'mantenimiento/clientes'),
	(4, 'Productos', 'mantenimiento/productos'),
	(5, 'Ventas', 'movimientos/ventas'),
	(6, 'Ventas', 'reportes/ventas'),
	(7, 'Usuarios', 'administrador/usuarios'),
	(8, 'Permisos', 'administrador/permisos'),
	(9, 'Marcas', 'mantenimiento/marcas'),
	(10, 'Proveedores', 'mantenimiento/proveedores'),
	(11, 'Compras', 'movimientos/compras');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE IF NOT EXISTS `permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `read` int(11) DEFAULT NULL,
  `insert` int(11) DEFAULT NULL,
  `update` int(11) DEFAULT NULL,
  `delete` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_menus_idx` (`menu_id`),
  KEY `fk_rol_idx` (`rol_id`),
  CONSTRAINT `fk_menus` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rol` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='			';

/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
INSERT INTO `permisos` (`id`, `menu_id`, `rol_id`, `read`, `insert`, `update`, `delete`) VALUES
	(1, 1, 1, 1, 1, 1, 1),
	(2, 2, 1, 1, 1, 1, 1),
	(7, 3, 1, 1, 1, 1, 1),
	(8, 4, 1, 1, 1, 1, 1),
	(9, 5, 1, 1, 1, 1, 1),
	(10, 6, 1, 1, 1, 1, 1),
	(11, 7, 1, 1, 1, 1, 1),
	(12, 8, 1, 1, 1, 1, 1),
	(13, 9, 1, 1, 1, 1, 1),
	(14, 10, 1, 1, 1, 1, 1),
	(15, 11, 1, 1, 1, 1, 1);
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `descripcion` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `precio` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `precioxMayor` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `precioxCantidad` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `color` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `stockMinimo` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `marca_id` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  KEY `fk_categoria_producto_idx` (`categoria_id`),
  CONSTRAINT `fk_categoria_producto` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` (`id`, `codigo`, `nombre`, `descripcion`, `precio`, `precioxMayor`, `precioxCantidad`, `color`, `stockMinimo`, `stock`, `categoria_id`, `marca_id`, `estado`) VALUES
	(1, '10001', 'Leche Gloria 400g', 'Leche enlatado', '5000', '', '', '', '34', 1, 2, 1, 1),
	(2, '10002', 'Jugos de Naranja', 'Todos los Jugos', '3000', NULL, NULL, NULL, NULL, 5, 1, 1, 1),
	(3, '10003', 'CocaCola 2.5l', 'Coca Cola no retornable', '5500', NULL, NULL, NULL, NULL, 57, 3, 1, 1),
	(4, '1004', 'Nokia', 'Nokia Lumia', '250000', NULL, NULL, NULL, NULL, 15, 4, 1, 1);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE IF NOT EXISTS `proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  `direccion` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `contacto` varchar(11) COLLATE latin1_spanish_ci DEFAULT NULL,
  `celular` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ruc` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` (`id`, `razon_social`, `telefono`, `direccion`, `contacto`, `celular`, `ruc`, `estado`) VALUES
	(1, 'prove', 'justo', 'dir', 'dir', '23424', '12312', NULL);
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `descripcion` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `nombre`, `descripcion`) VALUES
	(1, 'Superadmin', 'empleado'),
	(2, 'Admin', 'Empleado');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

DROP TABLE IF EXISTS `tipo_cliente`;
CREATE TABLE IF NOT EXISTS `tipo_cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `descripcion` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*!40000 ALTER TABLE `tipo_cliente` DISABLE KEYS */;
INSERT INTO `tipo_cliente` (`id`, `nombre`, `descripcion`) VALUES
	(1, 'Empresa', 'informatica'),
	(2, 'Publico General', 'toods');
/*!40000 ALTER TABLE `tipo_cliente` ENABLE KEYS */;

DROP TABLE IF EXISTS `tipo_comprobante`;
CREATE TABLE IF NOT EXISTS `tipo_comprobante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `igv` int(11) DEFAULT NULL,
  `serie` char(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*!40000 ALTER TABLE `tipo_comprobante` DISABLE KEYS */;
INSERT INTO `tipo_comprobante` (`id`, `nombre`, `cantidad`, `igv`, `serie`) VALUES
	(1, 'Factura', 9, 10, '001'),
	(2, 'Boleto', 21, 0, '001');
/*!40000 ALTER TABLE `tipo_comprobante` ENABLE KEYS */;

DROP TABLE IF EXISTS `tipo_documento`;
CREATE TABLE IF NOT EXISTS `tipo_documento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*!40000 ALTER TABLE `tipo_documento` DISABLE KEYS */;
INSERT INTO `tipo_documento` (`id`, `nombre`, `cantidad`) VALUES
	(1, 'Cedula', 1),
	(2, 'RUC', 2);
/*!40000 ALTER TABLE `tipo_documento` ENABLE KEYS */;

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `apellidos` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  `email` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `username` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `password` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_rol_usuarios_idx` (`rol_id`),
  CONSTRAINT `fk_rol_usuarios` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `telefono`, `email`, `username`, `password`, `rol_id`, `estado`) VALUES
	(3, 'Alexis', 'fretes fure', '0971516217', NULL, 'alex', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, 1),
	(4, 'Jorge', 'Jenes', '5225555', '', 'jorge', NULL, 1, 0),
	(5, 'olimpero', 'fretez', '4555', 'jsajajad', 'olimpero', '123456', 1, 0),
	(6, 'alexi', 'fretez', '55555', 'wwrer', 'aldo', '12345', 2, 0),
	(7, 'juan Alberto', 'Rojas', '44524', 'sdsds', 'alberto', '1234', 1, 0),
	(8, 'olim', 'fretez', '096885', 'kdkdkd', 'olimpia', '8cb2237d0679ca88db6464eac60da96345513964', 1, 1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `subtotal` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `igv` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `descuento` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `total` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `tipo_comprobante_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `num_documento` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `serie` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_venta_idx` (`usuario_id`),
  KEY `fk_cliente_venta_idx` (`cliente_id`),
  KEY `fk_tipo_comprobante_venta_idx` (`tipo_comprobante_id`),
  CONSTRAINT `fk_tipo_comprobante_venta` FOREIGN KEY (`tipo_comprobante_id`) REFERENCES `tipo_comprobante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_venta` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
INSERT INTO `ventas` (`id`, `fecha`, `subtotal`, `igv`, `descuento`, `total`, `tipo_comprobante_id`, `cliente_id`, `usuario_id`, `num_documento`, `serie`, `estado`) VALUES
	(8, '2018-10-27', '49.00', '0.00', '0.00', '49.00', 2, 1, 3, '000007', '001', 1),
	(9, '2018-10-20', '35.00', '0.00', '0.00', '35.00', 2, 2, 3, '000008', '001', 1),
	(14, '2018-10-27', '11.00', '0.00', '0.00', '11.00', 2, 1, 3, '000009', '001', 1),
	(15, '2018-10-27', '5500.00', '0.00', '0.00', '5500.00', 2, 2, 3, '000010', '001', 1),
	(16, '2018-10-27', '16500.00', '1650.00', '0.00', '18150.00', 1, 1, 3, '000002', '001', 1),
	(17, '2018-10-29', '5000.00', '0.00', '0.00', '5000.00', 2, 3, 3, '000019', '001', 1),
	(18, '2018-10-29', '2500000.00', '250000.00', '0.00', '2750000.00', 1, 3, 3, '000003', '001', 1),
	(19, '2018-10-31', '15.00', '1.50', '0.00', '16.50', 1, 2, 3, '000004', '001', 1),
	(20, '2018-11-03', '15.00', '0.00', '0.00', '15.00', 2, 1, 3, '000020', '001', 1),
	(22, '2018-11-13', '3000.00', '300.00', '0.00', '3300.00', 1, 0, NULL, '000005', '001', 1),
	(23, '2019-04-03', '5000.00', '0.00', '0.00', '5000.00', 2, 0, 8, '000021', '001', 1),
	(24, '2019-04-03', '5000.00', '500.00', '0.00', '5500.00', 1, 0, 8, '000006', '001', 1),
	(25, '2019-04-03', '5000.00', '500.00', '0.00', '5500.00', 1, 0, 8, '000007', '001', 1),
	(26, '2019-04-08', '66000.00', '6600.00', '0.00', '72600.00', 1, 0, 8, '000008', '001', 1),
	(27, '2019-04-08', '16500.00', '1650.00', '0.00', '18150.00', 1, 1, 8, '000009', '001', NULL);
