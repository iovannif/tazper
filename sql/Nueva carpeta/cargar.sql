/* CARGAR ANTES, orden: */
/* Impuestos - */
INSERT INTO `impuestos` (`Id_Imp`, `Imp_Des`, `Imp_Porc`) 
VALUES (NULL, 'Exentas', 0), (NULL, 'IVA 5%', 5), (NULL, 'IVA 10%', 10);
    
    /* Sucursal (ejemplo --cargar por phpmyadmin a mano antes) */
    INSERT INTO `sucursal` (`Id_Suc`, `Suc_NomFan`, `Suc_Des`, `Suc_Cod`, `Suc_Tel`, `Suc_Dir`, `Suc_Ciu`, `Suc_Bar`, `Suc_Red1`, `Suc_Red2`, `Suc_Email`, `Suc_Ruc`, `Suc_RazSoc`, `Suc_Enc`, `Suc_Est`, `Suc_Obs`) 
    VALUES (NULL, 'Sublimaciones Tazper', 'Tazper House Villa Elisa', '001', '(0985) 723 419', 'Av. Von Polesky c/ Av. Defensores del Chaco', 'Villa Elisa', 'San Juan', 'Tazper multitienda', 'tazperhouse', 'tazpersub@gmail.com', '80041653-5', 'Nicolás Cáceres', 'Isabel Cáceres', 'Activa', NULL);

/* PtoExpedicion */
INSERT INTO `ptoexpedicion` (`Id_PtoExp`, `PtoExp_Des`, `PtoExp_Cod`, `Id_Suc`, `PtoExp_Est`)
VALUES (NULL, 'Punto 1', '001', '1', 'Activo');

/* Cajas */
INSERT INTO `caja` (`Id_Caj`, `Caj_Cod`, `Caj_Des`, `Id_Suc`, `Id_PtoExp`, `Caj_Est`, `Caj_Fon`) 
VALUES (NULL, 'Caj-001-001', 'Caja 1', 1, 1, 'Activa', '0');

/* Lista Precio (ej) */
INSERT INTO `listaprecio` (`Id_Lp`, `Lp_Cat`, `Lp_Desc`, `Lp_Est`) 
VALUES (NULL, 'Ocasional', '0', 'Activa'), (NULL, 'Frecuente', '10', 'Activa'), (NULL, 'Fiel', '20', 'Activa');
/* Lista Precio Detalle (ej) */
INSERT INTO `listapreciodetalle` (`Id_Lp`) VALUES ('1'), ('2'), ('3');

/* Medio de pago */
INSERT INTO `Medio_Pago` (`Id_MedPag`, `MedPag_Des`) VALUES (NULL, 'Efectivo');


-- Usuario (cargar antes de registro admin1)
/* Perfil */
INSERT INTO `perfil` (`Id_Prf`, `Prf_Des`, `Prf_NivAcc`, `Prf_Est`)
VALUES (NULL, 'Vendedor', 'Ventas, Caja', 'Activo'), (NULL, 'Administrador', 'Compras, Ventas, Caja, Usuarios', 'Activo');
/* Perfil detalle (temp) */
INSERT INTO `perfildetalle` (`Id_Prf`, `Prf_Priv`) VALUES ('1', '-Módulo Usuario\r\nModificar datos personales\r\n\r\n-Módulo Caja\r\nCajas:\r\nAbrir caja\r\nCerrar caja\r\nVisualizar listado de cajas\r\nVisualizar registro\r\n\r\nArqueo:\r\nRegistrar arqueo de caja\r\nVisualizar estado de arqueo\r\n\r\nCobros:\r\nRegistrar cobro\r\n\r\n-Módulo Venta\r\nVentas:\r\nRegistrar venta\r\nVisualizar listado de ventas\r\nVisualizar registro\r\nAnular venta\r\nVisualizar informe de venta\r\nVisualizar comprobante de venta\r\nImprimir comprobante de venta\r\n\r\nProductos:\r\nRegistrar productos\r\nVisualizar listado de productos\r\nVisualizar registro\r\nModificar producto\r\n\r\nCategorías:\r\nRegistrar categorías\r\nVisualizar listado de categorías\r\nVisualizar registro\r\nModificar categoría\r\nEliminar categoría');
INSERT INTO `perfildetalle` (`Id_Prf`, `Prf_Priv`) VALUES ('2', '-Módulo Usuario\r\nPerfiles:\r\nVisualizar listado de perfiles\r\nVisualizar registro\r\n\r\nPersonal:\r\nRegistrar personal\r\nVisualizar listado del personal\r\nVisualizar registro\r\nModificar personal\r\nEliminar personal\r\nModificar datos personales\r\n\r\nUsuarios:\r\nRegistrar usuarios\r\nVisualizar listado de usuarios\r\nVisualizar registro\r\nModificar usuario\r\nEliminar usuario\r\nVisualizar auditoría de registros\r\n\r\n-Módulo Caja\r\nCajas:\r\nAbrir caja\r\nCerrar caja\r\nVisualizar listado de cajas\r\nVisualizar registro\r\n\r\nArqueo:\r\nRegistrar arqueo de caja\r\nVisualizar listado de arqueos\r\nVisualizar registro\r\nVisualizar reporte de arqueo\r\nImprimir reporte de arqueo\r\n\r\nPagos:\r\nRegistrar pagos\r\nVisualizar listado de pagos\r\nVisualizar reporte de pago\r\nImprimir reporte de pagos\r\n\r\nCobros:\r\nRegistrar pagos\r\nVisualizar listado de cobros\r\nVisualizar reporte de cobro\r\nImprimir reporte de cobro\r\n\r\n-Módulo Compra\r\nCompras:\r\nRegistrar compra\r\nVisualizar listado de compras\r\nVisualizar registro\r\nEliminar compra\r\nAnular compra\r\nVisualizar informe de compra\r\nImprimir informe de compra\r\n\r\nOrden de compra:\r\nRegistrar orden de compra\r\nVisualizar listado de orden de compra\r\nVisualizar registro\r\nCancelar orden de compra\r\nEliminar orden de compra\r\nImprimir orden de compra\r\nModificar orden de compra\r\n\r\nProveedores:\r\nRegistrar proveedores\r\nVisualizar listado de proveedores\r\nVisualizar registro\r\nModificar proveedor\r\nEliminar proveedor\r\n\r\nPedidos a proveedores:\r\nRegistrar pedidos\r\nVisualizar listado de pedidos\r\nVisualizar registro\r\nCancelar pedido\r\nEliminar pedido\r\n\r\nProducción:\r\nAgregar producción\r\nVisualizar listado de producción\r\nVisualizar producción\r\nFinalizar producción\r\nCancelar producción\r\n\r\nMateriales:\r\nRegistrar materiales\r\nVisualizar listado de materiales\r\nVisualizar registro \r\nModificar material\r\nEliminar material\r\n\r\nBodega:\r\nVisualizar bodega\r\n\r\n-Módulo Venta\r\nVentas:\r\nRegistrar venta\r\nVisualizar listado de ventas\r\nVisualizar registro\r\nAnular venta\r\nVisualizar informe de venta\r\nVisualizar comprobante de venta\r\nImprimir comprobante de venta\r\n\r\nProductos:\r\nRegistrar productos\r\nVisualizar listado de productos\r\nVisualizar registro\r\nModificar producto\r\nEliminar producto\r\n\r\nCategorías:\r\nRegistrar categorías\r\nVisualizar listado de categorías\r\nVisualizar registro\r\nModificar categoría\r\nEliminar categoría\r\n\r\nLista de Precio:\r\nVisualizar listado de listas de precios\r\nVisualizar lista de precio\r\n\r\nDescuento:\r\nAgregar descuentos\r\nVisualizar listado de descuentos\r\nVisualizar descuento\r\nActivar descuento\r\nDesactivar descuento\r\nEliminar descuento\r\n\r\nClientes:\r\nRegistrar clientes\r\nVisualizar listado de clientes\r\nVisualizar registro\r\nEliminar cliente\r\n\r\nPedidos de clientes:\r\nRegistrar pedidos\r\nVisualizar listado de pedidos\r\nVisualizar registro\r\nCancelar pedido\r\nEliminar pedido\r\n\r\nTimbrado:\r\nAgregar timbrado\r\nVisualizar listado de timbrados\r\nVisualizar registro\r\nAnular timbrado\r\n\r\nSucursal:\r\nVisualizar listado de sucursal\r\nVisualizar sucursal\r\nModificar sucursal\r\n\r\nPunto Expedición:\r\nVisualizar listado de punto expedición\r\nVisualizar punto de expedición');

    /* Personal: Admin1 (ej) --cargar por phpmyadmin a mano antes */
    INSERT INTO `personal` (`Id_Per`, `Per_Nom`, `Per_Ape`, `Per_CI`, `Per_Car`, `Id_Usu`, `Per_FeNac`, `Per_LugNac`, `Per_Gen`, `Per_Nac`, `Per_Hij`, `Per_EstCiv`, `Per_Ini`, `Per_Tur`, `Per_Tel`, `Per_Cel`, `Per_Email`, `Per_Dir`, `Per_Ciu`, `Per_Bar`, `Per_Est`, `Per_Obs`, `Per_RegPor`, `Per_MdfPor`, `created_at`, `updated_at`)
    VALUES (1, 'Franco', 'Salcedo', '5458651', 'Administrador', '1', '1996-10-23', 'Asunción', 'Masculino', 'Paraguaya', '0', 'Soltero', '2018-03-03', 'Lunes y Miércoles', '021931844', '0971800824', 'francoio04@hotmail.com', 'Salto del guairá 190 c/ Lima', 'Villa Elisa', 'Sol de américa', 'Activo', NULL, NULL, NULL, '2020-08-29 08:50:00', '2020-08-29 08:50:00');

/* trigger -usu per- */
create trigger Usu_User after insert on users
for each row
update personal set Id_Usu=new.Id_Usu where new.Id_Per=personal.Id_Per