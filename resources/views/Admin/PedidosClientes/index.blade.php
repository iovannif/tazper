@extends('Admin.lay.Index')

@section('titulo')
    Listado de Pedidos
@endsection

@section('navegacion_1')
    <div id="nav">
        <a href="PedidoCliente/create"><button class="boton" id="agregar">Agregar</button></a>
        <a href="#"><button class="boton" id="buscar">Buscar</button></a>
        <input type="text" id="busq" placeholder="Nombre del artículo" size="35" maxlength="35">
        <button class="boton total_reg" id="total_reg">Total: {{$cant}}</button>
    </div>
@endsection

@section('contenido')
    <table id="principal">
        <tr class="head">
            <td>Código</td>
            <td>Descripción</td>            
            <td>Estado</td>
            <td>Stock</td>
            <td>Compra</td>
            <td>Venta</td>
            <td>Impuesto</td>
        </tr>
        
        @if($articulos)
        @foreach($articulos as $articulo)
        <tr class="registro">
            <td><input type="text" size="4" value="{{$articulo->Id_Art}}" disabled></td>
            <td><input type="text" size="35" value="{{$articulo->Art_DesLar}}" disabled></td>
            <td><input type="text" size="10" value="{{$articulo->Art_Est}}" disabled></td>
            <td><input type="text" size="4" value="{{$articulo->Art_St}}" disabled></td>
            <td><input type="text" size="7" value="{{number_format($articulo->Art_PreCom,0,',','.')}}" disabled></td>
            <td><input type="text" size="7" value="{{number_format($articulo->Art_PreVen,0,',','.')}}" disabled></td>
            <td><input type="text" size="7" value="{{$articulo->Id_Imp}}" disabled></td>

            <td class="operacion"><button class="botones" id="ver"><a href="PedidoCliente/{{$articulo->Id_Art}}">Ver</a></button></td>
            <td class="operacion">
                {!! Form::open(['method'=>'DELETE', 'action'=>['PedidosClientesController@destroy', $articulo->Id_Art]]) !!}
                    {{csrf_field()}}
                    <input type="submit" class="botones" id="eliminar" value="Eliminar">
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
        @endif

        @php
            $linea=1;
            $relleno=20-$articulos->count();
        @endphp

        @for($linea==1;$linea<=$relleno;$linea++)
            <tr class="blank">
                <td><input type="text" size="4" value="" disabled></td>
                <td><input type="text" size="35" value="" disabled></td>
                <td><input type="text" size="10" value="" disabled></td>
                <td><input type="text" size="4" value="" disabled></td>
                <td><input type="text" size="7" value="" disabled></td>
                <td><input type="text" size="7" value="" disabled></td>
                <td><input type="text" size="7" value="" disabled></td>
            </tr>
        @endfor
    </table>
@endsection

@section('navegacion_2')
    <div class="arriba">
        <a href="#"><button class="boton" id="arriba">Volver arriba</button></a>
    </div>
@endsection

<style>
    /* buscador */
    #busq{
        margin: 0 20px 0 0;
        height: 32px;
        padding: 0 0 0 6px;
        vertical-align:middle;
        font-size:15px;
    }
</style>
