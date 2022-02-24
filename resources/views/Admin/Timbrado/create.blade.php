@extends('Admin.lay.Create')

<style>
	body{
		height:100.1%;		
	}
</style>

@section('titulo')
    Agregar Timbrado
@endsection

@section('contenido')
	{!! Form::open(['url'=>'/Timbrado', 'method'=>'post', 'autocomplete'=>'off', 'spelcheck'=>'false']) !!}
		{{csrf_field()}}
		<table id="principal">
			<tr>
				<td><label for="timb">Nº de Timbrado:</label></td>
				<td>
					<!-- <input type="number" class="primer" name="Timb_Num" placeholder="obligatorio" maxlength="8" onkeypress="if(this.value.length==8) return false;" value="{{old('Timb_Num')}}" style="width:110px;" autofocus required>										 -->
					<input type="number" class="primer" name="Timb_Num" placeholder="obligatorio" min="0" max="99999999" onkeypress="if(this.value.length==8) return false;" value="{{old('Timb_Num')}}" style="width:110px;" autofocus required>					
					@if($errors->has('Timb_Num'))
					<span class="help-block">{{$errors->first('Timb_Num')}}</span>
					@endif

					<input type="hidden" name="Id_Suc" value="1">
					<input type="hidden" name="Id_PtoExp" value="1">
				</td>
			</tr>		

			<tr>
				<td><label for="timb">Inicio de vigencia:</label></td>
				<td>
					<input type="date" name="Timb_IniVig" value="{{old('Timb_IniVig')}}" required>					
					@if($errors->has('Timb_IniVig'))
					<span class="help-block">{{$errors->first('Timb_IniVig')}}</span>
					@endif
				</td>
			</tr>	

			<tr>
				<td><label for="timb">Fin de vigencia:</label></td>
				<td>
					<input type="date" name="Timb_FinVig" value="{{old('Timb_FinVig')}}" required>					
					@if($errors->has('Timb_FinVig'))
					<span class="help-block">{{$errors->first('Timb_FinVig')}}</span>
					@endif
				</td>
			</tr>	
			
			<tr>
				<td><label for="timb">Rango de facturación:</label></td>
				<td>
					<input type="number" name="Timb_Rang" placeholder="obligatorio" size="7" min="20" max="999" onkeypress="if(this.value.length==3) return false;" value="{{old('Timb_Rang')}}" style="width:90px;" required>					
					@if($errors->has('Timb_Rang'))
					<span class="help-block">{{$errors->first('Timb_Rang')}}</span>
					@endif
				</td>
			</tr>		

			<tr>
				<td><label for="timb">Inicio de facturación:</label></td>
				<td>
					<input type="number" name="Timb_IniFact" placeholder="obligatorio" min="1000" max="9999999" size="7" onkeypress="if(this.value.length==7) return false;" value="{{old('Timb_IniFact')}}" style="width:100px;" required>					
					@if($errors->has('Timb_IniFact'))
					<span class="help-block">{{$errors->first('Timb_IniFact')}}</span>
					@endif
				</td>
			</tr>			

			<tr>
				<td><label for="timb">Fin de facturación:</label></td>
				<td>
					<input type="number" name="Timb_FinFact" placeholder="obligatorio" min="1020" max="9999999" size="7" onkeypress="if(this.value.length==7) return false;" value="{{old('Timb_FinFact')}}" style="width:100px;" required>					
					@if($errors->has('Timb_FinFact'))
					<span class="help-block">{{$errors->first('Timb_FinFact')}}</span>
					@endif
				</td>
			</tr>	

			<tr>
				<td><label for="estado">Estado:</label></td>				
				<td>
					<select class="seleccion" name="Timb_Est" id="est" minlength="7" maxlength="10" value="{{old('Timb_Est')}}" required>
						<option value="Activo">Activo</option>
						<option value="Finalizado">Finalizado</option>
					</select>					

					@if($errors->has('Timb_Est'))
						<span class="help-block">{{$errors->first('Timb_Est')}}</span>
					@endif
				</td>
			</tr>

			<tr>
				<td class="obs"><label for="observacion">Observación:</label></td>
				<td>
					<textarea rows="4" cols="50" name="Timb_Obs" id="obs" placeholder="opcional" maxlength="140">{{old('Timb_Obs')}}</textarea><br>
					@if($errors->has('Timb_Obs'))
					<span class="help-block obs_err">{{$errors->first('Timb_Obs')}}</span>
					@endif
				</td>
			</tr>
		</table>		
@endsection
        
@section('navegacion_2')
		<div class="arriba">
			<input class="boton" type="submit" id="registrar" value="Registrar">
			<input class="boton" type="reset" id="limpiar" value="Limpiar">
	{!! Form::close() !!}
			<a href="{{url('Timbrado')}}"><button class="boton lista" id="volver">Volver</button></a>
			<a href="/Tazper/public/Inicio"><button class="boton lista" id="cancelar">Cancelar</button></a>			
		</div>
@endsection