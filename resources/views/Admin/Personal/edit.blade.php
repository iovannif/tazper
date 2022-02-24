@extends('Admin.lay.Edit')

@section('titulo')
    Editar Personal
@endsection

@section('navegacion_1')
	<div id="este">								
		<button class="boton eliminar primer" id="borrar" onclick="						
			<?php if($personal->Id_Usu){ ?>;
				$('#rechazo').show().delay(1500).fadeOut(0);
			<?php }else{ ?>;
				$('#confirm').css('display','block');
			<?php } ?>;
		">Eliminar</button>		
		<a href="{{url('/Personal/'.$personal->Id_Per)}}" class="volver"><button class="boton lista" id="volver">Volver</button></a>
		<a href="{{url('/Personal')}}" class="listado"><button class="boton lista" id="volver">Lista</button></a>
	</div>
@endsection

@section('contenido')
	@include('Admin.Personal.session_div.edit')

	{!! Form::model($personal, ['method'=>'PATCH', 'action'=>['PersonalController@update', $personal->Id_Per], 'autocomplete'=>'off', 'spellcheck'=>'false']) !!}
		<table id="principal">
			<tr>
				<td><label for="id_per">Id de personal:</label></td>
				<td><input type="text" size="4" value="{{$personal->Id_Per}}" disabled></td>
			</tr>

			<tr>
				<td><label for="nombres">Nombres:</label></td>				
				<td>
					@if($errors->any())						
						<input type="text" name="Per_Nom" class="primero" placeholder="obligatorio" size="20" maxlength="20" value="{{old('Per_Nom')}}" required autofocus>						
						@if($errors->has('Per_Nom'))
						<span class="help-block">{{$errors->first('Per_Nom')}}</span>						
						@endif													
					@else			
						<input type="text" name="Per_Nom" class="primero" placeholder="obligatorio" size="20" maxlength="20" value="{{$personal->Per_Nom}}" required autofocus>					
					@endif												
				</td>
			</tr>			

			<tr>
				<td><label for="apellidos">Apellidos:</label></td>
				<td>
					@if($errors->any())		
						<input type="text" name="Per_Ape" placeholder="obligatorio" size="20" maxlength="20" value="{{old('Per_Ape')}}" required>
						@if($errors->has('Per_Ape'))
						<span class="help-block">{{$errors->first('Per_Ape')}}</span>
						@endif
					@else
						<input type="text" name="Per_Ape" placeholder="obligatorio" size="20" maxlength="20" value="{{$personal->Per_Ape}}" required>
					@endif
				</td>
			</tr>
			
			<tr>
				<td><label for="ci">CI:</label></td>
				<td>										
					@if($errors->any())		
						<input type="text" name="Per_CI" placeholder="obligatorio" size="15" maxlength="15" value="{{old('Per_CI')}}" required>
						@if($errors->has('Per_CI'))
						<span class="help-block">{{$errors->first('Per_CI')}}</span>
						@endif
					@else
						<input type="text" name="Per_CI" placeholder="obligatorio" size="15" maxlength="15" value="{{$personal->Per_CI}}" required>
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="cago">Cargo:</label></td>
				<td>						
					@php
						$car_1 = 'Vendedor';
						$car_2 = 'Administrador';
					@endphp

					<select class="seleccion" name="Per_Car" maxlength="20" value="{{old('Per_Car')}}" required>
						@if($personal->Per_Car == $car_1)
							<option value="{{$car_1}}">{{$car_1}}</option>
							<option value="{{$car_2}}">{{$car_2}}</option>
						@elseif($personal->Per_Car == $car_2)
							<option value="{{$car_2}}">{{$car_2}}</option>
							<option value="{{$car_1}}">{{$car_1}}</option>
						@endif
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
						<input type="text" name="Per_LugNac" placeholder="obligatorio" size="30" maxlength="30" value="{{old('Per_LugNac')}}" required>
						@if($errors->has('Per_LugNac'))
						<span class="help-block">{{$errors->first('Per_LugNac')}}</span>
						@endif
					@else
						<input type="text" name="Per_LugNac" placeholder="obligatorio" size="30" maxlength="30" value="{{$personal->Per_LugNac}}" required>
					@endif
				</td>				
			</tr>

			<tr>
				<td><label for="nacionalidad">Nacionalidad:</label></td>				
				<td>										
					@if($errors->any())		
						<input type="text" name="Per_Nac" placeholder="obligatorio" size="20" maxlength="20" value="{{old('Per_Nac')}}" required>
						@if($errors->has('Per_Nac'))
						<span class="help-block">{{$errors->first('Per_Nac')}}</span>
						@endif
					@else
						<input type="text" name="Per_Nac" placeholder="obligatorio" size="20" maxlength="20" value="{{$personal->Per_Nac}}" required>
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
					<select class="seleccion" name="Per_Gen" minlength="8" minlength="9" value="{{old('Per_Gen')}}" required>
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
						<input type="text" name="Per_EstCiv" placeholder="obligatorio" size="15" maxlength="15" value="{{old('Per_EstCiv')}}" required>
						@if($errors->has('Per_EstCiv'))
						<span class="help-block">{{$errors->first('Per_EstCiv')}}</span>
						@endif
					@else
						<input type="text" name="Per_EstCiv" placeholder="obligatorio" size="15" maxlength="15" value="{{$personal->Per_EstCiv}}" required>
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="hijos">Hijos:</label></td>
				<td>										
					@if($errors->any())		
						<input type="text" name="Per_Hij" placeholder="obligatorio" size="2" maxlength="2" value="{{old('Per_Hij')}}" required>
						@if($errors->has('Per_Hij'))
						<span class="help-block">{{$errors->first('Per_Hij')}}</span>
						@endif
					@else
						<input type="text" name="Per_Hij" placeholder="obligatorio" size="2" maxlength="2" value="{{$personal->Per_Hij}}" required>
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="telefono">Teléfono:</label></td>
				<td>										
					@if($errors->any())		
						<input type="text" name="Per_Tel" placeholder="opcional" size="15" minlength="8" maxlength="15" value="{{old('Per_Tel')}}">
						@if($errors->has('Per_Tel'))
						<span class="help-block">{{$errors->first('Per_Tel')}}</span>
						@endif
					@else
						<input type="text" name="Per_Tel" placeholder="opcional" size="15" minlength="8" maxlength="15" value="{{$personal->Per_Tel}}">
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="celular">Celular:</label></td>
				<td>										
					@if($errors->any())		
						<input type="text" name="Per_Cel" placeholder="obligatorio" size="15" minlength="10" maxlength="15" value="{{$personal->Per_Cel}}" required>
						@if($errors->has('Per_Cel'))
						<span class="help-block">{{$errors->first('Per_Cel')}}</span>
						@endif
					@else
						<input type="text" name="Per_Cel" placeholder="obligatorio" size="15" minlength="10" maxlength="15" value="{{$personal->Per_Cel}}" required>	
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
						<input type="email" name="Per_Email" placeholder="opcional" size="30" minlength="8" maxlength="30" value="{{old('Per_Email')}}">
					@endif
					</td>
				@else				
					<td><input type="email" name="Per_Email" placeholder="opcional" size="30" minlength="8" maxlength="30" value="{{$personal->Per_Email}}"></td>
				@endif
			</tr>

			<tr>
				<td><label for="direccion">Dirección:</label></td>
				<td>										
					@if($errors->any())		
						<input type="text" name="Per_Dir" placeholder="obligatorio" size="45" maxlength="50" value="{{old('Per_Dir')}}" required>
						@if($errors->has('Per_Dir'))
						<span class="help-block">{{$errors->first('Per_Dir')}}</span>
						@endif
					@else
						<input type="text" name="Per_Dir" placeholder="obligatorio" size="45" maxlength="50" value="{{$personal->Per_Dir}}" required>	
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="ciudad">Ciudad:</label></td>
				<td>										
					@if($errors->any())		
						<input type="text" name="Per_Ciu" placeholder="obligatorio" size="30" maxlength="30" value="{{old('Per_Ciu')}}" required>
						@if($errors->has('Per_Ciu'))
						<span class="help-block">{{$errors->first('Per_Ciu')}}</span>
						@endif
					@else
						<input type="text" name="Per_Ciu" placeholder="obligatorio" size="30" maxlength="30" value="{{$personal->Per_Ciu}}" required>
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="barrio">Barrio:</label></td>
				<td>										
					@if($errors->any())		
						<input type="text" name="Per_Bar" placeholder="obligatorio" size="30" maxlength="30" value="{{old('Per_Bar')}}" required>
						@if($errors->has('Per_Bar'))
						<span class="help-block">{{$errors->first('Per_Bar')}}</span>
						@endif
					@else
						<input type="text" name="Per_Bar" placeholder="obligatorio" size="30" maxlength="30" value="{{$personal->Per_Bar}}" required>
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="fe_ini">Inicio:</label></td>
				<td>										
					@if($errors->any())		
						<input type="date" name="Per_Ini" min="2016-01-01" max="{{date('Y-m-d')}}" minlength="10" maxlength="10" value="{{old('Per_Ini')}}" required>
						@if($errors->has('Per_Ini'))
						<span class="help-block">{{$errors->first('Per_Ini')}}</span>
						@endif
					@else
						<input type="date" name="Per_Ini" min="2016-01-01" max="{{date('Y-m-d')}}" minlength="10" maxlength="10" value="{{$personal->Per_Ini}}" required>
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="fe_ini">Turno/Horario:</label></td>
				<td>										
					@if($errors->any())		
						<input type="text" name="Per_Tur" size="55" minlength="5" maxlength="60" value="{{old('Per_Tur')}}" required>
						@if($errors->has('Per_Tur'))
						<span class="help-block">{{$errors->first('Per_Tur')}}</span>
						@endif
					@else
						<input type="text" name="Per_Tur" size="55" minlength="5" maxlength="60" value="{{$personal->Per_Tur}}" required>
					@endif
				</td>
			</tr>

			<tr>
				<td><label for="estado">Estado:</label></td>
				<td>
					@php
						$est_1='Activo';
						$est_2='Inactivo';
					@endphp
					<select class="seleccion" name="Per_Est" minlength="6" maxlength="8" value="{{old('Per_Est')}}" required>
						@if($personal->Per_Est == $est_1)
							<option value="{{$est_1}}">{{$est_1}}</option>
							<option value="{{$est_2}}">{{$est_2}}</option>
						@elseif($personal->Per_Est == $est_2)
							<option value="{{$est_2}}">{{$est_2}}</option>
							<option value="{{$est_1}}">{{$est_1}}</option>
						@endif
					</select>
					@if($errors->has('Per_Est'))<span class="help-block">{{$errors->first('Per_Est')}}</span>@endif
				</td>
			</tr>
			
			<tr>
				<td class="obs"><label for="observacion">Observación:</label></td>
				<td>										
					@if($errors->any())		
						<textarea name="Per_Obs" id="obs" cols="50" rows="4" placeholder="opcional" maxlength="140">{{old('Per_Obs')}}</textarea>	
						@if($errors->has('Per_Obs'))
						<br><span class="help-block" id="obs">{{$errors->first('Per_Obs')}}</span>
						@endif
					@else
						<textarea name="Per_Obs" id="obs" cols="50" rows="4" placeholder="opcional" maxlength="140">{{$personal->Per_Obs}}</textarea>
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
			<a href="{{url('/Inicio')}}"><button class="boton lista" id="cancelar">Cancelar</button></a>
		</div>
	
	<div id="confirm">
        <table>
            <tr><td class="center" colspan="2">Está a punto de eliminar el usuario, no lo podrá recuperar</td></tr>
            <tr><td class="center" colspan="2">Desea continuar?</td></tr>
            <tr>
                <td class="right">                
				{!! Form::open(['method'=>'DELETE', 'action'=>['PersonalController@destroy', $personal->Id_Per]]) !!}
					{{csrf_field()}}
					<input class="botones confirmar" type="submit" id="confirmar" value="Confirmar">
				{!! Form::close() !!}		
                </td>
                <td class="left"><button class="botones cancelar" id="c_cancelar">Cancelar</button></td>
            </tr>
        </table>
    </div>    
@endsection