@extends('layouts.Admin_app')

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
        margin-top: 4px;
        margin-bottom: 1px;
        background: #E1E1E1;
    }

    #navegacion_2{
        background: #EEEEEE;
    }

    #este{
        width:fit-content;
        padding: 0;
        margin:auto;
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

    /* #este .boton{
        margin: 0 12px;
    } */

    .anterior,.siguiente,.modificar,.eliminar,.listado,.volver{
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

    #actualizar,.actualizar{
        background: #F0B300;
        border: 1px solid #DAA300;
    }
    #actualizar:hover,.actualizar:hover{
        background: #DAA300;
        border: 1px solid #DAA300;
    }

    #eliminar,#borrar,.borrar{
        background: red;
        border: 1px solid #E10000;
    }
    #eliminar:hover,#borrar:hover,.borrar:hover{
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

    .informe{
        background: #A9D6CE;
        border: 1px solid #95B8B1;
    }
    .informe:hover{
        background: #95B8B1;
        border: 1px solid #95B8B1;
    }

    /* cuadro */
    #confirm,#actualizado,#rechazo,
    .finalizar,#cancela,#rechazo_act{
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
    #confirm table, #actualizado table,#rechazo table,
    .finalizar table,#cancela table,#rechazo_act table{
        margin:auto;
        width: 100%;
    }
    #confirm td, #actualizado td,#rechazo td,
    .finalizar td,#cancela td,#rechazo_act td{
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
        width:auto;
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
        color: black;
    }

    input[type=text],textarea
    {
        width: fit-content;
        height: 30px;
        padding: 0 5px 3px 7px;
        font-size: 15px;
        border:1px solid black;
        border-color: #999999;
        border-radius: 4px;
        color:black;
        box-shadow: inset 0px 0px 1px 1px #E6E6E6;
        margin: 2px 0 9px 30px;
        background:#FCFCFC;
    }

    .obs{
        vertical-align: top;
    }

    #obs{
        margin: 2px 0 9px 30px;
        height: 92px;
        resize:none;
    }

    #reg,#mdf{
        margin-left:76px;
        margin-right:20px;
    }

    #regPor_id,#mdfPor_id{
        margin-left:25px;
        margin-right:-15px;
    }

    #Id_Per{
        margin-right: -15px;
    }

    .id{
        margin-right: -15px !important;
    }

    #sin_modif{
        display:none;
    }
    .oculto{
        visibility:hidden;
    }

    /*detalle titulo*/
    #detalle{
        font-family: Raleway;
        color: #C90000;
        font-size:20px;
        font-weight:bold;
        text-shadow: 1px 1px 1px lightgray;
        margin-top:15px;
        margin-top:10px;  /**/
        cursor:default;
    }

    /*detalle tabla*/
    .detalle td{
        text-align:center;
        cursor:default;         
    }

    .detalle .head td{
        border-radius:3%;
        text-shadow: 1px 1px 1px #000;
        padding:4px 12px;
        background: #C90000;
        color:white;
        box-shadow: 0px 0px 1px 0px darkred;        
    }

    .detalle .body td{
        padding:3px 12px;
        border-right: 1px solid #EEEEEE;
        border-bottom: 0.1px solid lightgray;       
    }
    .detalle .body:nth-child(odd) {
        background-color:#EEEEEE;
    }
    .detalle .body:nth-child(even) {
        background-color:#fbfbfb;
    }

    .detalle input{
        border:none;
        box-shadow:none;
        padding:0;
        margin:0;
        text-align:center;
        background:none;
    }

    /* Navegacion 2 */
    .arriba{
        width:fit-content;
        margin:auto;
    }

    .arriba_no{
        height:27px;
    }
</style>

@section('content')
    <div id="content">
        <h1 id="titulo">@yield('titulo')</h1>

        <div id="navegacion_1">@yield('navegacion_1')</div>

        <div id="contenido">            
            @yield('contenido')            

            <table id="auditoria">
                <tr id="registro">
                    <td><label for="registrado">Registro:</label></td>
                    <td>
                        @yield('reg')
                    </td>

                    <td class="hidden"><label for="reg_por">Por:</label></td>
                    <td class="hidden">
                        @yield('reg_por')
                    </td>
                </tr>

                <tr id="modificado">
                    <td><label for="modificado">Modificado:</label></td>
                    <td>
                        @yield('mdf')
                    </td>

                    <td><label for="mdf_por">Por:</label></td>
                    <td>
                        @yield('mdf_por')
                    </td>
                </tr>

                <tr id="sin_modif">
                    <td colspan="2"><label for="modificado">Sin modificaciones</label></td>
                    <td colspan="2"><input type="text" class="oculto"></td>
                </tr>
            </table>

            @yield('detalle')
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
            $('#cancelar').click(function(){
                $('#confirm').css('display','none');
            });
        });
    });
</script>