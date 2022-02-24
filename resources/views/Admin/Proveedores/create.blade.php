@extends('Admin.lay.Create')

<style>	
	.email,.web{
		display:none;
		cursor:default;
		text-shadow:none;
		color:grey;
	}

	.masiva{
		position:absolute;
		bottom:-162px;
		left: 345px;
		cursor:default;
	}
</style>

@section('titulo')
    Agregar Proveedores
@endsection

@section('contenido')
	@include('Admin.Proveedores.session_div.create')	
	
	{!! Form::open(['url'=>'/Proveedores', 'method'=>'post', 'autocomplete'=>'off', 'spellcheck'=>'false']) !!}
		{{csrf_field()}}
		<table id="principal">
			<tr class="masiva">
				<td>
					<label for="masiva">Inserción masiva</label>
					<input type="checkbox" id="masiva">
					<input type="hidden" name="masiva">
				</td>
			</tr>
	
			<tr>
				<td><label for="descripcion">Descripción:</label></td>
				<td>
					<input type="text" name="Prov_Des" class="primer" id="des" placeholder="obligatorio" size="30" maxlength="24" value="{{old('Prov_Des')}}" required autofocus>
					@if($errors->has('Prov_Des'))<span class="help-block">{{$errors->first('Prov_Des')}}</span>@endif
					<span class="help-block ajax_error" style="display:none"></span>
				</td>
			</tr>

			<tr>
				<td><label for="raz_soc">Razón social:</label></td>
				<td>
					<input type="text" name="Prov_RazSoc" id="raz_soc" placeholder="obligatorio" size="40" maxlength="40" value="{{old('Prov_RazSoc')}}" required>
					@if($errors->has('Prov_RazSoc'))<span class="help-block">{{$errors->first('Prov_RazSoc')}}</span>@endif
				</td>
			</tr>

			<tr>
				<td><label for="ruc">RUC:</label></td>
				<td>
					<input type="text" name="Prov_Ruc" id="ruc" placeholder="obligatorio" size="20" maxlength="20" value="{{old('Prov_Ruc')}}" required>
					@if($errors->has('Prov_Ruc'))<span class="help-block">{{$errors->first('Prov_Ruc')}}</span>@endif
				</td>
			</tr>
			
			<tr>
				<td><label for="telefono">Teléfono:</label></td>
				<td>
					<input type="text" name="Prov_Tel" id="tel" placeholder="obligatorio" size="15" minlength="8" maxlength="15" value="{{old('Prov_Tel')}}" required>
					@if($errors->has('Prov_Tel'))<span class="help-block">{{$errors->first('Prov_Tel')}}</span>@endif
				</td>
			</tr>
			
			<tr>
				<td><label for="celular">Celular:</label></td>
				<td>
					<input type="text" name="Prov_Cel" id="cel" placeholder="opcional" size="15" maxlength="15" value="{{old('Prov_Cel')}}">
					@if($errors->has('Prov_Cel'))<span class="help-block">{{$errors->first('Prov_Cel')}}</span>@endif
				</td>
			</tr>

			<tr>
				<td><label for="email">E-mail:</label></td>
				<td>										
					<input type="email" name="Prov_Email" id="email" placeholder="opcional" size="30" maxlength="30" value="{{old('Prov_Email')}}">
					@if($errors->has('Prov_Email'))<span class="help-block">{{$errors->first('Prov_Email')}}</span>@endif
					<span class="email">ejemplo@gmail.com</span>					
				</td>
			</tr>

			<tr>
				<td><label for="web">Sitio web:</label></td>
				<td>					
					<input type="url" name="Prov_Web" id="web" placeholder="opcional" size="40" maxlength="45" value="{{old('Prov_Web')}}">
					@if($errors->has('Prov_Web'))<span class="help-block">{{$errors->first('Prov_Web')}}</span>@endif																						
					<span class="web">https://www.ejemplo.com</span>
				</td>
			</tr>

			<tr>
				<td><label for="direccion">Dirección:</label></td>
				<td>										
					<input type="text" name="Prov_Dir" id="dir" placeholder="obligatorio" size="45" maxlength="50" value="{{old('Prov_Dir')}}" required>																	
					@if($errors->has('Prov_Dir'))<span class="help-block">{{$errors->first('Prov_Dir')}}</span>@endif										
				</td>
			</tr>

			<tr>
				<td><label for="ciudad">Ciudad:</label></td>
				<td>
					<input type="text" name="Prov_Ciu" id="ciu" placeholder="opcional" size="30" maxlength="30" value="{{old('Prov_Ciu')}}">
					@if($errors->has('Prov_Ciu'))<span class="help-block">{{$errors->first('Prov_Ciu')}}</span>@endif
				</td>
			</tr>

			<tr>
				<td><label for="barrio">Barrio:</label></td>
				<td>
					<input type="text" name="Prov_Bar" id="bar" placeholder="opcional" size="30" maxlength="30" value="{{old('Prov_Bar')}}">
					@if($errors->has('Prov_Bar'))<span class="help-block">{{$errors->first('Prov_Bar')}}</span>@endif
				</td>
			</tr>

			<tr>
				<td><label for="horario">Horario:</label></td>
				<td>
					<input type="text" name="Prov_Ho" id="ho" placeholder="obligatorio" size="55" minlength="5" maxlength="60" value="{{old('Prov_Ho')}}" required>
					@if($errors->has('Prov_Ho'))<span class="help-block">{{$errors->first('Prov_Ho')}}</span>@endif
				</td>
			</tr>

			<tr>
				<td><label for="estado">Estado:</label></td>
				<td>
					<select class="seleccion" name="Prov_Est" id="est" minlength="6" maxlength="8" value="{{old('Prov_Est')}}">
						<option value="Activo">Activo</option>
						<option value="Inactivo">Inactivo</option>
					</select>
					@if($errors->has('Prov_Est'))<span class="help-block">{{$errors->first('Prov_Est')}}</span>@endif
				</td>
			</tr>
			
			<tr>
				<td class="obs"><label for="observacion">Observación:</label></td>
				<td>
					<textarea cols="50" rows="4" name="Prov_Obs" id="obs" placeholder="opcional" maxlength="140">{{old('Prov_Obs')}}</textarea><br>
					@if($errors->has('Prov_Obs'))<span class="help-block obs_err">{{$errors->first('Prov_Obs')}}</span>@endif
				</td>
			</tr>			
		</table>
@endsection
        
@section('navegacion_2')
		<div class="arriba">
			<input class="boton" type="submit" id="registrar" value="Registrar">
			<input class="boton" type="reset" id="limpiar" value="Limpiar">
	{!! Form::close() !!}
			<a href="{{url('Proveedores')}}"><button class="boton lista" id="volver">Volver</button></a>
			<a href="{{url('Inicio')}}"><button class="boton lista" id="cancelar">Cancelar</button></a>
		</div>
@endsection

<script src="{{asset('js/vistas/masiva/proveedor.js')}}"></script>