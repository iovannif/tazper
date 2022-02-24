@extends('Admin.lay.Index')

@if($cant==0)
    <link href="{{asset('css/vistas/todos_index.css')}}" rel="stylesheet">
@endif

<style>
    #navegacion_1{
        padding-right:0 !important;
    }
    #nav{
        text-align:center;
        height:32px;
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
    Listado de Ordenes
@endsection

@section('navegacion_1')
    <div id="nav">
        <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 3, " ", STR_PAD_LEFT))}}</button>

        @if($cant>0)
        <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($mostrados, 2, " ", STR_PAD_LEFT))}}</button>
        <button class="boton trans" id="pag">Página {{$ordenes->currentPage()}} de {{$lastPage}}</button>
        @endif

        @if($lastPage>1)
        <div id="pag_bot">
            <a href="{{url('OrdenCompra?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>
            {{$ordenes->links('vendor\pagination\simple-default')}}
            <a href="{{url('OrdenCompra?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
        </div>
        @endif     
    </div>
@endsection

@section('contenido')    
    @include('Admin.OrdenCompra.session_div.index')
    <div id="ordenes">
        <table id="principal">
            <tr class="head">
                <td>Id</td>
                <td>Proveedor</td>            
                <td>Pedido</td>
                <td>Estado</td>
                <td>Fecha de entrega</td>
                <td>Registro</td>
                <td id="opciones" colspan="2">Opciones</td>
            </tr>

            @if($ordenes)
            @foreach($ordenes as $orden)
            <tr class="registro">            
                <td><input type="text" size="4" value="{{$orden->Id_OC}}" disabled></td>
                <td>
                    @foreach($proveedores as $proveedor)
                        @if($proveedor->Id_Prov==$orden->Id_Prov)
                        <input type="text" size="30" value="{{$proveedor->Prov_Des}}" disabled>
                        @endif
                    @endforeach                    
                </td>
                <td><input type="text" size="4" value="{{$orden->Id_PedProv}}" disabled></td>
                <td><input type="text" size="7" value="{{$orden->OC_Est}}" disabled></td>
                <td><input type="text" size="8" value="{{date('d/m/y', strtotime($orden->OC_FeEnt))}}" disabled></td>
                <td><input type="text" size="14" value="{{$orden->created_at->format('d/m/y H:i')}}" disabled></td>

                <td class="operacion td_ver"><a href="OrdenCompra/{{$orden->Id_OC}}"><button class="botones" id="ver">Ver</button></a></td>
                <td class="operacion td_eliminar">
                    {!! Form::open(['method'=>'DELETE', 'action'=>['OrdenCompraController@destroy', $orden->Id_OC]]) !!}
                        {{csrf_field()}}
                        @if($orden->OC_Est=='Pendiente')
                        <input type="submit" class="botones borrar" id="eliminar" value="Cancelar">
                        @else
                        <input type="submit" class="botones borrar" id="eliminar" value="Eliminar">
                        @endif
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
            @endif

                @php
                    $linea=1;
                    $relleno=20-$mostrados;
                @endphp

                @for($linea==1;$linea<=$relleno;$linea++)
                    <tr class="blank">
                        <td><input type="text" size="4" disabled></td>
                        <td><input type="text" size="30" disabled></td>
                        <td><input type="text" size="4" disabled></td>
                        <td><input type="text" size="7" disabled></td>
                        <td><input type="text" size="8" disabled></td>
                        <td><input type="text" size="14" disabled></td>
                        @if($cant==0)
                        <td class="operacion td_ver"></td>
                        <td class="operacion td_eliminar"></td>
                        @endif
                    </tr>
                @endfor
        </table>
    </div>

    <!-- Fuera -->
    <!-- confirmar reg -->
    <div id="cancela">
        <table>
            <tr><td class="center" colspan="2">Está a punto de cancelar la orden, desea continuar?</td></tr>            
            <tr>
                <td class="right"><button class="c_botones confirmar" type="submit">Confirmar</button></td>
                <td class="left"><button class="c_botones cancelar" id="cancelar">Cancelar</button></td>
            </tr>
        </table>
    </div>

    <div id="confirm">
        <table>
            <tr><td class="center" colspan="2">Está a punto de eliminar la orden, desea continuar?</td></tr>            
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

<!-- js -->
<script>
    window.cantidad=<?php echo $cant; ?>;
    window.pagina_actual=<?php echo $ordenes->currentPage() ?>;
    window.ultima_pagina=<?php echo $lastPage ?>;  
</script>
<script src="{{asset('js/vistas/paginacion_busqueda/orden_compra.js')}}"></script>
<script src="{{asset('js/vistas/eliminar/orden_compra.js')}}"></script>