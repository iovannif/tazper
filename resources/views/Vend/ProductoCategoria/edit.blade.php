@extends('Vend.lay.Edit')

<style>	
    #content{
        margin-bottom:168px !important;
    }
	#contenido{
		padding-top:30px !important;
		padding-bottom:20px !important;
	}
</style>

@section('titulo')
    Editar Categorías
@endsection

@section('navegacion_1')
	<div id="este">
		<button class="boton eliminar primer" id="borrar" onclick="						
			<?php if($pro_cat->count()>0){ ?>;
				$('#rechazo').show().delay(1500).fadeOut(0);
			<?php }else{ ?>;
				$('#confirm').css('display','block');
			<?php } ?>;
		">Eliminar</button>						
		<a href="{{url('/Productos_Categoria/'.$cat->Id_Cat)}}" class="volver"><button class="boton lista" id="volver">Volver</button></a>
		<a href="{{url('/Productos_Categoria')}}" class="listado"><button class="boton lista" id="lista">Lista</button></a>
	</div>
@endsection

@section('contenido')
	@include('Vend.ProductoCategoria.session_div.edit')

	{!! Form::model($cat, ['method'=>'PATCH', 'action'=>['CategoriaController@update', $cat->Id_Cat], 'autocomplete'=>'off', 'spellcheck'=>'false']) !!}
		<table id="principal">
			<tr>
				<td><label for="id_per">Id de Categoría:</label></td>
				<td><input type="text" size="4" value="{{$cat->Id_Cat}}" disabled></td>
			</tr>

			<tr>
				<td><label for="descripcion">Descripción:</label></td>				
				<td>
					@if($errors->any())						
						<input type="text" name="Cat_Des" class="primero" placeholder="obligatorio" size="20" maxlength="20" value="{{old('Cat_Des')}}" required autofocus>						
						@if($errors->has('Cat_Des'))
						<span class="help-block">{{$errors->first('Cat_Des')}}</span>						
						@endif													
					@else			
						<input type="text" name="Cat_Des" class="primero" placeholder="obligatorio" size="20" maxlength="20" value="{{$cat->Cat_Des}}" required autofocus>					
					@endif												
				</td>
			</tr>

			<tr>
				<td><label for="estado">Estado:</label></td>
				<td>
					@php
						$est_1='Activa';
						$est_2='Inactiva';
					@endphp
					<select class="seleccion" name="Cat_Est" minlength="6" maxlength="8" value="{{old('Cat_Est')}}" required>
						@if($cat->Cat_Est == $est_1)
							<option value="{{$est_1}}">{{$est_1}}</option>
							<option value="{{$est_2}}">{{$est_2}}</option>
						@elseif($cat->Cat_Est == $est_2)
							<option value="{{$est_2}}">{{$est_2}}</option>
							<option value="{{$est_1}}">{{$est_1}}</option>
						@endif
					</select>
					@if($errors->has('Cat_Est'))<span class="help-block">{{$errors->first('Cat_Est')}}</span>@endif
				</td>
			</tr>

			<tr>
				<td class="obs"><label for="observacion">Observación:</label></td>
				<td>										
					@if($errors->any())		
						<textarea name="Cat_Obs" id="obs" cols="50" rows="4" placeholder="opcional" maxlength="140">{{old('Cat_Obs')}}</textarea>	
						@if($errors->has('Cat_Obs'))
						<br><span class="help-block" id="obs">{{$errors->first('Cat_Obs')}}</span>
						@endif
					@else
						<textarea name="Cat_Obs" id="obs" cols="50" rows="4" placeholder="opcional" maxlength="140">{{$cat->Cat_Obs}}</textarea>
					@endif
				</td>
			</tr>
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
            <tr><td class="center" colspan="2">Está a punto de eliminar la categoría, no la podrá recuperar</td></tr>
            <tr><td class="center" colspan="2">Desea continuar?</td></tr>
            <tr>
                <td class="right">                
				{!! Form::open(['method'=>'DELETE', 'action'=>['CategoriaController@destroy', $cat->Id_Cat]]) !!}
					{{csrf_field()}}
					<input class="botones confirmar" type="submit" id="confirmar" value="Confirmar">
				{!! Form::close() !!}		
                </td>
                <td class="left"><button class="botones cancelar" id="c_cancelar">Cancelar</button></td>
            </tr>
        </table>
    </div>    
@endsection