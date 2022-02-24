@extends('Admin.lay.Edit')

@section('titulo')
    Editar Descuento
@endsection

@section('navegacion_1')
	<div id="este">						
		<input class="boton eliminar primer" type="submit" id="borrar" value="Eliminar" onclick="                            
            <?php
            $ventas=0;
            $ped_cli=0;
            if($ventas>0 && $ped_cli>0){ ?>;
				$('#rechazo').show().delay(1500).fadeOut(0);
			<?php }else{ ?>;
				$('#confirm').css('display','block');
            <?php } ?>;
            
             // if($('.foreign').val()!=''){
			// 	$('#rechazo').show().delay(1500).fadeOut(0);
			// }else{
			// 	$('#confirm').css('display','block');
            // }   
        ">		
        <a href="{{url('Descuento/'.$descuento->Id_Desc)}}" class="volver"><button class="boton lista" id="volver">Volver</button></a>
        <a href="{{url('Descuento')}}" class="listado"><button class="boton lista" id="lista">Lista</button></a>    
	</div>
@endsection

@section('contenido')
    @include('Admin.Descuento.session_div.edit')        

	{!! Form::model($descuento, ['method'=>'PATCH', 'action'=>['DescuentoController@update', $descuento->Id_Desc], 'spellcheck'=>'false','autocomplete'=>'off']) !!}
        <table id="principal">
            <tr>
                <td><label for="codigo">Id de provedor:</label></td>
                <td><input type="text" size="4" value="{{$descuento->Id_Desc}}" disabled></td>
            </tr>

            <!-- det           -->
        </table>
@endsection

@section('navegacion_2')
        <div class="arriba">
            <input class="boton" type="submit" id="actualizar" value="Actualizar">
            <input class="boton" type="reset" id="limpiar" value="Limpiar">
    {!! Form::close() !!}
            <a href="{{url('Inicio')}}"><button class="boton lista" id="cancelar">Cancelar</button></a>
        </div>
    
        <div id="confirm">
            <table>
                <tr><td class="center" colspan="2">Está a punto de eliminar el descuento, no lo podrá recuperar</td></tr>
                <tr><td class="center" colspan="2">Desea continuar?</td></tr>
                <tr>
                    <td class="right">                
                    {!! Form::open(['method'=>'DELETE', 'action'=>['DescuentoController@destroy', $descuento->Id_Desc]]) !!}
                        {{csrf_field()}}
                        <input class="botones confirmar" type="submit" id="confirmar" value="Confirmar">
                    {!! Form::close() !!}		
                    </td>
                    <td class="left"><button class="botones cancelar" id="c_cancelar">Cancelar</button></td>
                </tr>
            </table>
        </div>    
@endsection

<!-- <script src="{{asset('js/vistas/create_edit/material.js')}}"></script>
<script src="{{asset('js/vistas/create_edit/producto.js')}}"></script> -->