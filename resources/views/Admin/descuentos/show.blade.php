@extends('Admin.lay.Show')



@section('titulo')
    Descuento
@endsection

@section('navegacion_1')
    <div id="este">
        @if($previous)
        <a href="{{URL::to('Descuento/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
        @else
        <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
        @endif

        <a href="{{url('Descuento/'.$descuento->Id_Desc.'/edit')}}" class="modificar "><button class="boton" id="actualizar">Activar</button></a>
        <!-- <a href="{{url('Descuento/'.$descuento->Id_Desc.'/edit')}}" class="modificar "><button class="boton" id="actualizar">Desctivar</button></a> -->

        <a href="{{url('Descuento/'.$descuento->Id_Desc.'/edit')}}" class="modificar"><button class="boton" id="actualizar">Modificar</button></a>

        <button class="boton eliminar" id="borrar" onclick="
            <?php
            $ventas=0;
            $ped_cli=0;
            if($ventas>0 && $ped_cli>0){ ?>;
				$('#rechazo').show().delay(1500).fadeOut(0);
			<?php }else{ ?>;
				$('#confirm').css('display','block');
			<?php } ?>;
		">Eliminar</button> 

        @if($next)
        <a href="{{URL::to('Descuento/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
        @else
        <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
        @endif

        <a href="{{url('Descuento')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>
    </div>
@endsection

@section('contenido')
    @include('Admin.Descuento.session_div.show')
    <table id="principal">
        <tr>
            <td><label for="des_lar">Id de Descuento:</label></td>
            <td><input type="text" size="4" value="{{$descuento->Id_Desc}}" disabled></td>
        </tr>

        <tr>
            <td><label for="des_lar">Tipo:</label></td>
            <td><input type="text" size="15" value="{{$descuento->Desc_Tip}}" disabled></td>
        </tr>

        <tr>
            <td><label for="des_lar">Descripción:</label></td>
            <td><input type="text" size="20" value="{{$descuento->Desc_Des}}" disabled></td>
        </tr>

        <tr>
            <td><label for="estado">Estado:</label></td>
            <td><input type="text" size="8" value="{{$descuento->Desc_Est}}" disabled></td>
        </tr>

        <tr>
            <td class="obs"><label for="observacion">Observación:</label></td>
            <td><textarea rows="4" cols="50" id="obs" disabled>{{$descuento->Desc_Obs}}</textarea></td>
        <tr>

        <tr>
            <td>&nbsp;</td>
        </tr>

        <!-- detalle -->
    </table>                    

    <div id="confirm">
        <table>
            <tr><td class="center" colspan="2">Está a punto de eliminar el descuento, no lo podrá recuperar</td></tr>
            <tr><td class="center" colspan="2">Desea continuar?</td></tr>
            <tr>
                <td class="right">                								
                {!! Form::open(['method'=>'DELETE', 'action'=>['DescuentoController@destroy', $descuento->Id_Desc]]) !!}
                    {{csrf_field()}}
                    <input class="botones eliminar" type="submit" id="eliminar" value="Confirmar">
                {!! Form::close() !!}
                </td>
                <td class="left"><button class="botones cancelar" id="cancelar">Cancelar</button></td>
            </tr>
        </table>
    </div>

    @include('Admin.Descuento.user')
@endsection

@section('navegacion_2')
    <div class="arriba_no">        
    </div>
@endsection

<!-- <script src="{{asset('js/vistas/paginacion_show/descuento.js')}}"></script> -->