<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>{{config('app.name')}}</title>
    <!-- <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        @font-face{
            font-family: Raleway;
            src:url("{{asset('css/raleway.regular.ttf')}}");
        }
        
        #barra{
            height: 44px;
            font-family: Raleway,sans-serif;
            box-shadow: 0px 2px 7px 0px #2E2929;
            background: #CF0000;
        }
        
        #barra a{
            text-shadow: 2px 2px 2px #000;
            color:white;
        }
        
        #barra .elemento:hover{
            background: #AF0000;
        }
        
        .dropdown-menu{
            border: 1px solid #464040;
            padding:0;
            background: darkred;
            border:none;
            box-shadow: 0px 1px 4px 0px #000;
        }

        .dropdown-menu a, .sub_elemento{
            width:auto;
            padding: 4px 0 4px 10px;
            box-shadow: 0px 0px 1px 0px #000;
            background: darkred;
        }

        .dropdown-menu a:hover{
            background:red;
        }

        #tazper{
            margin-left:15px;
            font-size:24px;
            margin-right: 50px;
        }

        #sesion{
            margin-right:32px;            
            list-style: none;
            height:44px;
            padding:10px 6px;
        }

        #sesion a:hover{
            text-decoration:none;
        }

        #menu_sesion{    
            background:white;
            box-shadow: 1px 1px 2px 1px #999999;
            border-radius:2px;
            min-width:0;
            width:164px;
            text-align:right;
        }            
        
        .perfil{
            color:#353535;
            text-shadow: 0px 0px 1px darkgray;
            font-size:14px;
            padding-right:20px;
            cursor:default;
        }
        
        #menu_sesion li{
            text-align:right;
            padding: 3px 0;            
        }

        #menu_sesion li:hover{
            box-shadow: 0px 0px 2px 2px darkgray;
        }

        #menu_sesion a{
            background:#fff;
            color:red;
            box-shadow:none;
            border:none;
            width:100%;
            padding:0 20px 0 0;
            text-shadow: 0px 0px 1px black;
            display:block;
        }

        .nav-link.dropdown{
            padding-top: 10px;
            margin: 0 1px;
            border-radius:1px;
            width:auto;
            padding:10px;
        }

        .elemento{
            padding: 0 8px;
            box-shadow: 1px 0px 1px 0px darkred;
            max-height:44px;
            border-radius:2px;
        }

        .sub_elemento{
            position:relative;
            color:white;
            text-shadow: 2px 2px 2px #000;
            cursor:hand;
        }

        .sub_elemento:hover{
            background:red;
            color:white;
        }

        .sub_menu{
            position:absolute;
            left:162px;
            top:-1px;
        }

        form{
            margin:0;
            display:inline-block;
        }

        #arqueo,#inhabilitado,#timbrado,#limite,#logout_arqueo{
            position:fixed;
            top:35%;
            left:34.5%;
            background:#FCFCFC;
            border:1px solid darkgrey;
            border-radius:3px;
            display:none;
            padding:12px 4px;
            box-shadow: 1px 1px 5px 1px #232323;
            font-size: 15px !important;
            cursor:default;
            width:440px;
            font-family: Raleway;
            border:none !important;
            z-index: 1;
        }
        #arqueo table,#inhabilitado table,
        #timbrado table,#limite table,
        #logout_arqueo table{
            margin:auto;
            width: 100%;
        }
        #arqueo td,#inhabilitado td,
        #timbrado td,#limite td,
        #logout_arqueo td
        {
            border:none;
        }
        .center{
            text-align:center;
        }
        #inhabilitado{
            width:fit-content !important;
        }

        button{
            outline: none !important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="barra">
        <a class="navbar-brand" href="{{url('/Inicio')}}" id="tazper">{{config('app.name')}}</a>
        
        <ul class="navbar-nav mr-auto" id="modulos">
            <li class="nav-item dropdown elemento">
            <a class="nav-link dropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Caja
            </a>
                <div class="dropdown-menu menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{url('/Sucursal')}}">Sucursal</a>
                    <a class="dropdown-item" href="{{url('/PtoExpedicion')}}">Punto Expedición</a>
                    <a class="dropdown-item" href="{{url('/Caja')}}">Cajas</a>
                    <a class="dropdown-item" href="{{url('Arqueo_Abrir')}}">Abrir caja</a>
                    <a class="dropdown-item" href="{{url('Arqueo_Cerrar')}}">Cerrar caja</a>    
                    <a class="dropdown-item" href="{{url('/Arqueo')}}">Arqueo</a>                    
                    <a class="dropdown-item" href="{{url('/Pagos')}}">Pagos</a>
                    <!-- <div class="dropdown-item dropdown sub_elemento" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pagos
                        <div class="dropdown-menu sub_menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{url('/Pagos')}}">Listado</a>
                            <a class="dropdown-item" href="{{url('/Cuentas_pagar')}}">Cuentas a pagar</a>
                        </div>
                    </div> -->                    
                    <a class="dropdown-item" href="{{url('/Cobros')}}">Cobros</a>
                    <!-- <div class="dropdown-item dropdown sub_elemento" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Cobros
                        <div class="dropdown-menu sub_menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{url('/Cobros')}}">Listado</a>
                            <a class="dropdown-item" href="{{url('/Cuentas_cobrar')}}">Cuentas a cobrar</a>
                        </div>
                    </div> -->                                                                               
                    <a class="dropdown-item" href="{{url('/Informes_listas')}}">Informes</a>
                </div>
            </li>

            <li class="nav-item dropdown elemento">
            <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Compras
            </a>
                <div class="dropdown-menu menu" aria-labelledby="navbarDropdown">                         
                    <div class="dropdown-item dropdown sub_elemento" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Proveedores
                        <div class="dropdown-menu sub_menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{url('/Proveedores/create')}}">Agregar proveedor</a>
                            <a class="dropdown-item" href="{{url('/Proveedores')}}">Ver proveedores</a>     
                            <a class="dropdown-item" href="{{url('/Materiales')}}">Materiales</a>
                            <a class="dropdown-item" href="{{url('/PedidoProveedor/create')}}">Registrar pedido</a>
                            <a class="dropdown-item" href="{{url('/PedidoProveedor')}}">Pedidos</a>
                            <a class="dropdown-item" href="{{url('/OrdenCompra')}}">Orden de compra</a>                                                   
                        </div>
                    </div>                    
                    <a class="dropdown-item" href="{{url('/Compras/create')}}">Registrar compra</a>
                    <a class="dropdown-item" href="{{url('/Compras')}}">Ver compras</a>                                
                    <a class="dropdown-item" href="{{url('/Articulos')}}">Bodega</a>
                </div>
            </li>

            <li class="nav-item dropdown elemento">
            <a class="nav-link dropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Ventas
            </a>
                <div class="dropdown-menu menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{url('/ListaPrecio')}}">Lista de Precios</a>                    
                    <div class="dropdown-item dropdown sub_elemento" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Productos
                        <div class="dropdown-menu sub_menu" aria-labelledby="navbarDropdown">                  
                            <a class="dropdown-item" href="{{url('/Productos_Categoria')}}">Categorías</a>          
                            <a class="dropdown-item" href="{{url('/Productos/create')}}">Agregar productos</a>
                            <a class="dropdown-item" href="{{url('/Productos')}}">Ver productos</a>                            
                        </div>
                    </div>
                    <div class="dropdown-item dropdown sub_elemento" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Clientes
                        <div class="dropdown-menu sub_menu" aria-labelledby="navbarDropdown">                            
                            <a class="dropdown-item" href="{{url('/Clientes/create')}}">Agregar cliente</a>
                            <a class="dropdown-item" href="{{url('/Clientes')}}">Ver clientes</a>
                            <a class="dropdown-item" href="{{url('/Descuento')}}">Descuento</a>   
                            <a class="dropdown-item" href="{{url('/PedidoCliente/create')}}">Registrar pedido</a>
                            <a class="dropdown-item" href="{{url('/PedidoCliente')}}">Pedidos</a>
                        </div>
                    </div>                    
                    <div class="dropdown-item dropdown sub_elemento" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Producción
                        <div class="dropdown-menu sub_menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{url('/Produccion/create')}}">Agregar</a>
                            <a class="dropdown-item" href="{{url('/Produccion')}}">Ver producción</a>                            
                        </div>
                    </div>           
                    <a class="dropdown-item" href="{{url('/Timbrado')}}">Facturación</a>
                    <a class="dropdown-item" href="{{url('/Ventas/create')}}">Realizar venta</a>
                    <a class="dropdown-item" href="{{url('/Ventas')}}">Ver ventas</a>   
                </div>                                                                              
            </li>                        

            <li class="nav-item dropdown elemento">
            <a class="nav-link dropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Administrar
            </a>
                <div class="dropdown-menu menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{url('/Perfil')}}">Perfiles</a>
                    <a class="dropdown-item" href="{{url('/Personal')}}">Personal</a>
                    <a class="dropdown-item" href="{{url('/Usuarios')}}">Usuarios</a>
                </div>
            </li>
        </ul>
        
        <!-- @if (Auth::guest())
            <li><a href="{{route('login')}}">Login</a></li>
            <li><a href="{{route('register')}}">Register</a></li>
        @else -->
        <li class="dropdown ml-auto" id="sesion">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{Auth::user()->Usu_User}} <span class="caret"></span>
            </a>
                <ul class="dropdown-menu dropdown-menu-right" role="menu" id="menu_sesion">                    
                    <span class="perfil">
                        @if(Auth::user()->Id_Prf==1)
                            {{'(Vendedor)'}}
                        @elseif(Auth::user()->Id_Prf==2)
                            {{'(Administrador)'}}
                        @endif
                    </span>
                    
                    <li><a href="{{asset('manual/admin.pdf')}}">Ayuda</a></li>                             
                    <!-- #            -->
                    <li><a href="{{url('/Datos_personales')}}">Modificar datos</a></li>
                    <li>
                        <a href="{{route('logout')}}" id="cerrar_sesion"
                            onclick="event.preventDefault();
                                    // if($('#arq').val()=='Abierto'){
                                    //     $('#logout_arqueo').show(); 
                                    // }
                                    // document.getElementById('logout-form').submit();">
                            Cerrar sesión
                        </a>
                            <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                            {{csrf_field()}}
                            </form>
                    </li>
                </ul>
        </li>
        <!-- @endif -->
    </nav>

    @include('arqueo')

    <div id="arqueo">
        <table>
            <tr><td>&nbsp;</td></tr>  
            <tr><td class="center">&nbsp;</td></tr>                                
            <tr><td>&nbsp;</td></tr>  
        </table>
    </div>

        @include('descuento')

        @include('timbrado')

        @include('cierre_arqueo')

    @yield('content')

</body>
<!-- <script src="{{asset('js/bootstrap.min.js')}}"></script> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>

<script>
    //desplegar menus de la barra con hover
    $(".elemento")
    .mouseover(function(){
        $(this).find('.menu').addClass('show');            
    })        
    .mouseout(function(){
        $(this).find('.menu').removeClass('show');
    })

    //submenu
    jQuery('.sub_elemento').hover(function(){
        jQuery(this).find('div').show()
    }, function(){
        jQuery(this).find('div').hide();
    });
    
    //sesion
    jQuery('#sesion').hover(function(){
        jQuery(this).find('#menu_sesion').show();
    }, function(){
        jQuery(this).find('#menu_sesion').hide();
    });

    // click mantenido
    $("#modulos .dropdown-menu a").mousedown(function(){
        $(this).css('background','red');
    });
    $("#modulos .dropdown-menu a").mouseup(function(){
        $(this).css('background','darkred');
    });
    $("#modulos .dropdown-menu a").mouseleave(function(){
        $(this).css('background','darkred');
    });
    $("#modulos .dropdown-menu a").mouseover(function(){
        $(this).css('background','red');
    });

    $("#modulos .dropdown-menu div").mousedown(function(){
        $(this).css('background','red');
    });
    $("#modulos .dropdown-menu div").mouseup(function(){
        $(this).css('background','darkred');
    });
    $("#modulos .dropdown-menu div").mouseleave(function(){
        $(this).css('background','darkred');
    });
    $("#modulos .dropdown-menu div").mouseover(function(){
        $(this).css('background','red');
    });
</script>
</html>