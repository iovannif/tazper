@extends('Admin.lay.Show')

<style>	
	/* sin detalle */
</style>

@section('titulo')
    Personal
@endsection

@section('navegacion_1')
    <div id="este">
        @if($previous)
        <a href="{{URL::to('Personal/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
        @else
        <button class="boton anterior primer" id="anterior_inactivo" disabled>Anterior</button>
        @endif

        <a href="{{url('/Personal/'.$personal->Id_Per.'/edit')}}" class="modificar"><button class="boton" id="actualizar">Modificar</button></a>
        <button class="boton eliminar" id="borrar" onclick="
			if($('#user').val()!=''){
				$('#rechazo').show().delay(1500).fadeOut(0);
			}else{
				$('#confirm').css('display','block');
			}
		">Eliminar</button>
		
        @if($next)
        <a href="{{URL::to('Personal/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
        @else
        <button class="boton siguiente" id="siguiente_inactivo" disabled>Siguiente</button>
        @endif

        <a href="{{url('/Personal')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>
    </div>
@endsection

@section('contenido')
	@include('Admin.Personal.session_div.show')
    <table id="principal">
		<tr>
            <td><label for="id_per">Id de personal:</label></td>
            <td><input type="text" size="4" value="{{$personal->Id_Per}}" disabled></td>
        </tr>

		<tr>
			<td><label for="nombres">Nombres:</label></td>
			<td><input type="text" size="20" value="{{$personal->Per_Nom}}" disabled></td>
		</tr>

		<tr>
			<td><label for="apellidos">Apellidos:</label></td>
			<td><input type="text" size="20" value="{{$personal->Per_Ape}}" disabled></td>
		</tr>

		<tr>
			<td><label for="ci">CI:</label></td>
			<td><input type="text" size="15" value="{{$personal->Per_CI}}" disabled></td>
		</tr>

		<tr>
			<td><label for="cargo">Cargo:</label></td>
			<td><input type="text" size="20" value="{{$personal->Per_Car}}" disabled></td>
		</tr>

		<tr>
			<td><label for="user">Username:</label></td>
			<td>
				@if($personal->Id_Usu=='')
					<input type="text" id="user" size="20" value="" disabled>
				@else
					@foreach($users as $user)
						@if($user->Id_Usu==$personal->Id_Usu)
							<input type="text" id="user" size="20" value="{{$user->Usu_User}}" disabled>
						@endif
					@endforeach
				@endif
			</td>
		</tr>

		<tr>
			<td><label for="fe_na">Fecha de nacimiento:</label></td>
			<td>
				<input type="text" id="fe_nac" size="8" value="{{date('d/m/Y', strtotime($personal->Per_FeNac))}}" disabled>
			</td>
		</tr>

		<tr>
			<td><label for="lu_na">Lugar de nacimiento:</label></td>
			<td><input type="text" size="30" value="{{$personal->Per_LugNac}}" disabled></td>
		</tr>

		<tr>
			<td><label for="edad">Edad:</label></td>
			<td>
				<input type="text" size="2" value="{{\Carbon\Carbon::now()->diffInYears($personal->Per_FeNac)}}" disabled>
			</td>
		</tr>

		<tr>
			<td><label for="nacionalidad">Nacionalidad:</label></td>
			<td><input type="text" size="20" value="{{$personal->Per_Nac}}" disabled></td>
		</tr>		

		<tr>
			<td><label for="genero">Género:</label></td>
			<td><input type="text" size="9" value="{{$personal->Per_Gen}}" disabled></td>
		</tr>

		<tr>
			<td><label for="est_civ">Estado civil:</label></td>
			<td><input type="text" size="15" value="{{$personal->Per_EstCiv}}" disabled></td>
		</tr>

		<tr>
			<td><label for="hijos">Hijos:</label></td>
			<td><input type="text" size="2" value="{{$personal->Per_Hij}}" disabled></td>
		</tr>

		<tr>
			<td><label for="telefono">Teléfono:</label></td>
			<td><input type="text" size="15" value="{{$personal->Per_Tel}}" disabled></td>
		</tr>

		<tr>
			<td><label for="celular">Celular:</label></td>
			<td><input type="text" size="15" value="{{$personal->Per_Cel}}" disabled></td>
		</tr>

		<tr>
			<td><label for="email">E-mail:</label></td>
			<td><input type="text" size="30" value="{{$personal->Per_Email}}" disabled></td>
		</tr>

		<tr>
			<td><label for="direccion">Dirección:</label></td>
			<td><input type="text" size="50" value="{{$personal->Per_Dir}}" disabled></td>
		</tr>

		<tr>
			<td><label for="ciudad">Ciudad:</label></td>
			<td><input type="text" size="30" value="{{$personal->Per_Ciu}}" disabled></td>
		</tr>

		<tr>
			<td><label for="barrio">Barrio:</label></td>
			<td><input type="text" size="30" value="{{$personal->Per_Bar}}" disabled></td>
		</tr>

		<tr>
			<td><label for="fe_ini">Inicio:</label></td>
			<td><input type="text" size="8" value="{{date('d/m/Y', strtotime($personal->Per_Ini))}}" disabled></td>
		</tr>		

		<tr>
			<td><label for="antigüedad">Antigüedad:</label></td>
			<td>
				@php
					$años=\Carbon\Carbon::now()->diffInYears($personal->Per_Ini);
					$y_meses=floor(\Carbon\Carbon::now()->diffInMonths($personal->Per_Ini)%12);

					if($años==1){
						$a='año';
					}elseif($años>1){
						$a='años';
					}

					if($y_meses==1){
						$y_m='mes';
					}elseif($y_meses>1){
						$y_m='meses';
					}

					if($años>=1 && $y_meses==0){
						echo "<input type='text' size='20' value='$años $a' disabled>";
					}elseif($años>=1 && $y_meses>0){
						echo "<input type='text' size='20' value='$años $a $y_meses $y_m' disabled>";
					}

					if($años==0){
						$meses=\Carbon\Carbon::now()->diffInMonths($personal->Per_Ini);

						if($meses==1){
							$m='mes';
						}elseif($meses>1){
							$m='meses';
						}

						if($meses>0){
							echo "<input type='text' size='20' value='$meses $m' disabled>";
						}
					}

					if($años==0 && $meses==0){
						$semanas=\Carbon\Carbon::now()->diffInWeeks($personal->Per_Ini);

						if($semanas==1){
							$s='semana';
						}elseif($semanas>1){
							$s='semanas';
						}

						if($semanas>0){
							echo "<input type='text' size='20' value='$semanas $s' disabled>";
						}
					}
					
					if($años==0 && $meses==0 && $semanas==0){
						$dias=\Carbon\Carbon::now()->diffInDays($personal->Per_Ini);
						
						if($dias==1){
							$d='día';
						}elseif($dias>1){
							$d='días';
						}

						if(!\Carbon\Carbon::now()==$personal->Per_Ini){
							echo "<input type='text' size='20' value='$dias $d' disabled>";
						}else{
							echo "<input type='text' size='20' value='Primer día' disabled>";
						}
					}
				@endphp
			</td>
		</tr>		

		<tr>
			<td><label for="turno">Turno/Horario:</label></td>
			<td><input type="text" size="60" value="{{$personal->Per_Tur}}" disabled></td>
		</tr>

		<tr>
			<td><label for="estado">Estado:</label></td>
			<td><input type="text" size="8" value="{{$personal->Per_Est}}" disabled></td>
		</tr>

		<tr>
			<td class="obs"><label for="observacion">Observación:</label></td>
			<td><textarea id="obs" cols="50" rows="4" disabled>{{$personal->Per_Obs}}</textarea></td>
		</tr>

        <tr>
            <td>&nbsp;</td>
        </tr>
	</table>
	@include('Admin.Personal.user')

	<div id="confirm">
        <table>
            <tr><td class="center" colspan="2">Está a punto de eliminar el personal, no lo podrá recuperar</td></tr>
            <tr><td class="center" colspan="2">Desea continuar?</td></tr>
            <tr>
                <td class="right">                				
				{!! Form::open(['method'=>'DELETE', 'action'=>['PersonalController@destroy', $personal->Id_Per]]) !!}
					{{csrf_field()}}
					<input class="botones confirmar" type="submit" id="confirmar" value="Confirmar">
				{!! Form::close() !!}
                </td>
                <td class="left"><button class="botones cancelar" id="cancelar">Cancelar</button></td>
            </tr>
        </table>
    </div>
@endsection

@section('navegacion_2')
    <div class="arriba">
		<a href="#"><button class="boton lista" id="arriba">Volver arriba</button></a>
    </div>
@endsection

<script src="{{asset('js/vistas/paginacion_show/personal.js')}}"></script>