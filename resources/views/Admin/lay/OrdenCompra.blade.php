@extends('layouts.Admin_app')
<!-- Marco -->
<style>
    /* Contenedor */
    @font-face{
        font-family: Raleway;
        src: url("{{asset('css/raleway.regular.ttf')}}");
    }

    body{
        background:#F3F3F3 !important;
    }

    #sesion{
        margin-right: 15px !important;
    }

    #content{
        font-family: Raleway;
        box-shadow: 0px 1px 9px 1px #000;
        margin: 4px 190px 10px 185px;
        padding: 10px 30px;
        border:1px solid lightgray;
        border-radius:2px;
        height:fit-content;
        background:#F4F4F4;
    }

    .boton:focus, .botones:focus{
        outline: none !important;
    }
    
    /* Titulo */
    #titulo{        
        color: white;
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
        border:none;
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

    .anterior,.siguiente,.modificar,.eliminar,.listado,.volver,.informe{
        margin: 0 12px;
    }

    .primer{
        margin-left:0;
    }  

    /* Contenido */
    #contenido{
        padding: 14px 20px;
        font-family: "Times New Roman";
        box-shadow: 0px 1px 3px 1px #000;
        border:1px solid lightgray;
        border-radius:2px;
        margin:4px 0 6px 0;
        height:fit-content;
        background: #FFF;
        text-align:center;
    }

    /* aud */
    #auditoria{
        /* font-family: arial; */
        margin-top:30px;
        margin-left: 30px;    
        
        font-family:arial !important;
        font-size:15px;
    }
    #auditoria input{
        width: fit-content;
        height: 30px;
        padding: 0 5px 2px 7px;
        font-size: 15px;
        border: 1px solid black;
        border-color: #999999;
        border-radius: 4px;
        color: black;
        box-shadow: inset 0px 0px 1px 1px #E6E6E6;
        margin: 2px 0 9px 30px;
        background: #FCFCFC; 
        text-shadow:none;         
    }
    #auditoria label{
        text-shadow: 0 0 0 #939393;
    }
    input{
        padding-bottom:2px !important;
    }

    #reg,#mdf{
        margin-left:76px !important;
        margin-right:20px !important;
    }

    #regPor_id,#mdfPor_id{
        margin-left:25px !important;
        margin-right:-15px !important;
    }    

    .oculto{
        visibility:hidden;
    }

    /* cuadro */
    #confirm,#cancela{
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
    #confirm table,#cancela table{
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
    .borrar{
        background: red;
        border: 1px solid #E10000;
    }
    .borrar:hover{
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

    /* Nagevacion 2 */
    .arriba{
        width:fit-content;
        margin:auto;
        border:none;
    }

    .arriba_no{
        height:27px;
    }

    .arriba .boton{
        margin-right:3px;
    }

    #cancelar{
		margin-right:0;
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
        border: 1px solid #dc3545;
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

    #actualizar{
        background: #F0B300;
        border: 1px solid #DAA300;
    }
    #actualizar:hover{
        background: #DAA300;
        border: 1px solid #DAA300;
    }

    /*boton color show*/
    #anterior,#siguiente{
        background: #979B9E;
        border: 1px solid #979B9E;
    }
    #anterior:hover,#siguiente:hover{
        background: #797D80;
        border: 1px solid #797D80;
    }
    #anterior_inactivo,#siguiente_inactivo{
        background: #979B9E;
        border: 1px solid #979B9E;
        opacity:0.5;
    }

    #eliminar,#borrar{
        background: red;
        border: 1px solid red;
    }
    #eliminar:hover,#borrar:hover{
        background: #E10000;
        border: 1px solid #E10000;
    }
</style>

<link href="{{asset('css/vistas/Orden_Compra.css')}}" rel="stylesheet"> <!-- orden -->

@section('content')
    <div id="content">
        <h1 id="titulo">@yield('titulo')</h1>

        <div id="navegacion_1">@yield('navegacion_1')</div>
        
        <div id="contenido">
            @yield('contenido')

            <table id="auditoria">
                <tr>
                    <td><label for="pedido">Pedido:</label></td>
                    <td><input type="text" size="4" value="{{$orden->Id_PedProv}}" disabled></td>
                </tr>

                <tr>
                    <td><label for="est">Estado:</label></td>
                    <td><input type="text" size="10" value="{{$orden->OC_Est}}" disabled></td>
                </tr>

                @if($orden->OC_Est=='Recibido' && $compra!='')
                <tr>
                    <td><label for="est">Compra:</label></td>
                    <td><input type="text" size="4" value="Id: {{$compra}}" disabled></td>
                </tr>
                @endif

                <tr>
                    <td>&nbsp;</td>
                </tr>

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
        </div>

        <div id="navegacion_2">@yield('navegacion_2')</div>
    </div>
@endsection