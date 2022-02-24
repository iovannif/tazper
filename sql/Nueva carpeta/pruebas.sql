-- pruebas
/*Proveedor*/
INSERT INTO `proveedores` (`Id_Prov`, `Prov_Des`, `Prov_RazSoc`, `Prov_Ruc`, `Prov_Tel`, `Prov_Cel`, `Prov_Email`, `Prov_Web`, `Prov_Dir`, `Prov_Ciu`, `Prov_Bar`, `Prov_Ho`, `Prov_Est`, `Prov_Obs`, `created_at`, `updated_at`, `Prov_RegPor`, `Prov_RegUser`, `Prov_MdfPor`, `Prov_MdfUser`, `Id_Usu`) 
VALUES (NULL, 'Martel Telas', 'Rafael López', '404-000102', '021-094 101', NULL, 'martel_telas@hotmail.com', 'telasmartel.com', 'San Martin 1910 c/ Cruz del Defensor', 'Asunción', 'Mcal. López', 'Lunes a Sábado 7:00 a 18:00', 'Activo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

    /*producto*/
    INSERT INTO `articulos` (`Id_Art`, `Art_Tip`, `Id_Mat`, `Id_Prod`, `Art_DesLar`, `Art_DesCor`, `Id_Cat`, `Id_Imp`, `Art_GanMin`, `Art_PreCom`, `Art_PreVen`, `Art_UniMed`, `Art_St`, `Art_StMn`, `Art_StMx`, `Id_Prov`, `Art_Est`, `Art_Obs`, `created_at`, `updated_at`, `Art_RegPor`, `Art_RegUser`, `Art_MdfPor`, `Art_MdfUser`, `Id_Usu`) 
    VALUES (NULL, 'Producto', NULL, '1', 'Plato personalizado', NULL, NULL, '1', NULL, '10000', '20000', 'Unidades', '11', NULL, NULL, NULL, 'Activo', NULL, '2020-10-22 00:00:00', '2020-10-22 00:00:00', NULL, NULL, NULL, NULL, NULL), 
    (NULL, 'Producto', NULL, '2', 'a', NULL, NULL, '2', NULL, '10000', '20000', 'Unidades', '4', NULL, NULL, NULL, 'Activo', NULL, '2020-10-22 00:00:00', '2020-10-22 00:00:00', NULL, NULL, NULL, NULL, NULL); 

    /*material*/
    INSERT INTO `articulos` (`Id_Art`, `Art_Tip`, `Id_Mat`, `Id_Prod`, `Art_DesLar`, `Art_DesCor`, `Id_Cat`, `Id_Imp`, `Art_GanMin`, `Art_PreCom`, `Art_PreVen`, `Art_UniMed`, `Art_St`, `Art_StMn`, `Art_StMx`, `Id_Prov`, `Art_Est`, `Art_Obs`, `created_at`, `updated_at`, `Art_RegPor`, `Art_RegUser`, `Art_MdfPor`, `Art_MdfUser`, `Id_Usu`) 
    VALUES (NULL, 'Material', '1', NULL, 'Tela', NULL, NULL, 1, NULL, '1000', NULL, 'metros', '5', NULL, NULL, NULL, 'Activo', NULL, '2020-10-28 00:00:00', '2020-10-28 00:00:00', '1', 'Franco', NULL, NULL, NULL);


/*Cliente*/
INSERT INTO `clientes` (`Id_Cli`, `Cli_Nom`, `Cli_Ape`, `Cli_Ruc`, `Id_Lp`, `Cli_Est`, `Cli_Obs`, `created_at`, `updated_at`, `Cli_RegPor`, `Cli_RegUser`, `Id_Usu`) 
VALUES (NULL, 'Cristian', 'Nuñez', '5341931-4', '1', 'Activo', NULL, '2020-12-25 00:00:00', '2020-12-25 00:00:00', NULL, NULL, NULL);

    /*pedido proveedor*/
    INSERT INTO `pedidosproveedores` (`Id_PedProv`, `Id_Suc`, `Id_PtoExp`, `PedProv_FeHo`, `Id_Prov`, `PedProv_FeEnt`, `PedProv_ConPag`, `Id_MedPag`, `PedProv_Est`, `PedProv_Obs`, `created_at`, `updated_at`, `PedProv_RegPor`, `PedProv_RegUser`, `Id_Usu`) 
    VALUES (NULL, '1', '1', '2020-11-03 00:00:00', '1', '2020-11-03', 'Contado', 1, 'Pendiente', 'a', '2020-11-03 00:00:00', '2020-11-03 00:00:00', '1', 'Franco', NULL);    
   
    /*pedido cliente*/
    INSERT INTO `pedidosclientes` (`Id_PedCli`, `Id_Suc`, `Id_PtoExp`, `PedCli_FeHo`, `Id_Cli`, `PedCli_Tip`, `PedCli_FeEnt`, `PedCli_CondCob`, `Id_MedPag`, `PedCli_Est`, `PedCli_Obs`, `created_at`, `updated_at`, `PedCli_RegPor`, `PedCli_RegUser`, `Id_Usu`) 
    VALUES (NULL, '1', '1', '2020-12-28 00:00:00', '1', 'Minorista', '2020-12-28', 'Contado', '1', 'Pendiente', NULL, '2020-12-28 00:00:00', '2020-12-28 00:00:00', '1', 'Franco', NULL);
    
    INSERT INTO `pedidosclientes` (`Id_PedCli`, `Id_Suc`, `Id_PtoExp`, `PedCli_FeHo`, `Id_Cli`, `PedCli_Tip`, `PedCli_FeEnt`, `PedCli_CondCob`, `Id_MedPag`, `PedCli_Est`, `PedCli_Obs`, `created_at`, `updated_at`, `PedCli_RegPor`, `PedCli_RegUser`, `Id_Usu`) 
    VALUES (NULL, '1', '1', '2020-12-29 00:00:00', '1', 'Mayorista', '2020-12-29', 'Contado', '1', 'Pendiente', NULL, '2020-12-29 00:00:00', '2020-12-29 00:00:00', '1', 'Franco', NULL);

/* Timbrado */
INSERT INTO `timbrado` (`Id_Timb`, `Id_Suc`, `Id_PtoExp`, `Timb_Num`, `Timb_IniVig`, `Timb_FinVig`, `Timb_Rang`, `Timb_IniFact`, `Timb_FinFact`, `Timb_Est`, `Timb_Obs`, `created_at`, `updated_at`, `Timb_RegPor`, `Timb_RegUser`, `Id_Usu`) 
VALUES (NULL, 1, 1, '14399098', '2021-01-06', '2021-01-15', '200', '0023190', '0023390', 'Activo', NULL, '2020-12-29 00:00:00', '2020-12-29 00:00:00', '1', 'Franco', NULL);

    /* descuento */
    INSERT INTO `descuento` (`Id_Desc`, `Desc_Tip`, `Desc_Des`, `Desc_Est`, `Desc_Obs`, `created_at`, `updated_at`, `Desc_RegPor`, `Desc_RegUser`, `Desc_MdfPor`, `Desc_MdfUser`, `Id_Usu`) 
    VALUES (NULL, 'Cantidad', 'Mayorista', 'Desactivado', NULL, '2021-01-08 00:00:00', '2021-01-08 00:00:00', '1', 'Franco', NULL, NULL, NULL);


    /* // */
    /*abrir caja*/
    /*compra*/
    INSERT INTO `compras` (`Id_Com`, `Id_Pag`, `Com_Fe`, `Com_Ho`, `Com_Fac`, `Id_Arq`, `Id_Suc`, `Id_PtoExp`, `Id_PedProv`, `Id_Prov`, `Id_OC`, `Com_ConPag`, `Id_MedPag`, `Com_StExe`, `Com_St5`, `Com_St10`, `Com_Total`, `Com_Liq5`, `Com_Liq10`, `Com_TotIva`, `created_at`, `updated_at`, `Com_RegPor`, `Com_RegUser`, `Id_Usu`) 
    VALUES (NULL, NULL, '2020-11-13', '15:00:00', '1234', '1', '1', '1', NULL, '1', NULL, 'Contado', 1, NULL, NULL, NULL, '10000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
    
    /* venta */
    INSERT INTO `ventas` (`Id_Ven`, `Id_Cob`, `Ven_Fe`, `Ven_Ho`, `Id_Suc`, `Id_PtoExp`, `Id_Arq`, `Id_Timb`, `Ven_Fact`, `Ven_Tip`, `Id_PedCli`, `Id_Cli`, `Ven_CliLp`, `Ven_CliDesc`, `Ven_CondCob`, `Id_MedPag`, `Ven_Est`, `Ven_StExe`, `Ven_St5`, `Ven_St10`, `Ven_Tot`, `Ven_Liq5`, `Ven_Liq10`, `Ven_TotIva`, `created_at`, `updated_at`, `Ven_RegPor`, `Ven_RegUser`, `Id_Usu`) 
    VALUES (NULL, 1, '2021-01-06', '15:00:00', '1', '1', '1', '1', '1', 'Mayorista', '1', '1', 'Ocasional', '0', 'Contado', '1', 'Válida', NULL, NULL, NULL, '10000', NULL, NULL, NULL, '2021-01-06 00:00:00', '2021-01-06 00:00:00', '1', 'Franco', NULL);

    /*personal*/
    INSERT INTO `personal` (`Id_Per`, `Per_Nom`, `Per_Ape`, `Per_CI`, `Id_Usu`, `Per_Car`, `Per_FeNac`, `Per_LugNac`, `Per_Gen`, `Per_Nac`, `Per_Hij`, `Per_EstCiv`, `Per_Ini`, `Per_Tur`, `Per_Tel`, `Per_Cel`, `Per_Email`, `Per_Dir`, `Per_Ciu`, `Per_Bar`, `Per_Est`, `Per_Obs`, `Per_RegPor`, `Per_MdfPor`, `Per_RegUser`, `Per_MdfUser`, `created_at`, `updated_at`)
    VALUES (NULL, 'a', 'a', '1', NULL, 'Vendedor', '1994-05-11', 'a', 'Femenino', 'a', '1', '', '2020-05-06', 'a', NULL, '1', NULL, 's', 'sa', 'a', 'Activo', NULL, 1, NULL, 'Franco', NULL, now(), now());

    INSERT INTO `personal` (`Id_Per`, `Per_Nom`, `Per_Ape`, `Per_CI`, `Id_Usu`, `Per_Car`, `Per_FeNac`, `Per_LugNac`, `Per_Gen`, `Per_Nac`, `Per_Hij`, `Per_EstCiv`, `Per_Ini`, `Per_Tur`, `Per_Tel`, `Per_Cel`, `Per_Email`, `Per_Dir`, `Per_Ciu`, `Per_Bar`, `Per_Est`, `Per_Obs`, `Per_RegPor`, `Per_MdfPor`, `Per_RegUser`, `Per_MdfUser`, `created_at`, `updated_at`)
    VALUES (NULL, 'a', 'a', '1', NULL, 'Vendedor', '1994-05-11', 'a', 'Femenino', 'a', '1', '', '2020-05-06', 'a', NULL, '1', NULL, 's', 'sa', 'a', 'Activo', NULL, 2, NULL, 'Silvi', NULL, now(), now());

    INSERT INTO `personal` (`Id_Per`, `Per_Nom`, `Per_Ape`, `Per_CI`, `Per_Car`, `Id_Usu`, `Per_FeNac`, `Per_LugNac`, `Per_Gen`, `Per_Nac`, `Per_Hij`, `Per_EstCiv`, `Per_Ini`, `Per_Tur`, `Per_Tel`, `Per_Cel`, `Per_Email`, `Per_Dir`, `Per_Ciu`, `Per_Bar`, `Per_Est`, `Per_Obs`, `created_at`, `updated_at`, `Per_RegPor`, `Per_RegUser`, `Per_MdfPor`, `Per_MdfUser`, `Usu_Id`)
    VALUES (NULL, 'a', 'a', 'a', 'Vendedor', NULL, '1996-10-23', 'a', 'Femenino', 'a', 'No', 'Soltera', '2020-09-08', 'Lunes', NULL, 'aaaaaaaaaaaa', NULL, 'a', 'a', 'a', 'Activo', NULL, '2020-09-08 00:00:00', '2020-09-08 00:00:00', '1', 'Franco', NULL, NULL, NULL);

    INSERT INTO `personal` (`Id_Per`, `Per_Nom`, `Per_Ape`, `Per_CI`, `Per_Car`, `Id_Usu`, `Per_FeNac`, `Per_LugNac`, `Per_Nac`, `Per_Gen`, `Per_EstCiv`, `Per_Hij`, `Per_Tel`, `Per_Cel`, `Per_Email`, `Per_Dir`, `Per_Ciu`, `Per_Bar`, `Per_Ini`, `Per_Tur`, `Per_Est`, `Per_Obs`, `created_at`, `updated_at`, `Per_RegPor`, `Per_RegUser`, `Per_MdfPor`, `Per_MdfUser`, `Usu_Id`)
    VALUES (NULL, 'a', 'a', 'a', 'a', NULL, '2020-10-01', 'a', 'a', 'a', 'a', 'a', NULL, 'a', NULL, 'a', 'a', 'a', '2020-10-01', 'a', 'a', NULL, '2020-09-08 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL);

    /*facturacion*/
    -- INSERT INTO `facturacion` (`Id_Fact`, `Fact_Cod`, `Fact_Est`, `Fact_Obs`, `Id_Tim`, `Fact_RegPor`, `Fact_MdfPor`, `created_at`, `updated_at`)
    -- VALUES (NULL, '7777', 'Activa', NULL, '1', NULL, NULL, NULL, NULL);