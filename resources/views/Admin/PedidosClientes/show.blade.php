@extends('Admin.lay.Show')

@section('titulo')
    Pedidos de Clientes
@endsection

@section('navegacion_1')
    <div id="este">
        @if($previous)
        <a href="{{URL::to('PedidoCliente/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
        @else
        <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
        @endif

        {!! Form::open(['method'=>'DELETE', 'action'=>['PedidosClientesController@destroy', $articulo->Id_Art]]) !!}
            {{csrf_field()}}
            <input class="boton eliminar" type="submit" id="eliminar" value="Eliminar">
        {!! Form::close() !!}
        
        @if($next)
        <a href="{{URL::to('PedidoCliente/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
        @else
        <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
        @endif

        <a href="{{url('PedidoCliente')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>
    </div>
@endsection

@section('contenido')
    
@endsection

@section('navegacion_2')
    <div class="arriba">
        <a href="#"><button class="boton lista" id="arriba">Volver arriba</button></a>
    </div>
@endsection