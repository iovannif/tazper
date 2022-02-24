<?php
//authentication
    //sesion
    Route::get('/usuario', 'usuarioController@check');
    //register
        $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    $this->post('register', 'Auth\RegisterController@register');
    Route::get('/registrado', 'usuarioController@registrado');
    //log
        $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
    $this->post('login', 'Auth\LoginController@login');
    
    $this->post('logout', 'Auth\LoginController@logout')->name('logout');

//sesion    
//home
Route::get('/Inicio', 'HomeController@index');

//Compras
// Compras
Route::resource('/Compras', 'ComprasController');
    //index buscador
    Route::get('/Compras_buscador', 'ComprasController@buscador');
    
    //create 
    //busca pedido
    Route::get('Compras/Create/busca_pedido', 'ComprasController@busca_pedido');
    //busca proveedor    
    Route::get('Compras/Create/busca_proveedor', 'ComprasController@busca_proveedor');
    //busca articulo
    Route::get('/Compras/Create/buscador', 'ComprasController@busca_articulo');    
    
    //show
    //informe
    // Route::get('/Compras/{id}/informe', 'ComprasController@informe');
    // Route::get('/Pagos/{id}/informe', 'PagosController@informe');
    Route::get('/Compras/{id}/informe', 'PagosController@informe');

    //fetch show
    Route::get('/show_compra_fetch_1', 'FetchController@show_compra_1');
    Route::get('/show_compra_fetch_c', 'FetchController@show_compra_cab');
    Route::get('/show_compra_fetch_d', 'FetchController@show_compra_det');
    Route::get('/show_compra_fetch_t', 'FetchController@show_compra_tot');

    //anular
    Route::get('/Compras/{id}/anular', 'ComprasController@anular');    
// Orden Compra
    Route::resource('/OrdenCompra', 'OrdenCompraController');

    //fetch show
    Route::get('/show_oc_fetch_1', 'FetchController@show_oc_1');
    Route::get('/show_oc_fetch_2', 'FetchController@show_oc_2');  
    
    //imprimir
    Route::get('/OrdenCompra/pdf/{id}', 'OrdenCompraController@imprimir');
// Proveedores
Route::resource('/Proveedores', 'ProveedoresController');
    //buscador
    Route::get('/Proveedores_buscador', 'ProveedoresController@buscador');

    //delete ajax
    Route::post('/proveedores_remove', 'ProveedoresController@remove');

    //fetch show
    Route::get('/show_proveedor_fetch_1', 'FetchController@show_proveedor_1');
    Route::get('/show_proveedor_fetch_2', 'FetchController@show_proveedor_2');
// Pedidos Proveedores
Route::resource('/PedidoProveedor', 'PedidosProveedoresController');
    //Create
    //buscador proveedor
    Route::get('/PedidoProveedor/Create/busca_proveedor', 'PedidosProveedoresController@busca_proveedor');
    //buscador articulo
    Route::get('/PedidoProveedor/Create/buscador', 'PedidosProveedoresController@busca_articulo');

    //fetch show
    Route::get('/show_pedidoproveedor_fetch_1', 'FetchController@show_pedidoproveedor_1');
    Route::get('/show_pedidoproveedor_fetch_2', 'FetchController@show_pedidoproveedor_2');    
// Produccion
Route::resource('/Produccion', 'ProduccionController');
    //Create 
    //producto
    Route::get('/Produccion/{id}/edit/busca_producto', 'ProduccionController@busca_producto');    
    //material    
    Route::get('/Produccion/Create/buscador', 'ProduccionController@busca_material');

    //fetch show
    Route::get('/show_produccion_fetch_1', 'FetchController@show_produccion_1');
    Route::get('/show_produccion_fetch_2', 'FetchController@show_produccion_2');

    Route::get('/Produccion/{id}/finalizar', 'ProduccionController@finalizar');
// Materiales
Route::resource('/Materiales', 'MaterialesController');
    //buscador
    Route::get('/Materiales_buscador', 'MaterialesController@buscador');

    //create edit
    Route::get('/Materiales/{id}/edit/busca_proveedor_1', 'MaterialesController@busca_proveedor_1');
    Route::get('/Materiales/{id}/edit/busca_proveedor_2', 'MaterialesController@busca_proveedor_2');

    //fetch show
    Route::get('/show_material_fetch_1', 'FetchController@show_material_1');
    Route::get('/show_material_fetch_2', 'FetchController@show_material_2');

    //delete ajax
    Route::post('/materiales_remove', 'MaterialesController@remove');
// Bodega
Route::get('/Articulos', 'BodegaController@index');

//Ventas
// Ventas
Route::resource('/Ventas', 'VentasController');
    //Index
    //buscador
    Route::get('/Ventas_buscador', 'VentasController@buscador');
    //filtros
    Route::get('/Ventas_filtros', 'VentasController@filtros');        

    //Create
    //buscador 
    Route::get('Ventas/Create/busca_pedido', 'VentasController@busca_pedido');
    //cuadros
    Route::get('Ventas/Create/busca_proveedor', 'VentasController@busca_cliente'); //cli
    Route::get('Ventas/Create/buscador', 'VentasController@busca_producto'); //prod
    //pdf factura
    Route::get('/Ventas/factura/{id}', 'VentasController@factura'); //get necesita un registro
        
    //Show    
    //fetch
    Route::get('/show_venta_fetch_1', 'FetchController@show_venta_1');
    Route::get('/show_venta_fetch_c', 'FetchController@show_venta_cab');
    Route::get('/show_venta_fetch_d', 'FetchController@show_venta_det');
    Route::get('/show_venta_fetch_t', 'FetchController@show_venta_tot');
    //anular
    Route::get('/Ventas/{id}/anular', 'VentasController@anular'); 
    //desanular
    Route::get('/Ventas/{id}/desanular', 'VentasController@desanular'); 
    //informe
    Route::get('/Ventas/{id}/informe', 'VentasController@informe');  
    //factura
    Route::get('/Ventas/comprobante/{id}', 'VentasController@comprobante');                        
// Productos
Route::resource('/Productos', 'ProductosController');
    //Index
    //buscador
    Route::get('/Productos_buscador', 'ProductosController@buscador');
    //filtros
    Route::get('/Productos_filtros', 'ProductosController@filtros');        
    //delete ajax
    Route::post('/productos_remove', 'ProductosController@remove');    
    //modif masiva
    Route::post('/productos_mod_mas', 'ProductosController@modificacion_masiva');

    //cuadro cat, create edit
    Route::get('/Productos/{id}/edit/busca_categoria_1', 'ProductosController@busca_categoria_1');
    Route::get('/Productos/{id}/edit/busca_categoria_2', 'ProductosController@busca_categoria_2');

    //fetch show
    Route::get('/show_producto_fetch_1', 'FetchController@show_producto_1');
    Route::get('/show_producto_fetch_2', 'FetchController@show_producto_2');
// Categoria
Route::resource('/Productos_Categoria', 'CategoriaController');
    //buscador categorias
    Route::get('/ProductosCategoria_buscador', 'CategoriaController@buscador');

    //delete ajax
    Route::post('/categorias_remove', 'CategoriaController@remove');

    //fetch show
    Route::get('/show_categoria_fetch_1', 'FetchController@show_categoria_1');
    Route::get('/show_categoria_fetch_2', 'FetchController@show_categoria_2');
// Lista Precio
Route::resource('/ListaPrecio', 'ListaPrecioController');
    //fetch show
    Route::get('/show_lp_fetch_1', 'FetchController@show_lp_1');
    Route::get('/show_lp_fetch_2', 'FetchController@show_lp_2');    
    //detalle ajax
    Route::get('/ListaPrecio/{id}/detalle', 'ListaPrecioController@show_det');
// Clientes
Route::resource('/Clientes', 'ClientesController');
    //fetch show
    Route::get('/show_cliente_fetch_1', 'FetchController@show_cliente_1');
    Route::get('/show_cliente_fetch_2', 'FetchController@show_cliente_2');
// Pedidos Clientes
Route::resource('/PedidoCliente', 'PedidosClientesController');    
    //Create
    //buscador cliente
    Route::get('/PedidoCliente/Create/busca_cliente', 'PedidosClientesController@busca_cliente');
    //buscador producto
    Route::get('/PedidoCliente/Create/buscador', 'PedidosClientesController@busca_producto');

    //fetch show
    Route::get('/show_pedidocliente_fetch_1', 'FetchController@show_pedidocliente_1');
    Route::get('/show_pedidocliente_fetch_2', 'FetchController@show_pedidocliente_2');
// Descuento
Route::resource('/Descuento', 'DescuentoController');
    //Create    
    Route::post('/Descuento_detalle', 'DescuentoController@store_detalle');    

    //fetch show
    Route::get('/show_descuento_fetch_1', 'FetchController@show_descuento_1');
    Route::get('/show_descuento_fetch_2', 'FetchController@show_descuento_2');

    Route::get('/Descuento/{id}/activar', 'DescuentoController@activar');    
    Route::get('/Descuento/{id}/desactivar', 'DescuentoController@desactivar');    
// Timbrado
Route::resource('/Timbrado', 'TimbradoController');

    Route::get('/Timbrado/{id}/anular', 'TimbradoController@anular');    
    Route::get('/Timbrado/{id}/desanular', 'TimbradoController@desanular');
// Sucursal
Route::resource('/Sucursal', 'SucursalController');
// Pto Expedicion
Route::resource('/PtoExpedicion', 'PtoExpedicionController');

//Caja
// Caja
Route::resource('/Caja', 'CajaController');
// Arqueo
Route::resource('/Arqueo', 'ArqueoController');
    //abrir caja
    Route::get('Arqueo_Abrir', 'ArqueoController@abrir_caja');
    //cerrar caja
    Route::get('Arqueo_Cerrar', 'ArqueoController@cerrar_caja');

    //buscador
    Route::get('/Arqueo_buscador', 'ArqueoController@buscador');

    //fetch show
    Route::get('/show_arqueo_fetch_1', 'FetchController@show_arqueo_1');
    Route::get('/show_arqueo_fetch_2', 'FetchController@show_arqueo_2');

    //informe
    Route::get('/Arqueo/{id}/informe', 'ArqueoController@informe');

    //cierre arqueo
    // Route::get('/Arqueo/koi', 'ArqueoController@koi'); //get requiere que le pases / no
    Route::get('/Arqueo_logout', 'ArqueoController@logout');
// Pagos
Route::resource('/Pagos', 'PagosController');
    //buscador
    Route::get('/Pagos_buscador', 'PagosController@buscador');

    //show informe
    Route::get('/Pagos/{id}/informe', 'PagosController@informe');    

    // //cuentas a pagar
    // Route::get('Cuentas_pagar', 'PagosController@index_pagar');    
    // //show cp
    // Route::get('Cuentas_pagar/{id}', 'PagosController@show_cp');
// Cobros
Route::resource('/Cobros', 'CobrosController'); //index ruta
    //buscador
    Route::get('/Cobros_buscador', 'CobrosController@buscador');

    //show informe
    Route::get('/Cobros/{id}/informe', 'CobrosController@informe');

    // //cuentas a cobrar
    // Route::get('Cuentas_cobrar', 'CobrosController@index_cobrar');
    // //show cc
    // Route::get('Cuentas_cobrar/{id}', 'CobrosController@show_cc');

//Informes
Route::get('Informes_listas', 'InformeListasController@filtros');
Route::post('lista_informe', 'InformeListasController@informe');

//Usuarios
// User
Route::resource('/Usuarios', 'UsuariosController');
    //create edit user
    Route::get('/Usuarios/{id}/edit/buscador1', 'FetchController@buscador1');
    Route::get('/Usuarios/{id}/edit/buscador2', 'FetchController@buscador2');

    //fetch index
    Route::get('/usuarios_fetch', 'FetchController@usuarios');

    //fetch show
    Route::get('/show_user_fetch_1', 'FetchController@show_user_1');
    Route::get('/show_user_fetch_2', 'FetchController@show_user_2');
    
    //ajax varios
    Route::post('/usuarios_remove', 'UsuariosController@remove');
// Perfil
Route::resource('/Perfil', 'PerfilController');
    //fetch show
    Route::get('/show_perfil_fetch_1', 'FetchController@show_perfil_1');
    Route::get('/show_perfil_fetch_2', 'FetchController@show_perfil_2');
// Personal
Route::resource('/Personal', 'PersonalController');    
    //fetch show
    Route::get('/show_personal_fetch_1', 'FetchController@show_personal_1');
    Route::get('/show_personal_fetch_2', 'FetchController@show_personal_2');

    //ajax varios
    Route::post('/personal_remove', 'PersonalController@remove');

    //datos personales
    Route::get('/Datos_personales', 'PersonalController@dp_show'); //show
    // Route::get('/Datos_personales', function(){return view("Admin.Informe_Listas.filtros");});
    Route::get('/Datos_personales/edit', 'PersonalController@dp_edit'); //edit
    Route::patch('/Datos_personales/{id}', 'PersonalController@dp_update'); //update