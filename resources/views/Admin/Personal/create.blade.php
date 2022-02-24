@extends('Admin.lay.Create')

@section('titulo')
    Agregar Personal
@endsection

@section('contenido')
	{!! Form::open(['url'=>'/Personal', 'method'=>'post', 'autocomplete'=>'off', 'spellcheck'=>'false']) !!}
		{{csrf_field()}}
		<table id="principal">
			<tr>
				<td><label for="nombres">Nombres:</label></td>
				<td>
					<input type="text" name="Per_Nom" class="primer" placeholder="obligatorio" size="20" maxlength="20" value="{{old('Per_Nom')}}" required autofocus>
					@if($errors->has('Per_Nom'))<span class="help-block">{{$errors->first('Per_Nom')}}</span>@endif
				</td>
			</tr>

			<tr>
				<td><label for="apellidos">Apellidos:</label></td>
				<td>
					<input type="text" name="Per_Ape" placeholder="obligatorio" size="20" maxlength="20" value="{{old('Per_Ape')}}" required>
					@if($errors->has('Per_Ape'))<span class="help-block">{{$errors->first('Per_Ape')}}</span>@endif
				</td>
			</tr>
			
			<tr>
				<td><label for="ci">CI:</label></td>
				<td>
					<input type="text" name="Per_CI" placeholder="obligatorio" size="15" maxlength="15" value="{{old('Per_CI')}}" required>
					@if($errors->has('Per_CI'))<span class="help-block">{{$errors->first('Per_CI')}}</span>@endif
				</td>
			</tr>
			
			<tr>
				<td><label for="cargo">Cargo:</label></td>
				<td>
					<select class="seleccion" name="Per_Car" maxlength="20" value="{{old('Per_Car')}}" required>
						<option value="Vendedor">Vendedor</option>
						<option value="Administrador">Administrador</option>
					</select>
					@if($errors->has('Per_Car'))<span class="help-block">{{$errors->first('Per_Car')}}</span>@endif
				</td>
			</tr>

			@php
				$current=\Carbon\Carbon::now()->year;			
				$max_year=$current-18;
				$min_year=$current-70;

				$fecha=\Carbon\Carbon::now()->format('m-d');
				$max=$max_year.'-'.$fecha;
				$min=$min_year.'-'.$fecha;
			@endphp

			<tr>
				<td><label for="fe_nac">Fecha de nacimiento:</label></td>
				<td>
					<input type="date" name="Per_FeNac" min="{{$min}}" max="{{$max}}" minlength="10" maxlength="10" value="{{old('Per_FeNac')}}" required>
					@if($errors->has('Per_FeNac'))<span class="help-block">{{$errors->first('Per_FeNac')}}</span>@endif
				</td>
			</tr>

			<tr>
				<td><label for="lu_nac">Lugar de nacimiento:</label></td>
				<td>
					<input type="text" name="Per_LugNac" placeholder="obligatorio" size="30" maxlength="30" value="{{old('Per_LugNac')}}" required>
					@if($errors->has('Per_LugNac'))<span class="help-block">{{$errors->first('Per_LugNac')}}</span>@endif
				</td>				
			</tr>

			<tr>
				<td><label for="nacionalidad">Nacionalidad:</label></td>
				<td>
					<input type="text" name="Per_Nac" placeholder="obligatorio" size="20" maxlength="20" value="{{old('Per_Nac')}}" required>
					@if($errors->has('Per_Nac'))<span class="help-block">{{$errors->first('Per_Nac')}}</span>@endif
				</td>
			</tr>

			<tr>
				<td><label for="genero">Género:</label></td>
				<td>
					<select class="seleccion" name="Per_Gen" minlength="8" minlength="9" value="{{old('Per_Gen')}}" required>
						<option value="Femenino">Femenino</option>
						<option value="Masculino">Masculino</option>
					</select>
					@if($errors->has('Per_Gen'))<span class="help-block">{{$errors->first('Per_Gen')}}</span>@endif
				</td>
			</tr>

			<tr>
				<td><label for="est_civ">Estado civil:</label></td>
				<td>
					<input type="text" name="Per_EstCiv" placeholder="obligatorio" size="15" minlength="5" maxlength="15" value="{{old('Per_EstCiv')}}" required>
					@if($errors->has('Per_EstCiv'))<span class="help-block">{{$errors->first('Per_EstCiv')}}</span>@endif
				</td>
			</tr>

			<tr>
				<td><label for="hijos">Hijos:</label></td>
				<td>
					<input type="text" name="Per_Hij" placeholder="obligatorio" size="2" maxlength="2" value="{{old('Per_Hij')}}" required>
					@if($errors->has('Per_Hij'))<span class="help-block">{{$errors->first('Per_Hij')}}</span>@endif
				</td>
			</tr>

			<tr>
				<td><label for="telefono">Teléfono:</label></td>
				<td>
					<input type="text" name="Per_Tel" placeholder="opcional" size="15" minlength="8" maxlength="15" value="{{old('Per_Tel')}}">					
					@if($errors->has('Per_Tel'))<span class="help-block">{{$errors->first('Per_Tel')}}</span>@endif															
				</td>
			</tr>

			<tr>
				<td><label for="celular">Celular:</label></td>
				<td>
					<input type="text" name="Per_Cel" placeholder="obligatorio" size="15" minlength="10" maxlength="15" value="{{old('Per_Cel')}}" required>
					@if($errors->has('Per_Cel'))<span class="help-block">{{$errors->first('Per_Cel')}}</span>@endif
				</td>
			</tr>

			<tr>
				<td><label for="email">E-mail:</label></td>				
				@if($errors->has('Per_Email'))
					<td>
						<input type="email" name="Per_Email" placeholder="ejemplo@gmail.com" size="30" minlength="8" maxlength="30">
						<span class="help-block">{{$errors->first('Per_Email')}}</span>
					</td>					
				@else				
					<td><input type="email" name="Per_Email" placeholder="opcional" size="30" maxlength="30" value="{{old('Per_Email')}}"></td>
				@endif
			</tr>

			<tr>
				<td><label for="direccion">Dirección:</label></td>
				<td>
					<input type="text" name="Per_Dir" placeholder="obligatorio" size="45" maxlength="50" value="{{old('Per_Dir')}}" required>
					@if($errors->has('Per_Dir'))<span class="help-block">{{$errors->first('Per_Dir')}}</span>@endif
				</td>
			</tr>

			<tr>
				<td><label for="ciudad">Ciudad:</label></td>
				<td>
					<input type="text" name="Per_Ciu" placeholder="obligatorio" size="30" maxlength="30" value="{{old('Per_Ciu')}}" required>
					@if($errors->has('Per_Ciu'))<span class="help-block">{{$errors->first('Per_Ciu')}}</span>@endif
				</td>
			</tr>

			<tr>
				<td><label for="barrio">Barrio:</label></td>
				<td>
					<input type="text" name="Per_Bar" placeholder="obligatorio" size="30" maxlength="30" value="{{old('Per_Bar')}}" required>
					@if($errors->has('Per_Bar'))<span class="help-block">{{$errors->first('Per_Bar')}}</span>@endif
				</td>
			</tr>

			<tr>
				<td><label for="fe_ini">Inicio:</label></td>
				<td>
					<input type="date" name="Per_Ini" min="2016-01-01" max="{{date('Y-m-d')}}" minlength="10" maxlength="10" value="{{old('Per_Ini')}}" required>
					@if($errors->has('Per_Ini'))<span class="help-block">{{$errors->first('Per_Ini')}}</span>@endif
				</td>
			</tr>

			<tr>
				<td><label for="turno">Turno/Horario:</label></td>
				<td>
					<input type="text" name="Per_Tur" placeholder="obligatorio" size="55" minlength="5" maxlength="60" value="{{old('Per_Tur')}}" required>
					@if($errors->has('Per_Tur'))<span class="help-block">{{$errors->first('Per_Tur')}}</span>@endif
				</td>
			</tr>

			<tr>
				<td><label for="estado">Estado:</label></td>
				<td>
					<select class="seleccion" name="Per_Est" minlength="6" maxlength="8" value="{{old('Per_Est')}}" required>
						<option value="Activo">Activo</option>
						<option value="Inactivo">Inactivo</option>
					</select>
					@if($errors->has('Per_Est'))<span class="help-block">{{$errors->first('Per_Est')}}</span>@endif
				</td>
			</tr>
			
			<tr>
				<td class="obs"><label for="observacion">Observación:</label></td>
				<td>
					<textarea name="Per_Obs" id="obs" cols="50" rows="4" placeholder="opcional" maxlength="140">{{old('Per_Obs')}}</textarea>					
					@if($errors->has('Per_Obs'))<br><span class="help-block" id="obs">{{$errors->first('Per_Obs')}}</span>@endif					
				</td>
			</tr>
		</table>
@endsection
        
@section('navegacion_2')
		<div class="arriba">
			<input class="boton" type="submit" id="registrar" value="Registrar">
			<input class="boton" type="reset" id="limpiar" value="Limpiar">
	{!! Form::close() !!}
			<a href="{{url('/Personal')}}"><button class="boton lista">Volver</button></a>
			<a href="{{url('/Inicio')}}"><button class="boton lista" id="cancelar">Cancelar</button></a>
		</div>
@endsection