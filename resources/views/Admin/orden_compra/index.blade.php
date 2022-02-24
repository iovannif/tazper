@extends('Admin.lay.Index')

@section('titulo')
    Listado de Ordenes
@endsection

@section('navegacion_1')
    <div id="nav">
        <a href="OrdenCompra/create"><button class="boton" id="agregar">Agregar</button></a>
        <a href="#"><button class="boton" id="buscar">Buscar</button></a>
        <input type="text" id="busq" placeholder="Fecha de la orden" size="15" maxlength="8">
        <button class="boton total_reg" id="total_reg">Total: {{ $cant }}</button>
        <button class="boton total_reg" id="most">Mostrados: {{ $mostrados }}</button>
        {{ $ordenes->links('vendor\pagination\simple-default') }}
        <button class="boton total_reg" id="pag">Página {{$ordenes->currentPage()}} de {{$lastPage}}</button>
        @if($lastPage>1)        
        <a href="/Tazper/public/OrdenCompra?page=1"><button class="boton" id="inicio">Inicio</button></a>
        <a href='{{"/Tazper/public/OrdenCompra"."?page=$lastPage"}}'><button class="boton" id="fin">Fin</button></a>
        @endif
    </div>
@endsection

@section('contenido')
    <table id="principal">
        <tr class="head">
            <td>Código</td>
            <td>Proveedor</td>            
            <td>Fecha</td>
            <td>Pedido</td>
            <td>Registro</td>
        </tr>

        @if($ordenes)
        @foreach($ordenes as $orden)
        <tr class="registro">            
            <td><input type="text" size="4" value="{{$orden->Id_OC}}" disabled></td>
            <td><input type="text" size="30" value="{{$orden->OC_EmpProv}}" disabled></td>
            <td><input type="text" size="8" value="{{date('d/m/y', strtotime($orden->OC_Fecha))}}" disabled></td>
            <td><input type="text" size="7" value="{{number_format($orden->OC_Total,0,',','.')}}" disabled></td>
            <td><input type="text" size="8" value="{{$orden->created_at->format('d/m/y')}}" disabled></td>

            <td class="operacion"><button class="botones" id="ver"><a href="OrdenCompra/{{$orden->Id_OC}}">Ver</a></button></td>
            <td class="operacion">
                {!! Form::open(['method'=>'DELETE', 'action'=>['OrdenCompraController@destroy', $orden->Id_OC]]) !!}
                    {{csrf_field()}}
                    <input type="submit" class="botones" id="eliminar" value="Eliminar">
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
                <td><input type="text" size="4" value="" disabled></td>
                <td><input type="text" size="30" value="" disabled></td>
                <td><input type="text" size="8" value="" disabled></td>
                <td><input type="text" size="7" value="" disabled></td>
                <td><input type="text" size="8" value="" disabled></td>
            </tr>
        @endfor
    </table>
@endsection

@section('navegacion_2')
    <div class="arriba" style="">
        <a href="#"><button class="boton" id="arriba">Volver arriba</button></a>
    </div>
@endsection

<style>
    /* margenes */
    #content{
        box-shadow: 0px 1px 9px 1px #000;
        margin: 4px 90px 10px 90px;
        padding: 10px 30px;
        border:1px solid lightgray;
        border-radius:2px;
        height:fit-content;
        background:#F4F4F4;
    }
    
    /* buscador */
    #busq{
        margin: 0 20px 0 0;
        height: 32px;
        padding: 0 0 0 6px;
        vertical-align:middle;
        font-size:15px;
    }
</style>
