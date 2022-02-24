@extends('Admin.lay.Edit')

@section('titulo')
    Editar Sucursal
@endsection

@section('navegacion_1')
	<div id="este">
		<a href="{{url('Sucursal/'.$sucursal->Id_Suc)}}" class="volver"><button class="boton lista" id="volver">Volver</button></a>
		<a href="{{url('Sucursal')}}" class="listado"><button class="boton lista" id="volver">Lista</button></a>
	</div>
@endsection

@section('contenido')
	{!! Form::model($sucursal, ['method'=>'PATCH', 'action'=>['SucursalController@update', $sucursal->Id_Suc], 'spellcheck'=>'false', 'autocomplete'=>'off']) !!}
		<table id="principal">
			<tr>
				<td><label for="id_suc">Id de sucursal:</label></td>
				<td><input type="text" size="4" value="{{$sucursal->Id_Suc}}" disabled></td>
			</tr>

			<tr>
				<td><label for="codigo">Código de sucursal:</label></td>
				<td><input type="text" size="7" value="Suc-{{$sucursal->Suc_Cod}}" disabled></td>
			</tr>

			<tr>
				<td><label for="nombre_fantasia">Nombre fantasía:</label></td>
				<td>
					@if($errors->any())   
						<input type="text" name="Suc_NomFan" class="primero" placeholder="obligatorio" size="30" maxlength="30" value="{{old('Suc_NomFan')}}" required autofocus>
						@if($errors->has('Suc_NomFan'))
						<span class="help-block">{{$errors->first('Suc_NomFan')}}</span>
						@endif
					@else
						<input type="text" name="Suc_NomFan" class="primero" placeholder="obligatorio" size="30" maxlength="30" value="{{$sucursal->Suc_NomFan}}" required autofocus>
					@endif
				</td>				
			</tr>  

			<tr>
				<td><label for="descripcion">Descripción:</label></td>
				<td>
					@if($errors->any())   
						<input type="text" name="Suc_Des" placeholder="obligatorio" size="30" maxlength="30" value="{{old('Suc_Des')}}" required>
						@if($errors->has('Suc_Des'))
							<span class="help-block">{{$errors->first('Suc_Des')}}</span>
						@endif
					@else
						<input type="text" name="Suc_Des" placeholder="obligatorio" size="30" maxlength="30" value="{{$sucursal->Suc_Des}}" required>
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="telefono">Teléfono:</label></td>
				<td>
					@if($errors->any())   
						<input type="text" name="Suc_Tel" placeholder="obligatorio" size="15" minlength="8" maxlength="15" value="{{old('Suc_Tel')}}" required>
						@if($errors->has('Suc_Tel'))
							<span class="help-block">{{$errors->first('Suc_Tel')}}</span>
						@endif
					@else
						<input type="text" name="Suc_Tel" placeholder="obligatorio" size="15" minlength="8" maxlength="15" value="{{$sucursal->Suc_Tel}}" required>
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="direccion">Dirección:</label></td>
				<td>
					@if($errors->any())   
						<input type="text" name="Suc_Dir" placeholder="obligatorio" size="50" maxlength="50" value="{{old('Suc_Dir')}}" required>
						@if($errors->has('Suc_Dir'))
							<span class="help-block">{{$errors->first('Suc_Dir')}}</span>
						@endif
					@else	
						<input type="text" name="Suc_Dir" placeholder="obligatorio" size="50" maxlength="50" value="{{$sucursal->Suc_Dir}}" required>
					@endif
				</td>
			</tr>
			
			<tr>
				<td><label for="ciudad">Ciudad:</label></td>
				<td>
					@if($errors->any())  
						<input type="text" name="Suc_Ciu" placeholder="obligatorio" size="30" maxlength="30" value="{{old('Suc_Ciu')}}" required>
						@if($errors->has('Suc_Ciu'))
							<span class="help-block">{{$errors->first('Suc_Ciu')}}</span>
						@endif
					@else
						<input type="text" name="Suc_Ciu" placeholder="obligatorio" size="30" maxlength="30" value="{{$sucursal->Suc_Ciu}}" required>
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="barrio">Barrio:</label></td>
				<td>
					@if($errors->any())  
						<input type="text" name="Suc_Bar" placeholder="obligatorio" size="30" maxlength="30" value="{{old('Suc_Bar')}}" required>
						@if($errors->has('Suc_Bar'))
							<span class="help-block">{{$errors->first('Suc_Bar')}}</span>
						@endif
					@else	
						<input type="text" name="Suc_Bar" placeholder="obligatorio" size="30" maxlength="30" value="{{$sucursal->Suc_Bar}}" required>
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="red_1">Red 1:</label></td>
				<td>
					@if($errors->any())  
						<input type="text" name="Suc_Red2" placeholder="opcional" size="30" maxlength="30" value="{{old('Suc_Red1')}}">
						@if($errors->has('Suc_Red1'))
							<span class="help-block">{{$errors->first('Suc_Red1')}}</span>
						@endif
					@else	
						<input type="text" name="Suc_Red1" placeholder="opcional" size="30" maxlength="30" value="{{$sucursal->Suc_Red1}}">
					@endif
				</td>
			</tr>
			
			<tr>
				<td><label for="red_2">Red 2:</label></td>
				<td>
					@if($errors->any())  
						<input type="text" name="Suc_Red2" placeholder="opcional" size="30" maxlength="30" value="{{old('Suc_Red2')}}">
						@if($errors->has('Suc_Red2'))
							<span class="help-block">{{$errors->first('Suc_Red2')}}</span>
						@endif
					@else	
						<input type="text" name="Suc_Red2" placeholder="opcional" size="30" maxlength="30" value="{{$sucursal->Suc_Red2}}">
					@endif
				</td>
			</tr>        

			<tr>
				<td><label for="ruc">RUC:</label></td>
				<td>
					@if($errors->any())  						
						<input type="text" name="Suc_Ruc" placeholder="obligatorio" size="20" maxlength="20" value="{{old('Suc_Ruc')}}" required>
						@if($errors->has('Suc_Ruc'))
							<span class="help-block">{{$errors->first('Suc_Ruc')}}</span>
						@endif
					@else	
						<input type="text" name="Suc_Ruc" placeholder="obligatorio" size="20" maxlength="20" value="{{$sucursal->Suc_Ruc}}" required>
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="raz_soc">Razón social:</label></td>
				<td>
					@if($errors->any())  
						<input type="text" name="Suc_RazSoc" placeholder="obligatorio" size="40" maxlength="40" value="{{old('Suc_RazSoc')}}" required>
						@if($errors->has('Suc_RazSoc'))
							<span class="help-block">{{$errors->first('Suc_RazSoc')}}</span>
						@endif
					@else	
						<input type="text" name="Suc_RazSoc" placeholder="obligatorio" size="40" maxlength="40" value="{{$sucursal->Suc_RazSoc}}" required>
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
					<select class="seleccion" name="Suc_Est" minlength="6" maxlength="8" value="{{old('Suc_Est')}}" required>
						@if($sucursal->Suc_Est == $est_1)
							<option value="{{$est_1}}">{{$est_1}}</option>
							<option value="{{$est_2}}">{{$est_2}}</option>
						@elseif($sucursal->Suc_Est == $est_2)
							<option value="{{$est_2}}">{{$est_2}}</option>
							<option value="{{$est_1}}">{{$est_1}}</option>
						@endif
					</select>
					@if($errors->has('Suc_Est'))
						<span class="help-block">{{$errors->first('Suc_Est')}}</span>
					@endif
				</td>
			</tr>				

			<tr>
                <td class="obs"><label for="observacion">Observación:</label></td>
                <td>
                    @if($errors->any())                                    
                        <textarea name="Suc_Obs" id="obs" cols="50" rows="4" placeholder="opcional" maxlength="140">{{old('Suc_Obs')}}</textarea>
                        @if($errors->has('Suc_Obs'))
                        <br><span class="help-block">{{$errors->first('Suc_Obs')}}</span>
                        @endif
                    @else
                        <textarea name="Suc_Obs" id="obs" cols="50" rows="4" placeholder="opcional" maxlength="140">{{$sucursal->Suc_Obs}}</textarea>
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
@endsection