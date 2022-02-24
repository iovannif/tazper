@extends('Admin.lay.Index')

@if($cant==0)
<link href="{{asset('css/vistas/todos_index.css')}}" rel="stylesheet">
<style>
    #buscar,#busqueda{
        visibility:hidden;
    }
    #paginacion{
        position: absolute;
        left: 46% !important;
    }
</style>
@endif
<style>
    #navegacion_1{
        padding-right:0 !important;
    }
    /* #nav{
        text-align:center;        
    }
    #nav_2{
        position: absolute;
        top: 105px;
        font-family: Raleway;
    } */
    .agregar{
        margin-right:15px;
    }
    #buscar{        
        cursor: hand !important;
        border-color: #0267D3 !important;
    }
    #buscar:hover{
        background: #0267D3 !important;
    }
    #busqueda{
        font-family:arial;
        cursor: hand;
    }
    #pag{
        margin-right: 16px;
    }    

    .operacion{
        width:90px !important;
    }
    .botones{
        padding:4px 16px !important;
    }
    #ver{
        margin-left:-18px;
    }
    #eliminar{
        padding-left:10px !important;
        padding-right:10px !important;
        margin-right: 5px !important;
    }

    .operacion .botones{
        width:fit-content !important;
    }
</style>

@section('titulo')
    Listado de Compras
@endsection

@section('navegacion_1')
    <div id="nav">                
        <a href="Compras/create"><button class="boton agregar" id="agregar">Registrar</button></a>
        <button class="boton" id="buscar">Buscar</button>
        <input type="date" id="busqueda" placeholder="Fecha" size="8" maxlength="8" spellcheck="false" autocomplete="off" autofocus>                               

        <div id="paginacion">
            <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 4, " ", STR_PAD_LEFT))}}</button>

            @if($cant>0)
            <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($mostrados, 2, " ", STR_PAD_LEFT))}}</button>
            <button class="boton trans" id="pag">Página {{str_replace(" ", "&nbsp;&nbsp;", str_pad($compras->currentPage(), 3, " ", STR_PAD_LEFT))}} de {{str_replace(" ", "&nbsp;&nbsp;", str_pad($lastPage, 3, " ", STR_PAD_LEFT))}}</button>
            @endif

            @if($lastPage>1)
            <div id="pag_bot"><div class="records">
                <a href="{{url('Compras?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>
                {{$compras->links('vendor\pagination\simple-default')}}
                <a href="{{url('Compras?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
            </div></div>
            @endif 
        </div>    
    </div>
@endsection

@section('contenido')
    <!-- <div id="nav_2">
        <a href="Compras/create"><button class="boton agregar" id="agregar">Agregar</button></a>
        <button class="boton" id="buscar">Buscar</button>
        <input type="date" id="busqueda" placeholder="Fecha" size="8" maxlength="8" spellcheck="false" autocomplete="off" autofocus>                               
    </div>     -->
    @include('Admin.Compras.session_div.index')
    <div id="compras">
        <table id="principal">        
            <tr class="head">
                <td>Id</td>            
                <td>Fecha</td>
                <td>Factura Nº</td>
                <td>Proveedor</td>
                <td>Id Pedido</td>
                <td>Id Orden</td>                        
                <td id="opciones" colspan="2">Opciones</td>
            </tr>

            @foreach($compras as $compra)
            <tr class="registro">
                <td><input type="text" id="id" size="4" value="{{$compra->Id_Com}}" disabled></td>
                <td><input type="text" size="14" value="{{date('d/m/y', strtotime($compra->Com_Fe)).' '.date('H:i', strtotime($compra->Com_Ho))}}" disabled></td>                
                <td><input type="text" size="15" value="{{$compra->Com_Fac}}" disabled></td>
                <td>
                    @if($compra->Id_Prov!='')
                        @foreach($proveedores as $proveedor)
                            @if($proveedor->Id_Prov==$compra->Id_Prov)
                            <input type="text" size="30" value="{{$proveedor->Prov_Des}}" disabled>
                            @endif
                        @endforeach
                    @else
                        <input type="text" size="30" value="{{$compra->Id_Prov}}" disabled>
                    @endif
                </td>
                <td><input type="text" size="4" value="{{$compra->Id_PedProv}}" disabled></td>
                <td><input type="text" size="4" value="{{$compra->Id_OC}}" disabled></td>

                <td class="operacion td_ver"><a href="Compras/{{$compra->Id_Com}}"><button class="botones" id="ver">Ver</button></a></td>            
                <td class="operacion td_eliminar">
                    {!! Form::open(['method'=>'DELETE', 'action'=>['ComprasController@destroy', $compra->Id_Com]]) !!}
                        {{csrf_field()}}
                        <input type="submit" class="botones eliminar" id="eliminar" value="Eliminar">
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach

                @php
                    $linea=1;
                    $relleno=20-$mostrados;
                @endphp

                @for($linea==1;$linea<=$relleno;$linea++)
                    <tr class="blank">
                        <td><input type="text" size="4" disabled></td>
                        <td><input type="text" size="14" disabled></td>
                        <td><input type="text" size="15" disabled></td>
                        <td><input type="text" size="30" disabled></td>
                        <td><input type="text" size="4" disabled></td>
                        <td><input type="text" size="4" disabled></td>
                        @if($cant==0)
                        <td class="operacion td_ver"></td>
                        <td class="operacion td_eliminar"></td>
                        @endif
                    </tr>
                @endfor        
        </table>
    </div>

    <!-- fuera -->
    <div id="confirm">
        <table>
            <tr><td class="center" colspan="2">Está a punto de eliminar la compra, no la podrá recuperar</td></tr>
            <tr><td class="center" colspan="2">Desea continuar?</td></tr>
            <tr>
                <td class="right"><button class="c_botones confirmar" type="submit">Confirmar</button></td>
                <td class="left"><button class="c_botones cancelar" id="cancelar">Cancelar</button></td>
            </tr>
        </table>
    </div>
@endsection

@section('navegacion_2')
    <div class="arriba_no">        
    </div>
@endsection

<script>
    window.cantidad=<?php echo $cant; ?>;
    window.pagina_actual=<?php echo $compras->currentPage() ?>;
    window.ultima_pagina=<?php echo $lastPage ?>;  
</script>
<script src="{{asset('js/vistas/paginacion_busqueda/compra.js')}}"></script>
<script src="{{asset('js/vistas/eliminar/compra.js')}}"></script>