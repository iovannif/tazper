@extends('layouts.Vend_app')

<style>
    /* Contenedor */
    @font-face{
        font-family: Raleway;
        src: url("{{ asset('css/raleway.regular.ttf') }}");
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
        color:black;
    }

    .boton:focus, .botones:focus{
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
        cursor:default;
    }
    
    /* Contenido */
    #contenido{
        box-shadow: 0px 1px 3px 1px #000;
        border:1px solid lightgray;
        border-radius:2px;
        margin: 0px 0 6px 0;
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
    input[type=url],
    .seleccion, textarea
    {        
        width: fit-content;
        height: 30px;
        padding: 0 5px 2px 7px;
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
        width:153px;
    }    

    input[size="4"]::-webkit-input-placeholder{ /* Chrome/Opera/Safari */
        /* name=campo */
        font-size: 11px;
    }
    input[size="7"]::-webkit-input-placeholder{
        /* name=campo */
        font-size: 11px;
    }
    input[size="3"]::-webkit-input-placeholder{
        font-size: 10px;
    }
    input[size="2"]::-webkit-input-placeholder{
        font-size: 9px;
    }
    
    .obs{
        vertical-align: top;
    }

    textarea#obs,#art_obs{
        margin: 2px 0 9px 30px;
        height: 92px;
        resize:none;
    }

    span#obs{
        margin-left:28px;
    }
    
    .help-block, .error{
        color:#C90000;
        text-shadow: 0 0 1px #C8C8C8;
        cursor:default;
        padding-left: 6px;
    }
    .obs_err{
		padding-left:30px !important;
	}

    .hidden{
        display:none;
    }

    .no_hay{
        border: none !important;
        box-shadow: none !important;
        background: none !important;
        padding: 0 !important;
    }

    /* resultados */
    input.busca{
        position: relative;
    }
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
        outline:none;
    }

    /* Navegacion */
    #navegacion_2{
        font-family: Raleway;
        border-radius:4px;
        height:fit-content;
        border: 1px solid gray;
        padding-top:1px;
        padding-bottom:2px;
        background: #EEEEEE;
    }

    .arriba{
        width:fit-content;
        margin:auto;
        padding-right:0;
        cursor:default;
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

    .arriba .boton{
        margin-right:3px;
    }

    /*boton color*/
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
        border: 1px solid #dc3545;
    }
    .lista:hover{
        background: #CC3140;
        border: 1px solid #CC3140;
    }
    
    /* #masivo{
        background:#6DC193;
        border: 1px solid #538369;
    }
    #masivo:hover{
        background:#538369;
        border: 1px solid #538369;
    } */

    .masiva{
        cursor:default;
    }
    #masiva{
        vertical-align:middle;
        cursor:hand;
    }    

    /* margin */
    #cancelar{
        margin-right:0;
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
        font-size: 15px !important;
        cursor:default;
        width:440px;
        font-family: Raleway;
        border:none !important;
        z-index:1;
    }
    #agregado table{
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
</style>

@section('content')
    <div id="content">
        <h1 id="titulo">@yield('titulo')</h1>         

        <div id="contenido">
            @yield('contenido')
        </div>

        <div id="navegacion_2">@yield('navegacion_2')</div>
    </div>
@endsection

<script>
    window.addEventListener("load", function(){
        $(function(){
            $('#limpiar').click(function(){
                $('.primer').focus();
            });
        });
    });
</script>