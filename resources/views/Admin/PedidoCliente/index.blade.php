@extends('Admin.lay.Index')
<!-- css -->
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
    .agregar{
        position: absolute;
        top: 105px;
        font-family: Raleway;
    }
    #pag{
        margin-right: 16px;
    }
    .pendientes{
        position: absolute;
        top: 107px;
        font-family: Raleway;
        right: 119px;
        cursor:default;
    }
    .pendientes input{
        cursor:hand;
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

<!-- html -->
@section('titulo')
    Listado de Pedidos
@endsection

@section('navegacion_1')
    <div id="nav">        
        <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 3, " ", STR_PAD_LEFT))}}</button>

        @if($cant>0)
        <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($mostrados, 2, " ", STR_PAD_LEFT))}}</button>
        <button class="boton trans" id="pag">Página {{str_replace(" ", "&nbsp;&nbsp;", str_pad($pedidos->currentPage(), 2, " ", STR_PAD_LEFT))}} de {{str_replace(" ", "&nbsp;&nbsp;", str_pad($lastPage, 2, " ", STR_PAD_LEFT))}}</button>
        @endif

        @if($lastPage>1)
        <div id="pag_bot">
            <a href="{{url('PedidoCliente?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>
            {{$pedidos->links('vendor\pagination\simple-default')}}
            <a href="{{url('PedidoCliente?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
        </div>
        @endif                
    </div>
@endsection

@section('contenido')
    <a href="PedidoCliente/create"><button class="boton agregar" id="agregar">Agregar</button></a> 

    <div class="pendientes">
        @if($filtro=='Pendiente')
            <button class="boton trans">Pendiente</button>
            <input type="radio" name="pedientes" id="pendiente" checked style="vertical-align:middle">    
            
            <button class="boton trans">Todos</button>
            <input type="radio" name="pedientes" id="todo" style="vertical-align:middle">
        @elseif($filtro=='todos' || $filtro=='')        
            <button class="boton trans">Pendiente</button>
            <input type="radio" name="pedientes" id="pendiente" style="vertical-align:middle">    
            
            <button class="boton trans">Todos</button>
            <input type="radio" name="pedientes" id="todo" checked style="vertical-align:middle">              
        @endif          
    </div>          
    <!-- nav -->

    @include('Admin.PedidoCliente.session_div.index')
    <div id="pedidos">
        <table id="principal">
            <tr class="head">
                <td>Id</td>
                <td>Cliente</td>
                <!-- <td>Descuento</td> -->
                <td>Tipo</td>
                <td>Fecha de Entrega</td>
                <td>Estado</td>
                <td>Registro</td>                
                <td id="opciones" colspan="2">Opciones</td>
            </tr>

            @if($pedidos)
            @foreach($pedidos as $pedido)
            <tr class="registro">
                <td><input type="text" size="4" value="{{$pedido->Id_PedCli}}" disabled></td>
                <td>
                    @foreach($clientes as $cliente)
                        @if($cliente->Id_Cli==$pedido->Id_Cli)
                        <input type="text" size="35" value="{{$cliente->Cli_Nom.' '.$cliente->Cli_Ape}}" disabled>
                        @endif
                    @endforeach
                </td>            
                {{--
                <td>
                    @foreach($clientes as $cliente)
                        @if($cliente->Id_Cli==$pedido->Id_Cli)
                            @foreach($listas as $lp)
                                @if($cliente->Id_Lp==$lp->Id_Lp)
                                    @if($cliente->Id_Lp!=1)
                                    <input type="text" size="3" value="{{$lp->Lp_Desc}}%" disabled>
                                    @else
                                    <input type="text" size="3" value="" disabled>
                                    @endif    
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </td>
                --}}
                <td><input type="text" size="9" value="{{$pedido->PedCli_Tip}}" disabled></td>
                <td><input type="text" size="8" value="{{date('d/m/y', strtotime($pedido->PedCli_FeEnt))}}" disabled></td>
                <td><input type="text" size="9" value="{{$pedido->PedCli_Est}}" disabled></td>
                <td><input type="text" size="14" value="{{$pedido->created_at->format('d/m/y H:i')}}" disabled></td>                

                <td class="operacion td_ver"><a href="{{url('PedidoCliente/'.$pedido->Id_PedCli)}}"><button class="botones" id="ver">Ver</button></a></td>
                <td class="operacion td_eliminar">
                {{--{!! Form::open(['method'=>'DELETE', 'action'=>['PedidosClientesController@destroy', $pedido->Id_PedCli]]) !!}
                        {{csrf_field()}} --}}
                        @if($pedido->PedCli_Est=='Pendiente')
                        <input type="submit" class="botones borrar" id="eliminar" value="Cancelar">
                        @else
                        <input type="submit" class="botones borrar" id="eliminar" value="Eliminar">
                        @endif
                {{--{!! Form::close() !!}--}}                                        
                </td>
            </tr>
            @endforeach
            @endif

                @php
                    $linea=1;
                    $relleno=20-$pedidos->count();
                @endphp

                @for($linea==1;$linea<=$relleno;$linea++)
                <tr class="blank">
                    <td><input type="text" size="4" disabled></td>
                    <td><input type="text" size="35" disabled></td>
                    <!-- <td><input type="text" size="3" disabled></td> -->
                    <td><input type="text" size="9" disabled></td>
                    <td><input type="text" size="8" disabled></td>
                    <td><input type="text" size="9" disabled></td>
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
            <tr><td class="center" colspan="2">Está a punto de cancelar el pedido, desea continuar?</td></tr>            
            <tr>
                <td class="right"><button class="c_botones confirmar" type="submit">Confirmar</button></td>
                <td class="left"><button class="c_botones cancelar" id="cancelar">Cancelar</button></td>
            </tr>
        </table>
    </div>

    <div id="confirm">
        <table>
            <tr><td class="center" colspan="2">Está a punto de eliminar el pedido, desea continuar?</td></tr>            
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
    // eliminar
    window.cantidad=<?php echo $cant; ?>;
    window.pagina_actual=<?php echo $pedidos->currentPage() ?>;
    window.ultima_pagina=<?php echo $lastPage ?>;  
</script>
<script src="{{asset('js/vistas/paginacion_busqueda/pedido_cliente.js')}}"></script>
<script src="{{asset('js/vistas/eliminar/pedido_cliente.js')}}"></script>