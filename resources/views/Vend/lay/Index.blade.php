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
        margin: 4px 33px 10px 33px;
        padding: 10px 30px;
        border:1px solid #EDEDED;
        border-radius:2px;
        height:fit-content;
        background:#F4F4F4;
        color:black;
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
        padding-right:20px;
        width:100%;
    }

    #navegacion_2{
        background: #EEEEEE;
    }

    #nav,#nav2,#nav3{
        margin: 0 auto;
        padding-left:0px;
        background: #F3F3F3;
        cursor:default;
    }    
    
    #nav3{
        display:none;
    }

    #content a{
        color:white !important;
    }
    #content a:hover{
        text-decoration:none !important;
    }

    #paginacion, .paginacion, #pag_bot{
        display:inline;
    }
    
    .records,.resultados{
        display:inline;
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

    .agregar{
        margin-left:20px;
    }

    input[type=text],#busqueda
    {
        width: fit-content;
        height: 27px;
        padding: 0 5px 4px 5px;
        font-size: 15px;
        border:1px solid black;
        border-color: #999999;
        border-radius: 4px;
        color:black;
        box-shadow: 0px 0px 1px 1px #E6E6E6;
        margin: 2px 0 9px 30px;
        background:#FCFCFC;
    }
    input[type=date]{
        width:153px;
    }

    #busqueda{
        margin: 0 20px 0 0;
        height: 32px;
        padding: 0 0 0 6px;
        vertical-align:middle;
        font-size:15px;
    }
    .filtro{
        /* margin: 7px 0 1px 0 !important; */
        height: 32px !important;
        padding: 0 0 0 6px !important;
        vertical-align:middle !important;
        font-size:15px !important;
        visibility:hidden;
    }

    #grupal{
        position:absolute;
        top: 105px;
        right: 87px;
        visibility:hidden;
        font-family:Raleway;
        cursor:default;
    }
    #marcar_todos{
        position:absolute;
        top:144px;
        right: 506px;        
        font-family:Raleway;
        cursor:default;
    }
    .marcar_todos{
        position:absolute;
        top:144px;
        right: 435px;        
        font-family:Raleway;
        cursor:default;
    }

    #todos,#filtrados,#esta_pagina,#todo{
        vertical-align: middle;
        cursor:hand;
    }

    /*boton color*/
    #agregar{
        background: #28a745;
        border: 1px solid #28a745;
        /* margin-left:20px;
        margin-right:20px; */
    }
    #agregar:hover{
        background: #269B41;
        border: 1px solid #269B41;
    }    
    
    #buscar,#buscar_filtro{
        background: #007bff;
        border: 1px solid #007bff;
        margin-right:5px;
    }

    #filtros{
        background:#0069D9;
        border:1px solid #005CBD;
        padding:1px 6px !important;
        /* margin-top:4px !important; */
        margin-left:-10px !important;
    }
    #filtros:hover{
        background:#005CBD;
        border:1px solid #005CBD;
    }

    #cancelar_filtro{
        background: #FF5733;
        border: 1px solid orangered;
        padding:1px 4px !important;
        margin-top:4px !important;
        display:none;
        margin-left:-10px !important;
    }
    #cancelar_filtro:hover{
        background:orangered;
        border:1px solid orangered;
    }

    /* #marcar_filtrados,#filtrados{
        margin-top:4px !important;
        margin-left:5px;
        display:none;
        position:relative;
    } */

    #mf{
        display:none;
        position:absolute;
        top: 144px;
        left: 564px;
        cursor:default;
    }

    .filtro_uno{
        margin-left:20px !important;
    }

    #anterior,#siguiente{
        background: #979B9E;
        border: 1px solid #797D80;        
    }
    #anterior:hover,#siguiente:hover{
        background: #797D80;
        border: 1px solid #797D80;
    }
    #anterior a,#siguiente a{
        text-decoration:none;
        color:white;
    }
    #anterior a:hover,#siguiente a:hover{
        text-decoration:none;
    }
    #anterior_inactivo,#siguiente_inactivo{
        background: #979B9E;
        border: 1px solid #797D80;
        opacity:0.5;
        cursor:default;
        pointer-events: none; /* disabled */
    }
    .inactivo{
        cursor:default;
        pointer-events: none;
    }

    #inicio,#fin{
        background: #979B9E;
    	border: 1px solid #898E92;        
    }
    #inicio:hover,#fin:hover{
        background: #898E92;
    	border: 1px solid #898E92;
    }

    .inicio{
        margin-right:3px;
    }
    .fin{
        margin-left:3px;
    }

    .anterior,.siguiente{
        margin: 0 3px;
    }    

    .total_reg{
        color:#303030;
        text-shadow: 0px 0px 0px #999;
        box-shadow:none;
        border:none;
        background:transparent;
        font-family:sans-serif;
        pointer-events: none;
    }
    .trans{
        color:#303030;
        text-shadow: 0px 0px 0px #999;
        box-shadow:none;
        border:none;
        background:transparent;
        font-family:sans-serif;
        pointer-events: none;
    }

    #buscar,#total_reg,#most,#pag{
        cursor:default;
    }

    /* Contenido */
    #contenido{
        box-shadow: 0px 1px 3px 1px #000;
        border:1px solid lightgray;
        border-radius:2px;
        margin: 6px 0 10px 0;
        padding: 0;
        /* height:793px; */
        background: #FFF;
    }

    /* cuadro */
    #confirm,#eliminado,#agregado,#rechazo,
    #admin_eliminados,#eliminados,#create,
    #vacio,#confirm_grupal,#mdf,#campo_vacio,
    #usuario_eliminados,#articulo_eliminados,
    #producto_eliminados,#material_eliminados,
    #finalizado,#cancelado,#cancela{
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
    }
    #confirm table,#eliminado table, #agregado table, #rechazo table,
    #admin_eliminados table,#eliminados table, #create table,
    #vacio table,#confirm_grupal table,#mdf table, #campo_vacio table,
    #usuario_eliminados table,#articulo_eliminados table,
    #producto_eliminados table,#material_eliminados table,
    #finalizado table,#cancelado table,#cancela table{
        margin:auto;
        width: 100%;
    }
    #confirm td,#eliminado td,#agregado td,#rechazo td,
    #admin_eliminados td,#eliminados td, #create td,
    #vacio td,#confirm_grupal td,#mdf td,#campo_vacio td,
    #usuario_eliminados td, #articulo_eliminados td,
    #producto_eliminados td,#material_eliminados td,
    #finalizado td,#cancelado td,#cancela td{
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
    .c_botones{
        text-shadow: 1px 1px 1px #000;
        color: white;
        text-align: center;
        vertical-align: middle;
        padding: 4px 6px;
        border-radius:2px;
        box-shadow: 1px 1px 2px 0 #131313;
    }
    .confirmar,.g_confirmar{
        background: red;
        border: 1px solid #E10000;
    }
    .confirmar:hover,.g_confirmar:hover{
        background: #E10000;
    }
    /* .cancelar{
        background: #979B9E;
        border: 1px solid #797D80;
    }
    .cancelar:hover{
        background: #797D80;
        border: 1px solid #797D80;
    } */
    .numero{
        font-family:arial;
    }    

    #cancelar,.g_cancelar,#cancelar_grupo{
        background: #dc3545;
        border: 1px solid #dc3545;
    }
    #cancelar:hover,.g_cancelar:hover,#cancelar_grupo:hover{
        background: #CC3140;
        border: 1px solid #CC3140;
    }

    /* #eliminados{
        z-index: 1;
    } */

    /*tabla*/
    #principal{
        width:100%;
        background:#F9F9F9;
    }

    .registro{
        margin:left;
        cursor:hand;
    }
    .registro input{
        cursor:hand;
    }

    td{
        border-radius:3%;
        border-bottom:0.1px solid lightgray;
    }

    .head{
        background: #C90000;
        color:white;
        text-shadow: 1px 1px 1px #000;
        text-align:center;
        font-size:17px;
        cursor:default;
    }
    .head td{
        padding:4px 0px;
        box-shadow:0px 0px 1px 0px darkred;
    }

    .registro{
        text-shadow: 0 0 0 #939393;
        height:38px;
        text-align:center;
    }
    .registro td{
        padding:3px 4px;
        font-size:15px;
        border-right: 1px solid #EEEEEE;
    }
    /* .registro:nth-child(even) {
        background-color:#fbfbfb;
    }
    .registro:nth-child(odd) {
        background-color:#EEEEEE;
    } */
    
    .registro:nth-last-of-type(odd){
        background-color: #EEEEEE;
    }
    .registro:nth-last-of-type(even){
        background-color: #fbfbfb;
    }
    .blank:nth-last-of-type(odd){
        background-color: #EEEEEE;
    }
    .blank:nth-last-of-type(even){
        background-color: #fbfbfb;
    }

    .registro input[type="text"]{
        border:none;
        box-shadow:none;
        padding:0;
        margin:0;
        text-align:center;
        background:none;
        padding-bottom:1px;
    }
    .registro:hover{
        background:lightblue;
    }
    .registro:hover td{
        border-right:1px solid lightblue;
    }
    #ver{
        /* margin-left:2px; */
    }
    #editar{
        /* margin-left:1px; */
        margin-right:-1px;
    }
    #eliminar{
        margin-right:-1px;
    }

    .blank{
        text-shadow: 0 0 0 #939393;
        height:38px;
        text-align:center;
    }
    .blank td{
        padding:3px 4px;
        font-size:15px;
        border-right: 1px solid #EEEEEE;
    }
    /* .blank:nth-child(even) {
        background-color:#EEEEEE;
    }
    .blank:nth-child(odd) {
        background-color:#fbfbfb;
    } */

    .blank input[type="text"]{
        border:none;
        box-shadow:none;
        padding:0;
        margin:0;
        text-align:center;
        background:none;
    }

    #opciones{
        background:#ED0000;        
        width:181px !important;    
    }

    /*botones*/
    .operacion{
        background:#F9F9F9;
        border:none;
        padding:0;
        visibility:hidden;
        padding:0 !important;
        text-align:center;
        border:none !important;
        width:fit-content;
    }

    .botones{
        text-shadow: 1px 1px 1px #000;
        color: white;
        text-align: center;
        vertical-align: middle;
        padding: 5px 5px;
        font-size: 16px;
        border-radius:2px;
    }
    .botones a{
        color:white;
    }
    .botones a:hover{
        color:white;
        text-decoration:none;
    }

    /*botones color*/
    #ver{
        background: #979B9E;
        border: 1px solid #797D80;
    }
    #ver:hover{
        background: #797D80;
        border: 1px solid #797D80;
    }

    #editar,#mdf_grupo{
        background: #F0B300;
        border: 1px solid #DAA300;
    }
    #editar:hover,#mdf_grupo:hover{
        background: #DAA300;
        border: 1px solid #DAA300;
    }

    #informe{
        background: #A9D6CE;
        border: 1px solid #95B8B1;
    }
    #informe:hover{
        background: #95B8B1;
        border: 1px solid #95B8B1;
    }

    #eliminar,#eliminar_grupo{
        background: red;
        border: 1px solid #E10000;
    }
    #eliminar:hover,#eliminar_grupo:hover{
        background: #E10000;
        border: 1px solid #E10000;
    }

    /* .td_ver{
        width:36px;
    }
    .td_editar{
        width:53px;
    }
    .td_eliminar{
        width:70px;
    }
    td.check{
        width:22px;
    } */

    .td_ver{
        width:41px;
    }
    .td_editar{
        width:60px;
    }
    .td_eliminar{
        width:80px;
    }
    .operacion .botones{
        width:97%;        
    }    
    
    /* Navegacion 2 */
    .arriba{
        width:fit-content;
        margin:auto;
    }

    /*boton inf color*/
    #arriba{
        background: #dc3545;
        border: 1px solid #dc3545;
    }
    #arriba:hover{
        background: #CC3140;
        border: 1px solid #CC3140;
    }

    .arriba_no{
        height:27px;
    }    

    .help-block{
        color:#C90000;
        text-shadow: 0 0 1px #C8C8C8;
        cursor:default;
        padding-left: 6px;
    }

    #masiva{        
        cursor:hand;
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
            // Opciones
            jQuery('.registro').hover(function(){
                jQuery(this).find('.operacion').css('visibility','visible');
            }, function(){
                jQuery(this).find('.operacion').css('visibility','hidden');
            });

            // focus
            // $('#busqueda').blur(function(){
            //     setTimeout(function(){
            //         $("#busqueda").focus();
            //     },0);
            // });

            // Eliminar
            $('.eliminar').click(function(){
                event.preventDefault();
                window.id=$('.registro:hover').find('#id').val();
                $('#confirm').css('display','block');
            });
            // Cancelar
            $('#cancelar').click(function(){
                $('#confirm').css('display','none');
            });
        });
    });
</script>