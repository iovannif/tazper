@extends('layouts.Vend_app')

<style>
    /* Contenedor */
    @font-face{
        font-family: Raleway;
        src:url("{{asset('css/raleway.regular.ttf')}}");
    }

    body{
        background:#EEEEEE !important;
    }

    #sesion{
        margin-right: 15px !important;
    }

    #content{
        box-shadow: 0px 1px 10px 0px #000;
        margin: 4px 72px 10px 72px;
        padding: 10px 26px;
        border:1px solid lightgray;
        border-radius:2px;
        height:fit-content;
        background:#F4F4F4;
        text-shadow: 0 0 0 #939393;
        color:black;
        cursor:default;
    }

    input{
        font-family:arial !important;
    }
    input:disabled{
        background:#fff;
    }

    .boton:focus, .botones:focus{
        outline: none !important;
    }

    /* Titulo */
    #titulo{        
        font-family: Raleway;
        font-size:20px;
        color: white;
        text-shadow: 2px 2px 4px #000;
        box-shadow: 0px 1px 3px 0px #000;
        /* padding: 4px 0; */
        padding: 6px 0;
        text-align:center;
        border-radius:2px;
        background: #C90000;
        /* margin: -8px -2px 3px -2px; */       
        margin-bottom:6px;
        cursor:default;
    }

    #navegacion_1{        
        text-align:center;
        padding-top:1px;
        padding-bottom:2px;
    }

    /* Navegacion */
    #navegacion_1,#cabecera,#navegacion_2,#total{
        font-family: Raleway;
        border-radius:3px;
        height:fit-content;
        border: 1px solid #666666;
    }

    #navegacion_2{        
        text-align:center;
        padding-top:1px;
        padding-bottom:2px;
    }

    /* Cabecera */
    #cabecera{        
        padding:5px 7px;
    }
    
    /* cuadros js */
    .lista_js{
        position: absolute;
        left: 361px;
        top: 357px;
        background: #fff;
        border: 1px solid gray;
        padding: 0;
        display: inline-block;
        margin: 0;
        width: 289px;
        border-radius: 3px;
        box-shadow: 1px 1px 1px 0px lightgrey;
        cursor:hand;
        font-size:15px;
    }
    .item_js{
        list-style: none;
        padding: 2px 0 0 7px;
        border-bottom:1px solid lightgray;
    }
    .item_js:hover{
        background:lightblue;
    }
    .resultado{
        padding:0 !important;
    }
    #id{
        display:none;
    }

    /* Detalle */
    #detalle{
        padding: 6px;
        /* padding-top:7px !important; */
        border-radius:3px;
        margin: 0px 0 0px 0;
        border: 1px solid gray;
        height:fit-content;
        background:#FAFAFA;
        border-top:none;
        border-bottom:none;
        border-bottom-left-radius:0;
        border-bottom-right-radius:0;
        background:#F1F1F1;
    }

    /* .cont_art{
        background:#E1E1E1;
    } */

    .botones{
        text-shadow: 1px 1px 1px #000;
        color: white;
        text-align: center;
        vertical-align: middle;
        padding: 1px 4px;
        margin: 0 -12px 0 -8px;
        font-size: 16px;
        border-radius:3px;
    }

    /* Total */
    #total{
        margin-bottom:6px;
        border-top:none;
        border-top-left-radius:0;
        border-top-right-radius:0;
    }

    /* Navegacion 2 */
    #este{
        width:fit-content;
        padding: 0;
        margin:auto;        
    }

    .boton{
        box-shadow: 1px 1px 2px 0px #000;
        text-shadow: 1px 1px 1px #000;
        color: white;
        text-align: center;
        vertical-align: middle;
        padding: 3px 6px;
        font-size: 16px;
        border-radius: 3px;
    }

    /* #este .boton{
        margin: 0 12px;
    } */

    .anterior,.siguiente,.informe,.eliminar,.anular,.listado{
        margin: 0 12px;
    }

    .primer{
        margin-left:0;
    } 

    /*boton color create*/
    #registrar{
		background: #24B800;
    	border: 1px solid #22AB00;
	}
    #registrar:hover{
		background:#22AB00;
        border: 1px solid #22AB00;
	}

	#limpiar{
		background: #979B9E;
    	border: 1px solid #898E92;
	}
    #limpiar:hover{
		background: #898E92;
    	border: 1px solid #898E92;
	}

    .lista{
        background: #dc3545;
        border: 1px solid #CC3140;
    }
    .lista:hover{
        background: #CC3140;
        border: 1px solid #CC3140;
    }

    /*boton color show*/
    #anterior,#siguiente{
        background: #979B9E;
        border: 1px solid #797D80;
    }
    #anterior:hover,#siguiente:hover{
        background: #797D80;
        border: 1px solid #797D80;
    }    
    #anterior_inactivo,#siguiente_inactivo{
        background: #979B9E;
        border: 1px solid #797D80;
        opacity:0.5;
        cursor:default;
    }

    #informe{
        background: #A9D6CE;
        border: 1px solid #95B8B1;
    }
    #informe:hover{
        background: #95B8B1;
        border: 1px solid #95B8B1;
    }

    #eliminar{
        background: red;
        border: 1px solid #E10000;
    }
    #eliminar:hover{
        background: #E10000;
        border: 1px solid #E10000;
    }

    .anular{
        background: #F0B300;
        border: 1px solid #DAA300;
    }
    .anular:hover{
        background: #DAA300;
        border: 1px solid #DAA300;
    }

    /* correcciones */
    #cabecera, #cabecera table{
        font-size:14px;
    }
    #detalle, #detalle table
    /* ,#total, #total table */
    {
        font-size:15px;
        color:black;
    }

    /* mensaje */
    #agregado{
        position:fixed;
        top:35%;
        left:33%;
        background:#FCFCFC;
        border:1px solid darkgrey;
        border-radius:3px;
        display:none;
        padding:12px 4px;
        box-shadow: 1px 1px 5px 1px #232323;        
        cursor:default;
        width:440px;
        font-family: Raleway;
        border:none !important;
        z-index:1;
    }
    #agregado table{
        font-size: 16px !important;        
        margin:auto;
        width: 100%;
    }
    #agregado td{
        border:none;
    }
    .center{
        text-align:center;
    }
    .right{
        text-align:right;
        padding-right:20px;
        width:50%;
        padding-top:10px;
    }
    .left{
        text-align:left;
        padding-left:20px; 
        width:50%;
        padding-top:10px;
    }

    .help-block{
        color:#C90000;
        text-shadow: 0 0 1px #C8C8C8;
        cursor:default;
        padding-left: 6px;
    }

    /* cuadro */
    #confirm,#anular{
        position:fixed;
        top:35%;
        left:33%;
        background:#FCFCFC;
        border:1px solid darkgrey;
        border-radius:3px;
        display:none;
        padding:12px 4px;
        box-shadow: 1px 1px 5px 1px #232323;        
        cursor:default;
        width:440px;
        font-family: Raleway;
    }
    #confirm table,#anular table{
        margin:auto;
        width: 100%;
        font-size: 16px !important;        
        text-shadow: 0 0 0 #939393;
    }
    #confirm td,#anular td{
        border:none !important;
    }
    #confirm .right,#anular .right{
        padding-right:30px !important; 
    }
    #confirm .left,#anular .left{        
        padding-left:30px !important; 
    }

    #confirm .botones,#anular .botones{
        text-shadow: 1px 1px 1px #000;
        color: white;
        text-align: center;
        vertical-align: middle;
        padding: 4px 6px;
        border-radius:2px;
        box-shadow: 1px 1px 2px 0 #131313;
    }
    .confirmar{
        background: red;
        border: 1px solid #E10000;
    }
    .confirmar:hover{
        background: #E10000;
    }
    .cancelar{
        background: #979B9E;
        border: 1px solid #797D80;
    }
    .cancelar:hover{
        background: #797D80;
        border: 1px solid #797D80;
    }
</style>

<!-- <link href="{{asset('css/vistas/Compra_Venta.css')}}" rel="stylesheet"> contenido -->

@section('content')
    <div id="content">
        <h1 id="titulo">@yield('titulo')</h1>

        <div id="navegacion_1">@yield('navegacion_1')</div>    
        
            <div id="cabecera">@yield('cabecera')</div>

            <div id="detalle">
                @yield('detalle')
            </div>

            <div id="total">@yield('total')</div>
        
        <div id="navegacion_2">@yield('navegacion_2')</div>
    </div>
@endsection