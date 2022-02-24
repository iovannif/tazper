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
    Listado de Producción
@endsection

@section('navegacion_1')
    <div id="nav">
        <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 2, " ", STR_PAD_LEFT))}}</button>

        @if($cant>0)
        <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($mostrados, 2, " ", STR_PAD_LEFT))}}</button>
        <button class="boton trans" id="pag">Página {{$produccion->currentPage()}} de {{$lastPage}}</button>
        @endif

        @if($lastPage>1)
        <div id="pag_bot">
            <a href="{{url('Produccion?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>
            {{$produccion->links('vendor\pagination\simple-default')}}
            <a href="{{url('Produccion?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
        </div>
        @endif
    </div>
@endsection

@section('contenido')
    <a href="Produccion/create"><button class="boton agregar" id="agregar">Agregar</button></a> <!-- nav -->

    @include('Admin.Produccion.session_div.index')
    <div id="produccion">
        <table id="principal">
            <tr class="head">
                <td>Id</td>
                <td>Producto</td>
                <td>Cantidad</td>
                <td>Concepto</td>
                <td>Registro</td>
                <td id="opciones" colspan="2">Opciones</td>
            </tr>

            @if($produccion)
            @foreach($produccion as $producto)
            <tr class="registro">
                <td><input type="text" size="4" value="{{$producto->Id_Pdc}}" disabled></td>
                <td>
                    @foreach($productos as $prod)
                        @if($producto->Id_Prod==$prod->Id_Art)
                        <input type="text" size="35" value="{{$prod->Art_DesLar}}" disabled>
                        @endif
                    @endforeach
                </td>
                <td><input type="text" size="4" value="{{$producto->Pdc_Cant}}" disabled></td>
                <td><input type="text" size="6" value="{{$producto->Pdc_Con}}" disabled></td>
                <td><input type="text" size="14" value="{{$producto->created_at->format('d/m/Y H:i')}}" disabled></td>

                <td class="operacion td_ver"><a href="{{url('Produccion/'.$producto->Id_Pdc)}}"><button class="botones" id="ver">Ver</button></a></td>
                <td class="operacion td_eliminar">
                    {!! Form::open(['method'=>'DELETE', 'action'=>['ProduccionController@destroy', $producto->Id_Pdc]]) !!}
                        {{csrf_field()}}
                        <input type="submit" class="botones borrar" id="eliminar" value="Cancelar">
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
            @endif

                @php
                    $linea=1;
                    $relleno=20-$produccion->count();
                @endphp

                @for($linea==1;$linea<=$relleno;$linea++)
                <tr class="blank">
                    <td><input type="text" size="4" disabled></td>
                    <td><input type="text" size="35" disabled></td>
                    <td><input type="text" size="4" disabled></td>
                    <td><input type="text" size="6" disabled></td>
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
    <div id="confirm"> <!-- confirmar reg -->
        <table>
            <tr><td class="center" colspan="2">Está a punto de cancelar la producción, desea continuar?</td></tr>            
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
    window.pagina_actual=<?php echo $produccion->currentPage() ?>;
    window.ultima_pagina=<?php echo $lastPage ?>;  
</script>
<script src="{{asset('js/vistas/paginacion_busqueda/produccion.js')}}"></script>
<script src="{{asset('js/vistas/eliminar/produccion.js')}}"></script>