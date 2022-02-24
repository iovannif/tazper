@extends('layouts.Admin_app')

<style>
    /* Contenedor */
    @font-face{
        font-family: Raleway;
        src:url("{{ asset('css/raleway.regular.ttf') }}");
    }

    body{
        background:#EEEEEE !important;
    }

    #sesion{
        margin-right: 15px !important;
    }

    #content{
        box-shadow: 0px 1px 9px 1px #000;
        margin: 4px 152px 10px 152px;
        padding: 10px 30px;
        border:1px solid lightgray;
        border-radius:2px;
        height:fit-content;
        background:#F4F4F4;
    }

    .boton:focus, .botones:focus, button{
        outline: none !important;
    }
    
    /* Titulo */
    #titulo{        
        color: white;
        font-family: Raleway;
        font-size:20px;
        text-shadow: 2px 2px 4px #000;
        box-shadow: 0px 1px 3px 1px #000;
        padding: 6px 0;
        text-align:center;
        border-radius:1px;
        background: #C90000;
        margin-right:-10px;
        margin-left:-10px;
        margin-bottom:6px;
        cursor:default;
    }

    /* Navegacion */
    #navegacion_1,#navegacion_2{
        font-family: Raleway;
        border-radius:4px;
        height:fit-content;
        border: 1px solid gray;
        padding-top:1px;
        padding-bottom:2px;
    }

    #navegacion_1{
        margin-top: 0px;
        margin-bottom: 0px;
        background: #E1E1E1;
    }

    #navegacion_2{
        background: #EEEEEE;
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

    #este{
        width:fit-content;
        padding: 0;
        margin:auto;
        cursor:default;        
    }

    /* #este .boton{
        margin: 0 12px;
    } */
    .eliminar,.volver,.listado{
        margin: 0 12px;
    }

    .primer{
        margin-left:0;
    }

    /*boton color*/
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

    #eliminar,#borrar{
        background: red;
        border: 1px solid #E10000;
    }
    #eliminar:hover,#borrar:hover{
        background: #E10000;
        border: 1px solid #E10000;
    }

    .lista{
        background: #dc3545;
        border: 1px solid #CC3140;
    }
    .lista:hover{
        background: #CC3140;
        border: 1px solid #CC3140;
    }

    /* cuadro */
    #confirm,#rechazo{
        position:fixed;
        top:35%;
        left:33%;
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
    }
    #rechazo table{
        margin:auto;
        width: 100%;
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
    .botones{
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

    /* Contenido */
    #contenido{
        box-shadow: 0px 1px 3px 1px #000;
        border:1px solid lightgray;
        border-radius:2px;
        margin: 4px 0 6px 0;
        padding: 14px 0 10px 30px;
        height:fit-content;
        background: #FFF;
    }

    /*tabla*/
    #principal{
        width: fit-content;
        height: fit-content;        
    }

    td{
        width:fit-content;
        text-shadow: 0 0 0 #939393;
        height:fit-content;
        padding:2px 0 2px 5px;
    }

    label{        
        padding-top:1px;
        font-size:15px;
    }

    input[type=text],
    input[type=number],
    input[type=email],
    input[type=password],
    input[type=date],
    .seleccion, textarea
    {        
        width: fit-content;
        height: 30px;
        padding: 0 5px 3px 7px;
        font-size: 15px;
        border:1px solid black;
        border-color: #999999;
        border-radius: 4px;
        color:black;
        box-shadow: 0px 0px 1px 1px #E6E6E6;
        margin: 2px 0 9px 30px;
        background:#FCFCFC;
    }
    .seleccion{
        padding: 0 5px 3px 4px !important;
    }

    input[type=date]{
        width:144px;
    }

    .obs{
        vertical-align: top;
    }

    #obs{
        margin: 2px 0 9px 30px;
        height: 92px;
        resize:none;
    }

    input[size="2"]::-webkit-input-placeholder{
        font-size: 9px;
    }

    .help-block{
        color:#C90000;
        text-shadow: 0 0 1px #C8C8C8;
        cursor:default;
        padding-left: 6px;
    }

    .hidden{
        display:none;
    }

    /* resultados */
    .busca{
        position: relative;
    }
    .lista_js{
        position: absolute;
        left: 346px;
        top: 416px;
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
        height:27px;
    }
    .item_js:hover{
        background:lightblue;
    }
    
    #id{
        display:none;
    }
    .resultado{
        padding:0 !important;
    }

    .no_hay{
        border: none !important;
        box-shadow: none !important;
        background: none !important;
        padding: 0 !important;
    }

    #cambiar,.cambiar{
        display:none;
        padding-bottom: 4px;
        text-shadow: 1px 1px 1px #000;
        color:white;
        background:#FF5733;
        border:1px solid orangered;
        margin-left:6px;
        border-radius:3px;
        box-shadow: 1px 1px 1px 0px darkgrey;
    }
    #cambiar:hover,.cambiar:hover{
        background:orangered;        
    }
    
    /* Navegacion 2 */
    .arriba{
        width:fit-content;
        margin:auto;
        padding-right:0;
        cursor:default;
    }

    .arriba .boton{
        margin-right:3px;
    }

    #cancelar{
		margin-right:0;
	}

    /*boton inf color*/
    #actualizar{
        background: #F0B300;
        border: 1px solid #DAA300;
    }
    #actualizar:hover{
        background: #DAA300;
        border: 1px solid #DAA300;
    }

    #limpiar{
		background: #979B9E;
    	border: 1px solid #898E92;
	}
    #limpiar:hover{
		background: #898E92;
    	border: 1px solid #898E92;
	}
</style>

@section('content')
    <div id="content">
        <h1 id="titulo">@yield('titulo')</h1>

        <div id="navegacion_1">@yield('navegacion_1')</div>

        <div id="contenido">
            @yield('contenido')
        </div>

        <div id="navegacion_2">@yield('navegacion_2')</div>
    </div>
@endsection

<script>
    window.addEventListener("load", function(){
        $(function(){
            // eliminar
            $('#eliminar').click(function(){
                $('#confirm').css('display','block');
            });
            $('#c_cancelar').click(function(){
                $('#confirm').css('display','none');
            });
         
            $('#limpiar').click(function(){
                $('.primero').focus();
            });            
        });
    });
</script>