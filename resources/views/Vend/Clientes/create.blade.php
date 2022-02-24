@extends('Vend.lay.Create')

<style>
	#contenido{
		padding-top: 25px !important;
		padding-bottom: 20px !important;
	}
	#content{
        margin-bottom: 122px !important;
    }		
</style>

@section('titulo')
    Agregar Clientes
@endsection

@section('contenido')
	{!! Form::open(['url'=>'/Clientes', 'method'=>'post', 'autocomplete'=>'off', 'spellcheck'=>'false']) !!}
		{{csrf_field()}}
		<table id="principal">
			<tr>
				<td><label for="des_lar">Nombres:</label></td>
				<td>
					<input type="text" name="Cli_Nom" class="primer" placeholder="obligatorio" size="20" maxlength="20" value="{{old('Cli_Nom')}}" required autofocus>
					@if($errors->has('Cli_Nom'))
					<span class="help-block">{{$errors->first('Cli_Nom')}}</span>
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="des_lar">Apellidos:</label></td>
				<td>
					<input type="text" name="Cli_Ape" placeholder="obligatorio" size="20" maxlength="20" value="{{old('Cli_Ape')}}" required>
					@if($errors->has('Cli_Ape'))
					<span class="help-block">{{$errors->first('Cli_Ape')}}</span>
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="des_lar">RUC o CI:</label></td>
				<td>
					<input type="text" name="Cli_Ruc" placeholder="obligatorio" size="15" maxlength="15" value="{{old('Cli_Ruc')}}" required>
					@if($errors->has('Cli_Ruc'))
					<span class="help-block">{{$errors->first('Cli_Ruc')}}</span>
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="categoria">Categoría:</label></td>
				<td>
					<select class="seleccion" name="Id_Lp" minlength="1" maxlength="1" min="1" required>
						@foreach($listas as $lp)
							<option value="{{$lp->Id_Lp}}">{{$lp->Lp_Cat}}</option>
						@endforeach
					</select>

					@if($errors->has('Id_Lp'))
					<span class="help-block">{{$errors->first('Id_Lp')}}</span>
					@endif
				</td>
			</tr>

			{{--
			@php
				$min=\Carbon\Carbon::now()->subYears(18)->toDateString();
				$max=\Carbon\Carbon::now()->subYears(70)->toDateString();
			@endphp

			<tr>
				<td><label for="des_lar">Fecha de nacimiento:</label></td>
				<td><input type="date" name="Cli_FeNac" placeholder="obligatorio" id="coño" size="10" maxlength="10" max="{{$min}}" min="{{$max}}" required></td>
			</tr>

			<tr>
				<td><label for="genero">Género:</label></td>
				<td>
					<select class="seleccion" name="Cli_Gen">
						<option value="Femenino">Femenino</option>
						<option value="Masculino">Masculino</option>
					</select>
				</td>
			</tr>

			<tr>
				<td><label for="des_lar">Celular:</label></td>
				<td><input type="text" name="Cli_Cel" placeholder="obligatorio" size="15" maxlength="15" required></td>
			</tr>
			
			<tr>
				<td><label for="des_lar">Dirección:</label></td>
				<td><input type="text" name="Cli_Dir" placeholder="obligatorio" size="40" maxlength="40" required></td>
			</tr>
			
			<tr>
				<td><label for="des_lar">Ciudad:</label></td>
				<td><input type="text" name="Cli_Ciu" placeholder="obligatorio" size="30" maxlength="30" required></td>
			</tr>

			<tr>
				<td><label for="des_lar">Barrio:</label></td>
				<td><input type="text" name="Cli_Bar" placeholder="obligatorio" size="30" maxlength="30" required></td>
			</tr>
			--}}
			<tr>
				<td><label for="estado">Estado:</label></td>
				<td>
					<select class="seleccion" name="Cli_Est" minlength="6" maxlength="8" required>
						<option value="Activo">Activo</option>
						<option value="Inactivo">Inactivo</option>
					</select>

					@if($errors->has('Cli_Est'))
					<span class="help-block">{{$errors->first('Cli_Est')}}</span>
					@endif
				</td>
			</tr>

			<tr>
				<td class="obs"><label for="observacion">Observación:</label></td>
				<td>
					<textarea rows="4" cols="50" name="Cli_Obs" id="obs" placeholder="opcional" maxlength="140">{{old('Cli_Obs')}}</textarea><br>
					@if($errors->has('Cli_Obs'))
					<span class="help-block obs_err">{{$errors->first('Cli_Obs')}}</span> <!-- display block lo mismo, salto de linea -->					
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
			<a href="/Tazper/public/Clientes"><button class="boton lista">Volver</button></a>
			<a href="/Tazper/public/Inicio"><button class="boton lista" id="cancelar">Cancelar</button></a>
			<!-- <a href="#"><button class="boton" id="masivo">Agregado masivo</button></a> -->
		</div>
@endsection