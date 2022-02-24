<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>{{config('app.name')}}</title>
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
    <style>
        @font-face{
            font-family: Raleway;
            src:url("{{asset('css/raleway.regular.ttf')}}");
        }

        .dropdown-menu{
            padding:0;
        }
        
        .dropdown-submenu {
            position:relative;
        }
        .dropdown-submenu>.dropdown-menu {
            top:0;
            left:100%;
            margin-top:-6px;
            margin-left:-1px;
            /* -webkit-border-radius:0 6px 6px 6px;
            -moz-border-radius:0 6px 6px 6px; */
            border-radius:0 6px 6px 6px;
        }
        .dropdown-submenu:hover>.dropdown-menu {
            display:block;
        }
        
        .dropdown-submenu.pull-left {
            float:none;
        }
        .dropdown-submenu.pull-left>.dropdown-menu {
            left:-100%;
            margin-left:10px;
            /* -webkit-border-radius:6px 0 6px 6px;
            -moz-border-radius:6px 0 6px 6px; */
            border-radius:6px 0 6px 6px;
        }

        /* -------------------- */

        .navbar{
            background:#CF0000;
            margin-bottom: 0;
            font-family: Raleway,sans-serif;
            padding:8px 16px;
            height: 44px;
            box-shadow: 0px 2px 7px 0px #2E2929;
        }
        .navbar a{
            color:white;
            text-shadow: 2px 2px 2px #000;
            max-height: 44px;
        }
        .modulo{
            padding-right: 17px;
            padding-left: 17px;
            max-height: 44px;
            padding-top: 12px;
            padding-bottom: 12px;
            box-shadow: 1px 0 1px 0 darkred;
            border-radius:2px;
        }
        .modulo:hover{
            background: #AF0000 !important;
        }
        .navbar a:hover{
            text-decoration:none;
            background:red;
        }
        .dropdown-toggle{
            margin-left:20px;
        }
        .navbar li{
            list-style: none;
            /* border:1px solid black; */
            max-height: 44px;
        }
        .menu a{
            display:block;
            background:darkred;

        }
        .dropdown-menu a{
            box-shadow:0px 0px 1px 0px #000;
        }
        .dropdown-menu li{
            background:darkred;
            
        }

        .menu{
            top:32px;
            background:darkred;
        }
        .menu a{
            padding: 4px 0 4px 10px;
        }

        #tazper{
            margin-left:15px;
            font-size:24px;
            margin-right: 50px;
        }
        #sesion{
            margin-right:30px;
        }

        form{
            margin:0;
        }
    </style>
</head>
<body>
    <ul class="navbar navbar-expand-lg navbar-dark sticky-top">
        <a class="navbar-brand" href="{{url('/Inicio')}}" id="tazper">{{config('app.name')}}</a>        
        
        <li class="dropdown elemento">
            <a href="#" class="dropdown modulo" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Compras</a>
            
            <ul class="dropdown-menu menu">
                <a href="{{url('/Compras/create')}}">Registrar compra</a>
                <a href="{{url('/Compras')}}">Ver compras</a>
                <a href="{{url('/OrdenCompra')}}">Orden Compra</a>
                <li class="dropdown-submenu">
                    <a href="#" class="dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Proveedores</a>
                    <ul class="dropdown-menu">
                        <a href="{{url('/Proveedores/create')}}">Agregar proveedor</a>
                        <a href="{{url('/Proveedores')}}">Ver proveedores</a>
                        <a href="{{url('/PedidoProveedor/create')}}">Registrar pedido</a>
                        <a href="{{url('/PedidoProveedor')}}">Pedidos</a>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a href="#" class="dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Producción</a>
                    <ul class="dropdown-menu">
                        <a href="{{url('/Produccion/create')}}">Agregar</a>
                        <a href="{{url('/Produccion')}}">Ver producción</a>
                        <a href="{{url('/Materiales')}}">Materiales</a>
                    </ul>
                </li>
                <a href="{{url('/Articulos')}}">Bodega</a>
            </ul>        
        </li>
        
        <li class="dropdown elemento">
            <a href="#" class="dropdown modulo" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Ventas</a>
            
            <ul class="dropdown-menu menu">
                <a href="{{url('/Ventas/create')}}">Realizar venta</a>
                <a href="{{url('/Ventas')}}">Ver ventas</a>
                <li class="dropdown-submenu">
                    <a href="#" class="dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Productos</a>
                    <ul class="dropdown-menu">
                        <a href="{{url('/Productos')}}">Ver productos</a>
                        <a href="{{url('/Productos/create')}}">Agregar productos</a>
                        <a href="{{url('/Productos_Categoria')}}">Categoría</a>
                        <a href="{{url('/ListaPrecio')}}">Lista de Precios</a>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a href="#" class="dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Clientes</a>
                    <ul class="dropdown-menu">
                        <a href="{{url('/Clientes')}}">Ver clientes</a>
                        <a href="{{url('/Clientes/create')}}">Agregar cliente</a>
                        <a href="{{url('/PedidoCliente')}}">Pedidos</a>
                        <a href="{{url('/PedidoCliente/create')}}">Registrar pedido</a>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a href="#" class="dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Numeración</a>
                    <ul class="dropdown-menu">
                        <a href="{{url('/Timbrado')}}">Timbrado</a>
                        <a href="{{url('/Sucursal')}}">Sucursal</a>
                        <a href="{{url('/PtoExpedicion')}}">Punto Expedición</a>
                    </ul>
                </li>
            </ul> 
        </li>

        <li class="dropdown elemento">
            <a href="#" class="dropdown modulo" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Caja</a>
            
            <ul class="dropdown-menu menu">
                <a href="{{url('/Arqueo_Abrir')}}">Abrir caja</a>
                <a href="{{url('/Arqueo_Cerrar')}}">Cerrar caja</a>
                <a href="{{url('/Caja')}}">Cajas</a>
                <a href="{{url('/Arqueo')}}">Arqueo</a>
                <li class="dropdown-submenu">
                    <a href="#" class="dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pagos</a>
                    <ul class="dropdown-menu">
                        <a href="{{url('/Pagos')}}">Listado</a>
                        <a href="{{url('/Cuentas_pagar')}}">Cuentas a pagar</a>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a href="#" class="dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cobros</a>
                    <ul class="dropdown-menu">
                        <a href="{{url('/Pagos')}}">Listado</a>
                        <a href="{{url('/Cuentas_cobrar')}}">Cuentas a cobrar</a>
                    </ul>
                </li>                
            </ul>
        </li>

        <li class="dropdown elemento">
            <a href="#" class="dropdown modulo" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Administrar</a>

            <ul class="dropdown-menu menu">
                <a href="{{url('/Usuarios')}}">Usuarios</a>
                <a href="{{url('/Perfil')}}">Perfiles</a>
                <a href="{{url('/Personal')}}">Personal</a>
            </ul>
        </li>
        
        <ul class="navbar-nav ml-auto elemento">
        <li class="dropdown" id="sesion">
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
                
                <li><a href="{{url('/Datos_personales')}}">Modificar datos</a></li>
                <li>
                    <a href="{{route('logout')}}" id="cerrar_sesion"
                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        Cerrar sesión
                    </a>
                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                        {{csrf_field()}}
                        </form>
                </li>
            </ul>
        </li>
        </ul>
    </ul>
</body>

@yield('content')

<script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<script>
    $(".elemento")
    .mouseover(function(){
        $(this).find('.menu').addClass('show');            
    })        
    .mouseout(function(){
        $(this).find('.menu').removeClass('show');
    })
</script>