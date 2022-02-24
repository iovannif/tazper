@extends('Admin.lay.Edit')

@section('titulo')
    Editar Datos personales
@endsection

@section('navegacion_1')
	<div id="este">
		<a href="{{url('/Datos_personales')}}"><button class="boton lista" id="volver">Volver</button></a> 
	</div>
@endsection

@section('contenido')
	{!! Form::model($personal, ['method'=>'PATCH', 'action'=>['PersonalController@dp_update', $personal->Id_Per], 'autocomplete'=>'off', 'spellcheck'=>'false']) !!}
		<table id="principal">
			<tr>
				<td><label for="id_per">Id de personal:</label></td>
				<td><input type="text" size="4" value="{{$personal->Id_Per}}" disabled></td>
			</tr>

			<tr>
				<td><label for="nombres">Nombres:</label></td>				
				<td>
					@if($errors->any())						
						<input type="text" name="Per_Nom" size="20" maxlength="20" value="{{old('Per_Nom')}}" required autofocus>						
						@if($errors->has('Per_Nom'))
						<span class="help-block">{{$errors->first('Per_Nom')}}</span>						
						@endif													
					@else			
						<input type="text" name="Per_Nom" size="20" maxlength="20" value="{{$personal->Per_Nom}}" required autofocus>					
					@endif												
				</td>
			</tr>			

			<tr>
				<td><label for="apellidos">Apellidos:</label></td>
				<td>
					@if($errors->any())		
						<input type="text" name="Per_Ape" size="20" maxlength="20" value="{{old('Per_Ape')}}" required>
						@if($errors->has('Per_Ape'))
						<span class="help-block">{{$errors->first('Per_Ape')}}</span>
						@endif
					@else
						<input type="text" name="Per_Ape" size="20" maxlength="20" value="{{$personal->Per_Ape}}" required>
					@endif
				</td>
			</tr>
			
			<tr>
				<td><label for="ci">CI:</label></td>
				<td>										
					@if($errors->any())		
						<input type="text" name="Per_CI" size="15" maxlength="15" value="{{old('Per_CI')}}" required>
						@if($errors->has('Per_CI'))
						<span class="help-block">{{$errors->first('Per_CI')}}</span>
						@endif
					@else
						<input type="text" name="Per_CI" size="15" maxlength="15" value="{{$personal->Per_CI}}" required>
					@endif
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
					@if($errors->any())		
						<input type="date" name="Per_FeNac" min="{{$min}}" max="{{$max}}" minlength="10" maxlength="10" value="{{old('Per_FeNac')}}" required>
						@if($errors->has('Per_FeNac'))
						<span class="help-block">{{$errors->first('Per_FeNac')}}</span>
						@endif
					@else
						<input type="date" name="Per_FeNac" min="{{$min}}" max="{{$max}}" minlength="10" maxlength="10" value="{{$personal->Per_FeNac}}" required>
					@endif
				</td>				
			</tr>

			<tr>
				<td><label for="lu_nac">Lugar de nacimiento:</label></td>				
				<td>										
					@if($errors->any())		
						<input type="text" name="Per_LugNac" size="30" maxlength="30" value="{{old('Per_LugNac')}}" required>
						@if($errors->has('Per_LugNac'))
						<span class="help-block">{{$errors->first('Per_LugNac')}}</span>
						@endif
					@else
						<input type="text" name="Per_LugNac" size="30" maxlength="30" value="{{$personal->Per_LugNac}}" required>
					@endif
				</td>				
			</tr>

			<tr>
				<td><label for="nacionalidad">Nacionalidad:</label></td>				
				<td>										
					@if($errors->any())		
						<input type="text" name="Per_Nac" size="20" maxlength="20" value="{{old('Per_Nac')}}" required>
						@if($errors->has('Per_Nac'))
						<span class="help-block">{{$errors->first('Per_Nac')}}</span>
						@endif
					@else
						<input type="text" name="Per_Nac" size="20" maxlength="20" value="{{$personal->Per_Nac}}" required>
					@endif
				</td>				
			</tr>
			
			<tr>
				<td><label for="genero">Género:</label></td>
				<td>
					@php
						$gen_1='Femenino';
						$gen_2='Masculino';
					@endphp
					<select class="seleccion" name="Per_Gen">
						@if($personal->Per_Gen == $gen_1)
							<option value="{{$gen_1}}">{{$gen_1}}</option>
							<option value="{{$gen_2}}">{{$gen_2}}</option>
						@elseif($personal->Per_Gen == $gen_2)
							<option value="{{$gen_2}}">{{$gen_2}}</option>
							<option value="{{$gen_1}}">{{$gen_1}}</option>
						@endif
					</select>
					@if($errors->has('Per_Gen'))<span class="help-block">{{$errors->first('Per_Gen')}}</span>@endif
				</td>
			</tr>
			
			<tr>
				<td><label for="est_civ">Estado civil:</label></td>
				<td>										
					@if($errors->any())		
						<input type="text" name="Per_EstCiv" size="15" maxlength="15" value="{{old('Per_EstCiv')}}" required>
						@if($errors->has('Per_EstCiv'))
						<span class="help-block">{{$errors->first('Per_EstCiv')}}</span>
						@endif
					@else
						<input type="text" name="Per_EstCiv" size="15" maxlength="15" value="{{$personal->Per_EstCiv}}" required>
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="hijos">Hijos:</label></td>
				<td>										
					@if($errors->any())		
						<input type="text" name="Per_Hij" size="2" maxlength="2" value="{{old('Per_Hij')}}" required>
						@if($errors->has('Per_Hij'))
						<span class="help-block">{{$errors->first('Per_Hij')}}</span>
						@endif
					@else
						<input type="text" name="Per_Hij" size="2" maxlength="2" value="{{$personal->Per_Hij}}" required>
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="telefono">Teléfono:</label></td>
				<td>										
					@if($errors->any())		
						<input type="text" name="Per_Tel" size="15" minlength="8" maxlength="15" value="{{old('Per_Tel')}}">
						@if($errors->has('Per_Tel'))
						<span class="help-block">{{$errors->first('Per_Tel')}}</span>
						@endif
					@else
						<input type="text" name="Per_Tel" size="15" minlength="8" maxlength="15" value="{{$personal->Per_Tel}}">
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="celular">Celular:</label></td>
				<td>										
					@if($errors->any())		
						<input type="text" name="Per_Cel" size="15" minlength="10" maxlength="15" value="{{$personal->Per_Cel}}" required>
						@if($errors->has('Per_Cel'))
						<span class="help-block">{{$errors->first('Per_Cel')}}</span>
						@endif
					@else
						<input type="text" name="Per_Cel" size="15" minlength="10" maxlength="15" value="{{$personal->Per_Cel}}" required>	
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="email">E-mail:</label></td>
				@if($errors->any())
					<td>
					@if($errors->has('Per_Email'))						
						<input type="email" name="Per_Email" placeholder="ejemplo@gmail.com" size="30" minlength="8" maxlength="30">
						<span class="help-block">{{$errors->first('Per_Email')}}</span>						
					@else
						<input type="email" name="Per_Email" size="30" minlength="8" maxlength="30" value="{{old('Per_Email')}}">
					@endif
					</td>
				@else				
					<td><input type="email" name="Per_Email" size="30" minlength="8" maxlength="30" value="{{$personal->Per_Email}}"></td>
				@endif
			</tr>

			<tr>
				<td><label for="direccion">Dirección:</label></td>
				<td>										
					@if($errors->any())		
						<input type="text" name="Per_Dir" size="45" maxlength="50" value="{{old('Per_Dir')}}" required>
						@if($errors->has('Per_Dir'))
						<span class="help-block">{{$errors->first('Per_Dir')}}</span>
						@endif
					@else
						<input type="text" name="Per_Dir" size="45" maxlength="50" value="{{$personal->Per_Dir}}" required>	
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="ciudad">Ciudad:</label></td>
				<td>										
					@if($errors->any())		
						<input type="text" name="Per_Ciu" size="30" maxlength="30" value="{{old('Per_Ciu')}}" required>
						@if($errors->has('Per_Ciu'))
						<span class="help-block">{{$errors->first('Per_Ciu')}}</span>
						@endif
					@else
						<input type="text" name="Per_Ciu" size="30" maxlength="30" value="{{$personal->Per_Ciu}}" required>
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="barrio">Barrio:</label></td>
				<td>										
					@if($errors->any())		
						<input type="text" name="Per_Bar" size="30" maxlength="30" value="{{old('Per_Bar')}}" required>
						@if($errors->has('Per_Bar'))
						<span class="help-block">{{$errors->first('Per_Bar')}}</span>
						@endif
					@else
						<input type="text" name="Per_Bar" size="30" maxlength="30" value="{{$personal->Per_Bar}}" required>
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